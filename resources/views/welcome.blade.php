
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
   
    </head>

    @if(Route::has('login'))
    @auth
    <script>window.location = "/basicInsight";</script>
    @else
     @include('auth.login')  
    @endauth
    @endif
</html>
