@extends('layouts.app')
@section('title')
    Permissions
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Permissions</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('permissions.create') }}" class="btn btn-primary form-btn">Add New <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            @include('notif.notif')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md" id="permissions-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($permissions as $permissions)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$permissions->name}}</td>
                                        <td class="text-center">
                                            {!! Form::open(['route' => ['permissions.destroy', $permissions->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{!! route('permissions.edit', [$permissions->id]) !!}"
                                                    class='btn btn-warning action-btn edit-btn'><i
                                                        class="fa fa-edit"></i></a>
                                                {!! Form::button('<i class="fa fa-trash"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger action-btn delete-btn',
                                                    'onclick' => 'return confirm("Are you sure want to delete this record ?")',
                                                ]) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
