@extends('layouts.app')
@section('title')
    Roles
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Roles</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('roles.create') }}" class="btn btn-primary form-btn">Add New <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            @include('notif.notif')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="roles-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($roles as $roles)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="text-upercase">{{ $roles->name }}</td>
                                        <td class=" text-center">
                                            {!! Form::open(['route' => ['roles.destroy', $roles->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{!! route('roles.show', [$roles->id]) !!}" class='btn btn-light action-btn '><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="{!! route('roles.edit', [$roles->id]) !!}"
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
