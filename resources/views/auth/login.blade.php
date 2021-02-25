<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../adminlte/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <h1  align="center">GADHOMES</h1>
        <div class="form-box" id="login-box">
            <div class="form-box" id="login-box">
                <div class="header">Sign In</div>
            
                <form action="{{ route('login') }}" method="POST">
                    @csrf
            
                    <div class="body bg-gray">
                        <p><a href="#">Please enter your User Name and Password</a></p>
            
                        <div class="form-group">
                            <label for="user" class="col-md-4 col-form-label text-md-right">User Name:</label>
                            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="User Name" required autocomplete="username" autofocus/>
            
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password"/>
            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>          
            
                    </div>
                    <div class="footer">                                                               
                        <button type="submit" class="btn bg-red btn-block">Login</button> 
                    </div>
                </form>
            
            </div>
        </div>

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../adminlte/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>

