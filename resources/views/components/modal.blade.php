{{ $button }}

<div id="{{ $id }}" class="modal w-full items-start pt-10">
    <div class="modal-box lg:w-1/2 md:w-2/3 w-[90%] max-w-full">
        {{ $content ?? '' }}
        <div class="modal-action">
            {{ $actions ?? '' }}
            <a href="#" class="btn">Cerrar</a>
        </div>
    </div>
</div>
