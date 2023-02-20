<?php require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/categories/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {

    $cat = [];
    $cat['id'] = $id;
    $cat['visible'] = $_POST['visible'] ?? "";
    $cat['category_name'] = $_POST['category_name'] ?? "";


    $result = update_cat($cat);
    if ($result === true) {

        redirect_to(url_for("/staff/categories/show.php?id=" . $id));
    } else {
        $errors = $result;
    }
} else {
    $cat = find_by_id($id, 'categories');
}


?>
<?php $page_title = "Edit category"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="song listing">
        <h1>Edit category</h1>
        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/categories/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Category</dt>
                <dd><input type="text" name="category_name" value="<?php echo h($cat['category_name']) ?>" /></dd>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <!-- hidden send value of "0" if checkbox is not checked -->
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php if ($cat['visible'] == "1") {
                                                                        echo " checked";
                                                                    } ?> />
                </dd>
            </dl>


            <div id="operations">
                <input type="submit" value="Edit category" />
            </div>

        </form>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>