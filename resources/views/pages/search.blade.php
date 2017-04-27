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
        <div id="{{ $array['ticker'] }}" class="favCompany">
            <h2>{{ $array['company'] }}</h2>
            <p>
                <b>Symbol</b>: {{ $array['ticker'] }}<br>
                <b>Exchange</b>: {{ $array['stock_exchange'] }}<br>
                <b>Company URL</b>: <a href="{{$array['company_url'] }}">{{ $array['company_url'] }}</a><br>
                <b>State Headquarters</b>: {{ $array['hq_state'] }} <br>
                <b>Sector</b>: {{ $array['sector'] }}<br>
                <b>Industry Category</b>: {{ $array['industry_category'] }} <br>
                <b>Industry Group</b>: {{ $array['industry_group'] }} <br>
            </p>
            <p>
                {{ $array['short_description'] }} <br>
            </p>
        </div>

        <form action="/add" method="post">
            {{ csrf_field() }}
            @foreach($array as $index => $item)
                <input type="hidden" name="{{ $index }}" value="{{ $item }}">
            @endforeach
            <input type="submit" class="btn-xs btn-success" value="Add to Favorites">
        </form>
    @endif

@endsection
