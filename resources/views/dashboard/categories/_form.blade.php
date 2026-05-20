@if ($errors->any())
    <div class="alert alert-danger">
        <h3 class="alert-heading">Validation Error</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-floating form-floating-outline mb-6">
    <x-form.input name="name" :value="$category->name" label="Category Name" />
</div>
<div class="form-floating form-floating-outline mb-6">
    <x-form.select name="parent_id" :options="$categories->pluck('name', 'id')->toArray()" :checked="old('parent_id', $category->parent_id)" label="Parent" />
 
</div>

<div class="mb-4">
    <label for="formFile" class="form-label">category Image</label>
    <input @class(['form-control', 'is-invalid' => $errors->has('image')]) type="file" name="image" id="formFile">
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100px" class="img-fluid">
    @endif
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-floating form-floating-outline mb-6">
    <x-form.textarea name="description" label="category description" >{{ old('description', $category->description) }}</x-form.textarea>
</div>

<div class="form-floating form-floating-outline mb-6">
    <x-form.select name="status" :checked="old('status', $category->status)" :options="['active' => 'Active', 'inactive' => 'Inactive']" label="Status" />
</div>
<button type="submit" class="btn btn-primary"><?php echo $button; ?> category</button>