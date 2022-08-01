<?php
// this renders the picture on a post given the post id and provides appropriate size
$target = glob("data/images/posts/" . $row['user_id'] . ".*");
if ($target) {
    echo '<img  src="' . $target[0] . '" width="' . $width . '" height="' . $height . '"        >';
} else {
    // if no picture, display default based on gender
    if ($row['user_gender'] == 'M') {
        echo '<img src="data/images/profiles/M.jpg" width="' . $width . '" height="' . $height . '"    >';
    } else if ($row['user_gender'] == 'F') {
        echo '<img src="data/images/profiles/F.jpg" width="' . $width . '" height="' . $height . '"   >';
    }
}
