@extends('backend.layout.app')
@section('title','Offers and Promotions')
@push('css')
@endpush
@section('main_menu','Offers')
@section('active_menu','Edit offer')
@section('link',route('admin.offers'))
@section('content')


<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Offers and Promotions</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('admin.update_offer', $offer->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="partnerName">Offer Title</label>
              <input type="text" class="form-control" id="partnerName" placeholder="Offer title" value="{{$offer->title}}" name="title">
          </div>
          <div class="form-group">
            <label for="partnerName">Offer Details</label>
              <textarea type="text" class="form-control" id="partnerName" placeholder="Offer Details" name="content">{{$offer->content}}</textarea>
          </div>
          <div class="form-group">
            <label for="partnerType" style="text-transform: capitalize;">Offer Icon - {{$offer->image}} ( <i class="fas fa-{{$offer->image}}"></i> )</label>
              <select class="form-control" id="partnerType" name="icon">
                <option value="0">Select Icon</option>
                <option value="car">Car</option>
                <option value="motorcycle">Motorcycle</option>
                <option value="bars">Bars</option>
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
