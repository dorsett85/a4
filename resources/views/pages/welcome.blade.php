@extends('master')

@section('title')
    Company Tracker
@endsection

@section('body')

<div class="container-fluid">
    <form method="post" action="/post">

        {{ csrf_field() }}

        <label for="company">Enter Company</label>
        <input type="text" name="company">
        <input type="submit" class="btn btn-primary">

    </form>
</div>

@endsection

