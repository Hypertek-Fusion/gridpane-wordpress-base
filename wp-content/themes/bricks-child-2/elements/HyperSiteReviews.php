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
    wp_enqueue_script( 'hypersite-reviews', HSREV_URL . 'public/js/hypersite-reviews.js', [], '1.0', true );
  }
  public function render() {
    $root_classes[] = 'hypersite-reviews';

    $this->set_attribute('_root', 'class', $root_classes);

    echo "<div {$this->render_attributes( '_root' )}>";
  }
}