@extends('userPages')

@section('title')
    Favorites Stocks
@endsection

@section('content')

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

                <div class="btn-toolbar spaceAbove">
                    <button class="btn btn-sm btn-info favoriteInfo">Description</button>
                    <a href="/data/{{ $value->ticker }}" class="btn btn-sm btn-primary">
                        Get Data <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="shortDescription">
                    {{ $value->short_description }}
                </div>

                <form class="spaceAbove" action="/favorites" method="post">
                    {{ csrf_field() }}

                    <button class="btn btn-sm btn-danger" name="remove" value="{{ $value->id }}">
                        Remove From Favorites <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </form>


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