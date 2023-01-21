<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__('Users')}}</h2>
    </x-slot>

    <div class=" mt-10 px-4 sm:px-6 lg:px-8">

        <x-status></x-status>
        @can('users_manage_create')

            <div class="lg:grid bg-white lg:grid-cols-12 lg:gap-x-5">
                <aside class=" py-6 px-4 sm:px-6 lg:col-span-3 lg:py-0 lg:px-4">
                    <h3 class="  py-5 text-gray-900 font-medium text-lg leading-5 ">
                        Users
                    </h3>
                    <p class="text-gray-600 text-sm mt-1">Informació Bàsica del Usuari</p>
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
                                @if($loop->odd)<tr class="bg-white">

                                @else
                                    <tr class="bg-gray-50">
                                        @endif
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$video->id}}</td>
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{$video->name}}</td>
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$video->superadmin}}</td>
                                    <td  class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">

                                        {{$video->email}}
                                    </td>

                                    <td class="whitespace-nowrap py-4 pl-3 pr-4  text-sm font-medium sm:pr-6 text-center">

                                        <form class="inline" action="/manage/users/{{$video->id}}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <a href="/users/{{$video->id}}"
                                               target="_blank"
                                               class=" text-center text-indigo-600 hover:text-indigo-900"
                                               onclick="event.preventDefault();
                                            this.closest('form').submit();">edit</a>
                                        </form>
                                        <a href="/users/{{$video->id}}"target="_blank" class=" text-center text-indigo-600 hover:text-indigo-900">Show</a>
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
