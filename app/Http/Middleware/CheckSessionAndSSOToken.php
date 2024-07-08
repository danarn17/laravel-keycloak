<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionAndSSOToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $user = Auth::user();

            if ($user) {
                $accessTokenExp = $user->kc_access_token_expiration;
                $refreshTokenExp = $user->kc_refresh_token_expkc_access_token_expiration;
                // set the interval check
                if (now()->addMinutes(5)->greaterThan($accessTokenExp)) {
                    $response = Http::asForm()->post(config('services.keycloak.base_url') . '/realms/' . config('services.keycloak.realms') . '/protocol/openid-connect/token', [
                        'refresh_token' => $user->kc_refresh_token,
                        'client_id' => config('services.keycloak.client_id'),
                        'grant_type' => 'refresh_token',
                        'client_secret' => config('services.keycloak.client_secret')
                    ]);

                    if ($response->ok()) {
                        $newTokens = $response->json();
                        $userModel = User::where('id', $user->id)->first();

                        // Update the access token and expiration dates in the database
                        $userModel->update([
                            'kc_access_token' => $newTokens['access_token'],
                            'kc_access_token_expiration' => now()->addSeconds($newTokens['expires_in']),
                            'kc_refresh_token' => $newTokens['refresh_token'], // Update if a new refresh token is issued
                            'kc_refresh_token_expiration' =>now()->addSeconds($newTokens['refresh_expires_in']), // Example: refresh token expiration
                        ]);
                    } else {
                        // Handle token refresh failure, e.g., log out the user or return an error
                        Auth::logout();
                        return redirect()->route('login')->withErrors(['message' => 'Session expired. Please log in again.']);
                    }
                }
            }
        }
        return $next($request);
    }
}
