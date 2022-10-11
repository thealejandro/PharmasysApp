<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('See All Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 items-center overflow-hidden">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
            {{-- </div> --}}
            <div class="flex flex-col md:flex-row w-full gap-2 justify-center items-center md:justify-between">
                <div class="form-control">
                    <div class="input-group">
                        <select class="select select-bordered">
                            <option disabled selected>Sucursal</option>
                            <option>T-shirts</option>
                            <option>Mugs</option>
                        </select>
                        <button class="btn">Run</button>
                    </div>
                </div>

                <div class="stats stats-vertical lg:stats-horizontal shadow">
                    <div class="stat">
                        <div class="stat-title">Shipping</div>
                        <div class="stat-value text-sky-500">380</div>
                        {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                    </div>

                    <div class="stat">
                        <div class="stat-title">Sales</div>
                        <div class="stat-value text-sky-500">450</div>
                        {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                    </div>

                    <div class="stat">
                        <div class="stat-title">Total money</div>
                        <div class="stat-value text-indigo-500">Q1,200</div>
                        {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 bg-white w-full overflow-hidden md:px-6 md:py-6 shadow-xl sm:rounded-2xl">
                <h1 class="font-bold text-center text-2xl">Processed data</h1>
                {{-- <div class="flex flex-col md:flex-row w-full"> --}}
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>{{ __("Code") }}</th>
                                <th>{{ __("Product") }}</th>
                                <th>{{ __("Quantity") }}</th>
                                <th>{{ __("System") }}</th>
                                <th>{{ __("Difference")}}</th>
                                <th>{{ __("Cost") }}</th>
                                <th>{{ __("Total") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr class="hover">
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr class="hover">
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 3 -->
                            <tr class="hover">
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                {{-- </div> --}}
            </div>

            <div class="flex flex-col gap-4 bg-white w-full overflow-hidden md:px-6 md:py-6 shadow-xl sm:rounded-2xl">
                <h1 class="font-bold text-center text-2xl">Shipping data</h1>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>{{ __("Code") }}</th>
                            <th>{{ __("Product") }}</th>
                            <th>{{ __("Quantity") }}</th>
                            <th>{{ __("System") }}</th>
                            <th>{{ __("Difference")}}</th>
                            <th>{{ __("Cost") }}</th>
                            <th>{{ __("Total") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        <tr class="hover">
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr class="hover">
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 3 -->
                        <tr class="hover">
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col gap-4 bg-white w-full overflow-hidden md:px-6 md:py-6 shadow-xl sm:rounded-2xl">
                <h1 class="font-bold text-center text-2xl">Sales data</h1>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>{{ __("Code") }}</th>
                            <th>{{ __("Product") }}</th>
                            <th>{{ __("Quantity") }}</th>
                            <th>{{ __("System") }}</th>
                            <th>{{ __("Difference")}}</th>
                            <th>{{ __("Cost") }}</th>
                            <th>{{ __("Total") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        <tr class="hover">
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr class="hover">
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 3 -->
                        <tr class="hover">
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
