@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('users.create') }}" class="btn btn-primary form-btn">Add New<i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            @include('stisla-templates::common.errors')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-uppercase">{{$user->name}}</td>
                                        <td class="">{{$user->email}}</td>
                                        <td class="text-center">
                                            @if(!empty($user->getRoleNames()))
                                              @foreach($user->getRoleNames() as $role_name)
                                                 <label class="badge badge-success">{{ $role_name }}</label>
                                              @endforeach
                                            @endif
                                        </td>
                                        <td class=" text-center">
                                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-light action-btn'><i class="fa fa-eye"></i></a>
                                                <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
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
