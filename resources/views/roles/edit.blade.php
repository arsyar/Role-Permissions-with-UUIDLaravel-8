@extends('layouts.app')
@section('title')
    Edit Role
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">Edit Role</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($roles, ['route' => ['roles.update', $roles->id], 'method' => 'patch']) !!}
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        {!! Form::label('name', 'Name:') !!}
                                        <input type="text" class="form-control border-primary" placeholder=""
                                            name="name" value="{{$roles->name}}" required>
                                    </div>
                                </div>
                                <label for="permissions" class="form-label">Assign Permissions</label>
                                    <table class="table table-striped">
                                        <thead>
                                            <th scope="col" width="1%"><input type="checkbox" name="all_permission">
                                            </th>
                                            <th scope="col" width="20%">Name</th>
                                            <th scope="col" width="1%">Guard</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($permission as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="permission[{{ $permission->name }}]"
                                                        value="{{ $permission->name }}" class='permission'
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                </td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                <div class="form-group col-sm-12">
                                    <a href="{{ route('roles.index') }}" class="btn btn-light">Cancel</a>
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}    
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection