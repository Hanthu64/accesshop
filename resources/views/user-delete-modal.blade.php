<div id="user-delete-modal" class="hidden bg-black inset-0 bg-none bg-opacity-50 flex items-center justify-center z-50 opacity-0 transition-opacity duration-500">
    <!-- Modal Container -->
    <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-lg font-semibold text-gray-800">ELIMINAR USUARIO</h3>
            <button id="delete_cancel_icon" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="mb-4 text-gray-700">
            ¿Estás seguro de que quieres eliminar a este usuario?
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end space-x-2">
            <button id="cancel_button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</button>
            <form id="delete-confirm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Confirmar</button>
            </form>
        </div>
        <script>
            const deleteRouteTemplate = `{{ route('user.delete', ['user' => ':id']) }}`;
        </script>
    </div>
</div>
