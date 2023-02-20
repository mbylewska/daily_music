<?php require_once('../../../private/initialize.php');


$id = $_GET['id'] ?? '1'; //Set default value for URL parameter

$cat = find_by_id($id, 'categories');

$page_title = "Show category";
include(SHARED_PATH . '/staff_header.php');
?>

<div class="content">

    <p><a href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to the list</a></p>

    <div class="page show">

        <h1>Category: <?php echo h($cat['category_name']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Id:</dt>
                <dd><?php echo h($cat['id']); ?> </dd>
            </dl>
            <dl>
                <dt>Visible:</dt>
                <dd><?php echo h($cat['visible'] == '1' ? 'true' : 'false'); ?> </dd>
            </dl>

        </div>

    </div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>