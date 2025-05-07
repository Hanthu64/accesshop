<form id="user-editor" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
      class="min-w-full p-4 bg-white border border-gray-200 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Rol</label>
        <select name="role" id="role" class="mt-1 p-2 w-full border rounded-md" required>
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ old('role', $user-> role) == $role ? 'selected' : '' }}>
                    {{ $role -> name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Actualizar Usuario
        </button>
    </div>
</form>

@vite(['resources/js/users-edit.js'])
