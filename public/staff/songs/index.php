<?php require_once('../../../private/initialize.php');

$song_set = find_all('songs');

$page_title = "Songs";
include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
    <div class="songs listing">
        <h1>Songs</h1>
        <div class='actions'>
            <a class="links" href="<?php echo url_for('/staff/songs/new.php'); ?>">Add new song</a>
        </div>
        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Visible</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>
            <?php while ($song = mysqli_fetch_assoc($song_set)) { ?>
                <tr>
                    <td><?php echo h($song['id']); ?></td>
                    <td><?php echo h($song['date']); ?></td>
                    <td><?php echo $song['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><?php echo h($song['title']); ?></td>
                    <td><?php echo h($song['artist']); ?></td>

                    <td><a class="links" href="<?php echo url_for('/staff/songs/show.php?id=' . h(u($song['id']))); ?>">View</a></td>
                    <td><a class="links" href="<?php echo url_for('/staff/songs/edit.php?id=' . h(u($song['id']))); ?>">Edit</a></td>
                    <td><a class="links" href="<?php echo url_for('/staff/songs/delete.php?id=' . h(u($song['id']))); ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <?php mysqli_free_result($song_set); ?>

    </div>
</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>