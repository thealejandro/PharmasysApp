<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Integrity Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 items-center overflow-hidden">

            <div class="flex justify-between w-full">
                <select class="select w-full max-w-xs">
                    <option disabled selected>Pick your favorite Simpson</option>
                    <option>Homer</option>
                    <option>Marge</option>
                    <option>Bart</option>
                    <option>Lisa</option>
                    <option>Maggie</option>
                </select>

                <div class="form-control">
                    <div class="input-group">
                        <input type="text" placeholder="Search…" class="input input-bordered" />
                        <button class="btn btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white w-full overflow-hidden md:px-6 md:py-6 shadow-xl sm:rounded-lg">
                <div class="flex flex-col md:flex-row w-full">
                    <div class="w-full flex flex-col md:flex-row md:justify-between gap-2">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col gap-3 items-center">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">
                                        Quantity initial after inventory
                                    </span>
                                </label>
                                <label class="input-group input-group-md">
                                    <span>{{ __("Number") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered input-md" />
                                </label>
                            </div>

                            <div class="stats stats-vertical lg:stats-horizontal shadow">
                                <div class="stat">
                                    <div class="stat-title">{{ __("Current Quantity") }}</div>
                                    <div class="stat-value">31</div>
                                    {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                                </div>

                                <div class="stat">
                                    <div class="stat-title">{{ __("Integrity") }}</div>
                                    <div class="stat-value">400</div>
                                    {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
