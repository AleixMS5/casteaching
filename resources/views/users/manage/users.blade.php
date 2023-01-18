<x-casteaching-layout>


    <div class=" mt-10 px-4 sm:px-6 lg:px-8">

        @if(session()->has('succes'))
            <div class="rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: mini/check-circle -->
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{session('succes')}}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button"
                                    class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                <span class="sr-only">Dismiss</span>
                                <!-- Heroicon name: mini/x-mark -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @can('users_manage_create')

            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <aside class=" py-6 px-4 sm:px-6 lg:col-span-3 lg:py-0 lg:px-4">
                    <h3 class="  py-5 text-gray-900 font-medium text-lg leading-5 ">
                        Vídeos
                    </h3>
                    <p class="text-gray-600 text-sm mt-1">Informació Bàsica del video</p>
                </aside>
                <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0">

                    <form class="px-4 py-5" data-qa="form_user_create" action="" METHOD="post">
                        @csrf
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white py-6 px-4 sm:p-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="text" name="name" id="name">
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="email" name="email" id="email">
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="password" name="password" id="password">
                                    </div>

                                </div>


                                <div class=" px-4 py-3 text-right sm:px-6">
                                    <button
                                        type="submit"
                                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Create User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                                        <form  class="inline" action="/manage/users/{{$video->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/users/{{$video->id}}"
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
