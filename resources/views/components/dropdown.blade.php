@props(['trigger'])

<div x-data="{show:false}" @click.away="show=false">

    <div @click="show = !show">

        {{$trigger}}

    </div>

    <div x-show="show" class="py-2 absolute w-full bg-gray-100 rounded-xl mt-2 overflow-auto max-h-52">

        {{$slot}}

    </div>
</div>