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
    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name" value="{{old('name', $category->name)}}" id="basic-default-fullname"
        placeholder="John Doe" />
    <label for="basic-default-fullname">Category Name</label>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-floating form-floating-outline mb-6">
    <select @class(['form-select', 'is-invalid' => $errors->has('parent_id')]) id="parentFormControlSelect1" name="parent_id" aria-label="Default select parent">
        <option selected="selected" disabled>Open this select category</option>
        @forelse($categories as $cat)
            <option @selected(old('parent_id', $category->parent_id) == $cat->id) value="{{ $cat->id }}">{{ $cat->name }}</option>
        @empty
            <option value="" disabled selected>None</option>
        @endforelse
    </select>
    @error('parent_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <label for="parentFormControlSelect1">Parent</label>
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
    <textarea @class(['form-control', 'is-invalid' => $errors->has('description')]) id="exampleFormControlTextarea1" name="description" rows="3"
        placeholder="Description here...">{{ old('description', $category->description) }}</textarea>
    <label for="exampleFormControlTextarea1">category description</label>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-floating form-floating-outline mb-6">
    <select @class(['form-select', 'is-invalid' => $errors->has('status')]) id="parentFormControlSelect1" name="status" aria-label="Default select parent">
        <option selected="selected" disabled>Open this select status</option>
        <option @if (old('status', $category->status) == 'active') selected="selected" @endif value="active">active</option>
        <option @if (old('status', $category->status) == 'inactive') selected="selected" @endif value="inactive">in-active</option>

    </select>
    <label for="parentFormControlSelect1">status</label>
</div>
<button type="submit" class="btn btn-primary"><?php echo $button; ?> category</button>