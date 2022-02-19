@extends('backend.layout.app')
@section('title','Messages')
@push('css')
@endpush
@section('main_menu', 'Website messages')
@section('active_menu','Single Message')
@section('link',route('admin.messages'))
@section('content')

<style type="text/css">
  .card table{
    width: 70%;
    margin: auto;
  }
  .card table, .card table tr,  .card table tr th{
    border: 1px solid #636363;
  }
  .card table tr td{
    padding-left: 1em;
    padding-right: 1em;
    min-width: 100%;
  }
  .card table tr th{
    padding: 1em;

  }
  .card a {
    margin-top: 1.5em;
    margin-left: 9.8em;
  }
</style>
@php($counter= \App\website_message::where('status',1)->get())
<div class="card">
  <div class="card-header">
    <h3 class="card-title">New Messages: <span class="badge badge-secondary">{{count($counter)}}</span></h3>
  </div>
  <div class="card-body">
    <table>
      <tbody>
        <tr>
          <th>Sender</th>
          <td>{{$messages->name}}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{$messages->email}}</td>
        </tr>
        <tr>
          <th>Phone</th>
          <td>{{$messages->phone}}</td>
        </tr>
        <tr>
          <th>Message</th>
          <td>{{$messages->message}}</td>
        </tr>
      </tbody>
    </table>
    <p><a href="#" type="button" data-toggle="modal" data-target="#reply" class="btn btn-success">Reply</a>  <a style="margin-left: 3em;" href="{{route('admin.delete_message',$messages->id)}}" type="button" class="btn btn-danger">Delete</a></p>
  </div>
</div>

<!-- Modal sms to all -->
<div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="smsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.reply', $messages->id)}}" method="get">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="bill_sheduleLabel">Reply to {{$messages->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reply"></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>

        </form>
    </div>
  </div>
</div>
@endsection
@push('js')
@endpush
