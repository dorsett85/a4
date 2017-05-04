@extends('master')

@section('title')
    Company Tracker
@endsection

@section('body')

    <h1 id="welcomeHead">
        Welcome to the company tracker application
    </h1>

    <div>
        <h4>
            Start by <a href="/search">searching</a> for companies to track. Remember to click
            <button class="btn-xs btn-success">Add to Favorites</button>.
        </h4>
        <h4>
            Once saved, view your favorites <a href="/favorites">here</a>.
        </h4>
    </div>

@endsection

