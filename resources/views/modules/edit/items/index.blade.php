<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Items') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:flex-row">

            <div class="flex flex-col w-full gap-4 md:flex-row md:gap-5">

                <div class="flex flex-col flex-1 gap-4 p-5 overflow-hidden bg-white shadow-md sm:rounded-lg">
                    <div class="form-control">
                        <div class="input-group">
                            <input type="text" placeholder="Search…" class="w-full input input-bordered" />
                            <button class="btn btn-square">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
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

                <div class="flex flex-col flex-1 gap-4">
                    <div class="shadow-lg card bg-base-100">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Data of item") }}</h2>
                            <div class="gap-2 form-control">
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

                    <button class="w-full btn btn-success">{{ __("Save") }}</button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>