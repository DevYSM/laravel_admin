@extends('admin.app')
@section('title', 'Pages')
@section('content')

    <div class="container-fluid ">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Create Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pages.store') }}" autocomplete="off"
                      enctype="multipart/form-data"  novalidate>
                    @csrf

                    <div class="row">
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="author">Page Name</label>
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

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
