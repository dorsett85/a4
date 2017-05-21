<!DOCTYPE html>
<html lang="en">
<head>

    <title>
        @yield('title', 'Stock Tracker')
    </title>
    <meta charset="utf-8">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Page specific import styles -->
@yield('pageStyle')

<!-- Stylesheet Links -->
    <link rel="stylesheet" href="/css/a4.css">

</head>
<body>

<header>
    <div>
        <h1>Stock Tracker</h1>
        <h5>
            Your source for publicly traded stock information
        </h5>
    </div>
    <h1 id="headerLogo" class="glyphicon glyphicon-briefcase"></h1>
</header>

<div class="container">
    <div id="mainDiv" class="col-sm-10 col-sm-offset-1">

        <div id="sidebar" class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-item">
                    <a class="nav-link" id="home" href="/">Home</a>
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
                                <a class="nav-link dropdown-item">
                                    Add More Favorites
                                </a>
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
        </div>

        <div id="bodyDiv" class="col-md-9">
            @yield('body')
        </div>

    </div>
</div>

<footer>
    <h4>
        This application uses data<br>
        from the following APIs...
    </h4>
    <div id="quandleImg" class="creditImgs">
        <div>
            Quandle
        </div>
        <a href="https://www.quandl.com/" target="_blank">
            <img src="/images/quandl-logo.png" alt="quandl-logo">
        </a>
    </div>
    <div id="intrinoImg" class="creditImgs">
        <div>
            Intrinio
        </div>
        <a href="https://intrinio.com/" target="_blank">
            <img src="/images/intrinio-logo.jpg" alt="intrinio-logo">
        </a>
    </div>
</footer>


<!-- JQuery Link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Page specific js -->
@yield('pageScript')

<!-- Other script links -->
<script src="/js/a4.js"></script>

</body>
</html>

