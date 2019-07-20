@extends('layouts.app-custom')
@section('content')
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-4 col-md-offset-4">
                    <section class="white-box">
                        <div class="user-account">
                            <h2>Admin Login</h2>
                            <p>Please enter your email and password</p>
                            <br>
                            <!-- form -->
                            <form class="" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                               <center> <button type="submit" name="bit_login" class="btn"><i class="fa fa-sign-in"></i> Login</button></center>

                            </form>
                            <!-- form -->
                         
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    
@endsection



