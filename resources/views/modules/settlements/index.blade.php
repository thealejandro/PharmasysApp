<x-app-layout>
    <x-slot name="header">
        {{ __('Module Settlements') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:gap-6">
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}

                <div
                    class="flex flex-col items-center justify-center w-full gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
                    {{-- <div class="flex flex-col items-center justify-center gap-4 md:flex-row md:gap-6"> --}}
                        <article class="prose">
                            <h1>Settlement of Money</h1>
                        </article>
                        <div class="flex flex-col items-center w-full gap-4 overflow-hidden md:flex-row md:gap-6 ">
                            {{-- Sucursal --}}
                            <div class="flex-1 gap-2 form-control md:gap-4">
                                <label class="label">
                                    <span class="label-text-alt">Market</span>
                                </label>
                                <select class="select select-bordered">
                                    <option disabled selected>Seleccione una sucursal</option>
                                    <option>Star Wars</option>
                                    <option>Harry Potter</option>
                                    <option>Lord of the Rings</option>
                                    <option>Planet of the Apes</option>
                                    <option>Star Trek</option>
                                </select>
                                <button class="text-white btn btn-info">
                                    Search
                                </button>
                            </div>


                            <div class="flex-1 shadow stats stats-vertical">

                                <div class="stat">
                                    <div class="stat-title">Total Sales</div>
                                    <div class="stat-value">31K</div>
                                    <div class="stat-desc">Jan 1st - Feb 1st</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">Total Sales Countable</div>
                                    <div class="stat-value">4,200</div>
                                    <div class="stat-desc">↗︎ 400 (22%)</div>
                                </div>

                            </div>

                            <div class="flex-1 shadow stats stats-vertical">
                                <div class="stat">
                                    <div class="stat-title">Total Sales Uncountable</div>
                                    <div class="stat-value">1,200</div>
                                    <div class="stat-desc">↘︎ 90 (14%)</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">Recovery</div>
                                    <div class="stat-value">1,200</div>
                                    <div class="stat-desc">↘︎ 90 (14%)</div>
                                </div>
                            </div>

                            <div class="flex-1 gap-4 form-control">
                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total money in market</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total money count</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <button class="btn btn-accent">Save</button>
                            </div>
                        </div>
                        {{--
                    </div> --}}
                </div>

                <div
                    class="flex flex-col items-center justify-center w-full gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
                    {{-- <div class="flex flex-col items-center justify-center gap-4 md:flex-row md:gap-6"> --}}
                        <article class="prose">
                            <h1>Settlement of Telephonies</h1>
                        </article>
                        <div class="flex flex-col items-center w-full gap-4 overflow-hidden md:flex-row md:gap-6 ">
                            {{-- Sucursal --}}
                            <div class="flex-1 gap-2 form-control md:gap-4">
                                <label class="label">
                                    <span class="label-text-alt">Market</span>
                                </label>
                                <select class="select select-bordered">
                                    <option disabled selected>Seleccione una sucursal</option>
                                    <option>Star Wars</option>
                                    <option>Harry Potter</option>
                                    <option>Lord of the Rings</option>
                                    <option>Planet of the Apes</option>
                                    <option>Star Trek</option>
                                </select>
                                <button class="text-white btn btn-info">
                                    Search
                                </button>
                            </div>


                            <div class="flex-1 shadow stats stats-vertical">

                                <div class="stat">
                                    <div class="stat-title">Total Sales</div>
                                    <div class="stat-value">31K</div>
                                    <div class="stat-desc">Jan 1st - Feb 1st</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">Total Sales Countable</div>
                                    <div class="stat-value">4,200</div>
                                    <div class="stat-desc">↗︎ 400 (22%)</div>
                                </div>

                            </div>

                            <div class="flex-1 shadow stats stats-vertical">
                                <div class="stat">
                                    <div class="stat-title">Total Sales Uncountable</div>
                                    <div class="stat-value">1,200</div>
                                    <div class="stat-desc">↘︎ 90 (14%)</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">Recovery</div>
                                    <div class="stat-value">1,200</div>
                                    <div class="stat-desc">↘︎ 90 (14%)</div>
                                </div>
                            </div>

                            <div class="flex-1 gap-4 form-control">
                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total money in market</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total money count</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <button class="btn btn-accent">Save</button>
                            </div>
                        </div>
                        {{--
                    </div> --}}
                </div>

                <div
                    class="flex flex-col items-center justify-center w-full gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
                    {{-- <div class="flex flex-col items-center justify-center gap-4 md:flex-row md:gap-6"> --}}
                        <article class="prose">
                            <h1>Settlement of Copy</h1>
                        </article>
                        <div class="flex flex-col items-center w-full gap-4 overflow-hidden md:flex-row md:gap-6 ">
                            {{-- Sucursal --}}
                            <div class="flex-1 gap-2 form-control md:gap-4">
                                <label class="label">
                                    <span class="label-text-alt">Market</span>
                                </label>
                                <select class="select select-bordered">
                                    <option disabled selected>Seleccione una sucursal</option>
                                    <option>Star Wars</option>
                                    <option>Harry Potter</option>
                                    <option>Lord of the Rings</option>
                                    <option>Planet of the Apes</option>
                                    <option>Star Trek</option>
                                </select>
                                <button class="text-white btn btn-info">
                                    Search
                                </button>
                            </div>


                            <div class="flex-1 shadow stats stats-vertical">

                                <div class="stat">
                                    <div class="stat-title">Total before copy letter</div>
                                    <div class="stat-value">31K</div>
                                    <div class="stat-desc">Jan 1st - Feb 1st</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">Total before copy legal</div>
                                    <div class="stat-value">31K</div>
                                    <div class="stat-desc">Jan 1st - Feb 1st</div>
                                </div>

                            </div>

                            <div class="flex-1 shadow stats stats-vertical">
                                <div class="stat">
                                    <div class="stat-title">Total money copy</div>
                                    <div class="stat-value">1,200</div>
                                    <div class="stat-desc">↘︎ 90 (14%)</div>
                                </div>
                            </div>

                            <div class="flex-1 gap-4 form-control">
                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total copy letter</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total copy legal</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total bad copy</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <div class="w-full max-w-xs form-control">
                                    <label class="label">
                                        <span class="label-text">Total copy with discount</span>
                                    </label>
                                    <input type="text" placeholder="Type here"
                                        class="w-full max-w-xs input input-bordered" />
                                </div>

                                <button class="btn btn-accent">Save</button>
                            </div>
                        </div>
                        {{--
                    </div> --}}
                </div>

                {{--
            </div> --}}
        </div>
    </div>
</x-app-layout>