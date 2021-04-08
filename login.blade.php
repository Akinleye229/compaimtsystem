<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Complaint System | Complaint Login</title>

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="{{ asset('files/css/login.css') }}">

</head>
<body>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Complaint Login Page</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">

            @if (Session::has('flash_message_success'))
                <p><span class="alert alert-success" style="text-align: center;font-size: 13px;">{{ Session::get('flash_message_success') }}</span></p>
            @endif

            @if(Session::has('flash_message_failure'))
                <p><span class="alert alert-danger" style="text-align: center;font-size: 13px;">{{ Session::get('flash_message_failure') }}</span></p>
            @endif
            <br>
            <form class="sign-in-htm" action="{{ url('complaint/login') }}" method="post">
                {{ csrf_field() }}
                <div class="group">
                    <label for="complaint" class="label">Username</label>
                    <input value="{{ old('username') }}" id="username" name="username" type="text" class="input">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="group">
                    <label for="pass" class="label">Password</label>
                    <input id="password" name="password" type="password" class="input" data-type="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="group">
                    <input type="submit" class="button" value="Sign In">
                </div>

            </form>
        </div>
    </div>
</div>


</body>
</html>