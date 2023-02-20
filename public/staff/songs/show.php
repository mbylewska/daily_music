<?php require_once('../../../private/initialize.php');


$id = $_GET['id'] ?? '1'; //Set default value for URL parameter

$song = find_by_id($id, 'songs');

$page_title = "Show song";
include(SHARED_PATH . '/staff_header.php');
?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/songs/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="page show">

        <h1>Title: <?php echo h($song['title']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Artist:</dt>
                <dd><?php echo h($song['artist']); ?> </dd>
            </dl>
            <dl>
                <dt>Category:</dt>
                <dd><?php echo h($song['category_id']); ?> </dd>
            </dl>
            <dl>
                <dt>Date:</dt>
                <dd><?php echo h($song['date']); ?> </dd>
            </dl>
            <dl>
                <dt>Visible:</dt>
                <dd><?php echo h($song['visible'] == '1' ? 'true' : 'false'); ?> </dd>
            </dl>
            <dl>
                <dt>Links:</dt>
                <ul>
                    <li><?php echo h($song['link_yt']); ?> </li>
                    <li><?php echo h($song['link_spotify']); ?> </li>
                    <li><?php echo h($song['link_apple']); ?> </li>
                </ul>

            </dl>
            <dl>
                <dt>Content:</dt>
                <dd><?php echo h($song['content']); ?> </dd>
            </dl>

        </div>

    </div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>