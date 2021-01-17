@extends('admin.app')
@section('title', 'Categories')
@section('content')

    <div class="container-fluid ">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="author">Category Name</label>
                                <input type="text"
                                       name="author"
                                       class="form-control"
                                       id="author"
                                       value="{{ old('author') }}"
                                       autocomplete="off"/>
                                @error('author')
                                <small class="form-text text-danger font-weight-bold">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="type">Type Of Category</label>
                                <select class="form-control" id="type" name="parent_id">
                                    <option style="color: #F00;font-weight: bold"  value="0">Parent</option>
                                    @forelse($categories as $category)
                                    <option style="color: #F00" value="{{$category->id}}">{{ $category->author }}</option>
                                    @empty
                                        <option disabled>No categories added yet.</option>
                                    @endforelse
                                </select>
                                @error('parent_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
