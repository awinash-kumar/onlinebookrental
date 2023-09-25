<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    .bg_url {
        background-image: url(https://img.freepik.com/free-photo/abundant-collection-antique-books-wooden-shelves-generated-by-ai_188544-29660.jpg?t=st=1693998898~exp=1694002498~hmac=87611bbd628dace042f413286c1d76835844b60fb9fafba36a2a20c4fc3abc62&w=826);
    }
    .form_grup{
        background-color:#402923!important;
        
    }
    .form_grup h1{
        color: white ;
        font-size: 30px;
        text-align: center;
        padding-bottom:10px;
    }
    .form_grup form label , .form_grup span{ 
        color:white;
        font-size: 17px;
    }
    .remeber_me {
        color:white;
        font-size: 15px;
    }
    .anch_sty{
        background: darkslategrey;
        color: aliceblue;
        padding: 11px;
        border-radius: 17px;
    }
</style>


    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="bg_url min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" >
        @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="anch_sty font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="anch_sty font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="anch_sty ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register/User</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="form_grup w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" >
                <h1>Login</h1>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
