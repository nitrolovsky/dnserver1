<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Информационный портал Службы государственного строительного надзора и экспертизы Санкт-Петербурга</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
        <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/docs.min.css">
        <link rel="stylesheet" href="/vendor/components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/custom.css">
    </head>
    <body class="body">
        @include('includes.navbar')
        <div class="bd-pageheader box-shadow bg-image">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <h4 class="display-4">
                            Служба государственного строительного надзора и экспертизы Санкт-Петербурга
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 bd-sidebar">
                    @include('includes.sidebar')
                </div>
                <div class="col-xl-9">
                    @include('includes.alerts')
                    @include('includes.errors')
                    @yield('content')
                    <br>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>
    </body>
</html>
