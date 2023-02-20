<?php require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/songs/index.php'));
}
$id = $_GET['id'];



if (is_post_request()) {
    delete_table($id, 'songs');
    redirect_to(url_for('/staff/songs/index.php'));
} else {
    $song = find_by_id($id, 'songs');
}
?>
<?php $page_title = "Delete Song"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/songs/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="subject listing">
        <h1>Delete song</h1>
        <p>Are you sure you want to delete this song?</p>
        <p class="item">TITLE: <?php echo h($song['title']); ?></p>
        <p class="item">ARTIST: <?php echo h($song['artist']); ?></p>
        <p class="item">DATE: <?php echo h($song['date']); ?></p>

        <form action="<?php echo url_for('/staff/songs/delete.php?id=' . h(u($song['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete song" />
            </div>
        </form>


    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>