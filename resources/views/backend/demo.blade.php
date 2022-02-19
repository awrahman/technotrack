@extends('backend.layout.app')
@section('title','Demo Accounts')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Demo')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="card">
    <div class="card-header">
        <a href="#" data-target="#add_demo_account" data-toggle="modal" class="btn btn-primary">Add Demo Account</a>
    </div>
            <!-- /.card-header -->
            
    <div class="card-body">
        <table id="demoRequests" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Facebook</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($demo as $key=>$demo_data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$demo_data->name}}</td>
                    <td>{{$demo_data->phone}}</td>
                    <td>{{$demo_data->email}}</td>
                    <td>{{$demo_data->social_media}}</td>
                    <td>{{$demo_data->link}}</td>
                    <td><a href="#" class="btn btn-primary">Approve</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal -->
<div class="modal fade" id="add_demo_account" tabindex="-1" role="dialog" aria-labelledby="add_happy_clientLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('demo_add')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_happy_clientLabel">Add demo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="demoEmail">Email*</label>
                        <input type="email" class="form-control" id="demoEmail" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="demoPhone">Phone*</label>
                        <input type="number" class="form-control" id="demoPhone" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="social">Facebook*</label>
                        <input type="text" class="form-control" id="social" placeholder="facebook" name="social">
                    </div>
                    <div class="form-group">
                        <label for="link">Demo Link</label>
                        <input type="text" class="form-control" id="link" placeholder="Demo link" name="link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
<!-- DataTables -->
<script src="{{asset('public/assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $('#demoRequests').DataTable({
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
