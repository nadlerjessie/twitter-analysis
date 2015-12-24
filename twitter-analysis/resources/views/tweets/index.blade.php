<!DOCTYPE html>
<html>
<head>
  <title>Flatiron School Tweet Stats</title>
</head>
<body>
hello, it's me
  @foreach($tweets as $key => $tweet)
    <p><h3>{{ $tweet->text }}</h3></p>
  @endforeach

</body>
</html>