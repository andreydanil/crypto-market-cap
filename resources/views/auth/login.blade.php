@extends('layouts.starter')

@section('content')
    <section id="wrapper">
        <div class="login-box card">
            <div class="card-block">

                <form class="form-horizontal form-material" id="loginform" method="POST"
                      action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <h3 class="box-title m-b-20">Sign In</h3>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-xs-4 control-label">E-Mail Address</label>

                        <div class="col-xs-6">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-xs-4 control-label">Password</label>

                        <div class="col-xs-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-info btn-lg btn-block">
                                Login
                            </button>
                            <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-info m-l-5"><b>Sign
                                        Up</b></a></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection