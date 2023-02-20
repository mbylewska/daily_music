<?php require_once('../../../private/initialize.php');

$cat_set = find_all('categories');

$page_title = "Categories";
include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
    <div class="songs listing">
        <h1>Songs</h1>
        <div class='actions'>
            <a class="links" href="<?php echo url_for('/staff/categories/new.php'); ?>">Add new category</a>
        </div>
        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Visible</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>
            <?php while ($cat = mysqli_fetch_assoc($cat_set)) { ?>
                <tr>
                    <td><?php echo h($cat['id']); ?></td>
                    <td><?php echo h($cat['category_name']); ?></td>
                    <td><?php echo $cat['visible'] == 1 ? 'true' : 'false'; ?></td>


                    <td><a class="links" href="<?php echo url_for('/staff/categories/show.php?id=' . h(u($cat['id']))); ?>">View</a></td>
                    <td><a class="links" href="<?php echo url_for('/staff/categories/edit.php?id=' . h(u($cat['id']))); ?>">Edit</a></td>
                    <td><a class="links" href="<?php echo url_for('/staff/categories/delete.php?id=' . h(u($cat['id']))); ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <?php mysqli_free_result($cat_set); ?>

    </div>
</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>