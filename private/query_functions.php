<?php

function find_all($table)
{
    global $db;
    $sql = "SELECT * FROM " .  mysqli_real_escape_string($db, $table) . " ";
    $sql .= "ORDER BY id ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    return $result;
}

function delete_table($id, $table)
{
    global $db;

    if ($table = 'categories') {
        $errors = validate_delete_cat($id);
        if (!empty($errors)) {
            return $errors;
        }
    }

    $sql = "DELETE FROM " . mysqli_real_escape_string($db, $table) . " ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {

        return true;
    } else {
        //DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_by_id($id, $table)
{
    global $db;
    $sql = "SELECT * FROM " . mysqli_real_escape_string($db, $table) . " ";
    $sql .= "WHERE id='" .  mysqli_real_escape_string($db, $id) . "'";
    //echo $sql;

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $set = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $set;
}
function find_song_by_date($song_date)
{
    global $db;
    $sql = "SELECT * FROM songs ";
    $sql .= "WHERE date='" .  mysqli_real_escape_string($db, $song_date) . "'";
    //echo $sql;

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $set = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $set;
}

function insert_song($song)
{
    global $db;

    $errors = validate_song($song);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO songs ";
    $sql .= "(title, artist, date, category_id, visible, link_yt, link_spotify, link_apple, content) ";
    $sql .= "VALUES ( ";
    $sql .= "'" .  mysqli_real_escape_string($db, $song['title']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $song['artist']) . "', ";
    $sql .= "'" .  mysqli_real_escape_string($db, $song['date']) . "', ";
    $sql .= "'" .  mysqli_real_escape_string($db, $song['category_id']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $song['visible']) . "', ";
    $sql .= "' " . mysqli_real_escape_string($db, $song['link_yt']) . "',";
    $sql .= "' " . mysqli_real_escape_string($db, $song['link_spotify']) . "',";
    $sql .= "' " . mysqli_real_escape_string($db, $song['link_apple']) . "',";
    $sql .= "' " . mysqli_real_escape_string($db, $song['content']) . "')";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function update_song($song)
{
    global $db;

    $errors = validate_song($song);
    if (!empty($errors)) {
        return $errors;
    }


    $sql = "UPDATE songs SET ";
    $sql .= "title='" . mysqli_real_escape_string($db, $song['title']) . "', ";
    $sql .= "artist='" . mysqli_real_escape_string($db, $song['artist']) . "', ";
    $sql .= "date='" . mysqli_real_escape_string($db, $song['date']) . "', ";
    $sql .= "category_id='" . mysqli_real_escape_string($db, $song['category_id']) . "', ";
    $sql .= "visible='" . mysqli_real_escape_string($db, $song['visible']) . "', ";
    $sql .= "link_yt='" . mysqli_real_escape_string($db, $song['link_yt']) . "', ";
    $sql .= "link_spotify='" . mysqli_real_escape_string($db, $song['link_spotify']) . "', ";
    $sql .= "link_apple='" . mysqli_real_escape_string($db, $song['link_apple']) . "', ";
    $sql .= "content='" . mysqli_real_escape_string($db, $song['content']) . "' ";
    $sql .= "WHERE id='" .  mysqli_real_escape_string($db, $song['id']) . "' ";
    $sql .= "LIMIT 1";
    echo $sql;

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_cat($cat)
{
    global $db;

    $errors = validate_cat($cat);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE categories SET ";
    $sql .= "category_name='" . mysqli_real_escape_string($db, $cat['category_name']) . "', ";
    $sql .= "visible='" . mysqli_real_escape_string($db, $cat['visible']) . "' ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $cat['id']) . "' ";
    $sql .= "LIMIT 1";
    echo $sql;

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function insert_cat($cat)
{
    global $db;

    $errors = validate_cat($cat);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO categories ";
    $sql .= "(category_name, visible) ";
    $sql .= "VALUES ( ";
    $sql .= "'" .  mysqli_real_escape_string($db, $cat['category_name']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $cat['visible']) . "')";

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}



/* ------------ VALIDATION ---------------*/
function validate_song($song)
{
    $errors = [];

    //Title
    if (is_blank($song['title'])) {
        $errors[] = "Title cannot be blank.";
    } elseif (!has_length($song['title'], ['min' => 2, 'max' => 500])) {
        $errors[] = "Title must be between 2 and 500 characters";
    }

    $current_id = $song['id'] ?? '0';
    if (!has_unique_song_title($song['title'], $current_id)) {
        $errors[] = "Song title must be unique.";
    }

    //visible
    //Make sure we are working with a string
    $visible_str = (string)$song['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }
    return $errors;
}

function validate_cat($cat)
{
    $errors = [];

    //Title
    if (is_blank($cat['category_name'])) {
        $errors[] = "Title cannot be blank.";
    } elseif (!has_length($cat['category_name'], ['min' => 2, 'max' => 500])) {
        $errors[] = "Title must be between 2 and 500 characters";
    }

    $current_id = $cat['id'] ?? '0';
    if (!has_unique_song_title($cat['category_name'], $current_id)) {
        $errors[] = "Song title must be unique.";
    }

    //visible
    //Make sure we are working with a string
    $visible_str = (string)$cat['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }
    return $errors;
}


function validate_delete_cat($id) //checking if subject has pages before deleting
{
    global $db;
    $errors = [];

    $sql = "SELECT * FROM songs ";
    $sql .= "WHERE category_id='" . mysqli_real_escape_string($db, $id) . "' ";


    $song_set = mysqli_query($db, $sql);
    $song_count = mysqli_num_rows($song_set);
    mysqli_free_result($song_set);

    if ($song_count !== 0) {
        $errors[] = "Cannot delete category with assigned songs.";
    }
    return $errors;
}
