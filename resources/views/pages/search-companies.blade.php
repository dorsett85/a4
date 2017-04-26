@extends('master')

@section('title')
    Search Companies
@endsection

@section('body')

    <div class="container-fluid">
        <form method="post" action="/search">

            {{ csrf_field() }}

            <label for="company">Enter Company</label>
            <input type="text" name="company" id="company" value="{{ old('company', '') }}">
            <input type="submit" class="btn btn-primary">

        </form>
    </div>

    @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if($name)
        {{ $array['ticker'] }}
    @endif

@endsection