@extends('layouts.app')
@section('title')
    Edit Permissions 
@endsection
@section('content')
    <section class="section">
            <div class="section-header">
                <h3 class="page__heading m-0">Edit Permissions</h3>
                <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                    <a href="{{ route('permissions.index') }}"  class="btn btn-primary">Back</a>
                </div>
            </div>
  <div class="content">
              @include('stisla-templates::common.errors')
              <div class="section-body">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-body ">
                                    {!! Form::model($permissions, ['route' => ['permissions.update', $permissions->id], 'method' => 'patch']) !!}
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {!! Form::label('name', 'Name :') !!}
                                            <input type="text"  class="form-control border-primary" placeholder="" name="name" value="{{$permissions->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <a href="{{ route('permissions.index') }}" class="btn btn-light">Cancel</a>
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
