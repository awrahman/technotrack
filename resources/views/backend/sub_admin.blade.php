@extends('backend.layout.app')
@section('title','Sub Admins')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Sub Admins')
@section('link',route('admin.adminDashboard'))
@section('content')



@if(count($user) == null)
    <div class="card">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Contact Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.contact_save')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Address" name="address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">phone</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="phone">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Seals number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="header_phone_1">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Billing Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="header_phone_2">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Support Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="header_phone_3">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
 </div>
@else

<div class="card">
            <div class="card-header">
              <h3 class="card-title">Total User: <span class="badge badge-secondary">{{$user->count()}}</span></h3>
              <a href="{{route('admin.add_admin')}}" class="btn btn-primary float-right">Add Admin</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($user as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                            @if($data->role == 3)
                                <span class="right badge badge-danger">Deactivated</span>
                            @elseif($data->role == 0)
                                <span class="right badge badge-success">Acive</span>
                            @endif
                        </td>
                        <td>
                            @if($data->role == 3)
                                <a href="{{route('admin.sub_admins_approve',$data->id)}}" class="btn btn-success">Approve</a>
                            @elseif($data->role == 0)
                            <a class="btn btn-info btn-sm" href="{{route('admin.sub_admins_edit', $data->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="{{route('admin.sub_admins_approve',$data->id)}}">
                              <i class="fas fa-trash">
                              </i>
                              Expire
                          </a>
                            @endif

                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          @endif





@endsection
@push('js')
@endpush
