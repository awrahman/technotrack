@extends('backend.layout.app')
@section('title','Registered Users')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Registered Users')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Registered ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Type</th>
                  <th>Registered On</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

            @foreach($users as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->emal}}</td>
                    <td>{{$data->role}}</td>
                    <td>{{$data->type}}</td>
                    <td>{{date("jS  F Y",strtotime($data->created_at))}}</td>
                    <td><a href="{{route('admin.delete_user',$data->id)}}" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->




@endsection
@push('js')
    <!-- DataTables -->
<script src="{{asset('public/assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('public/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endpush
