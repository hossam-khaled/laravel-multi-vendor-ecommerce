  @extends('layouts.dashboard')
  @section('title', 'Categories')
  @section('content')
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <x-alert type="success" />
        <x-alert type="info" />
        <!-- Hoverable Table rows -->
        {{-- {{ $categories }} --}}
        <div class="card">
          <div class="d-flex justify-content-between align-items-center">
            
            <h5 class="card-header">Categories
            </h5>
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary waves-effect mx-2">create category</a>
          </div>
          <form  class="d-flex m-2 justify-content-between mb-4" action="{{ URL::current() }}" method="get">
            <x-form.input name="search" placeholder="Search" :value="request('search')"  class="mx-2"/>
            <x-form.select class="me-2" name="status" :options="[''=>'All', 'active' => 'active', 'inactive' => 'inactive']" :value="request('status')" />
            <button class="btn btn-outline-primary waves-effect" type="submit">Search</button>
          </form>
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>created_at</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  {{-- <tr>
                    <td>
                      <i class="icon-base ri ri-suitcase-2-line icon-22px text-danger me-3"></i>
                      <span>Tours Project</span>
                    </td>
                    <td>Albert Cook</td>
                    <td>
                      <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                        <li
                          data-bs-toggle="tooltip"
                          data-popup="tooltip-custom"
                          data-bs-placement="top"
                          class="avatar avatar-xs pull-up"
                          title="Lilian Fuller">
                          <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li
                          data-bs-toggle="tooltip"
                          data-popup="tooltip-custom"
                          data-bs-placement="top"
                          class="avatar avatar-xs pull-up"
                          title="Sophia Wilkerson">
                          <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li
                          data-bs-toggle="tooltip"
                          data-popup="tooltip-custom"
                          data-bs-placement="top"
                          class="avatar avatar-xs pull-up"
                          title="Christina Parker">
                          <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                        </li>
                      </ul>
                    </td>
                    <td>
                      <span class="badge rounded-pill bg-label-primary me-1">Active</span>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button
                          type="button"
                          class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                          data-bs-toggle="dropdown">
                          <i class="icon-base ri ri-more-2-line icon-18px"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);">
                            <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                            Edit</a
                          >
                          <a class="dropdown-item" href="javascript:void(0);">
                            <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                            Delete</a
                          >
                        </div>
                      </div>
                    </td>
                  </tr> --}}
                  @if ($categories->isEmpty())
                    <tr>
                      <td colspan="6" class="text-center">No categories found.</td>
                    </tr>
                  
                  @endif
                  @foreach ($categories as $category )
                      <tr>
                        <td>{{ $category->id }} <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100px" class="img-fluid"></td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_name }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $category->status == 'active' ? 'bg-label-success' : 'bg-label-danger' }}  me-1">{{ $category->status }}</span>
                        </td>
                        <td>{{ $category->created_at }}</td>

                        <td><div class="dropdown">
                            <button
                              type="button"
                              class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                              data-bs-toggle="dropdown">
                              <i class="icon-base ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('dashboard.categories.edit',[$category->id]) }}">
                                <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                Edit</a
                              >
                              <form action="{{ route('dashboard.categories.destroy', [$category->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item" href="javascript:void(0);">
                                  <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                  Delete</a>
                              </form>
                            </div>
                          </div>
                        </td>
                      </tr>

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <br />
          {{ $categories->withQueryString()->links() }}
          <!--/ Hoverable Table rows -->
        </div>
      <!-- / Content -->
  @endsection

