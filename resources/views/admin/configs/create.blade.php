@extends('admin.app')
@section('title', 'Configs')
@section('content')

    <div class="container-fluid ">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Create Config</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('configs.store') }}" enctype="multipart/form-data" >
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="author">Config Name</label>
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
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
