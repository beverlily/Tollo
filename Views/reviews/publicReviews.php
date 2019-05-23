<?php
  $title = 'Review List';
  $style = 'review.css';
  include '../../header.php';
  include '../../Controllers/reviews/listPublicReviews.php';

?>
<main id="mainContent">
    <div class="container">
    <?php
        //If the user is logged in they can either create a review or update one
        if(isset($_SESSION['id']))
        {
            //Get user review and put results into variable c
            $c = $r->getUserReview($_SESSION['id'], $db);
            //If the user does not have a review already allow them to make one
            if(count($c) == 0)
            {
                echo"
                <form action='../../Views/reviews/reviewentry.php' method='post' id='createButton'>
                <button type='submit' class='btn btn-success btn-lg'>
                <span class='table-primaryTitle highlight-black' id='createEntry'>Create a review!</span>
                </button>
                </form>
                ";
            }
            //If the user has a review already allow them to go to see their review
            else
            {
                //Allow user to edit review
                echo"
                <form action='../../Views/reviews/myReview.php' method='post' id='editButton'>
                <button type='submit' class='btn btn-primary btn-lg'>
                <span class='table-primaryTitle highlight-black' id='createEntry'>My Review</span>
                </button>
                </form>
                ";
            }
        }
        //If they're not logged in they cannot create or update a review
        else
        {

        }
    ?>
        <div class="row text-center justify-content-center">
                <?php
                        foreach($item as $entry)
                        {
                            //Get user info
                            $user = $r->getUserInfo($entry->userid, $db);
                            foreach($user as $review)
                            {    
                                echo"
                                <div class='col'>
                                <div class='card' id='cardReview'>
                                <div class='card-body'>
                                <h5 class='card-title'>$entry->rating*</h5>
                                <h5 class='card-title'>$entry->title</h5>
                                <h6 class='card-subtitle mb-2 text-muted'>$entry->date</h6>
                                <h6 class='card-subtitle mb-2 text-muted'>$review->username</h6>
                                <p class='card-text'>$entry->content</p>
                                </div>
                                </div>
                                </div>
                                ";
                            }
                        }
                ?>

        </div>
    </div>
</main>
<?php
        include '../../footer.php';
?>