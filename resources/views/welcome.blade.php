<!DOCTYPE html>
<html lang="en">
<head>

    <title>TITLE</title>
    <meta charset="utf-8">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Stylesheet Links -->
    <link rel="stylesheet" href="">

</head>
<body>

<div class="container-fluid">
    <form method="post" action="/post">

        {{ csrf_field() }}

        <label for="company">Enter Company</label>
        <input type="text" name="company">
        <input type="submit" class="btn btn-primary">
    </form>
</div>


<!-- JQuery Link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Other script links -->
<script src=""></script>

</body>
</html>

