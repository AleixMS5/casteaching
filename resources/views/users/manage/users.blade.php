<x-casteaching-layout>


    <div class=" mt-10 px-4 sm:px-6 lg:px-8">




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
                                    name
                                </th>
                                <th scope="col"
                                    class=" px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                    superadmin
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                    email
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                   actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($users as $video)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$video->id}}</td>
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{$video->name}}</td>
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$video->superadmin}}</td>
                                    <td  class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">

                                        {{$video->email}}
                                    </td>

                                    <td class="whitespace-nowrap py-4 pl-3 pr-4  text-sm font-medium sm:pr-6 text-center">
                                        <a href="#"target="_blank"  class=" text-center text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <a href="/videos/{{$video->id}}"target="_blank" class=" text-center text-indigo-600 hover:text-indigo-900">Show</a>
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
