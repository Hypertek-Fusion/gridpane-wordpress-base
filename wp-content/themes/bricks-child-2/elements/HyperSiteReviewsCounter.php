<?php 
// element-test.php

use Bricks\Breakpoints;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Prefix_Element_Test extends \Bricks\Element {
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
      'group' => 'display',
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
    ];

    $this->controls['starsHorizontalPlacement'] = [
      'group' => 'display',
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
      'default' => 'top',
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

    $this->set_attribute('_root', 'class', $root_classes);

    echo "<div {$this->render_attributes( '_root' )}>";
?>
    <div class="google-reviews-count">
        <div class="google-reviews-count__logo-wrapper">
            <?php echo $google_logo; ?>
        </div>
    </div>

    <pre>
        <?php echo print_r($this->settings, true); ?>
    </pre>
<?php
    }
}
