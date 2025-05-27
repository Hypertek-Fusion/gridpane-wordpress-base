<?php

namespace BricksUltra\Modules\ImageCompare;

use Bricks\Element;

class Module extends Element
{

	public $category     = 'ultra';
	public $name         = 'wpvbu-image-compare';
	public $icon         = 'ion-ios-images';
	public $css_selector = '';
	public $scripts      = ['ExecuteAfterBefore'];

	// Methods: Builder-specific
	public function get_label()
	{
		return esc_html__('Image Compare', 'wpv-bu');
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts()
	{
		wp_enqueue_script('bultr-ic', WPV_BU_URL . 'assets/lib/image-compare/imageCompare.min.js', ['imagesloaded'], WPV_BU_VERSION, true);
		wp_enqueue_script('bultr-module-script');
		wp_enqueue_style('bultr-module-style');
		wp_enqueue_style('wpv-bu-ic-slider-css', WPV_BU_URL . 'assets/lib/image-compare/image-compare.css', [], WPV_BU_VERSION);
	}
	public function set_control_groups()
	{

		$this->control_groups['images_labels'] = [
			'title' => esc_html__('Images & Labels', 'wpv-bu'),
			'tab'   => 'content',
		];
		$this->control_groups['general']       = [
			'title' => esc_html__('General', 'wpv-bu'),
			'tab'   => 'content',
		];
		$this->control_groups['labels']        = [
			'title' => esc_html__('Labels Style', 'wpv-bu'),
			'tab'   => 'content',
		];
	}

	public function set_controls()
	{

		$this->controls['separator_orig'] = [
			'tab'   => 'content',
			'group' => 'images_labels',
			'label' => esc_html__('Original Image', 'wpv-bu'),
			'type'  => 'separator',
		];

		$this->controls['original_label'] = [
			'tab'            => 'content',
			'group'          => 'images_labels',
			'label'          => esc_html__('Label', 'wpv-bu'),
			'type'           => 'text',
			'inline'         => true,
			'default'        => esc_html__('Before', 'wpv-bu'),
			'hasDynamicData' => false,
		];

		$this->controls['original_image']          = [
			'tab'     => 'content',
			'group'   => 'images_labels',
			'label'   => esc_html__('Image', 'wpv-bu'),
			'type'    => 'image',
			'default' => [
				'full' => 'https://source.unsplash.com/random/1600x1200?moon',
				'url'  => 'https://source.unsplash.com/random/1600x1200?moon',
			],
		];
		$this->controls['original_image_alt_text'] = [
			'tab'            => 'content',
			'group'          => 'images_labels',
			'label'          => esc_html__('Custom Alt Text', 'wpv-bu'),
			'type'           => 'text',
			'placeholder'    => 'custom alt text',
			'hasDynamicData' => false,
		];

		$this->controls['separator_mod'] = [
			'tab'   => 'content',
			'group' => 'images_labels',
			'label' => esc_html__('Modified Image', 'wpv-bu'),
			'type'  => 'separator',
		];

		$this->controls['modified_label'] = [
			'tab'            => 'content',
			'group'          => 'images_labels',
			'label'          => esc_html__('Label', 'wpv-bu'),
			'type'           => 'text',
			'inline'         => true,
			'default'        => esc_html__('After', 'wpv-bu'),
			'hasDynamicData' => false,
		];

		$this->controls['modified_image'] = [
			'tab'     => 'content',
			'group'   => 'images_labels',
			'label'   => esc_html__('Image', 'wpv-bu'),
			'type'    => 'image',
			'default' => [
				'full' => 'https://source.unsplash.com/random/1600x1200?earth',
				'url'  => 'https://source.unsplash.com/random/1600x1200?earth',
			],
		];

		$this->controls['modified_image_alt_text'] = [
			'tab'            => 'content',
			'group'          => 'images_labels',
			'label'          => esc_html__('Custom Alt Text', 'wpv-bu'),
			'type'           => 'text',
			'placeholder'    => 'custom alt text',
			'hasDynamicData' => false,
		];
		/* General Style Control */
		$this->controls['orientation']    = [
			'tab'       => 'content',
			'group'     => 'general',
			'label'     => esc_html__('Orientation', 'wpv-bu'),
			'type'      => 'select',
			'options'   => [
				'column' => esc_html__('Vertical', 'wpv-bu'),
				'row'    => esc_html__('Horizontal', 'wpv-bu'),
			],
			'inline'    => true,
			'default'   => 'row',
			'clearable' => false,
		];
		$this->controls['slider_move_on'] = [
			'tab'       => 'content',
			'group'     => 'general',
			'label'     => esc_html__('Slider Trigger', 'wpv-bu'),
			'type'      => 'select',
			'options'   => [
				'hover' => esc_html__('Hover', 'wpv-bu'),
				'drag'  => esc_html__('Drag', 'wpv-bu'),
			],
			'inline'    => true,
			'default'   => 'drag',
			'clearable' => false,
		];
		$this->controls['move_on_click']  = [
			'tab'      => 'content',
			'group'    => 'general',
			'label'    => esc_html__('Enable Click', 'wpv-bu'),
			'type'     => 'checkbox',
			'inline'   => true,
			'small'    => true,
			'default'  => false,
			'required' => ['slider_move_on', '=', 'drag'],
		];

		$this->controls['divider_sep']     = [
			'tab'   => 'content',
			'group' => 'general',
			'label' => esc_html__('Divider', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['slider_position'] = [
			'tab'      => 'content',
			'group'    => 'general',
			'label'    => esc_html__('Initial Position (%)', 'wpv-bu'),
			'type'     => 'number',
			'rerender' => true,
			'unitless' => true,
			'default'  => '50',
			'max'      => 100,
		];
		$this->controls['separator_color'] = [
			'tab'    => 'content',
			'group'  => 'general',
			'label'  => esc_html__('Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-ic-handle-before',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-ic-handle-after',
				],
			],
		];
		$this->controls['separator_width'] = [
			'tab'         => 'content',
			'group'       => 'general',
			'label'       => esc_html__('Width (px)', 'wpv-bu'),
			'type'        => 'number',
			'unit'        => 'px',
			'min'         => 0,
			'max'         => 10,
			'css'         => [
				[
					'property' => 'width',
					'selector' => '.bultr-ic-horizontal .bultr-ic-handle-before',

				],
				[
					'property' => 'width',
					'selector' => '.bultr-ic-horizontal .bultr-ic-handle-after',
				],
				[
					'property' => 'height',
					'selector' => '.bultr-ic-vertical .bultr-ic-handle-before',
				],
				[
					'property' => 'height',
					'selector' => '.bultr-ic-vertical .bultr-ic-handle-after',
				],
			],
			'placeholder' => '3',
		];
		$this->controls['handle_sep'] = [
			'tab'   => 'content',
			'group' => 'general',
			'label' => esc_html__('Handle', 'wpv-bu'),
			'type'  => 'separator',
		];

		$this->controls['slider_icon'] = [
			'tab'     => 'content',
			'group'   => 'general',
			'label'   => esc_html__('Icon', 'wpv-bu'),
			'type'    => 'icon',
			'default' => [
				'library' => 'themify',
				'icon'    => 'ti-arrows-horizontal',
			],
		];

		$this->controls['icon_size'] = [
			'tab'     => 'content',
			'group'   => 'general',
			'label'   => esc_html__('Icon Size', 'wpv-bu'),
			'type'    => 'number',
			'css'     => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-ic-slider-icon i',
				],
			],
			'unit'    => 'px',
			'default' => '20px',
		];

		$this->controls['icon_color'] = [
			'tab'    => 'content',
			'group'  => 'general',
			'label'  => esc_html__('Icon color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-ic-slider-icon i',
				],
			],
		];

