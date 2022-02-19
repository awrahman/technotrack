@extends('backend.layout.app')
@section('title','Sub Admins')
@push('css')
@endpush
@section('main_menu','Subadmins')
@section('active_menu','Sub Admins')
@section('link',route('admin.sub_admins'))
@section('content')


<div class="row">
    <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  Preview
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-danger">
                  <h5>Name</h5>

                  <p>{{$subadmin->name}}</p>
                </div>
                <div class="callout callout-info">
                      <h5>Phone number</h5>

                      <p>{{$subadmin->phone}}</p>
                  </div>

                  <div class="callout callout-info">
                  <h5>Email</h5>

                  <p>{{$subadmin->email}}</p>
                </div>
                <div class="callout callout-info">
                  <h5>Role</h5>

                  <p>{{$subadmin->type}}</p>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>
<div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Subadmin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.sub_admin_update', $subadmin->id)}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" value="{{$subadmin->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">phone</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="phone" value="{{$subadmin->phone}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email" value="{{$subadmin->email}}">
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="adminType">Role</label>
                    <select class="form-control" id="adminType" name="adminRole">
                        <!--<option value="admin">Admin</option>-->
                        <option value="sub_admin">Billing admin</option>
                        <option value="web_admin">Website admin</option>
                    </select>
                  </div>
                </div>

                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
 </div>
</div>

@endsection
@push('js')
@endpush
