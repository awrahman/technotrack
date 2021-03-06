@extends('backend.layout.app')
@section('title','Change Password')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Change Password')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="tab-pane" id="password">
                        <form class="form-horizontal" method="POST" action="{{route('changePassword')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} row">
                            <label for="new-password" class="col-md-4 control-label">Current Password</label>

                            <div class="col-sm-10">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }} row">
                            <label for="new-password" class="col-md-4 control-label">New Password</label>

                            <div class="col-sm-10">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-sm-10">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>







@endsection
@push('js')
@endpush
