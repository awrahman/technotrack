@extends('backend.layout.app')
@section('title','User Logins')
@push('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','User Logins')
@section('link',route('admin.adminDashboard'))
@section('content')




<div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>SessionID</th>
                  <th>IP Address</th>
                  <th>Time</th>
                </tr>
                </thead>
                <tbody>

                @foreach($logins as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->user_id}}</td>
                        @php($user = \App\User::find($data->user_id))
                        <td>{{$user->name}}</td>
                        <td>{{$data->login_session}}</td>
                        <td>{{$data->user_ip}}</td>
                        <td>{{date("jS  F Y - h:i:s A",strtotime($data->updated_at))}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>SessionID</th>
                  <th>IP Address</th>
                  <th>Time</th>
                </tr>
                </tfoot>
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
