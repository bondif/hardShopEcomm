<!DOCTYPE HTML>
<html>
    <head>
    @include('includes.ad-head')
    <body style="background-color: rgb(239, 98, 80)">
        <div class="login">
            <h1><img src="{{ Storage::url('LogoHardShop_medium.png') }}"></h1>
            <div class="login-bottom">
                <h2>Login</h2>
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}

                    <ul>
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>

                    <div class="col-md-12">
                        <div class="login-mail">
                            <input type="text" placeholder="Username" required name="username">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="login-mail">
                            <input type="password" placeholder="Password" required name="password">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="login-do">
                            <label class="hvr-shutter-in-horizontal login-sub">
                                <input type="submit" value="Login">
                            </label>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </form>
            </div>
        </div>
        <div class="copy-right">
            <p style="color: white"> &copy; 2016 Hard Shop. All Rights Reserved </p>
        </div>
    </body>
</html>