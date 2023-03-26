@extends('layouts.app')
@section('title')
    Create User 
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">New User</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="card">
                           <div class="card-body ">
                                {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {!! Form::label('name', 'Name:') !!}
                                            <input type="text"  class="form-control border-primary" placeholder="" name="name">
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('email', 'Email:') !!}
                                            <input type="email"  class="form-control border-primary" placeholder="" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {!! Form::label('password', 'Password:') !!}
                                            <input type="text"  class="form-control border-primary" placeholder="" name="password">
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('confirm-password', 'Confirm Password:') !!}
                                            <input type="text"  class="form-control border-primary" placeholder="" name="confirm-password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {!! Form::label('role', 'Role:') !!}
                                            {!! Form::select('roles[]', $role,[], array('class' => 'form-control border-primary')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
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
