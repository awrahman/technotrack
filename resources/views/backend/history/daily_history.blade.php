@extends('backend.layout.app')
@section('title','Daily Payment History')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Daily payments')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Customer name</th>
                  <th>Paid Amount</th>
                  <th>Bill collected By</th>
                  <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>

            @foreach($payments as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @php($user = \App\AllUser::find($data->user_id))
                        <a href="{{route('admin.all_user.show',$user->id)}}">{{$user->name}}</a>
                    </td>
                    <td>{{$data->updated_amount}}</td>
                    <td>
                        @php($admin_name = \App\User::find($data->admin_id))
                        {{$admin_name->name}}
                    </td>
                    <td>{{date("jS  F Y",strtotime($data->created_at))}}</td>
                </tr>
            @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Customer name</th>
                  <th class="bg-primary">Total: {{$total}}</th>
                  <th>Bill collected By</th>
                  <th>Payment Date</th>
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
