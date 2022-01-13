<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchases') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- component -->
                <div class="w-full mx-auto px-4 py-4">
                    <input type="search" placeholder="{{ __('Search') }}" class="w-full rounded-full">
                    <div class="w-full">
                        <div class="z-10 fixed w-full bg-indigo-400">
                            <table class="table-auto">
                                <thead>
                                    <tr>
                                        <td>{{ __('CodeBar') }}</td>
                                        <td>{{ __('Item') }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12345</td>
                                        <td>Category - Item Name - Laboratory</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="sm:flex">
                    <div class="w-full mx-auto p-6 sm:py-0 sm:pb-4">
                        <div class="flex flex-col">
                            <div class="bg-indigo-400">
                                Hello
                            </div>
                            <div class="bg-indigo-400">
                                Hello
                            </div>
                            <div class="bg-indigo-400">
                                Hello
                            </div>
                            <div class="bg-indigo-400">
                                Hello
                            </div>
                        </div>
                    </div>
                <!-- component -->
                    <section class="w-full mx-auto p-6 sm:py-0 sm:pb-4">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Age</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Date</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-black">Sufyan</p>
                                                <p class="text-xs text-gray-600">Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-ms font-semibold border">22</td>
                                    <td class="px-4 py-3 text-xs border">
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Acceptable </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm border">6/4/2000</td>
                                </tr>
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <div class="relative w-8 h-8 mr-3 rounded-full">
                                                <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-black">Stevens</p>
                                                <p class="text-xs text-gray-600">Programmer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-md font-semibold border">27</td>
                                    <td class="px-4 py-3 text-xs border">
                                        <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-gray-100 rounded-sm"> Pending </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm border">6/10/2020</td>
                                </tr>
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <div class="relative w-8 h-8 mr-3 rounded-full">
                                                <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">Nora</p>
                                                <p class="text-xs text-gray-600">Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-md font-semibold border">17</td>
                                    <td class="px-4 py-3 text-xs border">
                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm"> Nnacceptable </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm border">6/10/2020</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
