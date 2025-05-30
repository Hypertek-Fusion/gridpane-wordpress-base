<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Carousel extends Custom_Render_Element {
	public $category     = 'media';
	public $name         = 'carousel';
	public $icon         = 'ti-layout-slider-alt';
	public $css_selector = '.swiper-slide';
	public $scripts      = [ 'bricksSwiper' ];
	public $draggable    = false;

	public function get_label() {
		return esc_html__( 'Carousel', 'bricks' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'bricks-swiper' );
		wp_enqueue_style( 'bricks-swiper' );

		if ( isset( $this->settings['imageLightbox'] ) ) {
			wp_enqueue_script( 'bricks-photoswipe' );
			wp_enqueue_script( 'bricks-photoswipe-lightbox' );
			wp_enqueue_style( 'bricks-photoswipe' );

			// Lightbox caption (@since 1.10)
			if ( isset( $this->settings['lightboxCaption'] ) ) {
				wp_enqueue_script( 'bricks-photoswipe-caption' );
			}
		}
	}

	public function set_control_groups() {
		$this->control_groups['settings'] = [
			'title' => esc_html__( 'Settings', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['image'] = [
			'title' => esc_html__( 'Image', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['fields'] = [
			'title'    => esc_html__( 'Fields', 'bricks' ),
			'tab'      => 'content',
			'required' => [ 'type', '=', 'posts' ],
		];

		$this->control_groups['content'] = [
			'title'    => esc_html__( 'Content', 'bricks' ),
			'tab'      => 'content',
			'required' => [ 'type', '=', 'posts' ],
		];

		$this->control_groups['overlay'] = [
			'title'    => esc_html__( 'Overlay', 'bricks' ),
			'tab'      => 'content',
			'required' => [ 'type', '=', 'posts' ],
		];

		$this->control_groups['arrows'] = [
			'title' => esc_html__( 'Arrows', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['dots'] = [
			'title' => esc_html__( 'Dots', 'bricks' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		$this->controls['type'] = [
			'tab'         => 'content',
			'type'        => 'select',
			'label'       => esc_html__( 'Type', 'bricks' ),
			'options'     => [
				'media' => esc_html__( 'Media', 'bricks' ),
				'posts' => esc_html__( 'Posts', 'bricks' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Media', 'bricks' ),
		];

		$this->controls['items'] = [
			'tab'      => 'content',
			'type'     => 'image-gallery',
			'rerender' => true,
			'label'    => esc_html__( 'Images', 'bricks' ),
			'exclude'  => [
				'size',
			],
			'required' => [ 'type', '!=', 'posts' ],
		];

		$this->controls['query'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Query', 'bricks' ),
			'type'     => 'query',
			'popup'    => true,
			'inline'   => true,
			'required' => [ 'type', '=', 'posts' ],
			'exclude'  => [
				'objectType',
				'infinite_scroll_separator',
				'infinite_scroll',
				'infinite_scroll_margin',
				'infinite_scroll_delay', // @since 1.12
			],
		];

		// SETTINGS

		$carousel_controls = self::get_swiper_controls();

		$this->controls['adaptiveHeight']               = $carousel_controls['adaptiveHeight'];
		$this->controls['height']                       = $carousel_controls['height'];
		$this->controls['height']['placeholder']        = '300';
		$this->controls['height']['css'][0]['selector'] = '.image';
		$this->controls['height']['css'][1]             = [
			'property' => 'height',
			'selector' => '.overlay-wrapper',
		];
		$this->controls['height']['required']           = [ 'adaptiveHeight', '=', '' ];

		$this->controls['gutter']                        = $carousel_controls['gutter'];
		$this->controls['initialSlide']                  = $carousel_controls['initialSlide'];
		$this->controls['slidesToShow']                  = $carousel_controls['slidesToShow'];
		$this->controls['slidesToShow']['placeholder']   = 2;
		$this->controls['slidesToScroll']                = $carousel_controls['slidesToScroll'];
		$this->controls['slidesToScroll']['placeholder'] = 1;
		$this->controls['effect']                        = $carousel_controls['effect'];
		$this->controls['alignItems']                    = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Align items', 'bricks' ),
			'type'     => 'align-items',
			'exclude'  => 'stretch',
			'css'      => [
				[
					'property' => 'align-items',
					'selector' => '.swiper-wrapper',
				],
			],
			'inline'   => true,
			'required' => [ 'adaptiveHeight', '!=', '' ],
		];
		$this->controls['infinite']                      = $carousel_controls['infinite'];
		$this->controls['centerMode']                    = $carousel_controls['centerMode'];
		$this->controls['disableLazyLoad']               = $carousel_controls['disableLazyLoad'];
		$this->controls['autoplay']                      = $carousel_controls['autoplay'];
		$this->controls['pauseOnHover']                  = $carousel_controls['pauseOnHover'];
		$this->controls['stopOnLastSlide']               = $carousel_controls['stopOnLastSlide'];
		$this->controls['autoplaySpeed']                 = $carousel_controls['autoplaySpeed'];
		$this->controls['speed']                         = $carousel_controls['speed'];

		// IMAGE

		$this->controls['imageDisable'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Hide image', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'type', '=', 'posts' ],
		];

		$this->controls['imageSize'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Image size', 'bricks' ),
			'type'     => 'select',
			'options'  => $this->control_options['imageSizes'],
			'required' => [ 'imageDisable', '=', '' ],
		];

		// LIGHTBOX

		$this->controls['lightboxSep'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Lightbox', 'bricks' ),
			'type'     => 'separator',
			'required' => [ 'imageLightbox', '=', true ],
		];

		$this->controls['imageLightbox'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Link to lightbox', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'type', '!=', 'posts' ],
		];

		$this->controls['imageLightboxSize'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Image size', 'bricks' ),
			'type'     => 'select',
			'options'  => $this->control_options['imageSizes'],
			'required' => [ 'imageLightbox', '=', true ],
		];

		// https://photoswipe.com/click-and-tap-actions/#supported-action-values
		$this->controls['lightboxImageClick'] = [
			'tab'         => 'content',
			'group'       => 'image',
			'label'       => esc_html__( 'Image click action', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'zoom'            => esc_html__( 'Zoom', 'bricks' ),
				'zoom-or-close'   => esc_html__( 'Zoom or close', 'bricks' ),
				'toogle-controls' => esc_html__( 'Toggle controls', 'bricks' ),
				'next'            => esc_html__( 'Next', 'bricks' ),
				'close'           => esc_html__( 'Close', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Zoom', 'bricks' ),
			'required'    => [ 'imageLightbox', '=', true ],
		];

		$this->controls['lightboxAnimationType'] = [
			'tab'         => 'content',
			'group'       => 'image',
			'label'       => esc_html__( 'Animation', 'bricks' ),
			'type'        => 'select',
			'options'     => $this->control_options['lightboxAnimationTypes'],
			'placeholder' => esc_html__( 'Zoom', 'bricks' ),
			'required'    => [ 'imageLightbox', '=', true ],
		];

		$this->controls['lightboxCaption'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Caption', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'imageLightbox', '=', true ],
		];

		$this->controls['lightboxThumbnails'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Thumbnail navigation', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'imageLightbox', '=', true ]
		];

		$this->controls['lightboxThumbnailSize'] = [
			'tab'         => 'content',
			'group'       => 'image',
			'label'       => esc_html__( 'Thumbnail size', 'bricks' ),
			'type'        => 'number',
			'units'       => true,
			'placeholder' => 60,
			'required'    => [
				[ 'imageLightbox', '=', true ],
				[ 'lightboxThumbnails', '=', true ],
			],
		];

		$this->controls['lightboxThumbnailInfo'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'content'  => esc_html__( 'We recommend setting a padding for your lightbox to accommodate the thumbnail navigation.', 'bricks' ),
			'type'     => 'info',
			'required' => [
				[ 'imageLightbox', '=', true ],
				[ 'lightboxThumbnails', '=', true ],
				[ 'lightboxPadding', '=', '' ],
			],
		];

		$this->controls['lightboxPadding'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Padding', 'bricks' ) . ' (px)',
			'type'     => 'dimensions',
			'required' => [ 'imageLightbox', '=', true ],
		];

		// FIELDS

		$this->controls = array_replace_recursive( $this->controls, $this->get_post_fields() );

		// CONTENT

		$this->controls = array_replace_recursive( $this->controls, $this->get_post_content() );

		// OVERLAY

		$this->controls = array_replace_recursive( $this->controls, $this->get_post_overlay() );

		// ARROWS

		$this->controls['arrows']          = $carousel_controls['arrows'];
		$this->controls['arrowHeight']     = $carousel_controls['arrowHeight'];
		$this->controls['arrowWidth']      = $carousel_controls['arrowWidth'];
		$this->controls['arrowBackground'] = $carousel_controls['arrowBackground'];
		$this->controls['arrowBorder']     = $carousel_controls['arrowBorder'];
		$this->controls['arrowTypography'] = $carousel_controls['arrowTypography'];

		$this->controls['prevArrowSeparator'] = $carousel_controls['prevArrowSeparator'];
		$this->controls['prevArrow']          = $carousel_controls['prevArrow'];
		$this->controls['prevArrowTop']       = $carousel_controls['prevArrowTop'];
		$this->controls['prevArrowRight']     = $carousel_controls['prevArrowRight'];
		$this->controls['prevArrowBottom']    = $carousel_controls['prevArrowBottom'];
		$this->controls['prevArrowLeft']      = $carousel_controls['prevArrowLeft'];

		$this->controls['nextArrowSeparator'] = $carousel_controls['nextArrowSeparator'];
		$this->controls['nextArrow']          = $carousel_controls['nextArrow'];
		$this->controls['nextArrowTop']       = $carousel_controls['nextArrowTop'];
		$this->controls['nextArrowRight']     = $carousel_controls['nextArrowRight'];
		$this->controls['nextArrowBottom']    = $carousel_controls['nextArrowBottom'];
		$this->controls['nextArrowLeft']      = $carousel_controls['nextArrowLeft'];

		// DOTS

		$this->controls['dots']            = $carousel_controls['dots'];
		$this->controls['dotsDynamic']     = $carousel_controls['dotsDynamic'];
		$this->controls['dotsVertical']    = $carousel_controls['dotsVertical'];
		$this->controls['dotsHeight']      = $carousel_controls['dotsHeight'];
		$this->controls['dotsWidth']       = $carousel_controls['dotsWidth'];
		$this->controls['dotsTop']         = $carousel_controls['dotsTop'];
		$this->controls['dotsRight']       = $carousel_controls['dotsRight'];
		$this->controls['dotsBottom']      = $carousel_controls['dotsBottom'];
		$this->controls['dotsLeft']        = $carousel_controls['dotsLeft'];
		$this->controls['dotsBorder']      = $carousel_controls['dotsBorder'];
		$this->controls['dotsColor']       = $carousel_controls['dotsColor'];
		$this->controls['dotsActiveColor'] = $carousel_controls['dotsActiveColor'];
		$this->controls['dotsSpacing']     = $carousel_controls['dotsSpacing'];

		$this->controls['dotsSpacing']['placeholder'] = [
			'top'    => 0,
			'right'  => 5,
			'bottom' => 0,
			'left'   => 0,
		];

		// DEFAULTS

		$this->controls['_border']['css'][0]['selector']    = '.image';
		$this->controls['_boxShadow']['css'][0]['selector'] = '.image';

	}

	public function render() {
		$settings = $this->settings;
		$fields   = $settings['fields'] ?? [];

		// https://swiperjs.com/swiper-api
		$options = [
			'slidesPerView'  => isset( $settings['slidesToShow'] ) ? intval( $settings['slidesToShow'] ) : 2,
			'slidesPerGroup' => isset( $settings['slidesToScroll'] ) ? intval( $settings['slidesToScroll'] ) : 1,
			'speed'          => isset( $settings['speed'] ) ? intval( $settings['speed'] ) : 300,
			'autoHeight'     => isset( $settings['adaptiveHeight'] ),
			'effect'         => isset( $settings['effect'] ) ? $settings['effect'] : 'slide',
			'spaceBetween'   => isset( $settings['gutter'] ) ? intval( $settings['gutter'] ) : 0,
			'initialSlide'   => isset( $settings['initialSlide'] ) ? intval( $settings['initialSlide'] ) : 0,
			'loop'           => isset( $settings['infinite'] ),
			'centeredSlides' => isset( $settings['centerMode'] ),
		];

		if ( isset( $settings['autoplay'] ) ) {
			$options['autoplay'] = Helpers::generate_swiper_autoplay_options( $settings );
		}

		// Arrow navigation
		if ( isset( $settings['arrows'] ) ) {
			$options['navigation'] = true;
		}

		// Dots
		if ( isset( $settings['dots'] ) ) {
			$options['pagination'] = true;

			if ( isset( $settings['dotsDynamic'] ) && ! isset( $settings['dotsVertical'] ) ) {
				$options['dynamicBullets'] = true;
			}
		}

		$breakpoint_options = Helpers::generate_swiper_breakpoint_data_options( $settings );

		// Has slidesPerView/slidesPerGroup set on non-desktop breakpoints
		if ( count( $breakpoint_options ) > 1 ) {
			unset( $options['slidesPerView'] );
			unset( $options['slidesPerGroup'] );

			$options['breakpoints'] = $breakpoint_options;
		}

		$this->set_attribute( 'swiper', 'class', 'bricks-swiper-container' );
		$this->set_attribute( 'swiper', 'data-script-args', wp_json_encode( $options ) );

		$type = $settings['type'] ?? 'media';
		// TYPE: MEDIA
		if ( $type === 'media' ) {
			// Dynamic data already checked inside this helper function (@since 1.9.3)
			$query_settings = Helpers::populate_query_vars_for_element( $this->element, $this->post_id );

			if ( ! empty( $query_settings ) ) {
				// Set lang to empty string if Polylang is active to fetch all images even if they are not translated (@since 1.9.4)
				if ( \Bricks\Integrations\Polylang\Polylang::$is_active ) {
					$query_settings['lang'] = '';
				}

				// Add query_settings to element_settings under query key
				$this->element['settings']['query'] = $query_settings;

				$carousel_query = new Query( $this->element );

				// Set $bricks_query (@since 1.10.2)
				$this->set_bricks_query( $carousel_query );

				$carousel_query = $carousel_query ? $carousel_query->query_result : false;
			}

			// Element placeholder
			else {
				return $this->render_element_placeholder( [ 'title' => esc_html__( 'No image selected.', 'bricks' ) ] );
			}
		}

		// TYPE: POSTS
		elseif ( $type === 'posts' ) {
			$carousel_query = new Query(
				[
					'id'       => $this->id,
					'settings' => $settings,
				]
			);

			if ( $carousel_query->count === 0 ) {
				// No results: Empty by default (@since 1.4)
				$no_results_content = $carousel_query->get_no_results_content();

				if ( ! $no_results_content ) {
					return $this->render_element_placeholder( [ 'title' => esc_html__( 'No results', 'bricks' ) ] );
				}
			}

			// Set $bricks_query (@since 1.10.2)
			$this->set_bricks_query( $carousel_query );

			$carousel_query = $carousel_query ? $carousel_query->query_result : false;
		}

		$carousel_posts = $carousel_query ? $carousel_query->get_posts() : [];

		if ( $type === 'media' && isset( $settings['imageLightbox'] ) ) {
			$this->set_attribute( '_root', 'class', 'bricks-lightbox' );

			// Lightbox caption (@since 1.10)
			if ( isset( $settings['lightboxCaption'] ) ) {
				$this->set_attribute( '_root', 'class', 'has-lightbox-caption' );
			}

			if ( isset( $settings['lightboxImageClick'] ) ) {
				$this->set_attribute( '_root', 'data-lightbox-image-click', esc_attr( $settings['lightboxImageClick'] ) );
			}

			if ( ! empty( $settings['lightboxAnimationType'] ) ) {
				$this->set_attribute( '_root', 'data-animation-type', esc_attr( $settings['lightboxAnimationType'] ) );
			}

			if ( ! empty( $settings['lightboxPadding'] ) ) {
				$this->set_attribute( '_root', 'data-lightbox-padding', wp_json_encode( $settings['lightboxPadding'] ) );
			}

			if ( ! empty( $settings['lightboxThumbnails'] ) ) {
				$this->set_attribute( '_root', 'class', 'has-lightbox-thumbnails' );
			}

			if ( ! empty( $settings['lightboxThumbnailSize'] ) ) {
				$this->set_attribute( '_root', 'data-lightbox-thumbnail-size', esc_attr( $settings['lightboxThumbnailSize'] ) );
			}
		}

		// STEP: Render
		echo "<div {$this->render_attributes( '_root' )}>";

		if ( $type === 'posts' && $carousel_query && $carousel_query->count === 0 ) {
			echo $no_results_content;
		} else {
			// (@since 1.10.2)
			$this->start_iteration();

			echo "<div {$this->render_attributes( 'swiper' )}>";
			echo '<div class="swiper-wrapper">';

			$item_classes = [ 'repeater-item', 'swiper-slide' ];
			$image_size   = $settings['imageSize'] ?? BRICKS_DEFAULT_IMAGE_SIZE;

			foreach ( $carousel_posts as $item_index => $item ) {
				// (@since 1.10.2)
				$item_id = $item->ID;
				$this->set_loop_object( get_post( $item_id ) );
				$this->set_attribute( "list-item-$item_index", 'class', $item_classes );

				$aria_label = get_post_meta( $item_id, '_wp_attachment_image_alt', true );
				$image_url  = false;

				echo "<div {$this->render_attributes( "list-item-$item_index" )}>";

				// Selected media image
				if ( $type === 'media' ) {
					$image_url = wp_get_attachment_image_src( $item_id, $image_size );
					$image_url = $image_url[0];
				}

				// Featured image
				if ( $type === 'posts' && has_post_thumbnail( $item_id ) && ! isset( $settings['imageDisable'] ) ) {
					$image_url = get_the_post_thumbnail_url( $item_id, $image_size );
				}

				if ( $image_url ) {
					// Lightbox (Photoswipe 5 requires <a> tag)
					$lightbox = $type === 'media' && isset( $settings['imageLightbox'] );

					if ( $lightbox ) {
						$lightbox_image_src = wp_get_attachment_image_src( $item_id, $settings['imageLightboxSize'] ?? 'full' );

						$this->set_attribute( "a-$item_index", 'href', $lightbox_image_src[0] );
						$this->set_attribute( "a-$item_index", 'data-pswp-src', $lightbox_image_src[0] );
						$this->set_attribute( "a-$item_index", 'data-pswp-width', $lightbox_image_src[1] );
						$this->set_attribute( "a-$item_index", 'data-pswp-height', $lightbox_image_src[2] );
						$this->set_attribute( "a-$item_index", 'data-pswp-index', $item_index );

						// Add aria-label to <a> tag (@since 1.10)
						$this->set_attribute( "a-$item_index", 'aria-label', esc_html__( 'Open image in lightbox', 'bricks' ) . ' (ID: ' . $item_id . ')' );

						// Lightbox caption (@since 1.10)
						$lightbox_caption = isset( $settings['lightboxCaption'] ) && $item_id ? wp_get_attachment_caption( $item_id ) : false;

						if ( $lightbox_caption ) {
							$this->set_attribute( "a-$item_index", 'data-lightbox-caption', $lightbox_caption );
						}

						echo "<a {$this->render_attributes( "a-$item_index" )}>";
					}

					// Use img tag
					if ( isset( $settings['adaptiveHeight'] ) ) {
						$image_id   = $type === 'posts' ? get_post_thumbnail_id( $item_id ) : $item_id;
						$image_atts = [ 'class' => 'image css-filter' ];

						if ( ! $this->lazy_load() ) {
							$image_atts['loading'] = 'eager';
						}

						echo wp_get_attachment_image( $image_id, $image_size, false, $image_atts );
					}

					// Use background image
					else {
						$image_classes = [ 'image', 'css-filter' ];

						if ( $this->lazy_load() ) {
							$image_classes[] = 'bricks-lazy-hidden';
						}

						$this->set_attribute( "image-$item_index", 'class', $image_classes );
						$this->set_attribute( "image-$item_index", 'role', 'img' );

						if ( $aria_label ) {
							$this->set_attribute( "image-$item_index", 'aria-label', $aria_label );
						}

						if ( $this->lazy_load() ) {
							$this->set_attribute( "image-$item_index", 'data-style', 'background-image: url("' . esc_url( $image_url ) . '")' );
						} else {
							$this->set_attribute( "image-$item_index", 'style', 'background-image: url("' . esc_url( $image_url ) . '")' );
						}

						echo "<div {$this->render_attributes( "image-$item_index" )}></div>";
					}

					if ( $lightbox ) {
						echo '</a>';
					}
				}

				// Overlay wrapper
				if ( $type === 'posts' && ! empty( $fields ) ) {
					$overlay_fields = [];

					foreach ( $fields as $field ) {
						if ( isset( $field['overlay'] ) ) {
							$overlay_fields[] = $field;
						}
					}

					if ( count( $overlay_fields ) ) {
						$this->set_attribute(
							"overlay-wrapper-$item_index",
							'class',
							[
								'overlay-wrapper',
								isset( $settings['overlayAlign'] ) ? $settings['overlayAlign'] : '',
								isset( $settings['overlayOnHover'] ) ? 'show-on-hover' : '',
								isset( $settings['overlayAnimation'] ) ? $settings['overlayAnimation'] : '',
							]
						);
						$overlay_wrapper_html  = "<div {$this->render_attributes( "overlay-wrapper-$item_index" )}>";
						$overlay_wrapper_html .= '<div class="overlay-inner">';
						$overlay_wrapper_html .= Frontend::get_content_wrapper( $settings, $overlay_fields, $item );
						$overlay_wrapper_html .= '</div>';
						$overlay_wrapper_html .= '</div>';

						echo $overlay_wrapper_html;
					}
				}

				// Content wrapper
				if ( $type === 'posts' && ! empty( $fields ) ) {
					$content_fields = [];

					foreach ( $fields as $field ) {
						if ( ! isset( $field['overlay'] ) ) {
							$content_fields[] = $field;
						}
					}

					if ( count( $content_fields ) ) {
						$this->set_attribute(
							"content-wrapper-$item_index",
							'class',
							[
								'content-wrapper',
								isset( $settings['contentAlign'] ) ? $settings['contentAlign'] : '',
							]
						);

						echo '<div ' . $this->render_attributes( "content-wrapper-$item_index" ) . '>';
						echo Frontend::get_content_wrapper( $settings, $content_fields, $item );
						echo '</div>';
					}
				}
				echo '</div>';

				// (@since 1.10.2)
				$this->next_iteration();
			}

			echo '</div>';
			echo '</div>';

			echo $this->render_swiper_nav();
		}

		// (@since 1.10.2)
		$this->end_iteration();

		echo '</div>';
	}
}
