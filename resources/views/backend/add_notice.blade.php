@extends('backend.layout.app')
@section('title','Add message')
@push('css')
@endpush
@section('main_menu','Messages')
@section('active_menu','New message')
@section('link',route('admin.notices'))
@section('content')





<div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Post new message</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.post_notice')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Message</label>
                    <textarea class="form-control" id="exampleInputEmail1" placeholder="Post new message" name="notice"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="adminType">Message for</label>
                    <select class="form-control" id="adminType" name="adminRole">
                        <option value="admin">Admin</option>
                        <option value="sub_admin">Billing admin</option>
                        <option value="web_admin">Website admin</option>
                    </select>
                  </div>
                </div>

                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Post</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
 </div>






@endsection
@push('js')
@endpush
