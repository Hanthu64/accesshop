<div id="admin-view" class="flex flex-col">
                <p class="text-3xl font-bold mb-4 text-center">Vista de administrador</p>
                <p class="text-2xl font-bold mb-4 text-center">Lista de usuarios</p>

                <table class="min-w-full border border-gray-200 shadow-md mb-3 bg-yellow-100 rounded-md">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Nombre</th>
                        <th class="py-2 px-4 text-left">Email</th>
                    </tr>
                    </thead>
                    <tbody id="data-container">
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-yellow-300">
                            <td class="py-2 px-4">{{$user -> id}}</td>
                            <td class="py-2 px-4">{{$user -> name}}</td>
                            <td class="py-2 px-4">{{$user -> email}}</td>

                            <td class="py-2 px-4 flex justify-end">
                                <button type="submit"
                                        class="user-editor p-2 hover:bg-yellow-400 rounded-full focus:outline-none"
                                        data-userid="{{ $user->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                    </svg>
                                </button>

                                <!---->
                                <button type="button"
                                        class="user-deleter p-2 hover:bg-yellow-400 rounded-full focus:outline-none"
                                        data-userid="{{ $user->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div id="modal_backdrop"
                     class="hidden fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-500"
                     aria-hidden="true"></div>
                <div id="modal_holder" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog"
                     aria-modal="true">
                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="mx-auto p-8">
                                    <div class="flex justify-between items-center pb-3 mb-4">
                                        <h3 class="text-lg font-semibold text-gray-800">Producto</h3>
                                        <button id="cancel_icon" class="text-gray-400 hover:text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="insertFormModal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @vite('resources/js/administrator-view.js')
                @include('user-delete-modal')
            </div>
