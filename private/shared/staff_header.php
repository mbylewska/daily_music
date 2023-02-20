<?php
if (!isset($page_title)) {
    $page_title = 'Staff Area';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" media="all" href="<?php echo url_for('stylesheets/style.css');
                                                ?>?ts=<?= time() ?>">

    <title>Daily Music - <?php echo h($page_title);
                            ?></title>
</head>

<body>
    <header>
        <h1>Daily Music - Admin Area</h1>
    </header>


    <navigation>
        <ul>
            <li><a class="links" href="<?php echo url_for('/staff/index.php');
                                        ?>">Menu</a></li>
        </ul>
    </navigation>