<?php 

if (!defined('ABSPATH')) exit; 

$selected_location = GoogleDataHandler::get_selected_location_id();
$selected_location_reviews = GoogleDataHandler::get_selected_location_reviews($selected_location, 1, 10);
?>

<div id="main-wrapper">
<h3>Reviews</h3>
<div id="main-page-table">
    <form>
        <div id="reviews-table">
            <div class="table-header">
                <div class="review-select-table__heading"><input id="select-all-reviews" type="checkbox" name="select-all-reviews"></div>
                <div class="review-select-table__heading"><p>Reviewer</p></div>
                <div class="review-select-table__heading"><p>Rating</p></div>
                <div class="review-select-table__heading"><p>Comment</p></div>
                <div class="review-select-table__heading"><p>Date</p></div>
            </div>
            <?php foreach($selected_location_reviews as $review): ?>
            <div class="row-item">
                <input type="checkbox" name="selected-review-<?php echo $review['review_id']; ?>" value="<?php echo $review['review_id']; ?>" ${isChecked ? 'checked' : ''}>
                <div class="row-item__cell" data-type="reviewer"><?php echo $review['reviewer_display_name']; ?></div>
                <div class="row-item__cell" data-type="rating"><?php echo $review['star_rating']; ?></div>
                <div class="row-item__cell" data-type="comment"><?php echo $review['comment']; ?></div>
                <div class="row-item__cell" data-type="date"><?php echo date('m/d/Y', strtotime($review['create_time'])); ?></div>
            </div>
            <?php endforeach ?>
        </div>
    </form>
</div>

</div>