@extends('backend.layout.app')
@section('title','TechnoTrack Contact')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','TechnoTrack Contact')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
@if($contact == null)
    <div class="col-md-6 ">
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
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="phone">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Sales number</label>
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
                    <label for="exampleInputPassword1">bKash Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="bKash">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nagad Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="Nagad">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Rocket Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="Rocket">
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
@endif
@if(isset($contact->address))

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
                  <h5>Address</h5>

                  <p>{{$contact->address}}</p>
                </div>
                <div class="callout callout-info">
                      <h5>Phone number</h5>

                      <p>{{$contact->phone}}</p>
                  </div>

                  <div class="callout callout-info">
                  <h5>Sales number</h5>

                  <p>{{$contact->header_phone_1}}</p>
                </div>

                  <div class="callout callout-info">
                  <h5>Billing Number</h5>

                  <p>{{$contact->header_phone_2}}</p>
                </div>

                  <div class="callout callout-info">
                  <h5>Support Number</h5>

                  <p>{{$contact->header_phone_3}}</p>
                </div>
                <div class="callout callout-info">
                  <h5>bKash Number</h5>

                  <p>{{$contact->bKash}}</p>
                </div>
                <div class="callout callout-info">
                  <h5>Nagad Number</h5>

                  <p>{{$contact->Nagad}}</p>
                </div>
                <div class="callout callout-info">
                  <h5>Rocket Number</h5>

                  <p>{{$contact->Rocket}}</p>
                </div>

                  <div class="callout callout-info">
                  <h5>Email</h5>

                  <p>{{$contact->email}}</p>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    {{--<a href="{{route('admin.contact_update',$contact->id)}}" type="button" class="btn btn-success">Update</a>
    <a href="{{route('admin.contact_delete',$contact->id)}}" type="button" class="btn btn-danger">Delete</a>--}}

</div>
<div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Contact Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.contact_update', $contact->id)}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Address" name="address" value="{{$contact->address}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="phone" value="{{$contact->phone}}">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Sales number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="header_phone_1" value="{{$contact->header_phone_1}}">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Billing Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="header_phone_2" value="{{$contact->header_phone_2}}">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Support Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="header_phone_3" value="{{$contact->header_phone_3}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">bKash Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="bKash" value="{{$contact->bKash}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nagad Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="Nagad" value="{{$contact->Nagad}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Rocket Number</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="Rocket" value="{{$contact->Rocket}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email" value="{{$contact->email}}">
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
    @endif
</div>










@endsection
@push('js')
@endpush
