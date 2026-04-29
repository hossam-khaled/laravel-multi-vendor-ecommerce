@extends('layouts.dashboard')
@section('title', 'Edit category')
@section('content')
    <div class="row mb-6 gy-6">
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@yield('title')</h5>
                    <small class="text-body float-end"><a href="{{ route('dashboard.categories.index') }}"> Category List</a></small>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.categories.update',[$category->id]) }}" enctype="multipart/form-data" accept="image/*">
                        @csrf
                        @method('put')
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" name="name" value="{{$category->name}}" id="basic-default-fullname"
                                placeholder="John Doe" />
                            <label for="basic-default-fullname">Category Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="parentFormControlSelect1" name="parent_id"
                                aria-label="Default select parent">
                                <option selected="selected"  disabled>Open this select category</option>
                                @forelse($categories as $cat)
                                    <option @selected($category->parent_id == $cat->id) value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @empty
                                    <option value="" disabled selected>None</option>
                                @endforelse
                            </select>
                            <label for="parentFormControlSelect1">Parent</label>
                        </div>
                        <div class="mb-4">
                            <label for="formFile" class="form-label">category Image</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" name="description"
                                rows="3" placeholder="Description here...">{{ $category->description  }}</textarea>
                            <label for="exampleFormControlTextarea1">category description</label>
                          </div>
                          <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="parentFormControlSelect1" name="status"
                                aria-label="Default select parent">
                                <option selected="selected" disabled>Open this select status</option>
                                <option @if ($category->status == 'active') selected="selected" @endif value="active" >active</option>
                                <option @if ($category->status == 'inactive') selected="selected" @endif value="inactive" >in-active</option>
                             
                            </select>
                            <label for="parentFormControlSelect1">status</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Create category</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection