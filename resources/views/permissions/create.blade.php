@extends('layouts.app')
@section('title')
    Create Permissions 
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">New Permission</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('notif.notif')
            <div class="section-body">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="card">
                           <div class="card-body ">
                                {!! Form::open(['route' => 'permissions.store']) !!}
                                        <table class="table table-bordered" id="dynamicAddRemove">
                                            <tr>
                                                <th>Data</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="addMoreInputFields[0][name]" placeholder="" class="form-control" />
                                                </td>
                                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-success"><i class="fa fa-plus"></i></button></td>
                                            </tr>
                                        </table>
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
    <!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][name]" placeholder="" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field"><i class="fa fa-minus"></i></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
