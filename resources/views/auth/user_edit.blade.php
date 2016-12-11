@extends('template')

@section('container')
    <div class="row">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/u/edit') }}">
                        {{ csrf_field() }}
                        <h3>Edit your Information</h3>

                        <div class="form-group{{ $errors->has('profile_name') ? ' has-error' : '' }}">

                            <label for="profile_name" class="col-md-2 control-label">Optional Additional Name Info (full name, real-world associations)</label>
                            
                            <div class="col-md-8">

                                <input id="profile_name" type="text" class="form-control" name="profile_name" value="{{ old('profile_name') }}" autofocus>

                                @if ($errors->has('profile_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bio" class="col-md-2 control-label">Write a short bio if you wish, or anything you want to say</label>

                            <div class="col-md-8">
                                <textarea id="bio" class="form-control" name="bio" value="{{ old('bio') }}"></textarea>

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_new') ? ' has-error' : '' }}">
                            <label for="password_new" class="col-md-2 control-label">New Password</label>

                            <div class="col-md-8">
                                <input id="password_new" type="password" class="form-control" name="password_new">

                                @if ($errors->has('password_new'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_new') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm_new" class="col-md-2 control-label">Confirm Password</label>

                            <div class="col-md-8">
                                <input id="password-confirm_new" type="password" class="form-control" name="password_confirm_new">
                            </div>
                        </div>

                        <div class = "separator"></div>
                        <h4>Enter your password to authenticate</h4>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label">Current Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit">
                                    Update User Info
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
@stop