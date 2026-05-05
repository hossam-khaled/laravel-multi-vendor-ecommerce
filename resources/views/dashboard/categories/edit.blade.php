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
                        @include('dashboard.categories._form', ['button' => 'Update'])
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection