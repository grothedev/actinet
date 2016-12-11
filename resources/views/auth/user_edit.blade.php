@extends('template')

@section('container')
    <div class="row">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/u/edit') }}">
                        {{ csrf_field() }}
                        <h3>Edit your Information</h3>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-2 control-label">Username</label>

                            <div class="col-md-8">

                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile_name') ? ' has-error' : '' }}">

                            <label for="profile_name" class="col-md-2 control-label">Optional Additional Name Info</label>
                            (full name, real-world associations)
                            
                            <div class="col-md-8">

                                <input id="profile_name" type="text" class="form-control" name="profile_name" value="{{ old('profile_name') }}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label">Password</label>

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
                            <label for="password-confirm" class="col-md-2 control-label">Confirm Password</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
@stop