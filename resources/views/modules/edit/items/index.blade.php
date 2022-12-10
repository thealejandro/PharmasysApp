<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col md:flex-row gap-4 object-center overflow-hidden">

            <div class="flex flex-col md:flex-row gap-4 md:gap-5 w-full">

                <div class="flex-1 flex flex-col gap-4 bg-white p-5 shadow-md sm:rounded-lg overflow-hidden">
                    <div class="form-control">
                        <div class="input-group">
                            <input type="text" placeholder="Search…" class="input input-bordered w-full" />
                            <button class="btn btn-square">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr class="hover">
                                    <th>1</th>
                                    <td>Quality Control Specialist</td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="hover">
                                    <th>2</th>
                                    <td>Desktop Support Technician</td>
                                </tr>
                                <!-- row 3 -->
                                <tr class="hover">
                                    <th>3</th>
                                    <td>Tax Accountant</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex-1 flex flex-col gap-4">
                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Data of item") }}</h2>
                            <div class="form-control gap-2">
                                <label class="input-group">
                                    <span>{{ __("Description") }}</span>
                                    <input type="text" placeholder="Description" class="input input-bordered" />
                                </label>
                                <label class="input-group">
                                    <span>{{ __("Category") }}</span>
                                    <input type="text" placeholder="Category" class="input input-bordered" />
                                </label>
                                <label class="input-group">
                                    <span>{{ __("Trademark") }}</span>
                                    <input type="text" placeholder="Trademark" class="input input-bordered" />
                                </label>
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
                                        <span>{{ __("Quantity") }}</span>
                                        <input type="text" placeholder="0" class="input input-bordered" />
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
                                        <span>{{ __("Quantity") }}</span>
                                        <input type="text" placeholder="0" class="input input-bordered" />
                                    </label>
                                    <label class="input-group w-full">
                                        <span>{{ __("Price") }}</span>
                                        <input type="text" placeholder="0.00" class="input input-bordered" />
                                    </label>
                                </div>
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
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success w-full">{{ __("Save") }}</button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
