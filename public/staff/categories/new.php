<?php require_once('../../../private/initialize.php');

if (is_post_request()) {

    $cat = [];
    //$cat['id'] = $id;

    $cat['visible'] = $_POST['visible'] ?? "";
    $cat['category_name'] = $_POST['category_name'] ?? "";


    $result = insert_cat($cat);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for("/staff/categories/show.php?id=" . $new_id));
    } else {
        $errors = $result;
    }
} else {
    // display the blank code
}
$cat_set = find_all('categories');

?>
<?php $page_title = "Add new category"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="cat listing">
        <h1>Add new category</h1>
        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for("/staff/categories/new.php"); ?>" method="post">
            <dl>
                <dt>Category name</dt>
                <dd><input type="text" name="category_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <!-- hidden send value of "0" if checkbox is not checked -->
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Add new category" />
            </div>

        </form>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>