<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>

        <table style="width:100%">

            <tr>

                <td><img src="{{ 'img/plantilla/logo-fissa.png' }}" alt="Logo Fissa" width="250px"></td>

                <td style="text-align:right;">

                    <h5 style="font-family: sans-serif">Sistema integrado de vacunaci&oacute;n Anti-Aftosa</h5>

                    <h5>{{$title}}</h5>

                    <small>{{ $today }}</small>

                </td>

            </tr>

        </table>

        <br>
        <hr>

        @yield('content')

    </body>

</html>
