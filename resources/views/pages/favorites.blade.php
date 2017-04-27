@extends('master')

@section('title')
    Favorites Companies
@endsection

@section('body')

    <h1>Companies you are currently tracking:</h1>

    @if(count($favorites) > 0)
        @foreach($favorites as $key => $value)
            <div id="{{ $value['ticker'] }}" class="favCompany">
                <h2>{{ $value['company_name'] }}</h2>
                <p>
                    <b>Symbol</b>: {{ $value['ticker'] }}<br>
                    <b>Exchange</b>: {{ $value['stock_exchange'] }}<br>
                    <b>Company URL</b>: <a href="{{$value['company_url'] }}">{{ $value['company_url'] }}</a><br>
                    <b>State Headquarters</b>: {{ $value['hq_state'] }} <br>
                    <b>Sector</b>: {{ $value['sector'] }}<br>
                    <b>Industry Category</b>: {{ $value['industry_category'] }} <br>
                    <b>Industry Group</b>: {{ $value['industry_group'] }} <br>
                </p>
                <form action="/data" method="get">
                    {{ csrf_field() }}
                    <button class="btn-xs btn-success infoButton">Description</button>
                    <input type="hidden" name="company" value="{{ $value['company_name'] }}">
                    <button type="submit" class="btn-xs btn-primary" name="symbol" value="{{ $value['ticker'] }}">
                        Get Data
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