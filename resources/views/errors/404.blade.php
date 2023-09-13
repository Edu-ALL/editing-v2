<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <title>Page Not Found</title>
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
    <link rel="stylesheet" href={{ asset('js/bootstrap.bundle.js') }}>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;800;900&display=swap');
    </style>
    <style>
        * {
            font-family: 'Maven Pro', sans-serif;
            line-height: 1.4;
        }
        .notfound-404 {
            position: absolute;
            height: 100px;
            /* top: 0; */
            left: 50%;
            -webkit-transform: translate(-50%);
            -ms-transform: translate(-50%);
            transform: translate(-50%);
            z-index: -1;
        }
        h1 {
            color: rgb(240, 240, 240);
            font-size: 276px;
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
        }
        h2 {
            color: black;
            font-size: 46px;
            font-weight: 900;
        }
        p {
            font-size: 16px;
            color: #000;
            font-weight: 400;
        }
        .btn {
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            background: #189cf0;
            display: inline-block;
            padding: 16px 38px;
            /* border: 2px solid transparent; */
            border-radius: 40px;
            color: #fff;
            font-weight: 400;
            -webkit-transition: .2s all;
            transition: .2s all;
        }
        .btn:focus {
            box-shadow: none;
        }
    </style>
</head>
<body class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh">
    <div class="col-10 text-center p-0">
        <div class="notfound-404">
            <h1 class="m-0">404</h1>
        </div>
        <h2 class="m-0 mb-3">WE ARE SORRY, PAGE NOT FOUND!</h2>
        <div class="col-9 mx-auto">
            <p>
                THE PAGE YOU ARE LOOKING FOR MIGHT DOES NOT EXIST, HAVE BEEN REMOVED HAD ITS NAME CHANGED OR IS TEMPORARILY UNAVAILABLE.
            </p>
        </div>
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">BACK TO PREVIOUS PAGE</a>
    </div>
</body>
</html>