<x-casteaching-layout>


    <div class=" mt-10 px-4 sm:px-6 lg:px-8">
        @can('videos_manage_create')
            <div class="bg-white ">
                <div class="p-6" >
                    <h3 class="text-gray-900 font-medium text-lg leading-5 ">
                        Vídeos
                    </h3>
                    <p class="text-gray-600 text-sm mt-1">Informació Bàsica del video</p>
                </div>
                <form class="p-6" data-qa="form_video_create" action="" METHOD="post">
                    <label for="title">Tilte</label>
                    <input type="text" name="title" id="title">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" id="description" rows="10" cols="10"></textarea>
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url">
                    <button>Create Video</button>
                </form>
            </div>
        @endcan
        <div class="mt-8 flex flex-col">
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
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                    url
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                    actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($videos as $video)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$video->id}}</td>
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{$video->title}}</td>
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$video->description}}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">
                                        <a href="{{$video->url}}"
                                           target="_blank"
                                           class="text-indigo-600 hover:text-indigo-900">{{$video->url}}</a>
                                    </td>

                                    <td class="whitespace-nowrap py-4 pl-3 pr-4  text-sm font-medium sm:pr-6 text-center">
                                        <a href="#" target="_blank"
                                           class=" text-center text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <a href="/videos/{{$video->id}}" target="_blank"
                                           class=" text-center text-indigo-600 hover:text-indigo-900">Show</a>
                                        <a href="#"
                                           target="_blank" class=" text-center text-indigo-600 hover:text-indigo-900">Delete</a>
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
