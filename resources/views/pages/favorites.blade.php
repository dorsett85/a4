@extends('master')

@section('title')
    Favorites Stocks
@endsection

@section('body')

    <h1 id="favHead">
        Favorite Stocks
    </h1>

    @if(Session::get('message') != null)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message', '') }}
        </div>
    @endif

    @if(!$favorites->isEmpty())
        @foreach($favorites as $value)
            <div id="{{ $value->ticker }}" class="favCompany">
                <h3>{{ $value->company_name }}</h3>
                <div>
                    <b>Symbol</b>: {{ $value->ticker }}<br>
                    <b>Exchange</b>: {{ $value->stock_exchange }}<br>
                    <b>Company URL</b>: <a href="{{$value->company_url }}" class="companyLink"
                                           target="_blank">{{ $value->company_url }}</a><br>
                    <b>State Headquarters</b>: {{ $value->hq_state }} <br>
                    <b>Sector</b>: {{ $value->sector }}<br>
                    <b>Industry Category</b>: {{ $value->industry_category }} <br>
                    <b>Industry Group</b>: {{ $value->industry_group }} <br>
                    <b>Tags</b>:
                    @foreach($allFavoritesTags as $name => $tags)
                        @if($name == $value->company_name)
                            {{ $tags }}
                        @endif
                    @endforeach
                </div>
                <form class="inlineBtn" action="/data" method="post">
                    {{ csrf_field() }}
                    <button class="btn-xs btn-success favoriteInfo">Description</button>
                    <input type="hidden" name="firstTicker" value="{{ $value->ticker }}">
                    <button type="submit" class="btn-xs btn-primary">
                        Get Data
                    </button>
                </form>
                <form class="inlineBtn" action="/favorites" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn-xs btn-danger" name="remove" value="{{ $value->id }}">
                        Remove From Favorites
                    </button>
                </form>
                <div class="shortDescription">
                    {{ $value->short_description }}
                </div>
            </div>
            <hr>
        @endforeach
    @else
        <h4>You have not selected any stocks to track yet.</h4>
    @endif

@endsection

@section('pageScript')
    <!-- local js -->
    <script src="js/companyUrl.js"></script>
@endsection