<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__('Videos')}}</h2>
    </x-slot>

    <div class=" flex flex-col at-10">
        <x-status></x-status>
        @can('videos_manage_create')

            <x-jet-form-section data-qa="form_video_create">
                <x-slot name="title">
                    {{ __('Videos') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Informacio basica del video') }}
                </x-slot>
                <x-slot name="actions">
                    <x-jet-button>
                        {{ __('Crear') }}
                    </x-jet-button>
                </x-slot>
                <x-slot name="form">

                    @csrf
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="title" value="{{ __('Title') }}"/>

                        <input
                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            type="text" name="title" id="title">
                        <x-jet-input-error for="title" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="description" value="{{ __('Description') }}"/>
                        <textarea type="text" name="description" id="description" rows="10" --}}
                                  class="block w-full  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        <x-jet-input-error for="description" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="url" value="{{ __('Url') }}"/>
                        <div class="mt-1 flex rounded-md shadow-sm">
                                                                <span
                                                                    class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                            <input
                                class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="https://www.youtube.com/watch?v=tweo3gmdha4&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=19"
                                type="url" name="url" id="url">
                        </div>
                        <x-jet-input-error for="url" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="serie" value="{{ __('Serie') }}"/>
                        <div class="mt-1 flex rounded-md shadow-sm">


                            <select id="serie" name="serie_id"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @foreach(\App\Models\Serie::all() as $series)
                                    <option value="{{$series->id}}">{{$series->title}}</option>
                                @endforeach
                            </select>

                        </div>
                        <x-jet-input-error for="serie" class="mt-2"/>
                    </div>
                    {{--                            <div class="space-y-6 bg-white py-6 px-4 sm:p-6">--}}
                    {{--                                <div>--}}
                    {{--                                    <label class="block text-sm font-medium text-gray-700" for="title">Tilte</label>--}}
                    {{--                                    <div class="mt-1">--}}
                    {{--                                        <input--}}
                    {{--                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"--}}
                    {{--                                            type="text" name="title" id="title">--}}
                    {{--                                    </div>--}}

                    {{--                                </div>--}}
                    {{--                                <div>--}}
                    {{--                                    <label class="block text-sm font-medium text-gray-700"--}}
                    {{--                                           for="description">Description</label>--}}
                    {{--                                    <div class="mt-1">--}}
                    {{--                            <textarea type="text" name="description" id="description" rows="10"--}}
                    {{--                                      class="block w-full  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>--}}
                    {{--                                    </div>--}}

                    {{--                                </div>--}}
                    {{--                                <div>--}}
                    {{--                                    <label class="block text-sm font-medium text-gray-700" for="url">URL</label>--}}
                    {{--                                    <div class="mt-1 flex rounded-md shadow-sm">--}}
                    {{--                                    <span--}}
                    {{--                                        class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>--}}
                    {{--                                        <input--}}
                    {{--                                            class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"--}}
                    {{--                                            placeholder="https://www.youtube.com/watch?v=tweo3gmdha4&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=19"--}}
                    {{--                                            type="url" name="url" id="url">--}}
                    {{--                                    </div>--}}

                    {{--                                </div>--}}

                    {{--                                <div>--}}
                    {{--                                    <label class="block text-sm font-medium text-gray-700" for="url">Serie</label>--}}
                    {{--                                    <div class="mt-1 flex rounded-md shadow-sm">--}}


                    {{--                                        <select id="serie" name="serie_id" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">--}}
                    {{--                                            @foreach(\App\Models\Serie::all() as $series)--}}
                    {{--                                                <option value="{{$series->id}}">{{$series->title}}</option>--}}
                    {{--                                            @endforeach--}}
                    {{--                                        </select>--}}

                    {{--                                    </div>--}}

                    {{--                                </div>--}}


                    {{--                            </div>--}}


                </x-slot>


            </x-jet-form-section>
            <div class="lg:grid bg-white md:bg-transparent  lg:grid-cols-12 lg:gap-x-5 mt-5">
                <aside class=" py-6 px-4 sm:px-6 lg:col-span-3 lg:py-0 lg:px-4">
                    <h3 class="  py-5 text-gray-900 font-medium text-lg leading-5 ">
                        Vídeos
                    </h3>
                    <p class="text-gray-600 text-sm mt-1">Informació Bàsica del video</p>
                </aside>
                <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0">

                    <form class="px-4 py-5" data-qa="form_video_create" action="" METHOD="post">
                        @csrf
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white py-6 px-4 sm:p-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="title">Tilte</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="text" name="title" id="title">
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700"
                                           for="description">Description</label>
                                    <div class="mt-1">
                            <textarea type="text" name="description" id="description" rows="10"
                                      class="block w-full  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="url">URL</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                                        <input
                                            class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="https://www.youtube.com/watch?v=tweo3gmdha4&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=19"
                                            type="url" name="url" id="url">
                                    </div>

                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="url">Serie</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">


                                        <select id="serie" name="serie_id"
                                                class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            @foreach(\App\Models\Serie::all() as $series)
                                                <option value="{{$series->id}}">{{$series->title}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>

                                <div class=" px-4 py-3 text-right sm:px-6">
                                    <button
                                        type="submit"
                                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Create Video
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
        <div class=" px-4  mt-8 flex flex-col ">
            <div class="-my-2  overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class=" bg-gray-50 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div class=" bg-gray-50 mt-2 ml-5 sm:flex-auto">
                            <h1 class="bg-gray-50 text-xl font-semibold text-gray-900">Videos</h1>

                        </div>
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">id
                                </th>
                                <th scope="col"
                                    class=" px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                    Title
                                </th>
                                <th scope="col"
                                    class=" px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                    description
                                </th>
                                <th scope="col"
                                    class=" px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                    serie
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left  text-sm font-semibold text-gray-900">
                                    url
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left  text-sm font-semibold text-gray-900">
                                    actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($videos as $video)
                                @if($loop->odd)
                                    <tr class="bg-white">

                                @else
                                    <tr class="bg-gray-50">
                                        @endif

                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$video->id}}</td>
                                        <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{$video->title}}</td>
                                        <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$video->description}}</td>
                                        <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ optional($video->serie)->title}}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">
                                            <a href="{{$video->url}}"
                                               target="_blank"
                                               class="text-indigo-600 hover:text-indigo-900">{{$video->url}}</a>
                                        </td>

                                        <td class="whitespace-nowrap py-4 pl-3 pr-4  text-sm font-medium sm:pr-6 text-center">


                                            <a href="/manage/videos/{{$video->id}}" target="_blank"
                                               class=" text-center text-indigo-600 hover:text-indigo-900">edit</a>
                                            <a href="/videos/{{$video->id}}" target="_blank"
                                               class=" text-center text-indigo-600 hover:text-indigo-900">Show</a>
                                            <form class="inline" action="/manage/videos/{{$video->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="/videos/{{$video->id}}"
                                                   target="_blank"
                                                   class=" text-center text-indigo-600 hover:text-indigo-900"
                                                   onclick="event.preventDefault();
                                            this.closest('form').submit();">Delete</a>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach


                                    <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-casteaching-layout>
