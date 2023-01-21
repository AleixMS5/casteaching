<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__('Edicio del usuari ').$user->name}}</h2>
    </x-slot>

    <div class=" mt-10 px-4 sm:px-6 lg:px-8">


        @can('users_manage_create')

            <div class="lg:grid bg-white lg:grid-cols-12 lg:gap-x-5">
                <aside class=" py-6 px-4 sm:px-6 lg:col-span-3 lg:py-0 lg:px-4">
                    <h3 class="  py-5 text-gray-900 font-medium text-lg leading-5 ">
                        Users
                    </h3>
                    <p class="text-gray-600 text-sm mt-1">Informació Bàsica del Usuari</p>
                </aside>
                <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0">

                    <form class="px-4 py-5" data-qa="form_user_edit" action="" METHOD="POST">
                        @csrf
                        @method('PUT')
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white py-6 px-4 sm:p-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="text" name="name" id="name" value="{{$user->name}}">
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="email" name="email" id="email" value="{{$user->email}}">
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                                    <div class="mt-1">
                                        <input
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="password" name="password" id="password" >
                                    </div>

                                </div>


                                <div class=" px-4 py-3 text-right sm:px-6">
                                    <button
                                        type="submit"
                                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Modify User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endcan



    </div>

</x-casteaching-layout>
