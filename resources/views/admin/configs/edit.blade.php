@extends('admin.app')
@section('config_name', 'Sections')
@section('content')
    <div class="container-fluid ">
        @if(session()->has('success'))
            <x-alert-component type="success" message="{{session('success')}}"></x-alert-component>
        @endif
        @if(count($errors) > 0)
            <x-alert-component type="danger" message="{{__('Some Errors Please Check Fileds')}}"></x-alert-component>
        @endif
        <form autocomplete="off" method="POST" action="{{ route('configs.update', $config) }}"
              enctype="multipart/form-data">
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
                                               value="{{ $config->author }}"
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
                                               value="getConfig({{$config->id}})"
                                               autocomplete="off"/>
                                        <small class="form-text text-info font-weight-bold">
                                            You can use this helper function to call this section
                                            <span class="text-danger">[config_name || config_value]</span>
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
                                                    <div
                                                        class="form-group @error($key.'.config_name') has-danger @enderror">
                                                        <label class="form-control-label"
                                                               for="input-name">{{ __('Config Name') }} <span
                                                                class="text-danger">*</span> </label>
                                                        <input
                                                            type="text"
                                                            name="{{ $key }}[config_name]"
                                                            id="input-author-en"
                                                            class="form-control form-control-alternative @error($key.'.config_name') is-invalid @enderror"
                                                            autofocus
                                                            value="{{ optional($config->translate($key))->config_name }}"
                                                            @if($loop->first) required @endif >
                                                        @error($key.'.config_name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./col-12 -->

                                                <!-- .col-12 -->
                                                <div class="col-12 col-sm-12">
                                                    <div
                                                        class="form-group @error($key.'.config_value') has-danger @enderror">
                                                        <label class="form-control-label"
                                                               for="input-name">{{ __('Config Value') }} <span
                                                                class="text-danger">*</span></label>
                                                        <textarea
                                                            class="form-control form-control-alternative @error($key.'.config_value') is-invalid @enderror"
                                                            name="{{ $key }}[config_value]"
                                                            @if($loop->first) required @endif
                                                            rows="6"
                                                        >{{ optional($config->translate($key))->config_value != null ? optional($config->translate($key))->config_value : old($key.'.config_value') }}</textarea>
                                                        @error($key.'.config_value')
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