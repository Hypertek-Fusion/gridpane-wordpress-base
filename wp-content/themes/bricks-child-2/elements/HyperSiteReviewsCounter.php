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

}
