<?php
namespace BricksUltra\includes\ContentTicker;

use Bricks\Element;
use Bricks\Query;
use Bricks\Helpers;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-content-ticker';
	public $icon         = 'ion-md-alert';
	public $css_selector = '';
	public $scripts      = [ 'bricksUltraContentTicker' ];
	public $loop_index   = 0;
	public function get_label() {
		return esc_html__( 'Content Ticker', 'wpv-bu' );
	}
	public function get_keywords() {
		return [ 'ticker', 'slider'];
	}

	public function set_control_groups() {
		$this->control_groups['content'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['header'] = [
			'title' => esc_html__( 'Header', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['arrows'] = [
			'title' => esc_html__( 'Arrows', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['slider_controls'] = [
			'title'    => esc_html__( 'Slider Controls', 'wpv-bu' ),
			'tab'      => 'content',
		];
		$this->control_groups['header_style'] = [
			'title' => esc_html__( 'Header Style', 'wpv-bu' ),
			'tab'   => 'content',
			'required' => [
				['show_header', '=', true]
			]
		];
		$this->control_groups['content_style'] = [
			'title' => esc_html__( 'Content Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['arrow_style'] = [
			'title' => esc_html__( 'Arrow Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}
	public function set_controls(){
		$this->controls['ticker_items'] = [
			'tab'           => 'content',
			'group'         => 'content',
			'checkLoop'     => true,
			'label'         => esc_html__( 'Items', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'item_title_text', // Default 'title'
			'default'       => [
				[
					'item_title_text' => __( 'Master Cleanse Bespoke', 'wpv-bu' ),
				],
				[
					'item_title_text' => __( 'Organic Blue Bottel', 'wpv-bu' ),
				],
				[
					'item_title_text' => __( 'Twee Diy Kale', 'wpv-bu' ),
				],
			],
			'fields'        => [
				'item_title_text' => [
					'label'       => esc_html__( 'Title', 'wpv-bu' ),
					'type'        => 'text',
					'default'     => __( 'This is the heading', 'wpv-bu' ),
					'placeholder' => __( 'Enter your title', 'wpv-bu' ),
				],
				'item_link' => [
					'label' => esc_html__( 'Link', 'wpv-bu' ),
					'type'  => 'link',
					'placeholder' => esc_html__( 'http://yoursite.com', 'wpv-bu' ),
				],
				
			],
		];
		$this->controls = array_replace_recursive( $this->controls, $this->get_loop_builder_controls( 'content' ) );
		
		$this->controls['show_header'] = [
			'tab'           => 'content',
			'group'         => 'header',
			'label' => esc_html__( 'Show Header', 'wpv-bu' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,	
		];
		$this->controls['heading'] = [
			'tab' => 'content',
			'group'         => 'header',
			'label' => esc_html__( 'Heading', 'bricks' ),
			'type' => 'text',
			'spellcheck' => true,
			'inlineEditing' => true,
			'default' => 'Trending..',
			'inline' => true,
			'required' => [
				['show_header', '=' , true]
			]
		];
		$this->controls['header_icon'] = [
			'tab' => 'content',
			'group'         => 'header',
			'label' => esc_html__( 'Icon', 'bricks' ),
			'type' => 'icon',
			'default' => [
				'library' => 'fontawesomSolid', // fontawesome/ionicons/themify
				'icon' => 'fas fa-bolt-lightning',    // Example: Themify icon class
			],
			'required' => [
				['show_header', '=' , true]
			]
		];
		$this->controls['icon_position'] = [
			'tab' => 'content',
			'group'   => 'header',
			'label' => esc_html__( 'Text align', 'bricks' ),
			'type' => 'select',
			'options' => [
			  'right' => esc_html__( 'Right', 'bricks' ),
			  'left' => esc_html__( 'Left', 'bricks' ),
			],
			'inline' => true,
			'placeholder' => esc_html__( 'Select', 'bricks' ),
			'default' => 'left', // Option key
			'clearable' => false,
			'required' => [
				['show_header', '=' , true]
			]
		];

		$this->controls['show_arrows'] = [
			'tab'           => 'content',
			'group'   => 'arrows',
			'label' => esc_html__( 'Show Arrow', 'wpv-bu' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true,	
		];

		$this->controls['prev_icon'] = [
			'tab' => 'content',
			'group'         => 'arrows',
			'label' => esc_html__( 'Prev Icon', 'bricks' ),
			'type' => 'icon',
			'default' => [
				'library' => 'themify', // fontawesome/ionicons/themify
				'icon' => 'ti-angle-left',    // Example: Themify icon class
			  ],
			'required' => [
				['show_arrows', '=' , true]
			]
		];

		$this->controls['next_icon'] = [
			'tab' => 'content',
			'group'         => 'arrows',
			'label' => esc_html__( 'Next Icon', 'bricks' ),
			'type' => 'icon',
			'default' => [
			  'library' => 'themify', // fontawesome/ionicons/themify
			  'icon' => 'ti-angle-right',    // Example: Themify icon class
			],
			'required' => [
				['show_arrows', '=' , true]
			]
		];
		$this->controls['slider_direction']           = [
			'tab'       => 'content',
			'group'     => 'slider_controls',
			'label'     => esc_html__( 'Direction', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'ttb'  => esc_html__( 'Vertical', 'wpv-bu' ),
				'ltr' => esc_html__( 'Horizontal', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => 'ltr',
			'clearable' => false,
		];

		$this->controls['slide_height']            = [
			'tab'     => 'content',
			'group'     => 'slider_controls',
			'label'   => esc_html__( 'Height', 'wpv-bu' ),
			'type'    => 'number',
			'default' => 50,
			'unit' => 'px',
			'css' => [
				[
					
					'property' => 'height',
					'selector' => '.bultr-content-ticker.bultr-slider-vertical .bultr-ct-label',
				],
				[
					'property' => 'height',
					'selector' => '.bultr-content-ticker.bultr-slider-vertical .bultr-ct-content',
				]
			],
			'required' => [ 'slider_direction', '=', 'ttb' ],
		];
		
		$this->controls['slider_effect']           = [
			'tab'       => 'content',
			'group'     => 'slider_controls',
			'label'     => esc_html__( 'Effect', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'fade'  => esc_html__( 'Fade', 'wpv-bu' ),
				'slide' => esc_html__( 'Slide', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => 'slide',
			'clearable' => false,
		];
		$this->controls['slider_speed']            = [
			'tab'     => 'content',
			'group'     => 'slider_controls',
			'label'   => esc_html__( 'Speed (ms)', 'wpv-bu' ),
			'type'    => 'number',
			'default' => 3000,
		];
		$this->controls['slider_autoplay']         = [
			'tab'     => 'content',
			'group'     => 'slider_controls',
			'label'   => esc_html__( 'Autoplay', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => false,
		];
		$this->controls['autoplay_interval']       = [
			'tab'      => 'content',
			'group'     => 'slider_controls',
			'label'    => esc_html__( 'Autoplay Interval (ms)', 'wpv-bu' ),
			'type'     => 'number',
			'default'  => 3000,
			'required' => [ 'slider_autoplay', '=', true ],
		];
		$this->controls['slide_pause_hvr']         = [
			'tab'     => 'content',
			'group'     => 'slider_controls',
			'label'   => esc_html__( 'Pause on Hover', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => false,
		];
		$this->controls['slider_loop']             = [
			'tab'     => 'content',
			'group'     => 'slider_controls',
			'label'   => esc_html__( 'Loop', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
			'required' => [
				['slider_effect', '=', 'slide']
			]
		];
		$this->controls['slider_keyboard_control'] = [
			'tab'     => 'content',
			'group'     => 'slider_controls',
			'label'   => esc_html__( 'Keyboard Control', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];

		$this->controls['header_color'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'group'    => 'header_style',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-ct-label',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-ct-label',
				],
			],
			'required' => [
				[ 'show_header', '=', true ],
			],
		];

		$this->controls['header_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'header_style',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-ct-label',
				],
			],
			'required' => [
				[ 'show_header', '=', true ],
			],
		];

		$this->controls['header_typo'] = [
			'tab'      => 'content',
			'group'    => 'header_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'typography',
					'selector' => '.bultr-ct-label',
				],
			],
			'inline'   => true,
			'exclude'  => [
				'color',
			],
			'required' => [
				[ 'show_header', '!=', '' ],
			],
		];

		$this->controls['header_padding'] = [
			'tab'      => 'content',
			'group'    => 'header_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-ct-label',
				],
			],
			'required' => [
				[ 'show_header', '!=', '' ],
			],
		];

		$this->controls['header_border'] = [
			'tab' => 'content',
			'group' => 'header_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type' => 'border',
			'css' => [
			  [
				'property' => 'border',
				'selector' => '.bultr-ct-label',
			  ],
			],
			'inline' => true,
			'small' => true,
		];

		$this->controls['content_color'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'group'    => 'content_style',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-ct-content .splide__slide',
				],
			],
		];

		$this->controls['content_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'content_style',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-content-ticker',
				],
			],
		];

		$this->controls['content_typo'] = [
			'tab'      => 'content',
			'group'    => 'content_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'typography',
					'selector' => '.bultr-ct-content .splide__slide',
				],
			],
			'inline'   => true,
			'exclude'  => [
				'color',
			],
		];

		$this->controls['content_border'] = [
			'tab' => 'content',
			'group' => 'content_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type' => 'border',
			'css' => [
			  [
				'property' => 'border',
				'selector' => '.bultr-ct-wrapper.bultr-content-ticker',
			  ],
			],
			'inline' => true,
			'small' => true,
		];

		$this->controls['arrow_size'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Size', 'bricks' ),
			'type' => 'number',
			'unit' => 'px',
			'inline' => true,
			'css' => [
			  [
				'selector' => '.bultr-ct-content .splide__arrow i',
				'property' => 'font-size',
			  ],
			],
			'default' => '15',
		];

		$this->controls['arrow_gap'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Gap', 'bricks' ),
			'type' => 'number',
			'unit' => 'px',
			'inline' => true,
			'css' => [
			  [
				'selector' => '.bultr-ct-content .splide__arrows',
				'property' => 'gap',
			  ],
			],
		];

		$this->controls['arrow_position'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Position', 'bricks' ),
			'type' => 'number',
			'unit' => 'px',
			'inline' => true,
			'css' => [
			  [
				'selector' => '.bultr-ct-content .splide__arrows',
				'property' => 'right',
			  ],
			],
		];

		$this->controls['arrow_color'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type' => 'color',
			'inline' => true,
			'small' => true,
			'css' => [
				[
					'property' => 'color',
					'selector' => '.bultr-ct-content .splide__arrow i',
					'important' => true, // Optional
				],
			],
		];

		$this->controls['arrow_bg_color'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Background color', 'wpv-bu' ),
			'type' => 'color',
			'inline' => true,
			'small' => true,
			'css' => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-ct-content .splide__arrow',
					'important' => true, // Optional
				],
			],
		];
		$this->controls['arrow_padding'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type' => 'dimensions',
			'css' => [
			  [
				'property' => 'padding',
				'selector' => '.bultr-ct-content .splide__arrow',
			  ]
			]
		];

		$this->controls['arrow_border'] = [
			'tab' => 'content',
			'group' => 'arrow_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type' => 'border',
			'css' => [
			  [
				'property' => 'border',
				'selector' => '.bultr-ct-content .splide__arrow',
			  ],
			],
			'inline' => true,
			'small' => true,
		];
	  
		



	}

	public function enqueue_scripts() {
		
		if ( (float) BRICKS_VERSION < 1.5 ) {
			wp_register_script( 'bricks-splide', BRICKS_URL_ASSETS . 'js/libs/splide.min.js', [ 'bricks-scripts' ], WPV_BU_VERSION, true );
			wp_register_style( 'bricks-splide', BRICKS_URL_ASSETS . 'css/libs/splide.min.css', [], WPV_BU_VERSION );
		}else{
			wp_enqueue_script( 'bricks-splide' );
			wp_enqueue_style( 'bricks-splide' );
		}
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
	}

	public function render(){
		$settings = $this->settings;
		$ticker_items = $settings['ticker_items'];
		if(count($ticker_items) < 1){
			return;
		}

		$main_slider_options = [];
		$effect = $settings['slider_effect'] ?? 'slide';
		$main_slider_options = [
			'type' => $effect,
			'perPage'      => 1,
			'speed'  => isset( $settings['slider_speed'] ) ? $settings['slider_speed'] : '',
			'autoplay'     => isset( $settings['slider_autoplay'] ) && $settings['slider_autoplay'] === true ? true : false,
			'interval'     => isset( $settings['autoplay_interval'] ) ? $settings['autoplay_interval'] : '',
			'pauseOnHover' => isset( $settings['slide_pause_hvr'] ),
			'pagination'	=> false,
			'direction'    => $settings['slider_direction'],
			'arrows'       => true,
			'keyboard'     => isset( $settings['slider_keyboard_control'] ),
			'width'		   => '100%',	
			'gap' => "10px"
		];
		if(is_rtl() && $settings['slider_direction'] == 'ltr'){
			$main_slider_options['direction'] = 'rtl';
		}
		if($settings['slider_direction'] == 'ttb'){
			$main_slider_options['autoHeight'] = true;
			$main_slider_options['height'] = isset($settings['slide_height']) ? $settings['slide_height'] : '50px';
		}
		if ( isset( $settings['slider_loop'] ) && $settings['slider_loop'] && $settings['slider_effect'] === 'slide' ) {
			$main_slider_options['type']   = 'loop';
			$main_slider_options['clones'] = 2;
		}
		
		
		$this->set_attribute('_root', 'class', 'bultr-ct');
		$this->set_attribute('wrapper', 'class', ['bultr-ct-wrapper','bultr-content-ticker']);
		if($settings['slider_direction'] == 'ltr'){
			$this->set_attribute('wrapper', 'class', 'bultr-slider-horizontal');
		}else{
			$this->set_attribute('wrapper', 'class', 'bultr-slider-vertical');
		}
		$this->set_attribute('ct-label', 'class', 'bultr-ct-label');
		if(isset($settings['header_icon']['icon'])){
			$this->set_attribute('ct-label', 'class', 'bultr-icon-pos-'.$settings['icon_position']);
		}
		$this->set_attribute('ct-content', 'class', ['bultr-ct-content', 'bultr-slider','splide']);
		$this->set_attribute( 'ct-content', 'data-splide', wp_json_encode( $main_slider_options ) );
		?>
			<div <?php echo $this->render_attributes('_root');?>>
				<div <?php echo $this->render_attributes('wrapper');?>>
					<?php if(isset($settings['show_header']) && (isset($settings['heading']) || isset($settings['heading_icon']['icon']))){?>
						<div <?php echo $this->render_attributes('ct-label');?>>
							
								<span>
									<?php if(isset($settings['header_icon'])){
										$icon = self::render_icon( $settings['header_icon']);
										echo $icon;
									}
									if(isset($settings['heading'])){?>
										<?php echo $settings['heading']; ?>
									<?php } ?>
								</span>
							
						</div>
					<?php } ?>	
					<div <?php echo $this->render_attributes('ct-content');?>>
						
						<div class="splide__track">
							<div class="splide__list">
								<?php 
									if ( isset( $settings['hasLoop'] ) ) {
										$query = new Query(
											[
												'id'       => $this->id,
												'settings' => $settings,
											]
										);
										$ticker_item = $ticker_items[0];
										$query->render( [ $this, 'render_repeater_item' ], compact( 'settings', 'ticker_item'));
										// We need to destroy the Query to explicitly remove it from the global store
										$query->destroy();
										unset( $query );
									} else {
										foreach ( $ticker_items as $index => $ticker_item ) {
											self::render_repeater_item($settings,$ticker_item);
										}
									}	
								?>
							</div>
						</div>
						<div class="splide__arrows  splide__arrows--ltr">
							<button class="splide__arrow  splide__arrow--prev" type="button" disabled="" aria-label="Previous slide" aria-controls="image-carousel-track">
								<?php echo self::render_icon( $settings['prev_icon'] ); ?>
							</button>
							<button class="splide__arrow  splide__arrow--next" type="button" disabled="" aria-label="Next slide" aria-controls="image-carousel-track">
								<?php echo self::render_icon( $settings['next_icon'] ); ?>
							</button>
						</div>	
					</div>
				</div>
			</div>
		<?php
	}

	public function render_repeater_item($settings, $item){
		?>
			<li class="splide__slide">
				<?php if(isset($item['item_link']['url'])){
					$this->set_link_attributes("item-{$this->loop_index}", $item['item_link']);?>
					<a <?php echo $this->render_attributes("item-{$this->loop_index}");?>>
				<?php } ?>
						<?php echo $this->render_dynamic_data($item['item_title_text']);?>
				<?php if(isset($item['item_link']['url'])){ ?>
					</a>
				<?php } ?>
			</li>
		<?php
		$this->loop_index++;
	}
}			