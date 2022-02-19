@extends('backend.layout.app')
@section('title','Messages')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Messages')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
            <!-- /.card-header -->
        <div class="card-header">
            {{--@if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')--}}
                <a href="{{route('admin.new_notice')}}" type="button" class="btn btn-primary">Post new message</a>
            {{--@endif--}}
        </div>
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Message ID</th>
                  <th>Created By</th>
                  @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                  <th>Updated By</th>
                  @endif
                  <th>Message</th>
                  <th>Action</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>

            @foreach($notice as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td style="text-transform:capitalize;">
                    @php($admin_name = \App\User::find($data->created_by))
                        {{$admin_name->name}}
                    </td>
                    @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                    <td style="text-transform:capitalize;">
                    @php($update_by = \App\User::find($data->updated_by))
                        {{$update_by->name}}
                    </td>
                    @endif
                    <td>{{$data->notice}}</td>
                    <td>
                    @if($data->completed == 0)
                        <a href="{{route('admin.update_notice',$data->id)}}" type="button" class="btn btn-success">Complete <i class="fas fa-check"></i></a>
                        @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                            <a href="{{route('admin.delete_notice',$data->id)}}" type="button" class="btn-sm btn-danger">Delete <i class="fas fa-trash"></i></a>
                        @endif
                    @else
                        <span class="badge badge-success">Completed</span>
                        @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                            <a href="{{route('admin.delete_notice',$data->id)}}" type="button" class="btn-sm btn-danger">Delete <i class="fas fa-trash"></i></a>
                        @endif
                    @endif
                    </td>
                    <td>{{date("jS  F Y",strtotime($data->created_at))}}</td>
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
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollX": true,
    });
  });
</script>

@endpush
