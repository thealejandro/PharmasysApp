<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col md:flex-row gap-4 justify-center overflow-hidden">
            <div class="flex flex-col bg-white w-full px-4 py-4 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="flex flex-col md:flex-row w-full justify-between">
                    <select class="select select-ghost w-full max-w-xs">
                        <option disabled selected>Sucursales</option>
                        <option>Svelte</option>
                        <option>Vue</option>
                        <option>React</option>
                    </select>

                    <div class="form-control">
                        <div class="input-group">
                            <input type="text" placeholder="{{ __('Search items') }}" class="input input-bordered" />
                            <button class="btn btn-square">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full md:py-10 py-4">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Cantidad 2</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div class="stats shadow-lg">
                    <div class="stat place-items-center">
                        <div class="stat-title">Items</div>
                        <div class="stat-value">1,235</div>
                        <div class="stat-actions">
                            <button class="btn btn-sm btn-secondary">Export inventory</button>
                        </div>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Prices") }}</h2>
                        <div class="form-control">
                            <label class="input-group">
                                <span>{{ __("Purchase") }}</span>
                                <input type="text" placeholder="0.00" class="input input-bordered" />
                            </label>
                            <div class="divider"></div>
                            <div class="form-control">
                                <label class="input-group">
                                    <span>{{ __("Sale") }}</span>
                                    <input type="text" placeholder="0.00" class="input input-bordered" />
                                </label>
                            </div>
                        </div>
                        <div class="card-actions w-full">
                            <button class="btn btn-primary w-full">Update</button>
                        </div>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Presentations") }}</h2>
                        <div class="card-actions flex flex-col w-full">
                            <div class="flex flex-col gap-1 w-full">
                                <label class="input-group w-full">
                                    <span>{{ __("Name") }}</span>
                                    <input type="text" placeholder="Blister" class="input input-bordered" />
                                </label>
                                <label class="input-group w-full">
                                    <span>{{ __("Price") }}</span>
                                    <input type="text" placeholder="0.00" class="input input-bordered" />
                                </label>
                            </div>
                            <div class="divider"></div>
                            <div class="flex flex-col gap-1 w-full">
                                <label class="input-group w-full">
                                    <span>{{ __("Name") }}</span>
                                    <input type="text" placeholder="Caja" class="input input-bordered" />
                                </label>
                                <label class="input-group w-full">
                                    <span>{{ __("Price") }}</span>
                                    <input type="text" placeholder="0.00" class="input input-bordered" />
                                </label>
                            </div>
                            <button class="btn btn-success w-full">{{ __("Save") }}</button>
                        </div>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Others") }}</h2>
                        <div class="card-actions flex flex-col w-full">
                            <div class="flex flex-col gap-1 w-full">
                                <label class="input-group w-full">
                                    <span>{{ __("Expiry") }}</span>
                                    <input type="text" placeholder="mm/aaaa" class="input input-bordered" />
                                </label>
                                <label class="input-group w-full">
                                    <span>{{ __("Stock") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered" />
                                </label>
                            </div>
                            <button class="btn btn-success w-full">{{ __("Save") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
