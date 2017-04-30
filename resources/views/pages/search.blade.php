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
        <div id="{{ $infoArray['ticker'] }}" class="favCompany">
            <h2>{{ $infoArray['company'] }}</h2>

            <form action="/add" method="post">
                {{ csrf_field() }}
                @foreach($infoArray as $index => $item)
                    <input type="hidden" name="{{ $index }}" value="{{ $item }}">
                @endforeach
                <input type="submit" class="btn-xs btn-success" value="Add to Favorites">
            </form>

            <hr>
            <p>
                <b>Symbol</b>: {{ $infoArray['ticker'] }}<br>
                <b>Exchange</b>: {{ $infoArray['stock_exchange'] }}<br>
                <b>Company URL</b>: <a href="{{$infoArray['company_url'] }}">{{ $infoArray['company_url'] }}</a><br>
                <b>State Headquarters</b>: {{ $infoArray['hq_state'] }} <br>
                <b>Sector</b>: {{ $infoArray['sector'] }}<br>
                <b>Industry Category</b>: {{ $infoArray['industry_category'] }} <br>
                <b>Industry Group</b>: {{ $infoArray['industry_group'] }} <br>
            </p>
            <p>
                {{ $infoArray['short_description'] }} <br>
            </p>
        </div>

    @endif

@endsection

@section('pageScript')
    <script src="js/search.js"></script>
@endsection
