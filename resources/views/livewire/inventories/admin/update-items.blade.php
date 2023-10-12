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
