@extends('layouts.starter')

@section('content')
    <section id="wrapper">
        <div class="login-box card">
            <div class="card-block">
                <form class="form-horizontal form-material" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h3 class="box-title m-b-20">Register</h3>

                    <div class="form-group{{ $errors->has('name') ? ' error' : '' }}">
                        <label for="name" class="col-xs-12 control-label">Name</label>

                        <div class="col-xs-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <ul>
                                        <li>{{ $errors->first('name') }}</li>
                                    </ul>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                        <label for="email" class="col-xs-12 control-label">E-Mail Address</label>

                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <ul>
                                        <li>{{ $errors->first('email') }}</li>
                                    </ul>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' error' : '' }}">
                        <label for="password" class="col-xs-12 control-label">Password</label>

                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <ul>
                                        <li>{{ $errors->first('password') }}</li>
                                    </ul>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-xs-12 control-label">Confirm Password</label>

                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-success p-t-0 p-l-10">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> I agree to all
                                    <a target="_blank" href="{{ route('static.terms') }}">Terms</a></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Sign Up
                            </button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="{{ route('login') }}" class="text-info m-l-5"><b>Sign
                                        In</b></a>
                            </p>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </section>

@endsection
