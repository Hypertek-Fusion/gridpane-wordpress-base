<?php 

if (!defined('ABSPATH')) exit; 

/*

 <input type="checkbox" <?php echo $review['is_selected'] ? 'checked' : '' ;?> name="selected-review-<?php echo $review['review_id']; ?>" value="<?php echo $review['review_id']; ?>" ${isChecked ? 'checked' : ''}>
                <div class="row-item__cell" data-type="reviewer"><?php echo $review['reviewer_display_name']; ?></div>
                <div class="row-item__cell" data-type="rating"><?php echo $review['star_rating']; ?></div>
                <div class="row-item__cell" data-type="comment"><?php echo $review['comment']; ?></div>
                <div class="row-item__cell" data-type="date"><?php echo date('m/d/Y', strtotime($review['create_time'])); ?></div>

*/
?>

<div id="main-wrapper">
<h3>Reviews</h3>
<div id="main-page-table">
    <form method="post">
        <div id="reviews-table">
            <div class="select-table__heading-row">
                <div class="review-select-table__heading"><input id="select-all-reviews" type="checkbox" name="select-all-reviews"></div>
                <div class="review-select-table__heading"><p>Reviewer</p></div>
                <div class="review-select-table__heading"><p>Rating</p></div>
                <div class="review-select-table__heading"><p>Comment</p></div>
                <div class="review-select-table__heading"><p>Date</p></div>
            </div>


            <div id="initial-reviews" class="reviews-page"></div>

        </div>
            <div class="pagination-controls">
                <label for="reviews-per-page">Reviews per page:</label>
                <select id="reviews-per-page">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                </select>
                <button id="page-prev" class="page-prev" type="button" disabled>Previous</button>
                <button id="page-next" class="page-next" type="button" disabled>Next</button>
                <input type="submit" value="Save Changes">
            </div>
    </form>
</div>

</div>