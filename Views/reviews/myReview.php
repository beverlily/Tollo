<?php
  $title = 'Review List';
  $style = 'review.css';
  include '../../header.php';
  include '../../Controllers/reviews/listReviews.php';

?>
<main id="mainContent">
    <div class="container">
        <div class="row text-center justify-content-center">
                <?php
                    foreach($item as $entry)
                    {
                        echo"
                        <div class='card' id='cardReview'>
                            <div class='card-body'>
                                <h5 class='card-title'>$entry->rating*</h5>
                                <h5 class='card-title'>$entry->title</h5>
                                <h6 class='card-subtitle mb-2 text-muted'>$entry->date</h6>
                                <p class='card-text'>$entry->content</p>
                                <form action='../../Views/reviews/reviewUpdate.php' method='post'>
                                <input type='hidden' name='id' value='$entry->id' />
                                <button type='submit' class='btn btn-primary btn-block'>Update</button>
                                </form>
                                <form action='../../Controllers/reviews/deleteReview.php' method='post'>
                                <input type='hidden' name='id' value='$entry->id' />
                                <button type='submit' name='delete' class='btn btn-danger btn-block' value='Delete'>Delete</button>
                                </form>
                            </div>
                         </div>
                        ";
                    }
                ?>

        </div>
    </div>
</main>
<?php
        include '../../footer.php';
?>