<?php
  $title = 'Diary Entry';
  $style = 'review.css';

  include '../../header.php';
?>
<main id="mainContent">
    <div class="pageWrapper">
        <form method="post" action="../../Controllers/reviews/addReview.php">
            <div id="formBox">
                <h1>Review Entry</h1>
                <div><label>Rating out of 5:</label></div>
                <select name="rating" id="ratingBox">
                    <option value="5">5*</option>
                    <option value="4">4*</option>
                    <option value="3">3*</option>
                    <option value="2">2*</option>
                    <option value="1">1*</option>
                </select>
                <div><label>Title:</label></div>
                <input type="text" class="formFields" name="title" />
                <div><label>Review:</label></div>
                <textarea class="formFields" id="textArea" name="content" wrap="soft"></textarea>
                <div><button type="submit" id="submitBtn" name="submit">Submit Review</div>
                <div id="errMsg"><?=$_SESSION['ReviewErrorMessage']?></div>
            </div>
        </form>
    </div>
</main>
<?php
        $_SESSION['ReviewErrorMessage'] = "";
        include '../../footer.php';
?>