<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TajaMandi | All your Home Groceries.</title>
    <link rel = "icon" href = "{{asset('frontend/img/tajamandi.png')}}"
        type = "image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link href="{{asset('frontend/modalassets/css/login-register.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend/css/rating.css')}}" type="text/css">

    @stack('styles')
</head>

<body>
    @include('frontend.layouts.includes.header')

    @yield('content')

    @include('frontend.layouts.includes.footer')
    @include('frontend.layouts.includes.modal')

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{asset('frontend/modalassets/js/login-register.js')}}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        function showPasswordForm(){
        $('.loginBox').fadeOut('fast',function(){
            $('.passwordBox').fadeIn('fast');
            $('.login-footer').fadeOut('fast',function(){
                $('.register-footer').fadeIn('fast');
            });
            $('.modal-title').html('Reset Password');
        });
        $('.error').removeClass('alert alert-danger').html('');
    }
    function showRegisterForm(){
        $('.loginBox').fadeOut('fast',function(){
            $('.registerBox').fadeIn('fast');
            $('.passwordBox').fadeOut('fast');
            $('.login-footer').fadeOut('fast',function(){
                $('.register-footer').fadeIn('fast');
            });
            $('.modal-title').html('Register');
        });
        $('.error').removeClass('alert alert-danger').html('');
    }
    function showLoginForm(){
        $('#loginModal .registerBox').fadeOut('fast',function(){
            $('.loginBox').fadeIn('fast');
            $('.passwordBox').fadeOut('fast');
            $('.register-footer').fadeOut('fast',function(){
                $('.login-footer').fadeIn('fast');
            });

            $('.modal-title').html('Login');
        });
        $('.error').removeClass('alert alert-danger').html('');
    }


    function openLoginModal(){
        showLoginForm();
        setTimeout(function(){
            $('#loginModal').modal('show');
        }, 230);
    }
    function openRegisterModal(){
        showRegisterForm();
        setTimeout(function(){
            $('#loginModal').modal('show');
        }, 230);
    }
    function openPasswordModal(){
        showPasswordForm();
        setTimeout(function(){
            $('#loginModal').modal('show');
        }, 230);
    }
    </script>

@if ($errors->has('email') || $errors->has('password') || $errors->has('name') ||$errors->has('password_confirmation'))
    <script type="text/javascript">
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');
    }, 230);
    shakeModal()
    function shakeModal(){
        $('#loginModal .modal-dialog').addClass('shake');
                setTimeout( function(){
                    $('#loginModal .modal-dialog').removeClass('shake');
        }, 2000 );
    }
    </script>
@endif
<script type="text/javascript">
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000); // 5 secs
</script>
@stack('scripts')
</body>

</html>
