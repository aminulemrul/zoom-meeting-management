<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zoom Meeting</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row" style="background: #bed95182">
        <div class="col-md-12">
            <h3 class="text-center"><a href="{{url('/')}}">ZOOM MEETING</a>
                <a href="{{url('login')}}" style="float: right;font-size: 15px"> &nbsp;&nbsp;Login</a>
                <a href="{{url('register')}}" style="float: right;font-size: 15px">Register </a>
            </h3>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block text-center">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block text-center">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="{{url('getLogin')}}" method="post">
                @csrf
                <h4 class="text-center">Login</h4>
                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" id="" class="form-control mx-sm-3" placeholder="User Name" required name="email">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" id="" class="form-control mx-sm-3" placeholder="Password" required name="password">
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Login</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" ></script>
</body>
</html>
