<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            {{-- <div class="overflow-hidden overflow-x-auto mt-3 p-6 bg-white dark:bg-gray-800 border-b border-gray-200"> --}}

                <div class="relative overflow-auto">
                    <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    NAME
                                </th>
                                <th scope="col" class="px-6 py-3" style="max-width: 300px">
                                    DATA
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    EXPIRED
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ACCESS_TOKEN
                                </th>
                                <td class="px-6 py-4">
                                    <p class="overflow-hidden break-all whitespace-normal">
                                        {{ Auth::user()->kc_access_token }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    {{ Auth::user()->kc_access_token_expiration }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    REFRESH_TOKEN
                                </th>
                                <td class="px-6 py-4">
                                    <p class="overflow-hidden break-all whitespace-normal">
                                        {{ Auth::user()->kc_refresh_token }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    {{ Auth::user()->kc_refresh_token_expiration }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        {{-- </div> --}}

    </div>
</x-app-layout>
