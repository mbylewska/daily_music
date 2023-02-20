<?php

function url_for($script_path)
{
    //add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}


/* shortcut for encoding for URL */
function u($string = "")
{
    return urlencode($string);
}

/* shortcut for encoding for HTML */
function h($string = "")
{
    return htmlspecialchars($string);
}

/* Checking request method*/
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}

function display_errors($errors = array())
{
    $output = '';
    if (!empty($errors)) {
        $output .= "<div class=\"errors\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach ($errors as $error) {
            $output .= "<li?>" . h($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function embed_youtube($link_yt)
{
    $link_yt = trim($link_yt);
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $link_yt, $matches);

    return $matches;


    // $ytarray = explode("/", $videolink);
    // $ytendstring = end($ytarray);
    // $ytendarray = explode("&v=", $ytendstring);
    // $ytendstring = end($ytendarray);
    // $ytendarray = explode("&", $ytendstring);
    // $ytcode = $ytendarray[0];
    // return $ytcode;
}
