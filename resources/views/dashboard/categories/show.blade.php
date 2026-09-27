@extends('layouts.dashboard')
@section('title', $category->name)
@section('content')

    <div class="row mb-6 gy-6">
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">@yield('title')</h3>
                    <small class="text-body float-end"><a href="{{ route('dashboard.categories.index') }}"> Category List</a></small>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h4 class="fw-bold mb-2">
                                    {{ $category->name }}
                                    @if($category->status == 'active')
                                        <span class="badge bg-label-success ms-2">{{ ucfirst($category->status) }}</span>
                                    @else
                                        <span class="badge bg-label-danger ms-2">{{ ucfirst($category->status) }}</span>
                                    @endif
                                </h4>
                                <p class="text-muted">{{ $category->description ?: 'No description provided.' }}</p>
                            </div>
                            <ul class="list-group list-group-flush mb-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium"><i class="icon-base ri-folder-3-line me-2"></i>Parent Category</span>
                                    <span>{{ $category->parent->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium"><i class="icon-base ri-shopping-basket-line me-2"></i>Products Count</span>
                                    <span class="badge bg-primary rounded-pill">{{ $category->products_count }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium"><i class="icon-base ri-calendar-line me-2"></i>Created At</span>
                                    <span class="text-muted">{{ $category->created_at->format('Y-m-d H:i') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium"><i class="icon-base ri-calendar-check-line me-2"></i>Updated At</span>
                                    <span class="text-muted">{{ $category->updated_at->format('Y-m-d H:i') }}</span>
                                </li>
                            </ul>

                            <div class="mt-5">
                                <h5 class="fw-bold mb-3">Products in this Category</h5>
                                @if($category->products && $category->products->count())
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                               $products = $category->products()->with('store')->latest()->paginate(10);
                                            @endphp
                                            @foreach($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>
                                                            <span class="badge {{ $product->status == 'active' ? 'bg-label-success' : 'bg-label-danger' }}">
                                                                {{ ucfirst($product->status) }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('dashboard.products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $products->links() }}
                                    </div>
                                @else
                                    <div class="alert alert-info mb-0">
                                        No products found in this category.
                                    </div>
                                @endif
                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
