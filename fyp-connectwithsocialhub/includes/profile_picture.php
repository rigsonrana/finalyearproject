<?php
// provides profile picture for a given user id
$target = glob("data/images/profiles/" . $row['user_id'] . ".*");
if ($target) {
    echo '<img class="profilepic" src="' . $target[0] . '" width="' . $width . '" height="' . $height . '"    >';
} else {
    // if no picture, display default based on gender
    if ($row['user_gender'] == 'M') {
        echo '<img src="data/images/profiles/M.jpg" class="profilepic" width="' . $width . '" height="' . $height . '">';
    } else if ($row['user_gender'] == 'F') {
        echo '<img src="data/images/profiles/F.jpg" class="profilepic" width="' . $width . '" height="' . $height . '">';
    }
}
