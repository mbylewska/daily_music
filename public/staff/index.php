<?php require_once('../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
    <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
            <li><a class="links" href="<?php echo url_for('/staff/categories/index.php'); ?>">Categories</a></li>
            <li><a class="links" href="<?php echo url_for('/staff/songs/index.php'); ?>">Songs</a></li>
        </ul>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>