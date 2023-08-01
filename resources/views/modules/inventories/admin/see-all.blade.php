<x-app-layout>
    <x-slot name="header">
        {{ __('See All Inventory') }}
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8">
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}
                {{-- </div> --}}
            <div class="flex flex-col items-center justify-center w-full gap-2 md:flex-row md:justify-between">
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

                <div class="shadow stats stats-vertical lg:stats-horizontal">
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
                        <div class="text-indigo-500 stat-value">Q1,200</div>
                        {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full gap-4 overflow-hidden bg-white shadow-xl md:px-6 md:py-6 sm:rounded-2xl">
                <h1 class="text-2xl font-bold text-center">Processed data</h1>
                {{-- <div class="flex flex-col w-full md:flex-row"> --}}
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
                    {{--
                </div> --}}
            </div>

            <div class="flex flex-col w-full gap-4 overflow-hidden bg-white shadow-xl md:px-6 md:py-6 sm:rounded-2xl">
                <h1 class="text-2xl font-bold text-center">Shipping data</h1>
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

            <div class="flex flex-col w-full gap-4 overflow-hidden bg-white shadow-xl md:px-6 md:py-6 sm:rounded-2xl">
                <h1 class="text-2xl font-bold text-center">Sales data</h1>
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