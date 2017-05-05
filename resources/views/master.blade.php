<!DOCTYPE html>
<html lang="en">
<head>

    <title>
        @yield('title', 'Company Tracker')
    </title>
    <meta charset="utf-8">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Page specific import styles -->
@yield('pageStyle')

<!-- Stylesheet Links -->
    <link rel="stylesheet" href="css/a4.css">

</head>
<body>

<header>
    <div>
        <h1>Company Tracker</h1>
        <h5>
            Your source for publicly traded stock information
        </h5>
    </div>
    <h1 id="headerLogo" class="glyphicon glyphicon-briefcase"></h1>
</header>

<div class="container">
    <div id="mainDiv" class="col-sm-10 col-sm-offset-1">
        <div class="row">

            <div id="sidebar" class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-item">
                        <a class="nav-link" id="home" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="search" href="/search">Search Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="favorites" href="/favorites">Favorites</a>
                    </li>
                    @if(isset($favorites['data']))
                        <li class="nav-item">
                            <a class="nav-link" id="data">Data</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div id="bodyDiv" class="col-md-9">
                @yield('body')
            </div>

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
            <img src="images/quandl-logo.png">
        </a>
    </div>
    <div id="intrinoImg" class="creditImgs">
        <div>
            Intrinio
        </div>
        <a href="https://intrinio.com/" target="_blank">
            <img src="images/intrinio-logo.jpg">
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
<script src="js/a4.js"></script>

</body>
</html>

