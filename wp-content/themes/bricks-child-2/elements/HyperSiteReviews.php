<?php 
// element-test.php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Prefix_Element_Test extends \Bricks\Element {
  // Element properties
  public $category     = 'HyperSite';
  public $name         = 'HyperSite Reviews';
  public $icon         = 'fas fa-comment';
  public $css_selector = 'hypersite-reviews';
  public $scripts      = ['hsrev-frontend-widget'];
  public $nestable     = false; // true || @since 1.5

  // Methods: Builder-specific
  public function get_label(
  ) {
    return esc_html__( 'HyperSite Reviews', 'bricks');
  }
  public function get_keywords() {}
  public function set_control_groups() {}
  public function set_controls() {
    $this->control_groups['text'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Text', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['settings'] = [
      'title' => esc_html__( 'Settings', 'bricks' ),
      'tab' => 'content',
    ];

  }

  // Methods: Frontend-specific
  public function enqueue_scripts() {
    if (!wp_script_is('hypersite-reviews-stylesheet', 'enqueued')) {
        wp_enqueue_style('hypersite-reviews-stylesheet', HSREV_URL . 'public/css/hsrev-main.css', [], '1.0', false);
    }
  }
  public function render() {
    $root_classes[] = 'hypersite-reviews';
    $reviews_batch = [];

    $per_page = 100;

    $location_id = GoogleDataHandler::get_selected_location_id();
    $total_selected_reviews = GoogleDataHandler::get_total_selected_reviews($location_id);    
    $pages = ceil( $total_selected_reviews / $per_page);
    $total_overall_reviews = GoogleDataHandler::get_location_reviews_length($location_id);


    // Prefetched Assets
    $google_logo = file_get_contents(HSREV_URL . 'public/images/google-logo-borderless.svg');
    $star_svg = file_get_contents(HSREV_URL . 'public/images/star-fill.svg');

    error_log('Per Page: '. $per_page);
    error_log('Location Id: '. $location_id);
    error_log('Total reviews: '. $total_selected_reviews);
    error_log('Pages: ' . $pages);

    $this->set_attribute('_root', 'class', $root_classes);

    echo "<div {$this->render_attributes( '_root' )}>";

    for($i = 0; $i < $pages; $i++) {
        $reviews = GoogleDataHandler::get_selected_reviews($location_id, $i + 1, $per_page);
        
        $reviews_batch = array_merge($reviews_batch, $reviews);
    }

    echo "Total Reviews: " . $total_overall_reviews;

    ?>
  <div class="testimonials-wrapper">
  <?php

    foreach($reviews_batch as $review) {
?>
    <div class="testimonial-card">
      <div class="testimonial-card__top-wrapper">
        <div class="testimonial-card__author-profile-icon-wrapper">
          <img class="testimonial-card__author-profile-icon" src="<?php echo $review['reviewer_profile_photo_url']; ?>">
        </div>
        <div class="testimonial-card__author-name-wrapper">
          <p class="testimonial-card__author-name"><?php echo $review["reviewer_display_name"]; ?></p>
          <div class="star-ratings-wrapper">
            <?php
              for($i = 0; $i < 5; $i++) {
                echo $star_svg;
              }
            ?>
          </div>
        </div>
      </div>
      <div class="testimonial-card__content-wrapper">
        <p class="testimonial-card__content"><?php echo $review["comment"]; ?></p>
      </div>
      <div class="testimonial-card__bottom-wrapper">
        <p><?php echo date('Y-m-d', strtotime($review["create_time"])); ?></p>
        <?php echo $google_logo; ?>
      </div>
    </div>
<?php
    }

?>
  </div>
<?php
  }
}

?>