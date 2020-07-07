@extends('admin::layouts.app_cms_admin')
@section('title_page','Danh sách nhóm quyền')
@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Quảng lý nhóm quyền</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Index</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('cms_get.role.create') }}" class="btn btn-info  mr-2"><i class="la la-edit"></i> Thêm mới</a>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-danger mr-2"><i class="la la-refresh"></i> Reload</button>
                </div>
            </div>
        </div>

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Guard_name</th>
                                        <th style="width: 50%">Permissions</th>
                                        <th>Create</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->guard_name }}</td>
                                        <td>
                                            @php
                                                $permissions = $role->permissions()->pluck('name') ?? []
                                            @endphp
                                            @foreach($permissions as $permission)
                                                <span class="btn btn-sm btn-success">{{ $permission }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>
                                            <a href="{{ route('cms_get.role.update', $role->id) }}" class="btn btn-sm btn-info"><i class="la la-pen"></i></a>
                                            <a href="{{ route('cms_get.role.delete', $role->id) }}" class="btn btn-sm btn-danger js-confirm-delete"><i class="la la-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
