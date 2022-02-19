@extends('backend.layout.app')
@section('title','Offers and Promotions')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Offers')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Add Offers and Promotions</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('admin.add_offer')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="partnerName">Offer Title</label>
              <input type="text" class="form-control" id="partnerName" placeholder="Offer title" name="title">
          </div>
          <div class="form-group">
            <label for="partnerName">Offer Details</label>
              <textarea type="text" class="form-control" id="partnerName" placeholder="Offer Details" name="content"></textarea>
          </div>
          <div class="form-group">
            <label for="partnerType">Offer Icon</label>
              <select class="form-control" id="partnerType" name="icon">
                <option value="0">Select Icon</option>
                <option value="car">Car</option>
                <option value="motorcycle">Motorcycle</option>
                <option value="bars">Bars</option>
                <option value="truck">Truck</option>
              </select>
          </div>
        </div>
      <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
      <!-- /.card -->
  </div>
  @foreach($offers as $data)

  <div class="col-md-4">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title" style="color: #00BFFF; text-transform: capitalize;">
          Offer Icon - {{$data->image}} ( <i class="fa fa-{{$data->image}}"></i> )
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="callout callout-danger">
          <h5>Title</h5>
          <p>{{$data->title}}</p>
        </div>
        <div class="callout callout-info">
          <h5>Description</h5>
          <p>{{$data->content}}</p>
        </div>

          <a href="{{route('admin.edit_offer', $data->id)}}" type="button" class="btn btn-primary">Update</a>
          @if($data->flag == 1)
          <a href="{{route('admin.offer_deactivate', $data->id)}}" type="button" class="btn btn-warning">Deactivate</a>
          @else
          <a href="{{route('admin.offer_activate', $data->id)}}" type="button" class="btn btn-success">Activate</a>
          @endif

          <a href="#" style="float: right;" type="button" class="btn btn-danger">Delete</a>
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
