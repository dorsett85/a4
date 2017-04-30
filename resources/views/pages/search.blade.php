@extends('master')

@section('title')
    Search Companies
@endsection

@section('body')

    <h1 id="searchHead">
        Search Public Companies
    </h1>

    <form id="searchForm" method="post" action="/search">
        {{ csrf_field() }}

        <label for="company">Enter Company</label>
        <input type="text" name="company" id="company" value="{{ old('company', $company) }}">
        <input type="submit" class="btn btn-primary">

    </form>

    @if(Session::get('message') != null)
        <div class="alert alert-success alertSpace">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message', '') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger alertSpace">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!empty($company))
        <p>Top five or fewer results, ordered alphabetically:</p>
        @foreach($searchResults as $key => $value)
            <div id="{{ $value['ticker'] }}" class="favCompany">
                <h3>{{ $value['company'] }}</h3>
                <form action="/add" method="post">
                    {{ csrf_field() }}
                    @foreach($value as $index => $item)
                        <input type="hidden" name="{{ $index }}" value="{{ $item }}">
                    @endforeach
                    <input type="submit" class="btn-xs btn-success" value="Add to Favorites">
                </form>
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
                    <button class="btn-xs btn-info infoButton">Description</button>
                </form>
                <div class="shortDescription">
                    {{ $value['short_description'] }} <br>
                </div>
            </div>
            <hr>
        @endforeach
    @endif


@endsection

@section('pageScript')
    <script src="js/search.js"></script>
@endsection
