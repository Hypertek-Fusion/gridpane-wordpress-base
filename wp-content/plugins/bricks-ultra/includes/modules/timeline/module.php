<?php

namespace BricksUltra\Modules\Timeline;

use Bricks\Element;
use Bricks\Query;
use Bricks\Helpers;
use Bricks\Setup;
class Module extends Element {

	public $category     = 'ultra';
	public $name         = 'wpvbu-timeline';
	public $icon         = 'fas fa-arrow-down-wide-short';
	public $css_selector = '';
	public $scripts      = [ 'bricksUltraTimeline' ];
	public $loop_index   = 0;

	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Timeline', 'wpv-bu' );
	}
	public function set_control_groups() {
		$this->control_groups['timeline']            = [
			'title' => esc_html__( 'Timeline', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['section_global_icon'] = [
			'title' => esc_html__( 'Global Icon', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['section_layout']      = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['card_styling']        = [
			'title' => esc_html__( 'Card', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['date_styling']        = [
			'title' => esc_html__( 'Label', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['connector_styling']   = [
			'title' => esc_html__( 'Connector', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['icon_styling'] = [
			'title' => esc_html__( 'Icon', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}
	public function set_controls() {

		$this->controls['timeline_items'] = [
			'tab'           => 'content',
			'group'         => 'timeline',
			'checkLoop'     => true,
			'label'         => esc_html__( 'Items', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'item_title_text', // Default 'title'
			'default'       => [
				[
					'item_date'       => __( 'February 2, 2022', 'wpv-bu' ),
					'item_title_text' => __( 'MASTER CLEANSE BESPOKE', 'wpv-bu' ),
					'item_content'    => __( 'IPhone tilde pour-over, sustainable cred roof party occupy master cleanse. Godard vegan heirloom sartorial flannel raw denim +1. Sriracha umami meditation, listicle chambray fanny pack blog organic Blue Bottle.', 'wpv-bu' ),
					'view'            => 'global',
					'shape'           => 'global',
					'item_title_size' => 'h3',
				],
				[
					'item_date'       => __( 'March 11, 2022', 'wpv-bu' ),
					'item_title_text' => __( 'ORGANIC BLUE BOTTLE', 'wpv-bu' ),
					'item_content'    => __( 'Godard vegan heirloom sartorial flannel raw denim +1 umami gluten-free hella vinyl. Viral seitan chillwave, before they sold out wayfarers selvage skateboard Pinterest messenger bag.', 'wpv-bu' ),
					'view'            => 'global',
					'shape'           => 'global',
					'item_title_size' => 'h3',
				],
				[
					'item_date'       => __( 'November 15, 2022', 'wpv-bu' ),
					'item_title_text' => __( 'TWEE DIY KALE', 'wpv-bu' ),
					'item_content'    => __( 'Twee DIY kale chips, dreamcatcher scenester mustache leggings trust fund Pinterest pickled. Williamsburg street art Odd Future jean shorts cold-pressed banh mi DIY distillery Williamsburg.', 'wpv-bu' ),
					'view'            => 'global',
					'shape'           => 'global',
					'item_title_size' => 'h3',
				],
			],
			'fields'        => [
				'item_date' => [
					'label' => esc_html__( 'Label', 'wpv-bu' ),
					'type'  => 'text',
				],

				'item_title_text' => [
					'label'       => esc_html__( 'Title', 'wpv-bu' ),
					'type'        => 'text',
					'default'     => __( 'This is the heading', 'wpv-bu' ),
					'placeholder' => __( 'Enter your title', 'wpv-bu' ),
				],

				'itemColor' => [
					'label'  => esc_html__( 'Title color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-item-title',
						],
					],
				],

				'item_title_size' => [
					'label'     => esc_html__( 'Title Tag', 'wpv-bu' ),
					'type'      => 'select',
					'options'   => [
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					],
					'inline'    => true,
					'clearable' => false,
					'default'   => 'h3',
				],

				'item_content' => [
					'label'         => esc_html__( 'Content', 'wpv-bu' ),
					'type'          => 'textarea',
					'rows'          => 10,
					'spellcheck'    => true,
					'inlineEditing' => true,
					'default'       => __( 'This is the heading', 'wpv-bu' ),
					'placeholder'   => __( 'Enter your Content', 'wpv-bu' ),
				],

				'item_content_image' => [
					'label' => esc_html__( 'Image', 'wpv-bu' ),
					'type'  => 'image',
				],

				'item_custom_icon' => [
					'tab'     => 'content',
					'group'   => 'items',
					'label'   => esc_html__( 'Custom Icon', 'wpv-bu' ),
					'type'    => 'checkbox',
					'inline'  => true,
					'small'   => true,
					'default' => true,

				],

				'icon_type' => [
					'label'    => esc_html__( 'Icon Type', 'wpv-bu' ),
					'type'     => 'select',
					'options'  => [
						'icon'  => 'Icon',
						'image' => 'Image',
						'text'  => 'Text',
						'svg'   => 'SVG',
					],
					'inline'   => true,
					'default'  => 'icon',
					'required' => [ 'item_custom_icon', '!=', '' ],
				],

				'icon' => [
					'label'    => esc_html__( 'Icon', 'wpv-bu' ),
					'type'     => 'icon',
					'default'  => [
						'library' => 'themify',
						'icon'    => 'ti-star',
					],
					'css'      => [
						[
							'selector' => '.icon-svg',
						],
					],
					'required' => [
						[ 'icon_type', '=', 'icon' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'svg' => [
					'tab'      => 'content',
					'type'     => 'svg',
					'required' => [
						[ 'icon_type', '=', 'svg' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'image' => [
					'label'    => esc_html__( 'Image', 'wpv-bu' ),
					'type'     => 'image',
					'required' => [
						[ 'icon_type', '=', 'image' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'text' => [
					'label'         => esc_html__( 'Text', 'wpv-bu' ),
					'type'          => 'text',
					'spellcheck'    => true,
					'inlineEditing' => true,
					'inline'        => true,
					'required'      => [
						[ 'icon_type', '=', 'text' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'view' => [
					'label'    => esc_html__( 'View', 'wpv-bu' ),
					'type'     => 'select',
					'options'  => [
						'global'  => 'Global',
						'default' => 'Default',
						'stacked' => 'Stacked',
						'framed'  => 'Framed',
					],
					'default'  => 'global',
					'required' => [ 'item_custom_icon', '!=', '' ],
				],

				'shape' => [
					'label'    => esc_html__( 'Shape', 'wpv-bu' ),
					'type'     => 'select',
					'options'  => [
						'global' => 'Global',
						'circle' => 'Circle',
						'square' => 'Square',
					],
					'default'  => 'global',
					'required' => [
						[ 'view', '!=', 'default' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'item_link' => [
					'label'   => esc_html__( 'Link', 'wpv-bu' ),
					'type'    => 'link',
					'default' => [
						'type'   => 'external',
						'url'    => '#',
						'newTab' => true,
					],
				],
			],
		];
		$this->controls = array_replace_recursive( $this->controls, $this->get_loop_builder_controls( 'timeline' ) );

		$this->global_icon_controls();

		$this->layout_controls();
		$this->card_style_controls();
		$this->icon_style_controls();
		$this->connector_style_controls();
	}

	// Methods: Frontend-specific

	public function connector_style_controls() {
		$this->controls['line_bg_color']   = [
			'tab'   => 'content',
			'group' => 'connector_styling',
			'label' => esc_html__( 'Line Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-timeline-progress-bar',
				],
			],
		];
		$this->controls['progress_color']  = [
			'tab'   => 'content',
			'group' => 'connector_styling',
			'label' => esc_html__( 'Progress Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-timeline-progress-bar .bultr-pb-inner-line',
				],
			],
		];
		$this->controls['progress_offset'] = [
			'tab'         => 'content',
			'group'       => 'connector_styling',
			'label'       => esc_html__( 'Offset', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 1,
			'max'         => 5000,
			'step'        => '1',
			'inline'      => true,
			'default'     => 200,
			'description' => esc_html__( 'Animation Trigger before item reach the top of the window', 'wpv-bu' ),
		];

		$this->controls['line_thickness'] = [
			'tab'    => 'content',
			'group'  => 'connector_styling',
			'label'  => esc_html__( 'Thickness', 'wpv-bu' ),
			'type'   => 'number',
			'min'    => 2,
			'max'    => 10,
			'step'   => '0.5',
			'inline' => true,
			'unit'   => 'px',
			'css'    => [
				[
					'selector' => '.bultr-timeline-progress-bar',
					'property' => 'width',
				],
			],
		];
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-timeline', WPV_BU_URL . 'assets/lib/timeline/timeline.min.js', '', WPV_BU_VERSION, true );
		wp_enqueue_script( 'bultr-module-script' );
	}

	public function render() {
		$settings        = $this->settings;
		$timeline_items  = $settings['timeline_items'];
		$index           = $this->loop_index;
		$output          = '';
		$global_settings = [];
		if ( isset( $settings['progress_offset'] ) ) {
			$top_offset = $settings['progress_offset'];
		} else {
			$top_offset = 500;
		}

		$this->set_attribute( 'wrapper_class', 'class', 'bultr-timeline' );
		if ( isset( $settings['timeline_align'] ) ) {
			$this->set_attribute( 'wrapper_class', 'data-layout', $settings['timeline_align'] );
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-layout-' . $settings['timeline_align'] );
		} else {
			$this->set_attribute( 'wrapper_class', 'data-layout', 'center' );
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-layout-center' );
		}

		$this->set_attribute( 'wrapper_class', 'data-top-offset', $top_offset );

		if ( is_rtl() ) {
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-timeline-layout-rtl' );
		}

		if ( isset( $settings['tl_alternate_style'] ) && $settings['tl_alternate_style'] === true ) {
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-timeline-alternate-yes' );
		}

		if ( isset( $settings['image_align_post'] ) ) {
			$this->set_attribute( 'wrapper_class', 'class', 'image-position-' . $settings['image_align_post'] );
		} else {
			$this->set_attribute( 'wrapper_class', 'class', 'image-position-column' );
		}

		if ( isset( $settings['arrow_align'] ) ) {
			if ( $settings['arrow_align'] === 'flex-start' ) {
				$arrow_align = 'top';
			} elseif ( $settings['arrow_align'] === 'center' ) {
				$arrow_align = 'center';
			} else {
				$arrow_align = 'bottom';
			}
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-tl-' . $arrow_align );
		} else {
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-tl-center' );
		}

		$start_pos = $settings['start_pos'] ?? 'left';
		$timeAlign = $this->settings['timeline_align'] ?? 'center';
		if ( $timeAlign === 'center' ) {
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-tl-start-pos-' . $start_pos );
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-tl-res-style-' . $settings['tl_responsive_style'] );
			if ( 'right' === $settings['tl_responsive_layout'] ) {
				$this->set_attribute( 'wrapper_class', 'class', 'bultr-tl-res-layout-right' );
			} else {
				$this->set_attribute( 'wrapper_class', 'class', 'bultr-tl-res-layout-left' );
			}
		}

		if ( isset( $settings['enable_fcs_style'] ) ) {
			$this->set_attribute( 'wrapper_class', 'class', 'bultr-fcs-style' );
		}
		$this->set_attribute( 'meta-wrapper', 'class', 'bultr-tl-item-meta-wrapper' );
		$this->set_attribute( 'meta', 'class', 'bultr-tl-item-meta' );
		$global_settings = [
			'global_icon_type'  => $settings['global_icon_type'],
			'global_icon_view'  => $settings['global_icon_view'],
			'global_icon_shape' => $settings['global_icon_shape'],
		];
		switch ( $settings['global_icon_type'] ) {
			case 'icon':
				$global_settings = [
					'global_icon_icon' => $settings['global_icon_icon'],
				];
				break;
			case 'image':
				$global_settings = [
					'global_icon_image' => $settings['global_icon_image'],
				];
				break;
			case 'text':
				$global_settings = [
					'global_icon_text' => $settings['global_icon_text'],
				];
				break;
			case 'svg':
				$global_settings = [
					'global_icon_text' => $settings['global_icon_svg'],
				];
				break;
		}

		$global_settings = [
			'global_icon_type'  => $settings['global_icon_type'],
			'global_icon_icon'  => $settings['global_icon_icon'],
			'global_icon_view'  => $settings['global_icon_view'],
			'global_icon_shape' => $settings['global_icon_shape'],
		];
		?>
		<div <?php echo $this->render_attributes( '_root' ); ?>>
			<section
			<?php echo $this->render_attributes( 'wrapper_class' ); ?>>
				<?php //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				if ( isset( $settings['hasLoop'] ) ) {
					$query         = new Query(
						[
							'id'       => $this->id,
							'settings' => $settings,
						]
					);
					$timeline_item = $settings['timeline_items'][0];
					$query->render( [ $this, 'render_timeline_item' ], compact( 'timeline_item', 'global_settings' ) );
					// We need to destroy the Query to explicitly remove it from the global store
					$query->destroy();
					unset( $query );
				} else {
					foreach ( $timeline_items as $index => $timeline_item ) {
						self::render_timeline_item( $timeline_item, $global_settings );
					}
				}
				?>
				<div class="bultr-timeline-progress-bar">
					<div class="bultr-pb-inner-line"></div>
				</div>
			</section>
		</div>    
		<?php
	}

	public function render_timeline_item( $item, $global_settings ) {
		$settings = $this->settings;
		$index    = $this->loop_index;
		if ( ! isset( $item['id'] ) ) {
			$item['id'] = wp_rand( '9999', '100000' );
		}

		if ( isset( $item['id'] ) ) {
			$this->set_attribute( "item-{$index}", 'data-id', $item['id'] );
			$this->set_attribute( "item-{$index}" . '-icon_wrapper', 'class', 'bultr-icon-' . $item['id'] );
			$this->set_attribute( "item-{$index}", 'class', [ 'bultr-repeater-item-' . $item['id'] ] );
		}

		$this->set_attribute( "item-{$index}", 'class', [ 'repeater-item', 'bultr-timeline-item' ] );
		$this->set_attribute( "item-{$index}" . '-icon_wrapper', 'class', [ 'bultr-tl-icon-wrapper' ] );
		
		if ( isset( $item['item_link'] ) ) {
			$this->set_link_attributes( "item-{$index}" . '-link-attributes', $item['item_link'] );
		}
		if ( isset( $settings['enable_hvr_style'] ) ) {
			$this->set_attribute( "item-{$index}", 'class', 'bultr-item-hvr-style' );
		}
		?>
		<div
		<?php
		// PHPCS:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->render_attributes( "item-{$index}" );
		?>
		>
			<div <?php echo $this->render_attributes( 'meta-wrapper' ); ?>>
				<div <?php echo $this->render_attributes( 'meta' ); ?>><?php echo $this->render_dynamic_data( $item['item_date'] ); ?></div>
			</div>
			<div <?php echo $this->render_attributes( "item-{$index}" . '-icon_wrapper' ); ?>>
				<?php $this->render_icon_html( $item, $settings, $global_settings, $index ); ?>
			</div>
			<div class='bultr-tl-content-wrapper'>
				<?php if ( isset( $item['item_link'] ) ) { ?>
					<a <?php echo $this->render_attributes( "item-{$index}" . '-link-attributes' ); ?>>
				<?php } ?>
					<div class="bultr-tl-item-content">
						<?php if ( isset( $item['item_content_image'] ) ) { ?>
							<?php
								// Image ID or URL from dynamic data
							if ( isset( $item['item_content_image']['useDynamicData'] ) ) {
								$img = $this->render_dynamic_data_tag( $item['item_content_image']['useDynamicData'], 'image', [ 'size' => $item['item_content_image']['size'] ] );
								if ( ! empty( $img[0] ) ) {
									if ( is_numeric( $img[0] ) ) {
										$img_id = $img[0];
									} else {
										$img_id = attachment_url_to_postid( $img[0] );
									}
								}
								if ( ! empty( $img_id ) ) {
									?>
										<div class='bultr-tl-item-image'>
										<?php echo wp_get_attachment_image( $img_id, $item['item_content_image']['size'], false, '' ); ?>
										</div>
										<?php
								}
							} else {
								$img_id = $item['item_content_image']['id'];
								if ( ! empty( $img_id ) ) {
									?>
										<div class='bultr-tl-item-image'>
										<?php echo wp_get_attachment_image( $img_id, $item['item_content_image']['size'], false, '' ); ?>
										</div>
										<?php
								}
							}
							?>
						<?php } ?>    
						<div class="bultr-tl-content">
							<div class="bultr-content-inner">
								<div class="bultr-tl-item-meta-wrapper-inner">
									<?php if ( isset( $item['item_date'] ) ) { ?>
										<div class="bultr-tl-item-meta-inner">
											<?php echo $this->render_dynamic_data( $item['item_date'] ); ?>
										</div>
									<?php } ?>
								</div>
								<?php
									printf( '<%1$s class="bultr-tl-item-title">%2$s</%1$s>', $item['item_title_size'], $this->render_dynamic_data( $item['item_title_text'] ) );
								?>
								<?php if ( isset( $item['item_content'] ) ) { ?>
								<div class="bultr-tl-content-innner"><?php echo $this->render_dynamic_data( $item['item_content'] ); ?> </div>
								<?php } ?>
							</div>
						</div>
					</div>
			<?php
			if ( isset( $item['item_link'] ) ) {
				?>
			</a> <?php } ?>
			</div>
		</div>
		<?php
		$this->loop_index++;
	}

	public function render_icon_html( $item, $settings, $global_settings, $index ) {
		//echo '<pre>';  print_r($item); echo '</pre>';
		//die('fdafdaf');
		$view      = 'bultr-icon-view-' . $global_settings['global_icon_view'];
		$shape     = 'bultr-icon-shape-' . $global_settings['global_icon_shape'];
		$icon_type = 'bultr-icon-type-' . $global_settings['global_icon_type'];

		if ( isset( $item['icon_type'] ) && isset( $item['item_custom_icon'] ) ) {
			if ( $item['view'] !== 'global' ) {
				$view = 'bultr-icon-view-' . $item['view'];
			}
			if ( $item['shape'] !== 'global' ) {
				$shape = 'bultr-icon-shape-' . $item['shape'];
			}
			$icon_t    = $item['icon_type'];
			$icon_type = 'bultr-icon-type-' . $item['icon_type'];
			switch ( $item['icon_type'] ) {
				case 'icon':
					$icon = $item['icon'];
					break;
				case 'image':
					$img        = $item['image']['id'];
					$image_size = isset( $item['image']['size'] ) ? $item['image']['size'] : 'medium';
					break;
				case 'text':
					$text = $item['text'];
					break;
				case 'svg':
					$svg = isset( $item['svg']['id'] ) ? $item['svg']['id'] : '';
					break;
			}
		} else {
			$icon_t = $settings['global_icon_type'];
			switch ( $settings['global_icon_type'] ) {
				case 'icon':
					$icon = $settings['global_icon_icon'];
					break;
				case 'image':
					$img                    = $settings['global_icon_image']['id'];
								$image_size = $settings['global_icon_image']['size'];
					break;
				case 'text':
					$text = $settings['global_icon_text'];
					break;
				case 'svg':
					$svg = isset( $settings['global_icon_svg']['id'] ) ? $settings['global_icon_svg']['id'] : '';
					break;
			}
		}

		$this->set_attribute( "item-{$index}" . '-icon', 'class', [ 'bultr-icon', 'bultr-icon-item_icon', $view, $shape, $icon_type ] );
		if ( isset( $item['id'] ) ) {
			$this->set_attribute( "item-{$index}" . '-icon', 'data-id', $item['id'] );
		}
		?>
		<div <?php echo $this->render_attributes( "item-{$index}" . '-icon' ); ?>>
			<div class="bultr-icon-wrap">
				<?php
				switch ( $icon_t ) {
					case 'icon':
							$icon = ! empty( $icon ) ? self::render_icon( $icon ) : false;
										echo $icon;
						break;
					case 'image':
										echo "<i class=''>" . wp_get_attachment_image( $img, $image_size ) . '</i>';
						break;
					case 'text':
							echo "<i class=''>$text</i>";
						break;
					case 'svg':
							$file_path = ! empty( $svg) ? get_attached_file( $svg) : false;
							$svg = Helpers::file_get_contents( $file_path);
							echo '<i>' . self::render_svg( $svg, [] ) . '</i>';
						break;
				}
				?>
			</div>
		</div>
		<?php
	}

	public function global_icon_controls() {
		$this->controls['global_icon_type'] = [
			'label'     => esc_html__( 'Icon Type', 'wpv-bu' ),
			'tab'       => 'content',
			'group'     => 'section_global_icon',
			'type'      => 'select',
			'options'   => [
				'icon'  => 'Icon',
				'image' => 'Image',
				'text'  => 'Text',
				'svg'   => 'SVG',
			],
			'inline'    => true,
			'default'   => 'icon',
			'clearable' => false,
		];

		$this->controls['global_icon_icon'] = [
			'label'    => esc_html__( 'Icon', 'wpv-bu' ),
			'tab'      => 'content',
			'group'    => 'section_global_icon',
			'type'     => 'icon',
			'default'  => [
				'library' => 'themify', // fontawesome/ionicons/themify
				'icon'    => 'ti-star',    // Example: Themify icon class
			],
			'required' => [
				'global_icon_type',
				'=',
				'icon',
			],
		];

		$this->controls['global_icon_svg'] = [
			'tab'      => 'content',
			'group'    => 'section_global_icon',
			'tab'      => 'content',
			'type'     => 'svg',
			'required' => [
				'global_icon_type',
				'=',
				'svg',
			],
		];

		$this->controls['global_icon_image'] = [
			'label'    => esc_html__( 'Image', 'wpv-bu' ),
			'tab'      => 'content',
			'group'    => 'section_global_icon',
			'type'     => 'image',
			'required' => [
				'global_icon_type',
				'=',
				'image',
			],
		];

		$this->controls['global_icon_text'] = [
			'label'         => esc_html__( 'Text', 'wpv-bu' ),
			'tab'           => 'content',
			'group'         => 'section_global_icon',
			'type'          => 'text',
			'spellcheck'    => true,
			'inlineEditing' => true,
			'inline'        => true,
			'required'      => [
				'global_icon_type',
				'=',
				'text',
			],
		];

		$this->controls['global_icon_view'] = [
			'label'     => esc_html__( 'View', 'wpv-bu' ),
			'tab'       => 'content',
			'group'     => 'section_global_icon',
			'type'      => 'select',
			'options'   => [
				'default' => 'Default',
				'stacked' => 'Stacked',
				'framed'  => 'Framed',
			],
			'default'   => 'stacked',
			'inline'    => true,
			'clearable' => false,
		];

		$this->controls['global_icon_shape'] = [
			'label'     => esc_html__( 'Shape', 'wpv-bu' ),
			'tab'       => 'content',
			'group'     => 'section_global_icon',
			'type'      => 'select',
			'options'   => [
				'circle' => 'Circle',
				'square' => 'Square',
			],
			'default'   => 'circle',
			'required'  => [
				'global_icon_view',
				'!=',
				'default',
			],
			'inline'    => true,
			'clearable' => false,
		];
	}

	public function layout_controls() {

		$this->controls['timeline_align'] = [ // Setting key
			'tab'       => 'content',
			'group'     => 'section_layout',
			'label'     => esc_html__( 'Alignment', 'wpv-bu' ),
			'type'      => 'text-align',
			'default'   => 'center',
			'exclude'   => [ 'justify' ],
			'inline'    => true,
			'clearable' => false,
		];

		$this->controls['start_pos'] = [ // Setting key
			'tab'       => 'content',
			'group'     => 'section_layout',
			'label'     => esc_html__( 'Start Position', 'wpv-bu' ),
			'type'      => 'select',
			'default'   => 'left',
			'options'   => [
				'left'  => 'Left',
				'right' => 'Right',
			],
			'inline'    => true,
			'required'  => [
				'timeline_align',
				'=',
				'center',
			],
			'clearable' => false,
		];

		$this->controls['tl_responsive_style'] = [
			'label'     => __( 'Responsive Style', 'wpv-bu' ),
			'tab'       => 'content',
			'group'     => 'section_layout',
			'type'      => 'select',
			'options'   => [
				'mobile'        => 'For Mobile',
				'mobile-tablet' => 'For Mobile & Tablet',
			],
			'inline'    => true,
			'default'   => 'mobile',
			'required'  => [
				'timeline_align',
				'=',
				'center',
			],
			'clearable' => false,
		];

		$this->controls['tl_responsive_layout'] = [
			'label'     => __( 'Responsive Orientation', 'wpv-bu' ),
			'tab'       => 'content',
			'group'     => 'section_layout',
			'type'      => 'select',
			'options'   => [
				'left'  => 'Left',
				'right' => 'Right',
			],
			'inline'    => true,
			'default'   => 'left',
			'required'  => [
				'timeline_align',
				'=',
				'center',
			],
			'clearable' => false,
		];

		$this->controls['horizontal_spacing'] = [
			'tab'     => 'content',
			'group'   => 'section_layout',
			'label'   => esc_html__( 'Horizontal Spacing', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'default' => '10',
			'css'     => [
				[
					'property' => 'margin-left',
					'selector' => '.bultr-layout-right .bultr-tl-icon-wrapper',
				],
				[
					'property' => 'margin-right',
					'selector' => '.bultr-layout-left .bultr-tl-icon-wrapper',
				],
				[
					'property' => 'margin-left',
					'selector' => '.bultr-layout-center .bultr-tl-icon-wrapper',
				],
				[
					'property' => 'margin-right',
					'selector' => '.bultr-layout-center .bultr-tl-icon-wrapper',
				],
			],
		];

		$this->controls['vertical_spacing'] = [
			'tab'     => 'content',
			'group'   => 'section_layout',
			'label'   => esc_html__( 'Vertical Spacing', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'default' => '50',
			'css'     => [
				[
					'selector' => '.bultr-timeline-item',
					'property' => 'padding-bottom',
				],
			],
		];
	}

	public function card_style_controls() {

		$this->card_default_controls();
		$this->card_hover_controls();
		$this->card_focused_controls();
		$this->date_style_controls();
	}

	public function card_default_controls() {
		$this->controls['title_typography'] = [
			'tab'    => 'content',
			'group'  => 'card_styling',
			'label'  => esc_html__( 'Title Typography', 'wpv-bu' ),
			'type'   => 'typography',
			'css'    => [
				[
					'property' => 'typography',
					'selector' => '.bultr-tl-item-title',
				],
			],
			'inline' => true,
		];

		$this->controls['content_typography'] = [
			'tab'    => 'content',
			'group'  => 'card_styling',
			'label'  => esc_html__( 'Content Typography', 'wpv-bu' ),
			'type'   => 'typography',
			'css'    => [
				[
					'property' => 'typography',
					'selector' => '.bultr-tl-content',
				],
			],
			'inline' => true,
		];

		$this->controls['content_padding_inner_text'] = [
			'tab'    => 'content',
			'group'  => 'card_styling',
			'label'  => esc_html__( 'Content Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'default' => [
				'top' => '10',
				'right' => '10',
				'bottom' => '10',
				'left' => '10',
			],
			'css'    => [
				[
					'property' => 'padding',
					'selector' => '.bultr-tl-content-innner',
				],
			],
		];

		$this->controls['image_align_heading'] = [
			'tab'   => 'content',
			'group' => 'card_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Image', 'wpv-bu' ),
		];

		$this->controls['image_align_post'] = [ // Setting key
			'tab'     => 'content',
			'group'   => 'card_styling',
			'label'   => esc_html__( 'Direction', 'wpv-bu' ),
			'type'    => 'direction',
			'inline'  =>'true',
			'css'     => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-tl-item-content',
				],
			],
			'default' => 'column',
		];

		$this->controls['image_alignment'] = [ // Setting key
			'tab'     => 'content',
			'group'   => 'card_styling',
			'label'   => esc_html__( 'Alignment', 'wpv-bu' ),
			'type' => 'text-align',
			'css'     => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-tl-item-image',
				],
			],
			'default' => 'center',
			'exclude' => 'justify',
			'inline'  =>'true',
		];


		$this->controls['tl_alternate_style'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Alternate Style', 'wpv-bu' ),
			'type'     => 'checkbox',
			'reset'    => true,
			'required' => [
				'image_align_post',
				'!=',
				['column', 'column-reverse', 'row-reverse'],
			],
		];

		$this->controls['image_width_post'] = [
			'tab'     => 'content',
			'group'   => 'card_styling',
			'label'   => esc_html__( 'Image Size', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => '%',
			'css'     => [
				[
					'property' => 'width',
					'selector' => '.bultr-tl-item-image',
				],
			],
			'min'     => 1,
			'max'     => 100,
			'step'    => 1,
			'default' => '100',
		];

		$this->controls['image_spacing_post'] = [
			'tab'     => 'content',
			'group'   => 'card_styling',
			'label'   => esc_html__( 'Spacing', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'default' => 5,
			'css'     => [
				[
					'property' => 'margin-bottom',
					'selector' => '.image-position-column .bultr-tl-item-image',
				],
				[
					'property' => 'margin-top',
					'selector' => '.image-position-column-reverse .bultr-tl-item-image',
				],
				[
					'property' => 'margin-right',
					'selector' => '.image-position-row:not(.bultr-timeline-alternate-yes) .bultr-tl-item-image',
				],
				[
					'property' => 'margin-left',
					'selector' => '.image-position-row-reverse:not(.bultr-timeline-alternate-yes) .bultr-tl-item-image',
				],
				[
					'property' => 'margin-right',
					'selector' => '.image-position-row.bultr-timeline-alternate-yes .bultr-timeline-item:nth-child(even) .bultr-tl-item-image',
				],
				[
					'property' => 'margin-left',
					'selector' => '.image-position-row.bultr-timeline-alternate-yes .bultr-timeline-item:nth-child(odd) .bultr-tl-item-image',
				],
			],
		];

		$this->controls['image_border_post'] = [
			'tab'    => 'content',
			'group'  => 'card_styling',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-tl-item-image img',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['card_style'] = [
			'tab'   => 'content',
			'group' => 'card_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Box', 'wpv-bu' ),
		];

		// TODO : Complete Responsive CSS on Resize Evente
		$this->controls['background_color'] = [
			'tab'   => 'content',
			'group' => 'card_styling',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-tl-item-content',
				],
				[
					'property' => 'border-right-color',
					'selector' => '.bultr-layout-center .bultr-timeline-item:nth-child(even) .bultr-tl-item-content::before',
				],
				[
					'property' => 'border-right-color',
					'selector' => '.bultr-layout-center.bultr-tl-start-pos-right .bultr-timeline-item:nth-child(odd) .bultr-tl-item-content::before',
				],
				[
					'property' => 'border-left-color',
					'selector' => '.bultr-layout-center .bultr-timeline-item:nth-child(odd) .bultr-tl-item-content::before',
				],
				[

					'property' => 'border-left-color',
					'selector' => '.bultr-layout-center.bultr-tl-start-pos-right .bultr-timeline-item:nth-child(even) .bultr-tl-item-content::before',
				],
				[
					'property' => 'border-left-color',
					'selector' => '.bultr-layout-right .bultr-tl-item-content::before',
				],
				[
					'property' => 'border-right-color',
					'selector' => '.bultr-layout-left .bultr-tl-item-content::before',
				],

				// Only For Mobile
				[
					'property'  => 'border-right-color',
					'selector'  => '.mobile.bultr-layout-center.bultr-tl-res-layout-left .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.mobile.bultr-layout-center.bultr-tl-res-layout-right .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.tablet.bultr-layout-center.bultr-tl-res-layout-left .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.tablet.bultr-layout-center.bultr-tl-res-layout-right .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				// For Tablet
				[
					'property'  => 'border-right-color',
					'selector'  => '.tablet.bultr-layout-center.bultr-tl-res-layout-left.bultr-tl-res-style-mobile-tablet .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.tablet.bultr-layout-center.bultr-tl-res-layout-right.bultr-tl-res-style-mobile-tablet .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.mobile.bultr-layout-center.bultr-tl-res-layout-left.bultr-tl-res-style-mobile-tablet .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.mobile.bultr-layout-center.bultr-tl-res-layout-right.bultr-tl-res-style-mobile-tablet .bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
			],
		];

		$this->controls['item_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'card_styling',
			'label'  => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'   => 'box-shadow',
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-tl-item-content',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['item_border'] = [
			'tab'    => 'content',
			'group'  => 'card_styling',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-tl-item-content',
				],
			],

			'inline' => true,
			'small'  => true,
		];
		$this->controls['content_align']   = [ // Setting key
			'tab'     => 'content',
			'group'   => 'card_styling',
			'label'   => esc_html__( 'Alignment', 'wpv-bu' ),
			'type'    => 'text-align',
			'css'     => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-tl-item-content',
				],
			],
			'inline'  => true,
			'default' => 'center',
			'exclude' => 'justify',
		];
		$this->controls['arrow_align']     = [
			'tab'          => 'content',
			'group'        => 'card_styling',
			'label'        => esc_html__( 'Arrow Position', 'wpv-bu' ),
			'type'         => 'justify-content',
			'isHorizontal' => false,
			'exclude'      => 'space',
			'default'      => 'center',
			'inline'       => true,
		];
		$this->controls['arrow_offset']    = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Arrow Position', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'default'  => '10',
			'required' => [
				[ 'arrow_align', '!=', 'center' ],
			],
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.bultr-tl-bottom .bultr-tl-item-content::before',
				],
				[
					'property' => 'top',
					'selector' => '.bultr-tl-top .bultr-tl-item-content::before',
				],
			],
			'inline'   => true,
		];
		$this->controls['content_padding'] = [
			'tab'   => 'content',
			'group' => 'card_styling',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-tl-item-content',
				],
			],
		];
	}

	public function card_hover_controls() {
		$this->controls['hvr'] = [
			'tab'   => 'content',
			'group' => 'card_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Hover', 'wpv-bu' ),
		];

		$this->controls['enable_hvr_style'] = [
			'label'  => esc_html__( 'Enable Style', 'wpv-bu' ),
			'type'   => 'checkbox',
			'tab'    => 'content',
			'group'  => 'card_styling',
			'inline' => true,
			'small'  => true,
		];

		$this->controls['title_hvr_color']  = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Title Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-item-title',
				],
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
		];
		$this->controls['title_hvr_shadow'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Text Shadow', 'wpv-bu' ),
			'type'     => 'text-shadow',
			'css'      => [
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-item-title',
				],
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
			'inline'   => true,
		];

		$this->controls['content_hvr_color'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Content Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-content',
				],
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
		];

		$this->controls['content_hvr_shadow'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Content Shadow', 'wpv-bu' ),
			'type'     => 'text-shadow',
			'css'      => [
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-content',
				],
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
			'inline'   => true,
		];

		// TODO : Complete THis after research
		$this->controls['background_hvr_color'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property'  => 'background-color',
					'selector'  => '.bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-item-content',
					'important' => true,
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-layout-center .bultr-item-hvr-style.bultr-timeline-item:nth-child(even) .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-layout-center.bultr-tl-start-pos-right .bultr-item-hvr-style.bultr-timeline-item:nth-child(odd) .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-layout-center .bultr-item-hvr-style.bultr-timeline-item:nth-child(odd) .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-layout-center.bultr-tl-start-pos-right .bultr-item-hvr-style.bultr-timeline-item:nth-child(even) .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property' => 'border-left-color',
					'selector' => '.bultr-layout-right .bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
				],
				[
					'property' => 'border-right-color',
					'selector' => '.bultr-layout-left .bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
				],

				// Only For Mobile
				[
					'property'  => 'border-right-color',
					'selector'  => '.mobile.bultr-layout-center.bultr-tl-res-layout-left .bultr-item-hvr-style.bultr-timeline-item .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.mobile.bultr-layout-center.bultr-tl-res-layout-right .bultr-item-hvr-style.bultr-timeline-item .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				// For Tablet
				[
					'property'  => 'border-right-color',
					'selector'  => '.tablet.bultr-layout-center.bultr-tl-res-layout-left.bultr-tl-res-style-mobile-tablet .bultr-item-hvr-style.bultr-timeline-item .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.tablet.bultr-layout-center.bultr-tl-res-layout-right.bultr-tl-res-style-mobile-tablet .bultr-item-hvr-style.bultr-timeline-item .bultr-tl-content-wrapper:hover .bultr-tl-item-content::before',
					'important' => true,
				],
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
		];

		$this->controls['item_hvr_box_shadow'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
			'css'      => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-item-hvr-style .bultr-tl-content-wrapper:hover .bultr-tl-item-content',
				],
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
			'inline'   => true,
			'small'    => true,
		];

		$this->controls['item_hvr_border'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-item-hvr-style .bultr-tl-item-content:hover',
				],
			],
			'exclude'  => [
				'width',
				'style',
			],
			'required' => [
				[ 'enable_hvr_style', '=', true ],
			],
			'inline'   => true,
			'small'    => true,
		];
	}

	public function card_focused_controls() {
		$this->controls['focused']          = [
			'tab'   => 'content',
			'group' => 'card_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Focused', 'wpv-bu' ),
		];
		$this->controls['enable_fcs_style'] = [
			'label'  => esc_html__( 'Enable Style', 'wpv-bu' ),
			'type'   => 'checkbox',
			'tab'    => 'content',
			'group'  => 'card_styling',
			'inline' => true,
			'small'  => true,
		];

		$this->controls['title_fcs_color'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Title Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-item-title',
				],
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
		];

		$this->controls['title_fcs_shadow'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Text Shadow', 'wpv-bu' ),
			'type'     => 'text-shadow',
			'css'      => [
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-item-title',
				],
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
			'inline'   => true,
		];

		$this->controls['content_fcs_color'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Content Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-content',
				],
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
		];

		$this->controls['content_fcs_shadow'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Content Shadow', 'wpv-bu' ),
			'type'     => 'text-shadow',
			'css'      => [
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-content',
				],
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
			'inline'   => true,
		];
		// TODO : Complete THis after research
		$this->controls['background_fcs_color'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-item-content',
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-fcs-style.bultr-timeline.bultr-layout-center .bultr-tl-item-focused.bultr-timeline-item:nth-child(even) .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-fcs-style.bultr-layout-center.bultr-tl-start-pos-right .bultr-tl-item-focused.bultr-timeline-item:nth-child(odd) .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-fcs-style.bultr-timeline.bultr-layout-center .bultr-tl-item-focused.bultr-timeline-item:nth-child(odd) .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-fcs-style.bultr-layout-center.bultr-tl-start-pos-right .bultr-tl-item-focused.bultr-timeline-item:nth-child(even) .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-fcs-style.bultr-layout-right .bultr-tl-item-focused .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-fcs-style.bultr-layout-left .bultr-tl-item-focused .bultr-tl-item-content::before',
					'important' => true,
				],

				// Only For Mobile
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-fcs-style.bultr-timeline.mobile.bultr-layout-center.bultr-tl-res-layout-left .bultr-tl-item-focused.bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-fcs-style.bultr-timeline.mobile.bultr-layout-center.bultr-tl-res-layout-right .bultr-tl-item-focused.bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				// For Tablet
				[
					'property'  => 'border-right-color',
					'selector'  => '.bultr-fcs-style.tablet.bultr-layout-center.bultr-tl-res-layout-left.bultr-tl-res-style-mobile-tablet .bultr-tl-item-focused.bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
				[
					'property'  => 'border-left-color',
					'selector'  => '.bultr-fcs-style.tablet.bultr-layout-center.bultr-tl-res-layout-right.bultr-tl-res-style-mobile-tablet .bultr-tl-item-focused.bultr-timeline-item .bultr-tl-item-content::before',
					'important' => true,
				],
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
		];
		$this->controls['item_fcs_box_shadow'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
			'css'      => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-item-content',
				],
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
			'inline'   => true,
			'small'    => true,
		];

		$this->controls['item_fcs_border'] = [
			'tab'      => 'content',
			'group'    => 'card_styling',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-fcs-style .bultr-tl-item-focused .bultr-tl-item-content',
				],
			],
			'exclude'  => [
				'width',
				'style',
			],
			'required' => [
				[ 'enable_fcs_style', '=', true ],
			],
			'inline'   => true,
			'small'    => true,
		];
	}

	public function date_style_controls() {

		$this->controls['date_typography'] = [
			'tab'     => 'content',
			'group'   => 'date_styling',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-tl-item-meta',
				],
				[
					'property' => 'typography',
					'selector' => '.bultr-tl-item-meta-inner',
				],
			],
			'exclude' => [
				'text-align',
			],
			'inline'  => true,
		];

		
		$this->controls['date_padding'] = [
			'tab'   => 'content',
			'group' => 'date_styling',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-tl-item-meta',
				],
				[
					'property' => 'padding',
					'selector' => '.bultr-tl-item-meta-inner',
				],
			],
		];

		$this->controls['date_margin'] = [
			'tab'   => 'content',
			'group' => 'date_styling',
			'label' => esc_html__( 'Margin', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'margin',
					'selector' => '.bultr-tl-item-meta',
				],
				[
					'property' => 'margin',
					'selector' => '.bultr-tl-item-meta-inner',
				],
			],
		];

		$this->controls['date_hvr']       = [
			'tab'   => 'content',
			'group' => 'date_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Hover', 'wpv-bu' ),
		];
		$this->controls['date_hvr_color'] = [
			'tab'   => 'content',
			'group' => 'date_styling',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-timeline-item:hover .bultr-tl-item-meta',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-timeline-item:hover .bultr-tl-item-meta-inner',
				],
			],
		];

		$this->controls['date_hvr_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'date_styling',
			'label'  => esc_html__( 'Text Shadow', 'wpv-bu' ),
			'type'   => 'text-shadow',
			'css'    => [
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-timeline-item:hover .bultr-tl-item-meta',
				],
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-timeline-item:hover .bultr-tl-item-meta-inner',
				],
			],
			'inline' => true,
		];

		$this->controls['date_fcs']            = [
			'tab'   => 'content',
			'group' => 'date_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Focused', 'wpv-bu' ),
		];
		$this->controls['date_fsc_color']      = [
			'tab'   => 'content',
			'group' => 'date_styling',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-tl-item-focused .bultr-tl-item-meta',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-tl-item-focused  .bultr-tl-item-meta-inner',
				],
			],
		];
		$this->controls['date_fcs_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'date_styling',
			'label'  => esc_html__( 'Text Shadow', 'wpv-bu' ),
			'type'   => 'text-shadow',
			'css'    => [
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-tl-item-focused .bultr-tl-item-meta',
				],
				[
					'property' => 'text-shadow',
					'selector' => '.bultr-tl-item-focused  .bultr-tl-item-meta-inner',
				],
			],
			'inline' => true,
			'small'  => true,
		];
	}

	public function icon_style_controls() {

		$this->controls['icon_primary_color'] = [
			'tab'   => 'content',
			'group' => 'icon_styling',
			'label' => esc_html__( 'Primary Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-stacked',
				],
				[
					'property' => 'border-color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-framed',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-framed i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-default i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-icon-item_icon.bultr-icon-type-svg i svg',
				],
			],
		];

		$this->controls['icon_secondary_color'] = [
			'tab'      => 'content',
			'group'    => 'icon_styling',
			'label'    => esc_html__( 'Secondary Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-icon-view-framed',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-icon-view-stacked i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-icon-view-stacked.bultr-icon-type-svg i svg',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-icon-view-stacked svg',
				],
			],

			'required' => [
				'global_icon_view',
				'!=',
				'default',
			],
		];

		$this->controls['icon_size'] = [
			'tab'     => 'content',
			'group'   => 'icon_styling',
			'label'   => esc_html__( 'Size', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-icon.bultr-icon-item_icon .bultr-icon-wrap',
					'property' => 'font-size',
				],
				[
					'selector' => '.bultr-icon.bultr-icon-item_icon .bultr-icon-wrap svg',
					'property' => 'font-size',
				],
			],
			'default' => '25',
		];

		$this->controls['icon_padding'] = [
			'tab'      => 'content',
			'group'    => 'icon_styling',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'inline'   => true,
			'css'      => [
				[
					'selector' => '.bultr-icon.bultr-icon-item_icon',
					'property' => 'padding',
				],
			],
			'default'  => '15',
			'required' => [
				'global_icon_view',
				'!=',
				'default',
			],
		];

		$this->controls['icon_rotate'] = [
			'tab'    => 'content',
			'group'  => 'icon_styling',
			'label'  => esc_html__( 'Rotate', 'wpv-bu' ),
			'type'   => 'number',
			'css'    => [
				[
					'selector' => '.bultr-icon-item_icon.bultr-icon i',
					'property' => 'transform:rotate',
				],
				[
					'selector' => '.bultr-icon-item_icon.bultr-icon svg',
					'property' => 'transform:rotate',
				],

			],
			'unit'   => 'deg',
			'min'    => 0,
			'max'    => 360,
			'step'   => 1,
			'inline' => true,
		];

		$this->controls['icon_border'] = [
			'tab'      => 'content',
			'group'    => 'icon_styling',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-icon.bultr-icon-item_icon',
				],
			],
			'exclude'  => [
				'color',
			],
			'inline'   => true,
			'small'    => true,
			'required' => [
				'global_icon_view',
				'!=',
				'default',
			],
		];

		// Hover
		$this->controls['icon_hover'] = [
			'tab'   => 'content',
			'group' => 'icon_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Hover', 'wpv-bu' ),
		];

		$this->controls['icon_primary_hvr_color'] = [
			'tab'   => 'content',
			'group' => 'icon_styling',
			'label' => esc_html__( 'Primary Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-stacked:hover',
				],
				[
					'property' => 'border-color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-framed:hover',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-framed:hover i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-default:hover i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-framed:hover svg',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-icon-item_icon.bultr-icon-view-default:hover svg',
				],
			],
		];

		$this->controls['icon_secondary_hvr_color'] = [
			'tab'      => 'content',
			'group'    => 'icon_styling',
			'label'    => esc_html__( 'Secondary Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-icon-view-framed:hover',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-icon-view-stacked:hover i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-icon-view-stacked:hover svg',
				],
			],
			'required' => [
				'global_icon_view',
				'!=',
				'default',
			],
		];
		
		$this->controls['icon_hvr_rotate']          = [
			'tab'    => 'content',
			'group'  => 'icon_styling',
			'label'  => esc_html__( 'Rotate', 'wpv-bu' ),
			'type'   => 'number',
			'css'    => [
				[
					'selector' => '',    
					'property' => '--icon_hvr_rotate',
					'value' => '%sdeg',
					],

			],
			'unitless'   => true,
			'min'    => 0,
			'max'    => 360,
			'step'   => 1,
			'inline' => true,
		];

		// Focused
		$this->controls['icon_focused'] = [
			'tab'   => 'content',
			'group' => 'icon_styling',
			'type'  => 'separator',
			'label' => esc_html__( 'Focused', 'wpv-bu' ),
		];

		$this->controls['icon_primary_fcs_color']   = [
			'tab'   => 'content',
			'group' => 'icon_styling',
			'label' => esc_html__( 'Primary Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-tl-item-focused .bultr-icon-item_icon.bultr-icon-view-stacked',
				],
				[
					'property' => 'border-color',
					'selector' => '.bultr-tl-item-focused .bultr-icon-item_icon.bultr-icon-view-framed',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-tl-item-focused .bultr-icon-item_icon.bultr-icon-view-framed i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-tl-item-focused .bultr-icon-item_icon.bultr-icon-view-default i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-tl-item-focused .bultr-icon-item_icon.bultr-icon-view-framed.bultr-icon-type-svg i svg',
				],
			],
		];
		$this->controls['icon_secondary_fcs_color'] = [
			'tab'      => 'content',
			'group'    => 'icon_styling',
			'label'    => esc_html__( 'Secondary Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-tl-item-focused .bultr-icon-view-framed',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-tl-item-focused .bultr-icon-view-stacked i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-tl-item-focused .bultr-icon-view-stacked svg',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-tl-item-focused .bultr-icon-view-stacked.bultr-icon-type-svg i svg',
				],
			],
			'required' => [
				'global_icon_view',
				'!=',
				'default',
			],
		];

		$this->controls['icon_fcs_rotate'] = [
			'tab'    => 'content',
			'group'  => 'icon_styling',
			'label'  => esc_html__( 'Rotate', 'wpv-bu' ),
			'type'   => 'number',
			'css'    => [
				[
					'selector' => '',    
					'property' => '--icon_fcs_rotate',
					'value' => '%sdeg',
					],


			],
			'unitless'   => true,
			'min'    => 0,
			'max'    => 360,
			'step'   => 1,
			'inline' => true,
		];
	}



}
