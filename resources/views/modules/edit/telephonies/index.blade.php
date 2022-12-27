<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Telephonies and Phones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 md:gap-12 object-center overflow-hidden">

            <div class="flex flex-col gap-4">
                <article class="prose">
                    <h1>Telephonies</h1>
                </article>

                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex flex-1 flex-col gap-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Telephonie #1") }}</h2>
                                <div class="form-control gap-2">
                                    <label class="input-group">
                                        <span>{{ __("Name") }}</span>
                                        <input type="text" placeholder="Name" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Contact") }}</span>
                                        <input type="text" placeholder="Category" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Phone") }}</span>
                                        <input type="text" placeholder="Trademark" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success w-full">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-1 flex-col gap-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Telephonie #2") }}</h2>
                                <div class="form-control gap-2">
                                    <label class="input-group">
                                        <span>{{ __("Name") }}</span>
                                        <input type="text" placeholder="Name" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Contact") }}</span>
                                        <input type="text" placeholder="Category" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Phone") }}</span>
                                        <input type="text" placeholder="Trademark" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success w-full">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-1 flex-col gap-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Telephonie #3") }}</h2>
                                <div class="form-control gap-2">
                                    <label class="input-group">
                                        <span>{{ __("Name") }}</span>
                                        <input type="text" placeholder="Name" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Contact") }}</span>
                                        <input type="text" placeholder="Category" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Phone") }}</span>
                                        <input type="text" placeholder="Trademark" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success w-full">{{ __("Save") }}</button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 overflow-hidden">
                <article class="prose">
                    <h1>Phones</h1>
                </article>

                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex flex-1 flex-col gap-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Phone #1") }}</h2>
                                <div class="form-control gap-2">
                                    <label class="input-group">
                                        <span>{{ __("Number") }}</span>
                                        <input type="text" placeholder="Number" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Telephonie") }}</span>
                                        <input type="text" placeholder="Telephonie" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Market") }}</span>
                                        <input type="text" placeholder="Market" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success w-full">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-1 flex-col gap-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Phone #2") }}</h2>
                                <div class="form-control gap-2">
                                    <label class="input-group">
                                        <span>{{ __("Number") }}</span>
                                        <input type="text" placeholder="Number" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Telephonie") }}</span>
                                        <input type="text" placeholder="Telephonie" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Market") }}</span>
                                        <input type="text" placeholder="Market" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success w-full">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-1 flex-col gap-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Phone #3") }}</h2>
                                <div class="form-control gap-2">
                                    <label class="input-group">
                                        <span>{{ __("Number") }}</span>
                                        <input type="text" placeholder="Number" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Telephonie") }}</span>
                                        <input type="text" placeholder="Telephonie" class="input input-bordered" />
                                    </label>
                                    <label class="input-group">
                                        <span>{{ __("Market") }}</span>
                                        <input type="text" placeholder="Market" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success w-full">{{ __("Save") }}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
