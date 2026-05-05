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
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100px" class="img-fluid">
                            @endif
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
                        <button type="submit" class="btn btn-primary"><?php echo $button; ?> category</button>