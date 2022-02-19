@extends('backend.layout.app')
@section('title','Messages')
@push('css')
@endpush
@section('main_menu', 'Website messages')
@section('active_menu','Single Message')
@section('link',route('admin.messages'))
@section('content')

<div class="row">

    <h1>Hi {{$name}}</h1>
    <p>Sending Mail from Laravel.</p>
</div>




@endsection
@push('js')
@endpush
