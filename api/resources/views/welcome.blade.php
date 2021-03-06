<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
            <form method="post" action="/api/authenticate">
              email: <input type="text" name="email"><br>
              password:<input type="text" name="password"><br>
              <input type="submit">
            </form>
            <form method="post" action="/api/user">
              name: <input type="text" name="name"><br>
              email: <input type="text" name="email"><br>
              password:<input type="text" name="password"><br>
              <input type="submit" name="userapi">
            </form>
            <form method="post" action="/api/project/create">
              name: <input type="text" name="name"><br>
              token: <input type="text" name="token"><br>
              <input type="submit" name="userapi">
            </form>
        </div>
    </body>
</html>
