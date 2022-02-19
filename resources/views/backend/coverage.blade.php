@extends('backend.layout.app')
@section('title','Our Coverage')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Coverages')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
    <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Coverage</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.add_coverage')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="coverageName">Coverage Name</label>
                        <input type="text" class="form-control" id="coverageName" placeholder="Coverage name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="CoveragePicture">Coverage Image</label>
                        <input type="file" class="form-control" id="CoveragePicture" placeholder="Select an image for coverage" name="image">
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
@foreach($coverages as $data)
<div class="col-md-4">
            <div class="card card-default">
              <div class="card-body">
                <div class="callout callout-success">
                  <h5>{{$data->name}}</h5>
                    <picture>
                      <source srcset="{{asset('storage/app/public/coverages/'.$data->image)}}" type="image/svg+xml">
                      <img src="{{asset('storage/app/public/coverages/'.$data->image)}}" class="img-fluid img-thumbnail" alt="...">
                    </picture>
                </div>
                <a href="#" type="button" class="btn btn-danger">Delete</a>
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
