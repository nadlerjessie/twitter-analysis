<!DOCTYPE html>
<html>
<body>
<h1>@FlatironSchool's Tweets</h1>
  <h3>Optimal time to tweet: {{ $time }}</h3>
  <?php $i = 1 ?>
  @foreach($tweets as $key => $tweet)
    <?php if( $tweet->getAttribute('text') ) {?>
      <p><h4>{{$i}}: {{ $tweet->text()}} -- {{ $tweet->favorite_count() }} Favorites -- {{ $tweet->retweet_count() }} RTs</h4></p>
    <?php 
      $i += 1;
      } 
    ?>
  @endforeach

</body>
</html>