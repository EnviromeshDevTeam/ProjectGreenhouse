<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enviromesh</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/favicon.png')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
            background: #f7fafc;
        }
    </style>
</head>
<body>
<div class="container-fluid fixed-top p-4">
    <div class="col-12">
        <div class="d-flex justify-content-end">
                <div class="">

                    <a href="{{ url('/dashboard') }}" class="btn btn-success">Dashboard</a>
                    <a href="{{ route('login') }}" class="btn btn-danger">Log in</a>


                    <!--Disabled register as we don't want new accounts registering-->

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}" class="ml-4 text-muted">Register</a>--}}
{{--                        @endif--}}
                </div>
        </div>
    </div>
</div>

    <div class="row justify-content-center px-4">
        <div class="col-md-12 col-lg-9">
            <img src="{{asset('/images/enviromeshfull-logo.svg')}}" class="img-fluid" style="width: 317px;"  alt="Enviromesh Full Logo"/>
            <img src="{{asset('/images/greenhouselogo256.svg')}}" class="img-fluid" width="200" alt="greenhouse logo 256"/>


            <!--Device Status, ForEach Device Loop Here-->

            <div class="card shadow-sm">
                <div class="container">
                    <p>This is the website for Project Greenhouse made by the EnviromeshDevTeam. Team members are: Kym(Dashboard), Alex(Dashboard), Syd(Whole Stack) and Vushesh(Mobile)</p>
                </div>
                <div class="card-columns mx-auto d-flex justify-content-center">
                    @foreach($devices as $device)
                    <div class="card {{ $device->status['dstatus_bg'] }} text-dark"><!--Add FA icon status class here in future-->
                        <h2 class="card-header">
                            {{ $device->name}}
                                <i class="fas fa-check-circle"></i><!--Add FA icon status signifier here in future-->
                        </h2>
                        <div class="card-body text-center">
                            <p><i class="{{ $device->status['dstatus_icon'] }} fa-5x"></i></p><!--Add FA icon status here in future-->
                            <h3 class="card-text">Device {{ $device->status['dstatus']}} </h3><!--Add Status here in future-->
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="d-flex justify-content-between mt-3">
                    <div class="text-sm text-muted">
                        <div class="flex align-content-center">
                            <i class="fab fa-github fa-lg"></i>

                            <a href="https://github.com/EnviromeshDevTeam/" class="text-muted">
                                GitHub
                            </a>
                        </div>
                    </div>

                    <div class="text-sm text-muted">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
