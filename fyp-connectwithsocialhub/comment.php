    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link rel="stylesheet" type="text/css" href="resources/css/comment.css">
    <link rel="stylesheet" type="text/css" href="resources/css/display-comment.css">

    <?php

    session_start();
    // Check whether user is logged on or not
    if (!isset($_SESSION['user_id'])) {
        header("location:index.php");
    }
    $temp = $_SESSION['user_id'];
    session_destroy();
    session_start();
    $_SESSION['user_id'] = $temp;
    ob_start();
    require 'functions/functions.php';
    $conn = connect();

    $post_id =  $_GET['post_id'];
    include 'includes/navbar.php';


    $sql = "SELECT posts.post_caption, posts.post_time, posts.post_public, users.user_firstname,
                        users.user_lastname, users.user_id, users.user_gender, posts.post_id
                FROM posts
                JOIN users
                ON posts.post_id =$post_id";



    $query = mysqli_query($conn, $sql);
    if (!$query) {
        echo mysqli_error($conn);
    }
    if (mysqli_num_rows($query) == 0) {
        echo '<div class="post">';
        echo 'There is no such post to show.';
        echo '</div>';
    } else {
        $width = '40px'; // Profile Image Dimensions
        $height = '40px';
        while ($row = mysqli_fetch_assoc($query)) {
            include 'includes/post.php';
            // echo '<div class="post">';
            // if ($row['post_public'] == 'Y') {
            //     echo '<p class="public">';
            //     echo 'Public';
            // } else {
            //     echo '<p class="public">';
            //     echo 'Private';
            // }
            // echo '<br>';
            // echo '<span class="postedtime">' . $row['post_time'] . '</span>';
            // echo '</p>';
            // echo '<div>';
            // include 'includes/profile_picture.php';
            // echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] . '">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '</a>';
            // echo '</div>';
            // echo '<br>';
            // echo '<p class="caption">' . $row['post_caption'] . '</p>';
            // echo '<center>';
            // $target = glob("data/images/posts/" . $row['post_id'] . ".*");

            // if ($target) {
            //     $img = '<img src="' . $target[0] . '" style="max-width:580px">';

            //     echo "" . $img;
            //     echo '<br><br>';
            // }

            // echo '</center>';
            // echo '</div>';
            echo '<br>';
            echo '<div class = "commentsbox">';
            include 'includes/commentbox.php';

            //render the comments
            $sql = "SELECT * FROM comments 
            INNER JOIN users ON comments.user_id= users.user_id "
                . "WHERE comments.post_id =" . $row['post_id'];
            $query_comments = mysqli_query($conn, $sql);
            // Action on Successful Query
            if ($query_comments) {
                //display comments if there are any

                while ($row = mysqli_fetch_assoc($query_comments)) {
                    // $target = glob("data/images/profiles/" . $row['user_id'] . ".*");
                    // echo ' <div class="user-comment-card">';
                    // if ($target) echo '<img class ="user-avatar" src="' . $target[0] . '">';
                    // else if ($row['user_gender'] == 'M') echo '<img src="data/images/profiles/M.jpg">';
                    // else if ($row['user_gender'] == 'F') echo '<img src="data/images/profiles/F.jpg">';
                    echo '<div class = "comment-container">';
                    echo '<div class = "commentheader">';
                    include 'includes/profile_picture.php';
                    echo '<div class="commentandtag">';
                    echo '<a class="profilelink" href="profile.php?id=' . $row['user_firstname'] . '">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '</a>';
                    echo '<span class="commentedtag">' . $row['comment_date'] . '</span>';
                    echo " </div>";
                    echo " </div>";

                    echo '<div class="comment">' . $row["comment_data"] . " </div>";
                    echo " </div>";
                    echo " </div>";
                }
            } else {
                echo mysqli_error($conn);
            }
            echo " </div>";
        }
    }

    ?>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Comment is to be Posted

        $comment = $_POST['comment'];

        $user_id = $_SESSION['user_id'];
        $post_id = $_GET['post_id'];
        // Apply Insertion Query
        //Comment table: id , comment_by, comment_date,comment_data,post_id
        $sql = "INSERT INTO comments (post_id,user_id, comment_date,comment_data)
            VALUES ($post_id,$user_id, NOW(),'$comment')";
        $query = mysqli_query($conn, $sql);
        // Action on Successful Query
        if ($query) {
            header("location:comment.php?post_id=" . $post_id);
        } else {
            echo mysqli_error($conn);
        }
    }
    ?>