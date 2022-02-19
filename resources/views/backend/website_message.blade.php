@extends('backend.layout.app')
@section('title','Messages')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Website Messages')
@section('link',route('admin.adminDashboard'))
@section('content')

@php($counter= \App\website_message::where('status',1)->get())
<div class="card">
  <div class="card-header">
    <h3 class="card-title">New Messages: <span class="badge badge-secondary">{{count($counter)}}</span></h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sender</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $key=>$data)
        @if(count($messages)>0)
          @if($data->status > 0)
            <tr style="background-color: #07D5E6">
              <td>{{$data->name}}</td>
              <td>{{$data->phone}}</td>
              <td>{{$data->email}}</td>
              <td>{{$data->created_at}}</td>
              <td>
                  <a type="button" class="btn btn-success" href="{{route('admin.single_message',$data->id)}}">View</a>
              </td>
            </tr>
          @else
            <tr style="background-color: #ddd">
              <td>{{$data->name}}</td>
              <td>{{$data->phone}}</td>
              <td>{{$data->email}}</td>
              <td>{{$data->created_at}}</td>
              <td>
                  <a type="button" class="btn btn-success" href="{{route('admin.single_message',$data->id)}}">View</a> <a type="button" class="btn btn-danger" href="{{route('admin.delete_message',$data->id)}}">Delete</a>
              </td>
            </tr>
          @endif
        @else
          <p>No messages yet.</p>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection
@push('js')
    <!-- DataTables -->
<script src="{{asset('public/assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('public/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
  $(function () {
    $('#example1').DataTable({
      "ordering": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
