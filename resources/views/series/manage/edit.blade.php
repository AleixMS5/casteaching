<x-casteaching-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $serie->title }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-10">

        <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">

            @can('series_manage_create')

                <x-jet-form-section data-qa="form_serie_edit">
                    <x-slot name="title">
                        {{ __('Series') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('informasio basica de la serie') }}
                    </x-slot>
                    <x-slot name="actions">
                        <x-jet-button>
                            {{ __('save') }}
                        </x-jet-button>
                    </x-slot>
                    <x-slot name="form">

                        @csrf
                        @method('PUT')
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="title" value="{{ __('Title') }}"/>

                            <input
                                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                type="text" name="title" id="title" value="{{$serie->title}}">
                            <x-jet-input-error for="title" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}"/>
                            <textarea type="text" name="description" id="description" rows="10"
                                      class="block w-full  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{$serie->description}}</textarea>
                            <x-jet-input-error for="description" class="mt-2"/>
                        </div>
                    </x-slot>


                </x-jet-form-section>

                <x-jet-section-border/>

                <x-jet-form-section action="/manage/series/image/{{$serie->id}}" data-qa="form_serie_image_edit"
                                    enctype="multipart/form-data">
                    <x-slot name="title">
                        {{ __('Imatge de la serie') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('aqui podeu modificar la imatge de la serie') }}
                    </x-slot>

                    <x-slot name="form">
                        @csrf
                        @method('PUT')
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="image" value="{{ __('Imatge') }}" />

                            <div x-data="{imageName: null, imagePreview: null}" class="col-span-6 sm:col-span-4">
                                <!-- Profile Photo File Input -->
                                <input type="file" class="hidden"
                                       name="image"
                                       x-ref="image"
                                       x-on:change="
                                    imageName = $refs.image.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        imagePreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.image.files[0]);
                            " />

                                <!-- Current Serie Image -->
                                <div class="mt-2" x-show="! imagePreview">
                                    <img class="h-48 w-full object-cover" src="/storage/{{$serie->image_url}}" alt="">
                                </div>

                                <!-- New Serie Image Preview -->
                                <div class="mt-2" x-show="imagePreview">
                                    <span class="block h-48 bg-cover bg-no-repeat bg-center"
                                          x-bind:style="'background-image: url(\'' + imagePreview + '\');'">
                                    </span>
                                </div>

                                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.image.click()">
                                    {{ __('Escolliu una imatge') }}
                                </x-jet-secondary-button>

                                @if ($serie->image )
                                    {{--                                    // TODO LIVEWIRE                        --}}
                                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                        {{ __('Eliminar') }}
                                    </x-jet-secondary-button>
                                @endif

                                <x-jet-input-error for="image" class="mt-2" />
                            </div>
                        </div>


                    </x-slot>

                    <x-slot name="actions">


                        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                            {{ __('Save') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-form-section>

            @endcan

        </div>
    </div>

</x-casteaching-layout>
