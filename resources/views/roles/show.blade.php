@extends('layouts.app')
@section('title')
    Roles Detail
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Roles Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('roles.index') }}" class="btn btn-primary form-btn float-right">Back</a>

            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <h1>{{ ucfirst($roles->name) }} Role</h1>
                    <div class="container mt-4">

                        <h3>Assigned permissions</h3>

                        <table class="table table-bordered">
                            <thead>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col" width="1%">Guard</th>
                            </thead>

                            @foreach ($rolePermissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <a href="{{ route('roles.edit', $roles->id) }}" class="btn btn-info form-btn float-right"><i
                                class="fa fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
