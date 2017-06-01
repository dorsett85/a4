@extends('master')

@section('body')

    <div id="sidebar" class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-item">
                <a class="nav-link" id="home" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="search" href="/search">Search Stocks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="favorites" href="/favorites">Favorites</a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" id="data" data-toggle="dropdown" href="#">
                    Data <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @if($favoritesList->isEmpty())
                        <li>
                            <a class="nav-link dropdown-item">Add More Favorites</a>
                        </li>
                    @else
                        @foreach($favoritesList as $item)
                            <li>
                                <a class="nav-link dropdown-item" href="/data/{{ $item->ticker }}">
                                    {{ $item->company_name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
        </ul>

        <form method='POST' id='logout' action='/logout'>
            {{csrf_field()}}
            <button class="btn btn-lg btn-default btn-block">Logout</button>
        </form>

    </div>

    <div id="bodyDiv" class="col-md-9">
        @yield('content')
    </div>

@endsection