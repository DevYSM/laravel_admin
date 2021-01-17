@extends('admin.app')
@section('title', 'Sections')
@section('content')
    <div class="container-fluid ">
        @if(session()->has('success'))
            <x-alert-component type="success" message="{{session('success')}}"></x-alert-component>
        @endif
        @if(count($errors) > 0)
            <x-alert-component type="danger" message="{{__('Some Errors Please Check Fileds')}}"></x-alert-component>
        @endif
         <form autocomplete="off" method="POST" action="{{ route('sections.update', $section) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <!-- .col-md-6 -->
                <div class="col-12 col-md-3  ">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4  h-100">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Section</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="author">Section Name</label>
                                        <input type="text"
                                               name="author"
                                               class="form-control"
                                               id="author"
                                               value="{{ $section->author }}"
                                               autocomplete="off"/>
                                        @error('author')
                                        <small class="form-text text-danger font-weight-bold">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="author">Section ID</label>
                                        <input type="text"
                                               readonly
                                               class="form-control"
                                               id="author"
                                               value="getSection({{$section->id}})"
                                               autocomplete="off"/>
                                        <small class="form-text text-info font-weight-bold">
                                            You can use this helper function to call this section
                                            <span class="text-danger">[ title || body ]</span>
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .col-md-6 -->
                <div class="col-12 col-md-9 h-100">
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
                                                    <div class="form-group @error($key.'.body') has-danger @enderror">
                                                        <label class="form-control-label"
                                                               for="input-name">{{ __('Body') }} <span class="text-danger">*</span></label>
                                                        <textarea class="ckeditor form-control form-control-alternative @error($key.'.body') is-invalid @enderror"
                                                                  name="{{ $key }}[body]"
                                                                  @if($loop->first) required @endif
                                                            rows="6"
                                                            >{{ optional($section->translate($key))->body != null ? optional($section->translate($key))->body : old($key.'.body') }}</textarea>

                                                        @error($key.'.body')
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
            <div class="mt-4 text-right">
                <button type="submit" class="btn btn-success btn-md">Update</button>
            </div>
        </form>
    </div>

@endsection



{{-- ./author-data --}}
