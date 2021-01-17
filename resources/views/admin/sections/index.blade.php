@extends('admin.app')
@section('title', 'Sections')
@section('content')
    <div class="container-fluid ">
        <!-- Page Heading -->
        <x-state-component name="Sections" active="{{$active}}" disabled="{{$disabled}}" total="{{$total}}"></x-state-component>
        @if(session()->has('success'))
            <x-alert-component type="success" message="{{session('success')}}"></x-alert-component>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Sections</h6>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{ route('sections.create') }}"
                           class="btn btn-outline-dark btn-sm">
                            Create Section
                            <i class="fas fa-plus-square ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('No') }}</th>
                            <th scope="col">{{ __('Author Title') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($data))
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <span class="btn btn-primary btn-sm">
                                            {{ $item->author }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($item->status == true)
                                            <span class="btn btn-sm btn-success">Active <i
                                                    class="fas fa-check ml-2"></i></span>
                                        @else
                                            <span class="btn btn-sm btn-danger">Unctive <i
                                                    class="fas fa-times ml-2"></i></span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <form class="delete-form mr-2" action="{{ route('sections.destroy', $item) }}"
                                              method="POST"
                                              onsubmit="return window.confirm('Are you Sure? ') ? true : false;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    data-toggle="tooltip" data-original-title="Delete">
                                                Delete &nbsp;<i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('sections.edit', $item) }}"
                                           class="btn btn-outline-primary btn-sm  mr-2"
                                           data-toggle="tooltip"
                                           data-original-title="Edit">
                                            Edit &nbsp;<i class="fa fa-edit"></i>
                                        </a>
                                        @if ($item->status == true)
                                            <a
                                                href="{{ route('sections.status', $item) }}"
                                                data-toggle="tooltip" data-original-title=""
                                                class="btn btn-outline-dark btn-sm mr-2">
                                                Disable &nbsp;<i class="fas fa-times"></i>
                                            </a>
                                        @else
                                            <a
                                                href="{{ route('sections.status', $item) }}"
                                                data-toggle="tooltip" data-original-title="Active"
                                                class="btn btn-outline-success btn-sm mr-2">
                                                Active &nbsp; <i class="fa fa-check"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
