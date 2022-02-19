@extends('backend.layout.app')
@section('title','Partners')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Our Partners')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Partner Information</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('admin.add_partner')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="partnerName">Partner Name</label>
              <input type="text" class="form-control" id="partnerName" placeholder="Partner name" name="name">
          </div>
          <div class="form-group">
            <label for="partnerType">Partner Type</label>
              <select class="form-control" id="partnerType" name="type">
                <option value="0">Select Partner Type</option>
                <option value="1">Device Partner</option>
                <option value="2">Telecom Partner</option>
              </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Partner Image</label>
              <input type="file" class="form-control" id="exampleInputPassword1" placeholder="Cover Small text" name="partner_image">
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
  @foreach($partners as $data)

  <div class="col-md-4">
    <div class="card card-default">
      <div class="card-body">
        <div class="callout callout-warning">
          @if($data->partner_type==1)
          <h6>{{$data->name}} - Device Partner</h6>
          @else
          <h6>{{$data->name}} - Telecom Partner</h6>
          @endif
          <picture>
            <source srcset="{{asset('storage/app/public/partner_image/'.$data->image)}}" type="image/svg+xml">
            <img src="{{asset('storage/app/public/partner_image/'.$data->image)}}" class="img-fluid img-thumbnail" alt="...">
          </picture>
        </div>
        @if($data->status == 1)
        <a href="{{route('admin.deactivate_partner', $data->id)}}" type="button" class="btn btn-danger">Deactivate</a>
        @else
        <a href="{{route('admin.activate_partner', $data->id)}}" type="button" class="btn btn-success">Activate</a>
        @endif
      </div>
      <!-- /.card-body -->
          
    </div>
      <!-- /.card -->

  </div>
  @endforeach
</div>







@endsection
@push('js')
@endpush
