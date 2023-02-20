<?php require_once('../private/initialize.php');

//$today = date("Y-m-d");
$today = '2023-02-19';
//echo $today;

if (isset($today)) {
    $song_date = $today;
    $song = find_song_by_date($song_date);
    $link_yt = embed_youtube($song['link_yt'])[1];
    if (!$song) {
        redirect_to(url_for('/index.php'));
    }
}

include(SHARED_PATH . '/public_header.php'); ?>

<div id="links">


    <!-- YouTube -->
    <div id="youtube">
        <h2><a href="<?php echo $song['link_yt']; ?>">You tube</a></h2>
        <iframe class="media-frame" width="250" height="150" src="http://www.youtube.com/embed/<?php echo $link_yt; ?>\" frameborder="0" allowfullscreen="" loading="lazy"></iframe>

    </div>

    <!-- Spotify -->
    <div id="Spotify">
        <h2><a href="<?php echo $song['link_spotify']; ?>">Spotify</a></h2>
        <iframe class="media-frame" width="250" height="150" src="<?php echo $song['link_spotify']; ?>" frameBorder="0" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Apple -->
    <div id="apple">
        <h2><a href="<?php echo $song['link_apple']; ?>">Apple</a></h2>

    </div>



</div>

<div class="content">

    <h2><?php echo $song['title']; ?></h2>
    <h3><?php echo $song['artist']; ?></h3>
    <article>
        <p> <?php echo $song['content']; ?></p>
    </article>
</div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>