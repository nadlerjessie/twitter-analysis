<!DOCTYPE html>
<html>
<body>
<h1>@FlatironSchool's Latest Tweets</h1>
  <?php $i = 1 ?>
  @foreach($tweets as $key => $tweet)
    <?php if( $tweet->getAttribute('text') ) {?>
      <p><h4>{{$i}}: {{ $tweet->getAttribute('text') }} -- {{ $tweet->getAttribute('favorite_count') }} Favorites -- {{ $tweet->getAttribute('retweet_count') }} RTs</h4></p>
    <?php 
      $i += 1;
      } 
    ?>
  @endforeach

</body>
</html>