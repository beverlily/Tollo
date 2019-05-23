<?php
$title = 'Review Update';
$style = 'review.css';
include '../../header.php';
require_once '../../vendor/autoload.php';
use App\Database;
use App\Review;

$db = Database::getDb();
$c = $rating = $title = $content = "";

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $r = new Review();
    $review = $r->getReviewById($id, $db);

    $title = $review->title;
    $date = $review->date;
    $content = $review->content;
}
?>
<main id="mainContent">
    <div class="pageWrapper">
        <form method="post" action="../../Controllers/reviews/updateReview.php">
            <div id="formBox">
                <h1>Update Review Entry</h1>
                <input type="hidden" name="eid" value="<?= $id; ?>">
                <div><label>Rating out of 5:</label></div>
                <select name="rating" id="ratingBox">
                    <option value="5">5*</option>
                    <option value="4">4*</option>
                    <option value="3">3*</option>
                    <option value="2">2*</option>
                    <option value="1">1*</option>
                </select>
                <div><label>Title:</label></div>
                <input type="text" class="formFields" name="title" value="<?= $title ?>"/>
                <div><label>Review:</label></div>
                <textarea class="formFields" id="textArea" name="content" wrap="soft"><?= $content ?></textarea>
                <div><button type="submit" id="submitBtn" name="submit">Edit Review</div>
                <div id="errMsg"><?=$_SESSION['ReviewErrorMessage']?></div>
            </div>
        </form>
    </div>
</main>

<?php
        $_SESSION['ReviewErrorMessage'] = "";
        include '../../footer.php';
?>
