@extends('master')

@section('title')
    Stock Tracker Login
@endsection

@section('body')

    <div class="col-sm-6 center-block loginDiv">

        <div class="text-center loginP">
            <h1>Login</h1>

            Don't have an account? <a href='/register'>Register here...</a><br>
            Or, return to <a href='/'>main page...</a>
        </div>

        <form id='login' method="POST" action="/login">
            {{ csrf_field() }}

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="email" class="col-form-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label">Password</label>
                <input id="password" type="password"  class="form-control" name="password" required>
            </div>

            <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</label>

            <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a>

            <button type="submit" class="btn btn-info btn-block" name="submit" id="submit">Login</button>

        </form>
    </div>

@endsection