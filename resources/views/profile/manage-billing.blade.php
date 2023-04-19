<x-jet-action-section>
    <x-slot name="title">
        {{__('billing')}}
    </x-slot>
    <x-slot name="description">
        {{__('billing')}}
    </x-slot>

    <x-slot name="content">
        <a href="{{route('kanuu.redirect',Auth::user())}}">
            <x-jet-button href="">
                {{__('Manage subscription')}}
            </x-jet-button>
        </a>

    </x-slot>
</x-jet-action-section>
