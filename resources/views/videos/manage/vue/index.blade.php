<x-casteaching-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__('Videos')}}</h2>
    </x-slot>
    <div id="vueapp">
    @can('videos_manage_create')
       <video-form></video-form>

    @endcan
    <div class=" flex flex-col at-10">

            <videos-list/>

    </div>
    </div>
</x-casteaching-layout>
