<?php require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/songs/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {

    $song = [];
    $song['id'] = $id;
    $song['title'] = $_POST['title'] ?? "";
    $song['artist'] = $_POST['artist'] ?? "";
    $song['date'] = $_POST['date'] ?? "";
    $song['visible'] = $_POST['visible'] ?? "";
    $song['category_id'] = $_POST['category_id'] ?? "";
    $song['link_yt'] = $_POST['link_yt'] ?? "";
    $song['link_spotify'] = $_POST['link_spotify'] ?? "";
    $song['link_apple'] = $_POST['link_apple'] ?? "";
    $song['content'] = $_POST['content'] ?? "";

    $result = update_song($song);
    if ($result === true) {

        redirect_to(url_for("/staff/songs/show.php?id=" . $id));
    } else {
        $errors = $result;
    }
} else {
    $song = find_by_id($id, 'songs');
}
$cat_set = find_all('categories');
$songs_set = find_all('songs');
$song_count = mysqli_num_rows($songs_set);
mysqli_free_result($songs_set);

// $song = [];
// $song['category_id'] = $song_count;

?>
<?php $page_title = "Edit song"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/songs/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="song listing">
        <h1>Edit song</h1>
        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/songs/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Title</dt>
                <dd><input type="text" name="title" value="<?php echo h($song['title']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Artist</dt>
                <dd><input type="text" name="artist" value="<?php echo h($song['artist']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Date</dt>
                <dd><input type="date" name="date" value="<?php echo h($song['date']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Category</dt>
                <dd>
                    <select name="category_id">
                        <?php


                        while ($cat = mysqli_fetch_assoc($cat_set)) { ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
                        <?php } ?>

                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <!-- hidden send value of "0" if checkbox is not checked -->
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php if ($song['visible'] == "1") {
                                                                        echo " checked";
                                                                    } ?> />
                </dd>
            </dl>
            <dl>
                <dt>Link - YouTube</dt>
                <dd><input type="text" name="link_yt" value="<?php echo h($song['link_yt']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Link - Spotify</dt>
                <dd><input type="text" name="link_spotify" value="<?php echo h($song['link_spotify']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Link - Apple</dt>
                <dd><input type="text" name="link_apple" value="<?php echo h($song['link_apple']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><textarea rows="4" cols="100" name="content"><?php echo h($song['content']) ?></textarea></dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit song" />
            </div>

        </form>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>