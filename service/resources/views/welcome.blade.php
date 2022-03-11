<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>{{config('app.name')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, max-scale=1.0">
        <style>
            * {
                box-sizing:  border-box;
            }
            html,
            body {
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100%;
                background-color: #264653;
            }
            body {
                display: grid;
                place-items: center;
            }

            .message {
                color: #fff;
                opacity: 0.85;
                font-size: 1.2rem;

            }
        </style>
    </head>
    <body>
        <span class="message">{{config('app.name')}} is working...</span>
    </body>
</html>
