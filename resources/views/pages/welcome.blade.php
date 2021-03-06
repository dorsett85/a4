@extends('userPages')

@section('title')
    Stock Tracker
@endsection

@section('content')

    <h1 id="welcomeHead">
        Welcome {{ $userName }}
    </h1>

    <div>
        <h4>
            Start by <a href="/search">searching</a> for stocks to track. Remember to click
            <button class="btn btn-xs btn-success">Add to Favorites</button>.
        </h4>
        <h4>
            Once saved, view your favorites <a href="/favorites">here</a>.
        </h4>
    </div>

@endsection

