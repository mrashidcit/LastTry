@extends('layouts.app')
@section('title','SemiFixed')
@section('BigHeading')
SemiFixed Cost
@endsection
@section('SmallHeading')
details
@endsection
@section('pagetitle')
SemiFixed
@endsection
@section('cssarea')
<!-- DataTable Bootstrap  -->
    <link href="{{ asset('css/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<!-- Responsive Bootstrap  -->
    <link href="{{ asset('css/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet"> 
<!-- Select2 -->
  <link rel="stylesheet" href="{{asset('css/bower_components/select2/dist/css/select2.min.css')}}">    
     
@endsection
@section('dynamiccontent')

<table id="companytable" class="display responsive table table-striped table-bordered nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th data-priority="1">Name</th>
                <th data-priority="7">Updated At</th>
                <th data-priority="8">Created At</th>
                <th data-priority="2">Actions</th> 
            </tr>
        </thead>
        <tbody>
        	@foreach($semifixedata as $cmp)
            <tr>
                <td>{{$cmp->name}}</td>
                <td>{{$cmp->updated_at->format('d-M-Y h:i a')}}</td>
                <td>{{$cmp->created_at->format('d-M-Y h:i a')}}</td>
                <td>@can('Edit-Company')<a href="{{route('SemiFixed.edit',$cmp->id)}}" class="btn btn-primary">Edit</a>@endcan
                  @can('Delete-Company')
                  <form action="{{route('SemiFixed.destroy',$cmp->id)}}" method="POST">
                    <input type="hidden" name="_method" value="delete">
                        {{csrf_field()}}
                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete his?');" value="Delete"></form>@endcan</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('footer')
<!--Create Modal -->
<div class="container">
  @can('Create-Company')
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-primary" id="companyCreate">New SemiFixed</button>
  @endcan

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>New Semi fixed Details</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="{{route('SemiFixed.store')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="name" type="name" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
            <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
        	@if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        	@endif	
            </div>
            <div class="form-group modal-footer">
      			<button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="" ="glyphicon glyphicon-remove"></span> Cancel</button>
          <button type="submit" class="btn btn-primary pull-right">Save it</button>
      		</div>
          </form> 
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection
@if(!$companyData==0)
  <!--Edit Modal -->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" href="{{url('/SemiFixed')}}">&times;</a>
          <h4>Edit Semi Fixed Details</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="{{route('SemiFixed.update',$companyData->id)}}" method="POST">
            <input type="hidden" name="_method" value="PATCH">
                      {{ csrf_field() }}
            <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="name" type="name" class="form-control" placeholder="Name" name="name" value="{{ $companyData->name}}" required autofocus>
            <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
          @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif  
            </div>
            
          <div class="form-group modal-footer">
            <a class="btn btn-default btn-default pull-left" href="{{url('/SemiFixed')}}">Back</a>
          <button type="submit" class="btn btn-primary pull-right">Update</button>
          </div>
          </form> 
        </div>
      </div>
    </div>
  </div> 
  @endif
@section('scriptarea')

<!-- DataTable -->
 <script src="{{ asset('css/bower_components/datatables.net-bs/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('css/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
 <script src="{{ asset('css/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('css/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js') }}"></script>
 <!-- InputMask -->
<script src="{{ asset('css/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{asset('css/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('css/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
  $(":input").inputmask();
});
</script>
<script type="text/javascript">
	$(document).ready(function(){
  $("#phone").inputmask("99999999999",{ "onincomplete": function(){ $(':input[type="submit"]').prop('disabled', true); },"oncomplete": function(){ $(':input[type="submit"]').prop('disabled', false); } }); //default
});
  $(document).ready(function(){
  $("#phone1").inputmask("99999999999",{ "onincomplete": function(){ $(':input[type="submit"]').prop('disabled', true); },"oncomplete": function(){ $(':input[type="submit"]').prop('disabled', false); } }); //default
});
</script>
 <script type="text/javascript">
	$(document).ready(function() {
    $('#companytable').DataTable( {
    
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
        

    } );
} );
</script>

<script type="text/javascript">
	$(document).ready(function(){
    $("#companyCreate").click(function(){
        $("#myModal").modal();
    });
});
</script>
<script type="text/javascript">
@if (count($errors) > 0 && $setModal!=true)
    $("#myModal").modal('show');
@elseif(count($errors) > 0 && $setModal==true)
    $("#editModal").modal('show');
@endif
@if($setModal==true)
$('#editModal').modal({backdrop: 'static', keyboard: false})
$("#editModal").modal('show');
@endif
</script>

@endsection