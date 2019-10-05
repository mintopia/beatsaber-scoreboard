<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Beat Saber</title>
    <link href="https://fonts.googleapis.com/css?family=Teko:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/beatsaber/css/application.css" />
</head>
<body>
<div id="particles-js"></div>

<h1>
    <span class="red">epi<span class="blink">c</span><span class="buzz">.</span>LAN</span>
    <br />
    <span class="blue">Be<span class="blink">a</span>t Saber</span>
</h1>

<section>
    <h2>{{ $leaderboard->name }}</h2>
    <div class="well" id="leaderboard"></div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="/beatsaber/js/particles.min.js"></script>
<script src="/beatsaber/js/application.js"></script>
@yield('leaderboard')
</body>
</html>
