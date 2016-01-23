<script> 
SC.initialize({
    client_id: "b728dfe1857acd4b20214c46de29ae56",
    redirect_uri: "http://example.com/callback.html",
});

SC.get("/users/fastnet-rally/tracks", {limit: 1}, function(tracks){
    var latest = tracks[0].title;
    latest = latest.split(' ').join('-');
    latest = latest.split('\'').join('');   
    
    SC.stream("/tracks/" + latest, function(sound){
  sound.play();
});
});
</script>