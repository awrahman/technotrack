@extends('backend.layout.app')
@section('title','Add Admin')
@push('css')
@endpush
@section('main_menu','Subadmins')
@section('active_menu','Add Admins')
@section('link',route('admin.sub_admins'))
@section('content')





<div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.create_admin')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="phone" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email"  autocomplete="off">
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






@endsection
@push('js')
@endpush
