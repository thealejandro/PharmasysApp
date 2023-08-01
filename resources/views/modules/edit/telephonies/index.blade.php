<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Telephonies and Phones') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:gap-12">

            <div class="flex flex-col gap-4">
                <article class="prose">
                    <h1>Telephonies</h1>
                </article>

                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex flex-col flex-1 gap-4">
                        <div class="shadow-lg card bg-base-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Telephonie #1") }}</h2>
                                <div class="gap-2 form-control">
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

                        <button class="w-full btn btn-success">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-col flex-1 gap-4">
                        <div class="shadow-lg card bg-base-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Telephonie #2") }}</h2>
                                <div class="gap-2 form-control">
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

                        <button class="w-full btn btn-success">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-col flex-1 gap-4">
                        <div class="shadow-lg card bg-base-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Telephonie #3") }}</h2>
                                <div class="gap-2 form-control">
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

                        <button class="w-full btn btn-success">{{ __("Save") }}</button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 overflow-hidden">
                <article class="prose">
                    <h1>Phones</h1>
                </article>

                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex flex-col flex-1 gap-4">
                        <div class="shadow-lg card bg-base-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Phone #1") }}</h2>
                                <div class="gap-2 form-control">
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

                        <button class="w-full btn btn-success">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-col flex-1 gap-4">
                        <div class="shadow-lg card bg-base-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Phone #2") }}</h2>
                                <div class="gap-2 form-control">
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

                        <button class="w-full btn btn-success">{{ __("Save") }}</button>
                    </div>

                    <div class="flex flex-col flex-1 gap-4">
                        <div class="shadow-lg card bg-base-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ __("Phone #3") }}</h2>
                                <div class="gap-2 form-control">
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

                        <button class="w-full btn btn-success">{{ __("Save") }}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>