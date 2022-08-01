<?php
// a simple comment box form to submit comments
echo '<section id="app">
  <div class="container">
    <div class="row">
      <div>
        <div class="comment">
          <p></p>
        </div>
      </div>

    </div>

    <form method="post" action="" class="row">
      <div class="sendcommentbox">
        <textarea type="text" class="input" name="comment" placeholder="Write a comment"></textarea>
       
        <button class="primaryContained float-right" type="submit">
         Comment
        </button>
      </div>
  </div>

  </div>

</section>';
