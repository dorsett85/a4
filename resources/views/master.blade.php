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

<div class="container">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="row">
            <header>
                <div id="headerText">
                    <h1>Company Tracker</h1>
                </div>
            </header>
        </div>
        <div class="row">
            <div id="sidebar" class="container col-md-3">
                <ul class="nav nav-tabs nav-stacked">
                    <li class="nav-item">
                        <a class="nav-link" id="home" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="about" href="/favorites">Favorites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="hikeCareFeed" href="/search">Search Companies</a>
                    </li>
                </ul>
                <div id="creditList">
                    <p>
                        Data acquired from:
                    </p>
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

<!-- Other script links -->
<script src="js/a4.js"></script>

</body>
</html>

