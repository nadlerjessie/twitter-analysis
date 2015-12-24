<!DOCTYPE html>
<html>
<body>
<h1>@FlatironSchool's Latest Tweets</h1>
  @foreach($tweets as $key => $tweet)
    <?php if( $tweet->getAttribute('text') ) {?>
      <p><h3>{{ $tweet->getAttribute('text') }} -- {{ $tweet->getAttribute('favorite_count') }} Favorites -- {{ $tweet->getAttribute('retweet_count') }} RTs</h3></p>
    <?php } ?>
  @endforeach

</body>
</html>