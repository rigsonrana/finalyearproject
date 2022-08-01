<?php
// onclick redirected to page with comments
echo '<div class="post">';
if ($row['post_public'] == 'Y') {
    echo '<p class="public">';
    echo 'Public';
} else {
    echo '<p class="public">';
    echo 'Private';
}
echo '<br>';

echo '</p>';
echo '<div class="postheader">';
include 'profile_picture.php';
echo '<div class="nametime">';
echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] . '">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '</a>';
echo '<span class="postedtime">' . $row['post_time'] . '</span>';
echo '</div>';
echo '</div>';
echo '<br>';
echo '<p class="caption" onClick=window.location.href="comment.php?post_id=' . $row['post_id'] . '">' . $row['post_caption'] . '</p>';
echo '<center>';
$target = glob("data/images/posts/" . $row['post_id'] . ".*");
if ($target) {
    echo '<img src="' . $target[0] . '" style="width:100%">';
    echo '<br><br>';
}
echo '</center>';
// create a button that calls like function when clicked
echo '<div>';
echo '<span class="like-button" id="likebutton' . $row['post_id'] . '" onclick="like(' . $row['post_id'] . ')"></span>';
// commen icon 💬 next to like button
echo '<span class="comment-button" onclick=window.location.href="comment.php?post_id=' . $row['post_id'] . '">💬</span>';
echo '</div>';
echo '</div>';
?>
<script>
    function like(id) {
        var liked = localStorage.getItem(id);
        if (liked === 'true') {
            // console.log('unliking');
            var btn = document.getElementById('likebutton' + id)
            btn.classList.toggle('liked');
            localStorage.setItem(id, 'false');
        } else {
            // console.log('liking');
            var btn = document.getElementById('likebutton' + id)
            btn.classList.toggle('liked');
            localStorage.setItem(id, 'true');
        }
    }
    // is Liked 
    function isLiked(id) {
        var liked = localStorage.getItem(id);
        if (liked === 'true') {
            return true;
        } else {
            return false;
        }
    }
    if (isLiked(<?php echo $row['post_id'] ?>)) {
        document.getElementById('likebutton' + <?php echo $row['post_id'] ?>).classList.add('liked')
    }
</script>