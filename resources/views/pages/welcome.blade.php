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
            Start by <a href="/search">searching</a> for companies to track. Remember to click
            <button class="btn-xs btn-success">Add to Favorites</button>.
        </p>
        <p>
            Once saved, view your favorites <a href="/favorites">here</a>.
        </p>
    </div>

@endsection

