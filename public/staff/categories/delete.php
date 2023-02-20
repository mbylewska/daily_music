<?php require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/categories/index.php'));
}
$id = $_GET['id'];



if (is_post_request()) {
    $result = delete_table($id, 'categories');

    if ($result === true) {
        redirect_to(url_for('/staff/categories/index.php'));
    } else {
        $errors = $result;
    }
} else {
}
$cat = find_by_id($id, 'categories');
?>
<?php $page_title = "Delete category"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="subject listing">
        <h1>Delete category</h1>

        <?php echo display_errors($errors); ?>
        <p>Are you sure you want to delete this category?</p>
        <p class="item">ID: <?php echo h($cat['id']); ?></p>
        <p class="item">CATEGORY: <?php echo h($cat['category_name']); ?></p>


        <form action="<?php echo url_for('/staff/categories/delete.php?id=' . h(u($cat['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete category" />
            </div>
        </form>


    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>