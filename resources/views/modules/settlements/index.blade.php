<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Module Settlements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 md:gap-6 object-center overflow-hidden">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}

                <div class="flex flex-col gap-4 md:gap-6 bg-white w-full overflow-hidden items-center justify-center p-5 shadow-md sm:rounded-lg">
                    {{-- <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-center"> --}}
                        <article class="prose">
                            <h1>Settlement of Money</h1>
                        </article>
                        <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full overflow-hidden items-center ">
                            {{-- Sucursal --}}
                            <div class="flex-1 form-control gap-2 md:gap-4">
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
                                <button class="btn btn-info text-white">
                                    Search
                                </button>
                            </div>


                            <div class="flex-1 stats stats-vertical shadow">

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

                            <div class="flex-1 stats stats-vertical shadow">
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

                            <div class="flex-1 form-control gap-4">
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total money in market</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total money count</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <button class="btn btn-accent">Save</button>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>

                <div class="flex flex-col gap-4 md:gap-6 bg-white w-full overflow-hidden items-center justify-center p-5 shadow-md sm:rounded-lg">
                    {{-- <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-center"> --}}
                        <article class="prose">
                            <h1>Settlement of Telephonies</h1>
                        </article>
                        <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full overflow-hidden items-center ">
                            {{-- Sucursal --}}
                            <div class="flex-1 form-control gap-2 md:gap-4">
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
                                <button class="btn btn-info text-white">
                                    Search
                                </button>
                            </div>


                            <div class="flex-1 stats stats-vertical shadow">

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

                            <div class="flex-1 stats stats-vertical shadow">
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

                            <div class="flex-1 form-control gap-4">
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total money in market</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total money count</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <button class="btn btn-accent">Save</button>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>

                <div class="flex flex-col gap-4 md:gap-6 bg-white w-full overflow-hidden items-center justify-center p-5 shadow-md sm:rounded-lg">
                    {{-- <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-center"> --}}
                        <article class="prose">
                            <h1>Settlement of Copy</h1>
                        </article>
                        <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full overflow-hidden items-center ">
                            {{-- Sucursal --}}
                            <div class="flex-1 form-control gap-2 md:gap-4">
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
                                <button class="btn btn-info text-white">
                                    Search
                                </button>
                            </div>


                            <div class="flex-1 stats stats-vertical shadow">

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

                            <div class="flex-1 stats stats-vertical shadow">
                                <div class="stat">
                                    <div class="stat-title">Total money copy</div>
                                    <div class="stat-value">1,200</div>
                                    <div class="stat-desc">↘︎ 90 (14%)</div>
                                  </div>
                            </div>

                            <div class="flex-1 form-control gap-4">
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total copy letter</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total copy legal</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total bad copy</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                      <span class="label-text">Total copy with discount</span>
                                    </label>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                  </div>

                                  <button class="btn btn-accent">Save</button>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>

            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
