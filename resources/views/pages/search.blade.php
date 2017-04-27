@extends('master')

@section('title')
    Search Companies
@endsection

@section('body')

    @if(Session::get('message') != null)
        <div class='message'>{{ Session::get('message') }}</div>
    @endif

    <div class="container-fluid">
        <form method="post" action="/search">

            {{ csrf_field() }}

            <label for="company">Enter Company</label>
            <input type="text" name="company" id="company" value="{{ old('company', $company) }}">
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

    @if(!empty($company))
        <form action="/add" method="post">
            {{ csrf_field() }}
            @foreach($array as $index => $item)
                <div>
                    {{ $item }}
                    <input type="hidden" name="{{ $index }}" value="{{ $item }}">
                </div>
            @endforeach
            <input type="submit" value="Add to Favorites">
        </form>
    @endif

@endsection