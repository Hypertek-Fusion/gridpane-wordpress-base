<?php 
// element-test.php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Prefix_Element_Test extends \Bricks\Element {
  // Element properties
  public $category     = 'HyperSite';
  public $name         = 'HyperSite Reviews';
  public $icon         = 'fas fa-comment';
  public $css_selector = 'hypersite-reviews';
  public $scripts      = ['hsrev-frontend-widget, bricksSplide'];
  public $nestable     = false; // true || @since 1.5

  // Methods: Builder-specific
  public function get_label(
  ) {
    return esc_html__( 'HyperSite Reviews', 'bricks');
  }
  public function get_keywords() {}
  public function set_control_groups() {
    $this->control_groups['display'] = [
      'title' => esc_html__( 'Display', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['card'] = [
      'title' => esc_html__( 'Card', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['author'] = [
      'title' => esc_html__( 'Author', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['images'] = [
      'title' => esc_html__( 'Images', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['testimonial'] = [
      'title' => esc_html__( 'Testimonial', 'bricks' ),
      'tab' => 'content',
    ];
  }
  public function set_controls() {

    $this->controls['reviewsToShow'] = [
      'group' => 'display',
      'label' => esc_html__( 'Number of Reviews', 'bricks' ),
      'type' => 'number',
      'min' => 0,
      'inline' => true,
      'default' => 6,
    ];

    // Display type
    $this->controls['selectDisplayType'] = [
      'group' => 'display',
      'label' => esc_html__( 'Display Type', 'bricks' ),
      'type' => 'select',
      'options' => [
        'grid' => 'Grid',
        'slider' => 'Slider'
      ],
      'inline' => true,
      'placeholder' => esc_html__( 'Grid', 'bricks' ),
      'multiple' => false, 
      'searchable' => false,
      'clearable' => false,
      'default' => 'grid',
    ];

    // Columns (only if display type is Grid)
    $this->controls['gridColumns'] = [
      'group' => 'display',
      'label' => esc_html__( 'Grid Template Columns', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'grid-template-columns',
        'selector' => '.testimonials-grid',
        ]
      ],
      'inlineEditing' => false,
      'default' => 'repeat(3, 1fr)',
      'required' => ['selectDisplayType', '=', ['grid','']]
    ];

    // Grid row gap
    $this->controls['gridRowGap'] = [
      'group' => 'display',
      'label' => esc_html__( 'Row Gap', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'row-gap',
        'selector' => '.testimonials-grid',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '12px',
      'required' => ['selectDisplayType', '=', ['grid','']]
    ];

    // Grid column gap
    $this->controls['gridColumnGap'] = [
      'group' => 'display',
      'label' => esc_html__( 'Column Gap', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'column-gap',
        'selector' => '.testimonials-grid',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '12px',
      'required' => ['selectDisplayType', '=', ['grid','']]
    ];

    // Card Padding
    $this->controls['cardPadding'] = [
      'group' => 'card',
      'label' => esc_html__( 'Padding', 'bricks' ),
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.testimonial-card',
        ]
      ],
      'default' => [
        'top' => '30px',
        'right' => '30px',
        'bottom' => '30px',
        'left' => '30px',
      ]
    ];

    // Grid row gap
    $this->controls['cardRowGap'] = [
      'group' => 'card',
      'label' => esc_html__( 'Row Gap', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'row-gap',
        'selector' => '.testimonial-card',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '12px',
    ];

    $this->controls['cardBorder'] = [
      'group' => 'card',
      'label' => esc_html__( 'Border', 'bricks' ),
      'type' => 'border',
      'css' => [
        [
          'property' => 'border',
          'selector' => '.testimonial-card',
        ],
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'width' => [
          'top' => 0,
          'right' => 0,
          'bottom' => 0,
          'left' => 0,
        ],
        'style' => 'solid',
        'color' => [
          'hex' => '#ffff00',
        ],
        'radius' => [
          'top' => 1,
          'right' => 1,
          'bottom' => 1,
          'left' => 1,
        ],
      ],
    ];

    $this->controls['topBarSeparator'] = [
      'group' => 'card',
			'label' => esc_html__( 'Top Bar', 'bricks' ),
			'type'  => 'separator',
		];

    $this->controls['topBarAlignItems'] = [
      'group' => 'card',
      'label' => esc_html__( 'Align items', 'bricks' ),
      'type'  => 'align-items',
      'css'   => [
        [
          'property' => 'align-items',
          'selector' => '.testimonial-card__top-wrapper',
        ],
      ],
    ];

    $this->controls['topBarJustifyContent'] = [
      'group' => 'card',
      'label' => esc_html__( 'Justify content', 'bricks' ),
      'type'  => 'justify-content',
      'css'   => [
        [
          'property' => 'justify-content',
          'selector' => '.testimonial-card__top-wrapper',
        ],
      ],
    ];

    // Top Bar column gap
    $this->controls['topBarColumnGap'] = [
      'group' => 'display',
      'label' => esc_html__( 'Column Gap', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'column-gap',
        'selector' => '.testimonials-grid',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '12px'
    ];

    // Card Box Shadow
    $this->controls['cardShadow'] = [
      'group' => 'card',
      'label' => esc_html__( 'Box Shadow', 'bricks' ),
      'type' => 'box-shadow',
      'css' => [
        [
          'property' => 'box-shadow',
          'selector' => '.testimonial-card',
        ],
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'values' => [
          'offsetX' => 0,
          'offsetY' => 0,
          'blur' => 0,
          'spread' => 0,
        ],
        'color' => [
          'rgb' => 'rgba(0, 0, 0, 0)',
        ],
      ],
    ];

    // Author Typography
    $this->controls['authorTypography'] = [
      'group' => 'author',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.testimonial-card__author-name',
        ],
      ],
      'inline' => true
    ];

    // Testimonial Typography
    $this->controls['testimonialTypography'] = [
      'group' => 'testimonial',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.testimonial-card__content',
        ],
      ],
      'inline' => true
    ];

        // Card Padding
    $this->controls['testimonialMargin'] = [
      'group' => 'card',
      'label' => esc_html__( 'Margin', 'bricks' ),
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => '.testimonial-card__content',
        ]
      ],
      'default' => [
        'top' => '30px',
        'right' => '30px',
        'bottom' => '30px',
        'left' => '30px',
      ]
    ];

    $this->controls['authorLogoSeparator'] = [
      'group' => 'images',
			'label' => esc_html__( 'Author Logo', 'bricks' ),
			'type'  => 'separator',
		];

    // Profile Image Size ( Affects width and height )
    $this->controls['authorLogoSize'] = [
      'group' => 'images',
      'label' => esc_html__( 'Size', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'width',
        'selector' => '.testimonial-card__author-profile-icon',
        ],
        [
        'property' => 'height',
        'selector' => '.testimonial-card__author-profile-icon',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '16px'
    ];

      $this->controls['brandLogoSeparator'] = [
      'group' => 'images',
			'label' => esc_html__( 'Brand Logo', 'bricks' ),
			'type'  => 'separator',
		];

    // Profile Image Size ( Affects width and height )
    $this->controls['brandLogoSize'] = [
      'group' => 'images',
      'label' => esc_html__( 'Size', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'width',
        'selector' => '.testimonial-card__bottom-wrapper > svg',
        ],
        [
        'property' => 'height',
        'selector' => '.testimonial-card__bottom-wrapper > svg',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '16px'
    ];

    $this->controls['ratingsLogoSeparator'] = [
      'group' => 'images',
			'label' => esc_html__( 'Ratings', 'bricks' ),
			'type'  => 'separator',
		];

    // Profile Image Size ( Affects width and height )
    $this->controls['ratingSize'] = [
      'group' => 'images',
      'label' => esc_html__( 'Size', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'width',
        'selector' => '.star-ratings-wrapper > svg',
        ],
        [
        'property' => 'height',
        'selector' => '.star-ratings-wrapper > svg',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '16px'
    ];

    $this->controls['ratingFill'] = [
      'group' => 'images',
      'label' => esc_html__( 'Fill', 'bricks' ),
      'type' => 'color',
      'inline' => true,
      'css' => [
        [
          'property' => 'fill',
          'selector' => '.star-ratings-wrapper > svg > path',
        ]
      ],
      'default' => [
        'hex' => '#ffc1a1',
        'rgb' => 'rgba(255,193,10, 1)',
      ],
    ];

    $this->controls['ratingColumnGap'] = [
      'group' => 'images',
      'label' => esc_html__( 'Column Gap', 'bricks' ),
      'type' => 'text',
      'css' => [
        [
        'property' => 'column-gap',
        'selector' => '.star-ratings-wrapper',
        ]
      ],
      'inlineEditing' => false,
      'inline' => true,
      'small' => false,
      'default' => '12px'
    ];

  }

  // Methods: Frontend-specific
  public function enqueue_scripts() {
    if (!wp_style_is('hypersite-reviews-stylesheet', 'enqueued')) {
        wp_enqueue_style('hypersite-reviews-stylesheet', HSREV_URL . 'public/css/hsrev-main.css', [], '1.0', false);
    }

    if(!wp_script_is('bricks-splide', 'enqueued')) {
      wp_enqueue_script( 'bricks-splide' );
    }

    if(!wp_style_is('bricks-splide', 'enqueued')) {
      wp_enqueue_style( 'bricks-splide' );
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


    for($i = 0; $i < $pages; $i++) {
        $reviews = GoogleDataHandler::get_selected_reviews($location_id, $i + 1, $per_page);
        
        $reviews_batch = array_merge($reviews_batch, $reviews);
    }

    // Prefetched Assets
    $google_logo = file_get_contents(HSREV_URL . 'public/images/google-logo-borderless.svg');
    $star_svg = file_get_contents(HSREV_URL . 'public/images/star-fill.svg');

    $output_card = function($review) use ($google_logo, $star_svg) {
      ob_start();
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
      return ob_get_clean();
    };

    $this->set_attribute('_root', 'class', $root_classes);

    echo "<div {$this->render_attributes( '_root' )}>";

    ?>
  <div class="testimonials">
    <?php if($this->settings['selectDisplayType'] === 'grid' || !isset($this->settings['selectDisplayType'])): ?>
      <div class="testimonials-grid">
    <?php else : ?>
      <div class="testimonials-slider"></div>
    <?php endif; ?>
  <?php

    $greater_value = $this->settings['reviewsToShow'] > count($reviews_batch) ? count($reviews_batch) : $this->settings['reviewsToShow'];

    for($i = 0; $i < $greater_value; $i++) {
      echo $output_card($reviews_batch[$i]);
    }

?>
    </div>
  </div>
<?php
  }
}

?>