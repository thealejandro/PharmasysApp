<x-app-layout>
    <x-slot name="header">
        {{ __('Inventories') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col justify-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:flex-row">
            <div class="flex flex-col w-full px-4 py-4 overflow-hidden bg-white shadow-lg sm:rounded-lg">
                <div class="flex flex-col justify-between w-full md:flex-row">
                    <select class="w-full max-w-xs select select-ghost">
                        <option disabled selected>Sucursales</option>
                        <option>Svelte</option>
                        <option>Vue</option>
                        <option>React</option>
                    </select>

                    <div class="gap-4 form-control">
                        <div class="input-group">
                            <input type="text" placeholder="{{ __('Search items') }}" class="input input-bordered" />
                            <button class="btn btn-square">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                        <button class="btn btn-sm btn-outline">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg> --}}
                            All items
                        </button>
                    </div>
                </div>
                <div class="w-full py-4 md:py-10">
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
                <div class="shadow-lg stats">
                    <div class="stat place-items-center">
                        <div class="stat-title">Items</div>
                        <div class="stat-value">1,235</div>
                        <div class="stat-actions">
                            <button class="btn btn-sm btn-secondary">Export inventory</button>
                        </div>
                    </div>
                </div>
                <div class="shadow-lg card bg-base-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Location") }}</h2>
                        <div class="gap-2 form-control">
                            <label class="input-group">
                                <span>{{ __("Estante") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                            <label class="input-group">
                                <span>{{ __("Nivel") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                            <label class="input-group">
                                <span>{{ __("Caja") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                        </div>
                        <div class="w-full card-actions">
                            <button class="w-full btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
                <div class="shadow-lg card bg-base-100">
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
                        <div class="w-full card-actions">
                            <button class="w-full btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
                <div class="shadow-lg card bg-base-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Presentations") }}</h2>
                        <div class="flex flex-col w-full card-actions">
                            <div class="flex flex-col w-full gap-1">
                                <label class="w-full input-group">
                                    <span>{{ __("Name") }}</span>
                                    <input type="text" placeholder="Blister" class="input input-bordered" />
                                </label>
                                <label class="w-full input-group">
                                    <span>{{ __("Price") }}</span>
                                    <input type="text" placeholder="0.00" class="input input-bordered" />
                                </label>
                            </div>
                            <div class="divider"></div>
                            <div class="flex flex-col w-full gap-1">
                                <label class="w-full input-group">
                                    <span>{{ __("Name") }}</span>
                                    <input type="text" placeholder="Caja" class="input input-bordered" />
                                </label>
                                <label class="w-full input-group">
                                    <span>{{ __("Price") }}</span>
                                    <input type="text" placeholder="0.00" class="input input-bordered" />
                                </label>
                            </div>
                            <button class="w-full btn btn-success">{{ __("Save") }}</button>
                        </div>
                    </div>
                </div>
                <div class="shadow-lg card bg-base-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Others") }}</h2>
                        <div class="flex flex-col w-full card-actions">
                            <div class="flex flex-col w-full gap-1">
                                <label class="w-full input-group">
                                    <span>{{ __("Expiry") }}</span>
                                    <input type="text" placeholder="mm/aaaa" class="input input-bordered" />
                                </label>
                                <label class="w-full input-group">
                                    <span>{{ __("Stock") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered" />
                                </label>
                            </div>
                            <button class="w-full btn btn-success">{{ __("Save") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>