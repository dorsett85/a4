<!DOCTYPE html>
<html lang="en">
<head>

    <title>
        @yield('title', 'Company Tracker')
    </title>
    <meta charset="utf-8">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Stylesheet Links -->
    <link rel="stylesheet" href="css/a4.css">

</head>
<body>

<header>
    <div id="headerText">
        <h1>Company Tracker</h1>
    </div>
</header>

<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
            
            <div id="sidebar" class="container col-md-3">
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
                </ul>
                <div id="creditList">
                    <p>
                        Data acquired from:
                    </p>
                    <div>
                        Quandle
                    </div>
                    <img src="images/quandl-logo.png">
                    <div>
                        Intrinio
                    </div>
                    <img src="images/intrinio-logo.jpg">
                </div>
            </div>
            
            <div id="bodyDiv" class="col-md-9">
                @yield('body')
            </div>
            
        </div>
    </div>
</div>


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

