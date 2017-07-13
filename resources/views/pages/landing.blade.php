@extends('master')

@section('body')

    <div id="landingHeader" class="text-center">
        <h1>
            Welcome to the Stock Tracker Application
        </h1>
        <i class="fa fa-line-chart" aria-hidden="true"></i>
        <h3>
            Company/fund information and prices, updated daily
        </h3>
    </div>

    <div id="landingButtons">
        <div>
            <div class="btn-group">
                <div>
                    <a href="/login" class="btn btn-lg btn-default landingButton">Login</a>
                </div>
            </div>
            <div class="btn-group">
                <div>
                    <a href="/register" class="btn btn-lg btn-default landingButton">Register</a>
                </div>
            </div>
            <div class="btn-group">
                <div>
                    <a href="/guest" class="btn btn-lg btn-default landingButton">Sign in as Guest</a>
                </div>
            </div>
        </div>
    </div>

    <div id="landingFeatures">
        <h3>
            Stock Tracker Features:
        </h3>
        <ul>
            <li>Quandl API stock prices, updated daily</li>
            <li>Intrinio API Company/fund information</li>
            <li>Interactive and customizable price charts</li>
            <li>Save and track your portfolio of favorite stocks</li>
        </ul>
    </div>

    <div id="landingInfo">
        <h3>
            Sample Company/Fund Information
        </h3>

        <div id="sampleCompanies">
        @foreach($landingInfo as $item)
                <div class="companyPadding">
                    <h4>{{ $item['company'] }}</h4>
                    <button class="btn btn-sm btn-success spaceBelow landingFavorite" value="Add to Favorites">
                        Add to Favorites
                    </button>
                    <div class="alertFade">
                        <div class="alert alert-danger">Login to use this feature</div>
                    </div>
                    <div>
                        <b>Symbol</b>: {{ $item['ticker'] }}<br>
                        <b>Exchange</b>: {{ $item['stock_exchange'] }}<br>
                        <b>Company URL</b>: <a href="{{$item['company_url'] }}" class="companyLink"
                                               target="_blank">{{ $item['company_url'] }}</a><br>
                        <b>State Headquarters</b>: {{ $item['hq_state'] }} <br>
                        <b>Sector</b>: {{ $item['sector'] }}<br>
                        <b>Industry Category</b>: {{ $item['industry_category'] }} <br>
                        <b>Industry Group</b>: {{ $item['industry_group'] }} <br>
                    </div>
                    <button class="btn btn-sm btn-info landingInfo">Description</button>
                    <div class="shortDescription">
                        {{ $item['short_description'] }}
                    </div>
                </div>
        @endforeach
        </div>

    </div>

    <div id="landingChart">
        <h3>
            Interactive Charting
        </h3>
        <button id="landingChartButton" class="btn btn-lg btn-warning">
            View sample chart <i class="fa fa-line-chart" aria-hidden="true"></i> <i id="fa-spinner"></i>
        </button>
        <span id="exampleSpan">Click again to see more examples!</span>
        <div id="plotDiv">
            <!-- Plotly chart will go here on button click -->
        </div>
    </div>

@endsection

@section('pageScript')
    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <!-- local js -->
    <script src="/js/landing.js"></script>
@endsection