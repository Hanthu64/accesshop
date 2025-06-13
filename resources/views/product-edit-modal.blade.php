<form id="product-editor" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="min-w-full p-4 bg-white border border-gray-200 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product -> name) }}" class="mt-1 p-2 w-full border rounded-md" required>
        @error('name')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        @if($product->image)
            <label>Imagen actual</label>
            <img src="{{ ($product->image) }}" alt="Imagen de perfil">
        @endif
        <label for="image" class="block text-sm font-medium text-gray-700 my-4">Imagen</label>
        <input type="file" name="image" accept="image/*">
        @error('image')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
        <input type="text" id="description" name="description" value="{{ old('description', $product -> description) }}" class="mt-1 p-2 w-full border rounded-md" required>
        @error('description')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
        <input type="text" id="price" name="price" value="{{ old('price', $product -> pivot -> price) }}" class="mt-1 p-2 w-full border rounded-md" required>
        @error('price')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label>Valoración</label>
        <select name="rating" id="rating" class="mt-1 p-2 w-full border rounded-md" required>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ old('rating', $product-> pivot -> rating) == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
    </div>

    <div class="mb-4">
        <label for="link" class="block text-sm font-medium text-gray-700">Enlace</label>
        <input type="text" id="link" name="link" value="{{ old('link', $product -> pivot -> product_link) }}" class="mt-1 p-2 w-full border rounded-md" required>
        @error('link')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mt-6">
        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Actualizar Producto</button>
    </div>
</form>
