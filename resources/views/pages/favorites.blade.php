@extends('master')

@section('title')
    Favorites Companies
@endsection

@section('body')

    <h1 id="favHead">
        Favorite companies
    </h1>

    @if(Session::get('message') != null)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message', '') }}
        </div>
    @endif

    @if(count($favorites) > 0)
        @foreach($favorites as $key => $value)
            <div id="{{ $value['ticker'] }}" class="favCompany">
                <h3>{{ $value['company_name'] }}</h3>
                <div>
                    <b>Symbol</b>: {{ $value['ticker'] }}<br>
                    <b>Exchange</b>: {{ $value['stock_exchange'] }}<br>
                    <b>Company URL</b>: <a href="http://{{$value['company_url'] }}"
                                           target="_blank">{{ $value['company_url'] }}</a><br>
                    <b>State Headquarters</b>: {{ $value['hq_state'] }} <br>
                    <b>Sector</b>: {{ $value['sector'] }}<br>
                    <b>Industry Category</b>: {{ $value['industry_category'] }} <br>
                    <b>Industry Group</b>: {{ $value['industry_group'] }} <br>
                </div>
                <form class="inlineBtn" action="/data" method="post">
                    {{ csrf_field() }}
                    <button class="btn-xs btn-success infoButton">Description</button>
                    <input type="hidden" name="company" value="{{ $value['company_name'] }}">
                    <input type="hidden" name="data" value="data">
                    <button type="submit" class="btn-xs btn-primary" name="ticker" value="{{ $value['ticker'] }}">
                        Get Data
                    </button>
                </form>
                <form class="inlineBtn" action="/favorites" method="post">
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
        <p id="noCompany">You have not selected any companies to track yet.</p>
    @endif

@endsection