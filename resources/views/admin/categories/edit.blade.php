@extends('admin.app')
@section('title', 'Categories')
@section('content')
     <div class="container-fluid ">
{{--         {{ dd($category->parent_id) }}--}}
        @if(session()->has('success'))
            <x-alert-component type="success" message="{{session('success')}}"></x-alert-component>
        @endif
        <form autocomplete="off" method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PATCH')
            <div class="row">
                <!-- .col-md-6 -->
                <div class="col-12 col-md-6 ">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4  h-100">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="author">Category Name</label>
                                        <input type="text"
                                               name="author"
                                               class="form-control"
                                               id="author"
                                               value="{{ $category->author }}"
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
                                        <label for="type">Parent Of Category</label>
                                        <select class="form-control" id="type" name="parent_id">
                                            @forelse($categories as $cat)
                                                @if ($cat->id == $category->id)
                                                    <option style="color: #F00;font-weight: bold"  value="0">Parent</option>
                                                @else
                                                    <option value="{{$cat->id}}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                                                        {{ $cat->author }}
                                                    </option>
                                                @endif

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

                        </div>
                    </div>
                </div>
                <!-- .col-md-6 -->
                <div class="col-12 col-md-6 h-100">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Translations</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="transliation-tabs">
                                <ul class="nav nav-pills " id="custom-content-below-tab" role="tablist">
                                    @forelse(locales() as $key)
                                        <li class="nav-item">
                                            <a class="nav-link @if($loop->first) active @endif"
                                               id="custom-{{$key}}-below-home-tab"
                                               data-toggle="pill"
                                               href="#tab-{{ $key }}"
                                               role="tab"
                                               aria-controls="custom-content-below-home"
                                               aria-selected="true">
                                                {{ localesAliases($key) }}
                                            </a>
                                        </li>
                                    @empty
                                        Don't found any language to show it
                                    @endforelse
                                </ul>


                                <div class="tab-content" id="custom-content-below-tabContent">
                                    @forelse(locales() as $key)
                                        <div class="tab-pane fade @if($loop->first) active show @endif"
                                             id="tab-{{$key}}"
                                             role="tabpanel"
                                             aria-labelledby="tab-{{$key}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mt-3">
                                                <!-- .col-12 -->
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group @error($key.'.title') has-danger @enderror">
                                                        <label class="form-control-label"
                                                               for="input-name">{{ __('Title') }}</label>
                                                        <input
                                                            type="text"
                                                            name="{{ $key }}[title]"
                                                            id="input-author-en"
                                                            class="form-control form-control-alternative @error($key.'.title') is-invalid @enderror"
                                                            autofocus
                                                            value="{{ optional($category->translate($key))->title }}"
                                                            @if($loop->first) required @endif >
                                                        @error($key.'.title')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./col-12 -->
                                            </div>

                                        </div>

                                        @endforeach
                                </div>


                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 ">
                <button type="submit" class="btn btn-danger btn-sm">Update</button>
            </div>
        </form>
    </div>

@endsection



{{-- ./author-data --}}
