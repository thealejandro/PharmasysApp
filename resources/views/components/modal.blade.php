{{ $button }}

<div id="{{ $id }}" class="modal w-full items-start pt-10">
    <div class="modal-box md:w-2/3 w-[90%] h-[90%] max-w-full">
        {{ $content ?? '' }}
    </div>
    <div class="modal-action">
        {{ $actions ?? '' }}
        <a href="#" class="btn btn-circle bg-red-700">X</a>
    </div>
</div>
