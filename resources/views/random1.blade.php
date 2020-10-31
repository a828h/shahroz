<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *,
        body {
            margin: 0;
            padding: 0;
            border: 0;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column
        }

        .main-box {
            width: 400px;
            height: 500px;
            background-color: #e0e0e0;
            overflow: hidden;
            position: relative;
        }

        .random-box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .random-item {
            height: 98px;
            width: 398px;
            border: 1px solid red;
            background-color: aqua;
            line-height: 80px;
            text-align: center;
            font-size: 50px;
        }

        button {
            width: 100px;
            height: 50px;
            margin: 50px auto;
            font-size: 20px
        }

        .active-random {
            animation: mymove 10s ease-in-out;
            animation-fill-mode: forwards;
        }

        @keyframes mymove {
            from   {top: 0px;}
            to {top: -19800px;}
          }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-box">
            <div class="random-box" id="random-box">
                @for($i = 0; $i <= 10; $i++) <div class="random-item {{$i}}">{{Str::random(6)}}</div>
            @endfor
        </div>
    </div>
    <button onclick="startRandom()">Start</button>
    </div>
    <script>
        function startRandom() {
            var element = document.getElementById("random-box");
            element.classList.add("active-random");
        }
    </script>
</body>

</html>