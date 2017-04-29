@extends('master')

@section('title')
    Favorites Companies
@endsection

@section('body')

    <h1>Companies you are currently tracking:</h1>

    @if(Session::get('message') != null)
        <div class='remove'>{{ Session::get('message') }}</div>
    @endif

    @if(count($favorites) > 0)
        @foreach($favorites as $key => $value)
            <div id="{{ $value['ticker'] }}" class="favCompany">
                <h2>{{ $value['company_name'] }}</h2>
                <div>
                    <b>Symbol</b>: {{ $value['ticker'] }}<br>
                    <b>Exchange</b>: {{ $value['stock_exchange'] }}<br>
                    <b>Company URL</b>: <a href="http://{{$value['company_url'] }}" target="_blank">{{ $value['company_url'] }}</a><br>
                    <b>State Headquarters</b>: {{ $value['hq_state'] }} <br>
                    <b>Sector</b>: {{ $value['sector'] }}<br>
                    <b>Industry Category</b>: {{ $value['industry_category'] }} <br>
                    <b>Industry Group</b>: {{ $value['industry_group'] }} <br>
                </div>
                <form class="favBtn" action="/data" method="get">
                    {{ csrf_field() }}
                    <button class="btn-xs btn-success infoButton">Description</button>
                    <input type="hidden" name="company" value="{{ $value['company_name'] }}">
                    <button type="submit" class="btn-xs btn-primary" name="symbol" value="{{ $value['ticker'] }}">
                        Get Data
                    </button>
                </form>
                <form class="favBtn" action="/remove" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn-xs btn-danger" name="remove" value="{{ $value['company_name'] }}">
                        Remove From Favorites
                    </button>
                </form>
                <div class="shortDescription">
                    {{ $value['short_description'] }} <br>
                </div>
            </div>
            <hr>
        @endforeach
    @else
        <div>
            <p>You have not selected any companies to track yet.</p>
        </div>
    @endif

@endsection