<form id="user-editor" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
      class="min-w-full p-4 bg-white border border-gray-200 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Rol</label>
        <select name="role" id="role" class="mt-1 p-2 w-full border rounded-md" required>
            @foreach($roles as $shop)
                <option value="{{ $shop }}" {{ old('role', $user-> role) == $shop ? 'selected' : '' }}>
                    {{ $shop -> name }}
                </option>
            @endforeach
        </select>
        <select name="shop" id="shop" class="hidden mt-1 p-2 w-full border rounded-md">
            <option value="">Selecciona una tienda</option>
            @foreach($shops as $shop)
                <option value="{{ $shop -> id }}" {{ old('shop', $user-> shop_id) == $shop -> id ? 'selected' : '' }}>
                    {{ $shop -> name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white hover:bg-yellow-600 rounded-md">Actualizar
            Usuario
        </button>
    </div>
</form>
