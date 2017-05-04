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

        <div class="form-group">
            <label for="company">Enter company (partial matches accepted)</label>
            <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $company) }}"
                   autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>

    </form>

    @if(Session::get('message') != null)
        <div class="alert alert-success spaceAbove">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message', '') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger spaceAbove">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!empty($company))
        <p class="spaceAbove">
            Top {{ count($searchResults) }} result{{ (count($searchResults) > 1) ? 's' : '' }}
            for '{{ $company }}', ordered alphabetically:
        </p>
        @foreach($searchResults as $key => $value)
            <div>
                <h3>{{ $value['company'] }}</h3>
                @if(empty($value['duplicate']))
                    <form action="/add" method="post">
                        {{ csrf_field() }}
                        @foreach($value as $index => $item)
                            <input type="hidden" name="{{ $index }}" value="{{ $item }}">
                        @endforeach
                        <input type="submit" class="btn-xs btn-success spaceBelow" value="Add to Favorites">
                    </form>
                @else
                    <button type="button" class="btn-xs btn-danger spaceBelow disabled">Already Added to Favorites
                    </button>
                @endif
                <div>
                    <b>Symbol</b>: {{ $value['ticker'] }}<br>
                    <b>Exchange</b>: {{ $value['stock_exchange'] }}<br>
                    <b>Company URL</b>: <a href="{{$value['company_url'] }}"
                                           target="_blank">{{ $value['company_url'] }}</a><br>
                    <b>State Headquarters</b>: {{ $value['hq_state'] }} <br>
                    <b>Sector</b>: {{ $value['sector'] }}<br>
                    <b>Industry Category</b>: {{ $value['industry_category'] }} <br>
                    <b>Industry Group</b>: {{ $value['industry_group'] }} <br>
                </div>
                <button class="btn-xs btn-info searchInfo">Description</button>
                <div class="shortDescription">
                    {{ $value['short_description'] }}
                </div>
            </div>
            <hr>
        @endforeach
    @endif


@endsection

@section('pageScript')
    <script src="js/search.js"></script>
@endsection
