<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>EMAS</title>
        <link rel="icon" type="image/png" href="{{asset('/images/logo.svg')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' type='text/css' media='screen' href='{{asset('css/login.css')}}'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- bootstrap core css -->
<link href="{{asset('user/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>

@media only screen and (min-width: 768px) and (max-width: 769px) {
.navbar-brand img {
  width: auto;
  height: 40%;
}

}
@media only screen and (min-width: 500px) and (max-width: 740px) {
.navbar-brand img {
  width: auto;
  height: 40%;
}
.navbar-expand-md .navbar-nav .nav-link {
   padding: 7px 0 !important;
   margin: 0 auto !important;
}

}
@media only screen and (min-width: 500px) and (max-width: 540px) {
.form-sec1 {
    padding: 70px !important;
}
}

@media only screen and (min-width: 360px) and (max-width: 360px) {
  .form-sec1 {
    margin-block: 100px !important;
  }
}
@media only screen and (min-width: 359px) and (max-width: 428px) {
.navbar-brand img {
  width: auto;
  height: 40%;
}
.navbar-expand-md .navbar-nav .nav-link {
   padding: 7px 0 !important;
   margin: 0 auto !important;
}
.form-sec1 {
  padding: 45px !important;
  width: 100% !important;
}
}

@media only screen and (max-width: 300px) {
  .navbar-brand img {
  width: auto;
  height: 40%;
}
.navbar-expand-md .navbar-nav .nav-link {
   padding: 7px 0 !important;
   margin: 0 auto !important;
}
.form-sec1 {
  /* padding: 45px !important; */
  width: 100% !important;
  margin-block: 100px !important;
}
.loginNavProfile {
    font-size: 15px !important;
}
}
</style>

    </head>
    <body>
        <div class="login">
            
            @if(session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" style="float:right">
                    
                </button>
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('failed'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" style="float:right">
                    
                </button>
                {{ session()->get('failed') }}
            </div>
        @endif
            @yield('content')
        </div>
        @stack('custom-scripts')
    </body>
</html>