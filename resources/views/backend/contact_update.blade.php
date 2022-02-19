@extends('backend.layout.app')
@section('title','Contact')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Contact')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
    <div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Contact Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.contact_update')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Address" name="address" value="{{$contact->address}}">
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


@endsection
@push('js')
@endpush
