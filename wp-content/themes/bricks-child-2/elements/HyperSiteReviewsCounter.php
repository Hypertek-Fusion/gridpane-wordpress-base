<?php 
// element-test.php

use Bricks\Breakpoints;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HyperSiteReviewsCounter extends \Bricks\Element {
  // Element properties
  public $category     = 'HyperSite';
  public $name         = 'HyperSite Reviews - Counter';
  public $icon         = 'fas fa-comment';
  public $css_selector = 'hypersite-reviews-counter';
  public $scripts      = ['hsrev-frontend-widget'];
  public $nestable     = false; // true || @since 1.5

  // Methods: Builder-specific
  public function get_label(
  ) {
    return esc_html__( 'HyperSite Reviews Counter', 'bricks');
  }
  public function get_keywords() {}
  public function set_control_groups() {

  }
  public function set_controls() {
    $this->controls['contentDirection'] = [ // Setting key
    'tab'   => 'content',
    'label' => esc_html__( 'Content Direction', 'bricks' ),
    'type'  => 'direction',
    'css'   => [
        [
            'property' => 'flex-direction',
            'selector' => '.flexbox-wrapper'
        ],
        ],
    ];

    $this->controls['starsVerticalPlacement'] = [
      'tab'   => 'content',
      'label' => esc_html__( 'Stars Placement (Vertical)', 'bricks' ),
      'type' => 'select',
      'options' => [
        'top' => 'Top',
        'bottom' => 'Bottom'
      ],
      'inline' => true,
      'placeholder' => esc_html__( 'Grid', 'bricks' ),
      'multiple' => false, 
      'breakpoints' => true,
      'searchable' => false,
      'clearable' => false,
      'default' => 'top',
      'required' => ['contentDirection', '=', 'column']
    ];

    $this->controls['starsHorizontalPlacement'] = [
      'tab'   => 'content',
      'label' => esc_html__( 'Stars Placement (Horizontal)', 'bricks' ),
      'type' => 'select',
      'options' => [
        'left' => 'Left',
        'right' => 'Right'
      ],
      'inline' => true,
      'placeholder' => esc_html__( 'Grid', 'bricks' ),
      'multiple' => false, 
      'breakpoints' => true,
      'searchable' => false,
      'clearable' => false,
      'default' => 'left',
      'required' => [['contentDirection', '!=', 'column']]
    ];

    // Stars size
    $this->controls['starSize'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Star Icon Size', 'bricks' ),
      'placeholder' => esc_html__( '30px', 'bricks' ),
      'type' => 'number',
      'min' => 0,
      'css' => [
        [
          'property' => 'width',
          'selector' => '.google-reviews-count__content-wrapper svg',
        ],
        [
          'property' => 'height',
          'selector' => 'google-reviews-count__content-wrapper svg',
        ]
      ],
      'step' => '1',
      'breakpoints' => true,
      'units' => true,
      'inline' => true,
      'default' => 30,
    ];

    // Text that will go before the reviews
    $this->controls['prefixText'] = [
      'tab'   => 'content',
      'label' => esc_html__( 'Prefix Text', 'bricks' ),
      'type' => 'text',
      'breakpoints' => true,
      'inlineEditing' => true,
    ];

    // Text that will go after the reviews
    $this->controls['suffixText'] = [
      'tab'   => 'content',
      'label' => esc_html__( 'Suffix Text', 'bricks' ),
      'type' => 'text',
      'breakpoints' => true,
      'inlineEditing' => true,
    ];
  }

  // Methods: Frontend-specific
  public function enqueue_scripts() {
    if (!wp_style_is('hypersite-reviews-stylesheet', 'enqueued')) {
        wp_enqueue_style('hypersite-reviews-stylesheet', HSREV_URL . 'public/css/hsrev-main.css', [], '1.0', false);
    }
  }
  public function render() {
    $root_classes[] = 'hypersite-reviews';

    // Prefetched Assets
    $google_logo = file_get_contents(HSREV_URL . 'public/images/google-logo-borderless.svg');
    $star_svg = file_get_contents(HSREV_URL . 'public/images/star-fill.svg');

    $location_id = GoogleDataHandler::get_selected_location_id();
    $reviews_count = GoogleDataHandler::get_location_reviews_total($location_id);

    $output_text = function() use ($reviews_count) {
      $prefix_text = isset($this->settings['prefixText']) ? $this->settings['prefixText'] . ' ' : '';
      $suffix_text = isset($this->settings['suffixText']) ? ' ' . $this->settings['suffixText'] : '';
      ob_start();
      ?>
        <p><?php echo $prefix_text . $reviews_count . ' ' . $suffix_text; ?></p>
      <?php
      return ob_get_clean();
    };

    $this->set_attribute('_root', 'class', $root_classes);

    echo "<div {$this->render_attributes( '_root' )}>";
?>
    <div class="google-reviews-count">
        <div class="google-reviews-count__logo-wrapper">
            <?php echo $google_logo; ?>
        </div>
        <div class="google-reviews-count__content-wrapper">
          <?php if($this->settings['starsVerticalPlacement'] === 'top' || $this->settings['starsVerticalPlacement'] === 'left') {
            for($i = 0; $i < 5; $i++){
              echo $star_svg;
            }
              echo $output_text();
            } else {
              echo $output_text();
              for($i = 0; $i < 5; $i++) {
                echo $star_svg;
              }
            }
          ?>
        </div>
    </div>
<?php
    }
}