		$this->controls['slider_size']              = [
			'tab'         => 'content',
			'group'       => 'general',
			'label'       => esc_html__('Size', 'wpv-bu'),
			'type'        => 'number',
			'unit'        => 'px',
			'placeholder' => '38',
			'css'         => [
				[
					'property' => 'height',
					'selector' => '.bultr-ic-handle.bultr-ic-slider-icon',
				],
				[
					'property' => 'width',
					'selector' => '.bultr-ic-handle.bultr-ic-slider-icon',
				],
			],
		];
		$this->controls['slider_color']             = [
			'tab'    => 'content',
			'group'  => 'general',
			'label'  => esc_html__('Background color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-ic-handle.bultr-ic-slider-icon',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-ic-handle.bultr-ic-slider-icon',
				],
			],
		];
		$this->controls['slider_border']            = [
			'tab'   => 'content',
			'group' => 'general',
			'label' => esc_html__('Border', 'wpv-bu'),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-ic-handle.bultr-ic-slider-icon',
				],
			],
		];
		$this->controls['separator_icon_alignment'] = [
			'tab'         => 'content',
			'group'       => 'general',
			'label'       => esc_html__('Position (%)', 'wpv-bu'),
			'type'        => 'number',
			'default'     => '50',
			'placeholder' => '50',
			'unit'        => '%',
			'css'         => [
				[
					'property' => 'top',
					'selector' => '.bultr-ic-horizontal .bultr-ic-slider-icon',
				],
				[
					'property' => 'left',
					'selector' => '.bultr-ic-vertical .bultr-ic-slider-icon',
				],
			],
		];

		/* General Controls End */

		/* Labels Controls Start */

		$this->controls['hide_overlay']             = [
			'tab'     => 'content',
			'group'   => 'labels',
			'label'   => esc_html__('Hide Overlay', 'wpv-bu'),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => false,
			'css'     => [
				[
					'property' => 'opacity',
					'selector' => '.bultr-ic-overlay',
					'value'    => '0',
					'required' => true,
				],
			],
		];
		$this->controls['ovelay_color']             = [
			'tab'         => 'content',
			'group'       => 'labels',
			'label'       => esc_html__('Overlay Color', 'wpv-bu'),
			'type'        => 'color',
			'inline'      => true,
			'small'       => true,
			'css'         => [
				[
					'property' => 'background',
					'selector' => '.bultr-ic-overlay:hover',
				],
			],
			'pasteStyles' => false,
			'required'    => ['hide_overlay', '!=', true],
		];
		$this->controls['separator_label_position'] = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Labels', 'wpv-bu'),
			'type'     => 'separator',
			'required' => ['hide_overlay', '!=', true],
		];
		$this->controls['label_position']           = [
			'tab'          => 'content',
			'group'        => 'labels',
			'label'        => esc_html__('Position', 'wpv-bu'),
			'type'         => 'align-items',
			'isHorizontal' => true,
			'default'      => 'center',
			'exclude'      => ['stretch'],
			'directionKey' => 'orientation',
			'required'     => ['hide_overlay', '!=', true],
		];
		$this->controls['separator_before_label']   = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Original Label', 'wpv-bu'),
			'type'     => 'separator',
			'required' => ['hide_overlay', '!=', true],
		];
		$this->controls['label_color']              = [
			'tab'         => 'content',
			'group'       => 'labels',
			'label'       => esc_html__('Color', 'wpv-bu'),
			'type'        => 'color',
			'inline'      => true,
			'small'       => true,
			'css'         => [
				[
					'property' => 'color',
					'selector' => '.bultr-ic-before-label:before',
				],
			],
			'pasteStyles' => false,
			'required'    => ['hide_overlay', '!=', true],
		];
		$this->controls['label_bg_color']           = [
			'tab'         => 'content',
			'group'       => 'labels',
			'label'       => esc_html__('Background Color', 'wpv-bu'),
			'type'        => 'color',
			'inline'      => true,
			'small'       => true,
			'css'         => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-ic-before-label:before',
				],
			],
			'pasteStyles' => false,
			'required'    => ['hide_overlay', '!=', true],
		];
		$this->controls['label_border']             = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Border', 'wpv-bu'),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-ic-before-label:before',
				],
			],
			'required' => ['hide_overlay', '!=', true],
		];
		$this->controls['separator_after_label']    = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Modified Label', 'wpv-bu'),
			'type'     => 'separator',
			'required' => ['hide_overlay', '!=', true],
		];

		$this->controls['label_color_after']    = [
			'tab'         => 'content',
			'group'       => 'labels',
			'label'       => esc_html__('Color', 'wpv-bu'),
			'type'        => 'color',
			'inline'      => true,
			'small'       => true,
			'css'         => [
				[
					'property' => 'color',
					'selector' => '.bultr-ic-after-label:before',
				],
			],
			'pasteStyles' => false,
			'required'    => ['hide_overlay', '!=', true],
		];
		$this->controls['label_bg_color_after'] = [
			'tab'         => 'content',
			'group'       => 'labels',
			'label'       => esc_html__('Background Color', 'wpv-bu'),
			'type'        => 'color',
			'inline'      => true,
			'small'       => true,
			'css'         => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-ic-after-label:before',
				],
			],
			'pasteStyles' => false,
			'required'    => ['hide_overlay', '!=', true],
		];
		$this->controls['label_border_after']   = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Border', 'wpv-bu'),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-ic-after-label:before',
				],
			],
			'required' => ['hide_overlay', '!=', true],
		];
		$this->controls['separator_labels']     = [
			'tab'      => 'content',
			'group'    => 'labels',
			'type'     => 'separator',
			'required' => ['hide_overlay', '!=', true],
		];
		$this->controls['label_typography']     = [
			'tab'         => 'content',
			'group'       => 'labels',
			'label'       => esc_html__('Typography', 'wpv-bu'),
			'type'        => 'typography',
			'inline'      => true,
			'small'       => true,
			'css'         => [
				[
					'property' => 'font',
					'selector' => '.bultr-ic-before-label:before',
				],
				[
					'property' => 'font',
					'selector' => '.bultr-ic-after-label:before',
				],
			],
			'exclude'     => ['color'],
			'pasteStyles' => false,
			'required'    => ['hide_overlay', '!=', true],
		];

		$this->controls['label_padding'] = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Padding', 'wpv-bu'),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-ic-before-label:before',
				],
				[
					'property' => 'padding',
					'selector' => '.bultr-ic-after-label:before',
				],
			],
			'required' => ['hide_overlay', '!=', true],
		];
		$this->controls['label_margin']  = [
			'tab'      => 'content',
			'group'    => 'labels',
			'label'    => esc_html__('Margin', 'wpv-bu'),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.bultr-ic-before-label:before',
				],
				[
					'property' => 'margin',
					'selector' => '.bultr-ic-after-label:before',
				],
			],
			'required' => ['hide_overlay', '!=', true],
		];
		/* Labels Controls End */
	}

	public function render()
	{

		$settings = $this->settings;

		// TODO: Issue in editor in 1.5 beta version -> adding classes twice
		$this->set_attribute('_root', 'class', 'bultr-ic-wrapper');
		
		$slider_move_on           = $settings['slider_move_on'] ?? 'drag';
		$orientation              = $settings['orientation'] ?? 'row';
		$slider_position          = $settings['slider_position'] ?? 50;
		$separator_icon_alignment = $settings['separator_icon_alignment'] ?? 50;
		$labelPosition            = $settings['label_position'] ?? 'center';

		$this->set_attribute('_root', 'data-slide-move', $slider_move_on);
		if (isset($settings['move_on_click'])) {
			$this->set_attribute('_root', 'data-move-click', $settings['move_on_click']);
		}
		$this->set_attribute('_root', 'data-orientation', $this->get_orientation_value($orientation));
		if (isset($settings['original_label'])) {
			$this->set_attribute('_root', 'data-before-text', $settings['original_label']);
		}
		if (isset($settings['modified_label'])) {
			$this->set_attribute('_root', 'data-after-text', $settings['modified_label']);
		}

		$this->set_attribute('_root', 'data-slider-offset', $slider_position);
		$this->set_attribute('_root', 'data-separator-offset', $separator_icon_alignment);

		$this->set_attribute('ic_child', 'class', "bultr-ic-label-{$labelPosition}");

		$id = rand(10,999);
		$this->set_attribute( 'ic_child', 'class', [ 'after-before', 'bultr-ic-brxe-' . $id ] );
		$this->set_attribute( '_root', 'data-ic-id', $id  );
		$this->set_attribute( 'ic_child', 'class', 'bultr-ic-'.$id );
?>
		<div <?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $this->render_attributes('_root');
				?>>
			<div <?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $this->render_attributes('ic_child');
					?>>
				<?php $this->render_image($settings, 'original_image'); ?>
				<?php $this->render_image($settings, 'modified_image'); ?>
				<div class="bultr-ic-handle bultr-ic-slider-icon">
					<span class="bultr-ic-handle-before"></span>
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo self::render_icon($settings['slider_icon'])
					?>
					<span class="bultr-ic-handle-after"></span>
				</div>
			</div>
		</div>
		<?php
	}

	public function get_orientation_value($key)
	{
		$orientation = [
			'row'    => 'horizontal',
			'column' => 'vertical',
		];

		return $orientation[$key];
	}

	public function get_normalized_image_settings( $settings, $key ) {
		if ( empty( $settings[$key] ) ) {
			return [
				'id'   => 0,
				'url'  => false,
				'size' => BRICKS_DEFAULT_IMAGE_SIZE,
			];
		}

		$image = $settings[$key];

		// Size
		$image['size'] = empty( $image['size'] ) ? BRICKS_DEFAULT_IMAGE_SIZE : $settings[$key]['size'];

		// Image ID or URL from dynamic data
		if ( ! empty( $image['useDynamicData'] ) ) {
			$images = $this->render_dynamic_data_tag( $image['useDynamicData'], 'image', [ 'size' => $image['size'] ] );

			if ( ! empty( $images[0] ) ) {
				if ( is_numeric( $images[0] ) ) {
					$image['id'] = $images[0];
				} else {
					$image['url'] = $images[0];
				}
			}

			// No dynamic data image found (@since 1.6)
			else {
				return;
			}
		}

		$image['id'] = empty( $image['id'] ) ? 0 : $image['id'];

		// If External URL, $image['url'] is already set
		if ( ! isset( $image['url'] ) ) {
			$image['url'] = ! empty( $image['id'] ) ? wp_get_attachment_image_url( $image['id'], $image['size'] ) : false;
		} else {
			// Parse dynamic data in the external URL
			$image['url'] = $this->render_dynamic_data( $image['url'] );
		}
		return $image;
	}

	public function render_image($settings, $name)
	{
		$atts = [
			'_brx_disable_lazy_loading' => true,
		];

		if (isset($settings[$name . '_alt_text'])) {
			$atts['alt'] = $settings[$name . '_alt_text'];
		}

		$image = $this->get_normalized_image_settings($settings, $name);
		if(isset($image['url'])){
			echo '<img src="' . $image['url'] . '">';
		}
	}
}
