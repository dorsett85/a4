@extends('master')

@section('title')
    Company Tracker
@endsection

@section('body')

    <h1 id="welcomeHead">
        Welcome to the company tracker application
    </h1>

    <div>
        <p>
            Start by <a href="/search">searching for companies</a> to track.  Remember to click 'Add to Favorites'.
        </p>
        <p>
            View your favorites <a href="/favorites">here</a>.
        </p>
    </div>

@endsection

