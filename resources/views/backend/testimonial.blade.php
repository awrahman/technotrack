@extends('backend.layout.app')
@section('title','Testimonials')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Testimonials')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Testimonials</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('admin.add_testimonial')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="clientName">Client Name</label>
              <input type="text" class="form-control" id="clientName" placeholder="Name of the client" name="name">
          </div>
          <div class="form-group">
            <label for="clientFeedback">Client feedback</label>
            <textarea type="text" class="form-control" id="clientFeedback" placeholder="Client feedback" name="feedback"></textarea>
          </div>
          <div class="form-group">
            <label for="clientImage">Client Image</label>
              <input type="file" class="form-control" id="clientImage" placeholder="Select client image" name="client_image">
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
  @foreach($testimonials as $data)
  <div class="col-md-4">
    <div class="card card-default">
      <div class="card-body">
        <div class="callout callout-warning">
            <h6>{{$data->client_name}}</h6>
          <picture>
            <source height="215" width="215" srcset="{{asset('storage/app/public/testimonials/'.$data->client_image)}}" type="image/svg+xml">
            <img height="215" width="215" src="{{asset('storage/app/public/testimonials/'.$data->client_image)}}" class="img-fluid img-thumbnail" alt="...">
          </picture>
          <p><h6>{{$data->client_fedback}}</h6></p>
        </div>
        @if($data->status == 1)
        <a href="{{route('admin.deactivate',$data->id)}}" type="button" class="btn btn-warning">Deactivate</a>
        @else
        <a href="{{route('admin.activate',$data->id)}}" type="button" class="btn btn-success">Activate</a>
        @endif
        <a href="{{route('admin.delete',$data->id)}}" type="button" class="btn btn-danger float-right">Delete</a>
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
