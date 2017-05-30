@extends('master')

@section('title')
    Stock Tracker Register
@endsection

@section('body')

    <div class="col-sm-5 center-block loginDiv">

        <div class="text-center loginP">
            <h1>Register</h1>
        </div>

        <form method="POST" id='register' action="{{ route('register') }}">
            {{ csrf_field() }}

            <p>* Required fields</p>

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
                <label for="name" class="col-form-label">* Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                       autofocus>
            </div>

            <div class="form-group">
                <label for="email" class="col-form-label">* E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label">* Password (min: 6)</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-form-label">* Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-info btn-block" name="submit">Register</button>

        </form>

    </div>

@endsection