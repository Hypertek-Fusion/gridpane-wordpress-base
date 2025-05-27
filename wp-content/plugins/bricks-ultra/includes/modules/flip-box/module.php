<?php

namespace BricksUltra\Modules\FlipBox;

use Bricks\Element;
use BricksUltra\includes\Helper;

class Module extends Element
{

	public $category     = 'ultra';
	public $name         = 'wpvbu-flip-box';
	public $icon         = 'ti-layers';
	public $css_selector = '';
	public $scripts      = ['FlipBox'];
	public $loop_index   = 0;

	// Methods: Builder-specific
	public function get_label()
	{
		return esc_html__('Flip Box', 'wpv-bu');
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts()
	{
		wp_enqueue_script('bultr-module-script');
		wp_enqueue_style('bultr-module-style');
	}
	public function set_control_groups()
	{

		$this->control_groups['fb_settings']     = [
			'title' => esc_html__('General', 'wpv-bu'),
			'tab'   => 'content',
		];
		$this->control_groups['front_box']       = [
			'title' => esc_html__('Front Box', 'wpv-bu'),
			'tab'   => 'content',
		];
		$this->control_groups['back_box']        = [
			'title' => esc_html__('Back Box', 'wpv-bu'),
			'tab'   => 'content',
		];
		$this->control_groups['front_box_style'] = [
			'title' => esc_html__('Front Box Style', 'wpv-bu'),
			'tab'   => 'content',
		];
		$this->control_groups['back_box_style']  = [
			'title' => esc_html__('Back Box Style', 'wpv-bu'),
			'tab'   => 'content',
		];
	}

	public function set_controls()
	{
		// Front Box Controls
		$this->front_box_controls();

		// Back Box Controls
		$this->back_box_controls();

		// Settings Control
		$this->fb_settings_controls();

		// Front Box Style Control
		$this->front_box_style_controls();

		// Back Box Style Control
		$this->back_box_style_controls();
	}

	public function front_box_controls()
	{
		$display_group = 'front_box';
		$helper        = new Helper();

		$this->controls['graphic_element'] = [
			'label'     => esc_html__('Graphic Element', 'wpv-bu'),
			'group'     => $display_group,
			'type'      => 'select',
			'inline'    => true,
			'options'   => [
				'none'  => 'None',
				'icon'  => 'Icon',
				'image' => 'Image',
			],
			'clearable' => false,
			'default'   => 'icon',
		];

		$helper->add_icon_controls(
			$this,
			[
				'control_name' => 'front_icon',
				'shape'        => true,
				'view'         => true,
				'label'        => 'Icon',
				'tab'          => 'content',
				'group'        => $display_group,
				'required'     => [['graphic_element', '=', 'icon']],
			]
		);
		$this->controls['front_icon_view']['default'] = 'framed';

		$this->controls['front_image'] = [
			'label'    => esc_html__('Image', 'wpv-bu'),
			'group'    => $display_group,
			'type'     => 'image',
			'default'  => [
				'size' => 'thumbnail',
			],
			'required' => [['graphic_element', '=', 'image']],
		];

		$this->controls['title_sept']  = [
			'tab'   => 'content',
			'group' => $display_group,
			'type'  => 'separator',
		];
		$this->controls['front_title'] = [
			'label'   => esc_html__('Title', 'wpv-bu'),
			'group'   => $display_group,
			'type'    => 'text',
			'inline'  => true,
			'default' => esc_html__('Front Box Title', 'wpv-bu'),
		];
		$this->controls['front_desc']  = [
			'label'   => esc_html__('Description', 'wpv-bu'),
			'group'   => $display_group,
			'type'    => 'editor',
			'inline'  => false,
			'default' => esc_html__('Front Box Description', 'wpv-bu'),
		];
	}

	public function back_box_controls()
	{
		$display_group = 'back_box';
		$helper        = new Helper();

		$this->controls['back_show'] = [
			'label'  => esc_html__('Show Back Box (Preview)', 'wpv-bu'),
			'group'  => $display_group,
			'type'   => 'checkbox',
			'inline' => true,
		];

		$this->controls['graphic_element_back'] = [
			'label'     => esc_html__('Graphic Element', 'wpv-bu'),
			'group'     => $display_group,
			'type'      => 'select',
			'inline'    => true,
			'options'   => [
				'none'  => 'None',
				'icon'  => 'Icon',
				'image' => 'Image',
			],
			'clearable' => false,
			'default'   => 'icon',
		];
		$helper->add_icon_controls(
			$this,
			[
				'control_name' => 'back_icon',
				'shape'        => true,
				'view'         => true,
				'label'        => 'Icon',
				'tab'          => 'content',
				'group'        => $display_group,
				'required'     => [['graphic_element_back', '=', 'icon']],
			]
		);
		$this->controls['back_icon_view']['default'] = 'framed';
		$this->controls['back_image']                = [
			'label'    => esc_html__('Image', 'wpv-bu'),
			'group'    => $display_group,
			'type'     => 'image',
			'default'  => [
				'size' => 'thumbnail',
			],
			'required' => [['graphic_element_back', '=', 'image']],
		];
		$this->controls['back_title_sept']           = [
			'tab'   => 'content',
			'group' => $display_group,
			'type'  => 'separator',
		];
		$this->controls['back_title']                = [
			'label'   => esc_html__('Title', 'wpv-bu'),
			'group'   => $display_group,
			'type'    => 'text',
			'inline'  => true,
			'default' => esc_html__('Back Box Title', 'wpv-bu'),
		];
		$this->controls['back_desc']                 = [
			'label'   => esc_html__('Description', 'wpv-bu'),
			'group'   => $display_group,
			'type'    => 'editor',
			'inline'  => false,
			'default' => esc_html__('Back Box Description', 'wpv-bu'),
		];

		$this->controls['action_btn_sept'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Button', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['button_text']     = [
			'label'   => esc_html__('Text', 'wpv-bu'),
			'group'   => $display_group,
			'type'    => 'text',
			'default' => esc_html__('Click Here', 'wpv-bu'),
			'inline'  => true,
		];
		$this->controls['button_icon']     = [
			'label'  => esc_html__('Icon', 'wpv-bu'),
			'group'  => $display_group,
			'type'   => 'icon',
			'inline' => true,
		];
		$this->controls['button_link']     = [
			'label'    => esc_html__('Link', 'wpv-bu'),
			'group'    => $display_group,
			'type'     => 'link',
			'inline'   => true,
			'required' => [['button_text', '!=', '']],
		];
	}

	public function fb_settings_controls()
	{
		$display_group = 'fb_settings';

		$this->controls['fb_trigger'] = [
			'label'     => esc_html__('Trigger', 'wpv-bu'),
			'group'     => $display_group,
			'type'      => 'select',
			'options'   => [
				'hover' => esc_html__('Hover', 'wpv-bu'),
				'click' => esc_html__('Click', 'wpv-bu'),
			],
			'clearable' => false,
			'inline'    => true,
			'default'   => 'hover',
		];
		$this->controls['fb_effect']  = [
			'label'     => esc_html__('Effect', 'wpv-bu'),
			'group'     => $display_group,
			'type'      => 'select',
			'options'   => [
				'flip'      => esc_html__('Flip', 'wpv-bu'),
				'flip-alt'  => esc_html__('Flip Alt', 'wpv-bu'),
				'slide'     => esc_html__('Slide', 'wpv-bu'),
				'push'      => esc_html__('Push', 'wpv-bu'),
				'swap'      => esc_html__('Swap', 'wpv-bu'),
				'fade'      => esc_html__('Fade', 'wpv-bu'),
				'zoomin'    => esc_html__('Zoom In', 'wpv-bu'),
				'zoomout'   => esc_html__('Zoom Out', 'wpv-bu'),
				'zoominout' => esc_html__('Zoom In/Out', 'wpv-bu'),
			],
			'clearable' => false,
			'inline'    => true,
			'default'   => 'flip',
		];

		$this->controls['fb_effect_direction'] = [
			'label'     => esc_html__('Direction', 'wpv-bu'),
			'group'     => $display_group,
			'type'      => 'select',
			'options'   => [
				'left'  => esc_html__('Left', 'wpv-bu'),
				'right' => esc_html__('Right', 'wpv-bu'),
				'up'    => esc_html__('Up', 'wpv-bu'),
				'down'  => esc_html__('Down', 'wpv-bu'),
			],
			'clearable' => false,
			'inline'    => true,
			'required'  => ['fb_effect', '=', ['flip', 'flip-alt', 'swap', 'slide', 'push']],
		];
		$this->controls['depth_3d']            = [
			'label'    => esc_html__('3D Depth', 'wpv-bu'),
			'group'    => $display_group,
			'type'     => 'checkbox',
			'inline'   => true,
			'required' => ['fb_effect', '=', ['flip', 'flip-alt']],
		];

		$this->controls['fb_height'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Height (px)', 'wpv-bu'),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'height',
					'selector' => '.bultr-flip-box-container',
				],
			],
		];

		$this->controls['animat_duration']  = [
			'tab'       => 'content',
			'group'     => $display_group,
			'label'     => esc_html__('Animation Duration (ms)', 'wpv-bu'),
			'type'      => 'number',
			'unit'      => 'ms',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'transition-duration',
					'selector' => '.bultr-flip-box-panel',
				],
			],
		];
		$this->controls['fb_border']        = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__('Border', 'wpv-bu'),
			'type'    => 'border',
			'exclude' => ['radius'],
			'css'     => [
				[
					'property' => 'border',
					'selector' => '.bultr-flip-box-panel',
				],
			],
		];
		$this->controls['fb_border_radius'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Border Radius (px)', 'wpv-bu'),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'border-radius',
					'selector' => '.bultr-flip-box-panel',
				],
			],
		];
	}

	public function front_box_style_controls()
	{
		$display_group                 = 'front_box_style';
		$helper                        = new Helper();
		$this->controls['box_sep']     = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Box', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['image_align'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Image/Icon Align', 'wpv-bu'),
			'type'     => 'direction',
			'css'      => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-flip-box-front .bultr-flip-box-content',
				],
			],
			'required' => [['graphic_element', '!=', 'none']],
		];
		$this->controls['image_space'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Spacing (px)', 'wpv-bu'),
			'type'     => 'number',
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'gap',
					'selector' => '.bultr-flip-box-front .bultr-flip-box-content',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-flip-box-front .bultr-inner-content',
				],
			],
			'required' => [['graphic_element', '!=', 'none']],
		];

		$this->controls['fb_align'] = [
			'tab'          => 'content',
			'group'        => $display_group,
			'label'        => esc_html__('Align Main Axis', 'wpv-bu'),
			'type'         => 'justify-content',
			'directionKey' => 'image_align',
			'css'          => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-flip-box-front .bultr-flip-box-content',
				],
			],
			'exclude'      => 'space',
		];

		$this->controls['fb_vertical'] = [
			'tab'          => 'content',
			'group'        => $display_group,
			'label'        => esc_html__('Align Cross Axis', 'wpv-bu'),
			'type'         => 'align-items',
			'directionKey' => 'image_align',
			'exclude'      => ['stretch'],
			'css'          => [
				[
					'property' => 'align-items',
					'selector' => '.bultr-flip-box-front .bultr-flip-box-content',
				],
				[
					'property' => 'align-items',
					'selector' => '.bultr-flip-box-front .bultr-inner-content',
				],
			],
		];

		$this->controls['fb_bg']           = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Background', 'wpv-bu'),
			'type'   => 'background',
			'inline' => true,
			
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-flip-box-front',
				],
			],
		];
		$this->controls['fb_padding']      = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Padding', 'wpv-bu'),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-flip-box-front',
				],
			],
		];
		$this->controls['icon_before_sep'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Icon', 'wpv-bu'),
			'type'     => 'separator',
			'required' => [['graphic_element', '=', 'icon']],
		];

		$this->controls['image_before_sep'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Image', 'wpv-bu'),
			'type'     => 'separator',
			'required' => [['graphic_element', '=', 'image']],
		];

		$this->controls['img_size']    = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Size (%)', 'wpv-bu'),
			'type'     => 'number',
			'unit'     => '%',
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.bultr-flip-box-front .bultr-fb-image',
				],
			],
			'required' => [['graphic_element', '=', 'image']],
		];
		$this->controls['img_opacity'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Opacity', 'wpv-bu'),
			'type'     => 'number',
			'step'     => '0.1',
			'min'      => 0,
			'css'      => [
				[
					'property' => 'opacity',
					'selector' => '.bultr-flip-box-front .bultr-fb-image',
				],
			],
			'required' => [['graphic_element', '=', 'image']],
		];

		$this->controls['img_border'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Border', 'wpv-bu'),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-flip-box-front .bultr-fb-image',
				],
			],
			'required' => [['graphic_element', '=', 'image']],
		];
		$helper->add_icon_style_controls(
			$this,
			[
				'control_name'        => 'front_icon',
				'tab'                 => 'content',
				'group'               => $display_group,
				'wrapper-class'       => '.bultr-flip-box-front .bultr-fb-icon-wrapper',
				'size'                => true,
				'rotate'              => true,
				'primary_color'       => true,
				'secondary_color'     => true,
				'icon_hvr'            => false,
				'hvr_rotate'          => true,
				'primary_hvr_color'   => true,
				'secondary_hvr_color' => true,
				'padding'             => true,
				'border'              => true,
				'required'            => [['graphic_element', '=', 'icon']],
			]
		);

		$this->controls['title_sep']      = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Title', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['title_space']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Spacing (px)', 'wpv-bu'),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-flip-box-front .bultr-fb-title',
				],
			],
		];
		$this->controls['fb_title_color'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-front .bultr-fb-title',
				],
			],
		];
		$this->controls['fb_title_typo']  = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__('Typography', 'wpv-bu'),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-flip-box-front .bultr-fb-title',
				],
			],
			'exclude' => ['color', 'text-align'],
		];

		$this->controls['desc_sep'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Description', 'wpv-bu'),
			'type'  => 'separator',
		];

		$this->controls['fb_desc_color'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-front .bultr-fb-desc',
				],
			],
		];
		$this->controls['fb_desc_typo']  = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__('Typography', 'wpv-bu'),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-flip-box-front .bultr-fb-desc',
				],
			],
			'exclude' => ['color', 'text-align'],
		];
	}

	public function back_box_style_controls()
	{
		$display_group                  = 'back_box_style';
		$helper                         = new Helper();
		$this->controls['box_sep_back'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Box', 'wpv-bu'),
			'type'  => 'separator',
		];

		$this->controls['image_align_back'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Image/Icon Align', 'wpv-bu'),
			'type'     => 'direction',
			'css'      => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-flip-box-back .bultr-flip-box-content',
				],
			],
			'required' => [['graphic_element', '!=', 'none']],
		];

		$this->controls['image_back_space']   = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Spacing (px)', 'wpv-bu'),
			'type'     => 'number',
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'gap',
					'selector' => '.bultr-flip-box-back .bultr-flip-box-content',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-flip-box-back .bultr-inner-content',
				],
			],
			'required' => [['graphic_element_back', '!=', 'none']],
		];
		$this->controls['fb_vertical_back']   = [
			'tab'          => 'content',
			'group'        => $display_group,
			'label'        => esc_html__('Align Main Axis', 'wpv-bu'),
			'type'         => 'justify-content',
			'directionKey' => 'image_align_back',
			'css'          => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-flip-box-back .bultr-flip-box-content',
				],
			],
			'exclude'      => 'space',
		];
		$this->controls['fb_horizontal_back'] = [
			'tab'          => 'content',
			'group'        => $display_group,
			'label'        => esc_html__('Align Cross Axis', 'wpv-bu'),
			'type'         => 'align-items',
			'directionKey' => 'image_align_back',
			'exclude'      => ['stretch'],
			'css'          => [
				[
					'property' => 'align-items',
					'selector' => '.bultr-flip-box-back .bultr-flip-box-content',
				],
				[
					'property' => 'align-items',
					'selector' => '.bultr-flip-box-back .bultr-inner-content',
				],
			],
		];

		$this->controls['fb_bg_back']            = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Background', 'wpv-bu'),
			'type'   => 'background',
			'inline' => true,
			
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-flip-box-back',
				],
			],
		];
		$this->controls['fb_padding_back']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Padding', 'wpv-bu'),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-flip-box-back',
				],
			],
		];
		$this->controls['icon_before_sep_back']  = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Icon', 'wpv-bu'),
			'type'     => 'separator',
			'required' => [['graphic_element_back', '=', 'icon']],
		];
		$this->controls['image_before_sep_back'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Image', 'wpv-bu'),
			'type'     => 'separator',
			'required' => [['graphic_element_back', '=', 'image']],
		];

		$this->controls['img_size_back'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Opacity', 'wpv-bu'),
			'type'     => 'number',
			'unit'     => '%',
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.bultr-flip-box-back .bultr-fb-image',
				],
			],
			'required' => [['graphic_element_back', '=', 'image']],
		];

		$this->controls['img_opacity_back'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Size (%)', 'wpv-bu'),
			'type'     => 'number',
			'step'     => '0.1',
			'min'      => 0,
			'css'      => [
				[
					'property' => 'opacity',
					'selector' => '.bultr-flip-box-back .bultr-fb-image',
				],
			],
			'required' => [['graphic_element_back', '=', 'image']],
		];

		$this->controls['img_border_back'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__('Border', 'wpv-bu'),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-flip-box-front .bultr-fb-image',
				],
			],
			'required' => [['graphic_element_back', '=', 'image']],
		];
		$helper->add_icon_style_controls(
			$this,
			[
				'control_name'        => 'back_icon',
				'tab'                 => 'content',
				'group'               => $display_group,
				'wrapper-class'       => '.bultr-flip-box-back .bultr-fb-icon-wrapper',
				'size'                => true,
				'rotate'              => true,
				'primary_color'       => true,
				'secondary_color'     => true,
				'icon_hvr'            => true,
				'hvr_rotate'          => true,
				'primary_hvr_color'   => true,
				'secondary_hvr_color' => true,
				'padding'             => true,
				'border'              => true,
				'required'            => [['graphic_element_back', '=', 'icon']],
			]
		);
		
		$this->controls['title_back_sep']      = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Title', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['title_back_space']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Spacing (px)', 'wpv-bu'),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-flip-box-back .bultr-fb-title',
				],
			],
		];
		$this->controls['fb_title_color_back'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-back .bultr-fb-title',
				],
			],
		];
		$this->controls['fb_title_typo_back']  = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__('Typography', 'wpv-bu'),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-flip-box-back .bultr-fb-title',
				],
			],
			'exclude' => ['color', 'text-align'],
		];
		$this->controls['desc_back_sep']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Description', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['desc_back_space']     = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Description Spacing (px)', 'wpv-bu'),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-flip-box-back .bultr-fb-desc:not(:last-child)',
				],
			],
		];
		$this->controls['fb_desc_color_back']  = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-back .bultr-fb-desc',
				],
			],
		];
		$this->controls['fb_desc_typo_back']   = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__('Typography', 'wpv-bu'),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-flip-box-back .bultr-fb-desc',
				],
			],
			'exclude' => ['color', 'text-align'],
		];

		$this->controls['button_style_sept'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Button', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['button_icon_pos']   = [
			'label'     => esc_html__('Icon Position', 'wpv-bu'),
			'group'     => $display_group,
			'type'      => 'select',
			'options'   => [
				'left'  => 'Left',
				'right' => 'Right',
			],
			'clearable' => false,
			'rerender'  => true,
			'inline'    => true,
		];
		$this->controls['btn_icon_clr']      = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Icon Color', 'wpv-bu'),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button svg',
				],
			],
		];
		$this->controls['btn_icon_spacing']  = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Icon Spacing', 'wpv-bu'),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'gap',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],
		];
		$this->controls['btn_color']         = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Text Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],
		];

		$this->controls['btn_typo'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__('Typography', 'wpv-bu'),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],
			'exclude' => ['color', 'text-align'],
		];
		$this->controls['btn_g_bg'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Background', 'wpv-bu'),
			'type'   => 'background',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],

		];
		$this->controls['btn_hvr_sep']   = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Button Hover', 'wpv-bu'),
			'type'  => 'separator',
		];
		$this->controls['btn_color_hvr'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Text Color', 'wpv-bu'),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button:hover',
				],
			],
		];

		$this->controls['btn_bg_hvr'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__('Background', 'wpv-bu'),
			'type'   => 'background',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button:hover',
				],
			],

		];
		$this->controls['btn_g_hvr_end'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'type'  => 'separator',
		];
		$this->controls['btn_border']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Border', 'wpv-bu'),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],

		];
		$this->controls['btn_padding'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Padding', 'wpv-bu'),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],
		];

		$this->controls['button_shadow'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__('Box shadow', 'wpv-bu'),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-flip-box-back .bultr-fb-back-button',
				],
			],
		];
	}

	public function render()
	{
		$settings = $this->settings;
		$this->set_attribute('_root', 'class', 'bultr-flip-box');
		$helper = new Helper();

		$graphic_element      = $settings['graphic_element'] ?? 'none';
		$graphic_element_back = $settings['graphic_element_back'] ?? 'none';
		$trigger              = $settings['fb_trigger'] ?? 'hover';
		$fb_effect_direction  = $settings['fb_effect_direction'] ?? 'left';
		$btn_icon_postition   = $settings['button_icon_pos'] ?? 'left';

		$this->set_attribute('bultr-container', 'class', 'bultr-flip-box-container');
		$this->set_attribute('bultr-container', 'class', 'bultr-flip-box-container--hover');
		$fb_effect = $settings['fb_effect'] ?? 'flip';
		if (isset($settings['depth_3d']) && ($fb_effect === 'flip' || $fb_effect === 'flip-alt')) {
			$this->set_attribute('bultr-container', 'class', 'fb-3d');
		}
		$this->set_attribute('bultr-container', 'class', 'bultr-hide');

		if (bricks_is_builder_call() && isset($settings['back_show'])) {
			$this->set_attribute('bultr-container', 'class', 'bultr-show');
			$this->set_attribute('bultr-container', 'data-disable', 'bultr-disable-pointer-events');
		}

		$this->set_attribute('bultr-container', 'data-trigger', $trigger);
		$animations = ['flip', 'flip-alt', 'swap', 'slide', 'push'];

		if (in_array($fb_effect, $animations, true)) {
			$this->set_attribute('bultr-container', 'class', $fb_effect . '_' . $fb_effect_direction);
		} else {
			$this->set_attribute('bultr-container', 'class', $fb_effect);
		}

		$this->set_attribute('bultr-container', 'data-effect', $fb_effect);

		$this->set_attribute('bultr-front-box', 'class', 'bultr-flip-box-panel');
		$this->set_attribute('bultr-front-box', 'class', 'bultr-flip-box-front');

		$this->set_attribute('bultr-back-box', 'class', 'bultr-flip-box-panel');
		$this->set_attribute('bultr-back-box', 'class', 'bultr-flip-box-back');

		$this->set_attribute('bultr-button-wrapper', 'class', 'bultr-fb-back-button-wrapper');
		$this->set_attribute('bultr-back-button', 'class', 'bultr-button');
		$this->set_attribute('bultr-back-button', 'class', 'bultr-fb-back-button');

		$this->set_attribute('bultr-back-button', 'class', 'bultr-icon-' . $btn_icon_postition);
		if (isset($settings['button_link'])) {
			$this->set_link_attributes('bultr-back-button', $settings['button_link']);
		}

?>
		<div <?php echo $this->render_attributes('_root'); ?>>
			<div <?php echo $this->render_attributes('bultr-container'); ?>>
				<div <?php echo $this->render_attributes('bultr-front-box'); ?>>
					<div class="bultr-flip-box-content-wrapper">
						<div class="bultr-flip-box-content">
							<?php
							if ($graphic_element === 'icon') {
								echo $helper->render_icon_html($this, $settings, 'front_icon', 'bultr-fb-icon-wrapper');
							} elseif ($graphic_element === 'image') {
								if (isset($settings['front_image'])) {
									echo '<div class="bultr-fb-image">';
									echo wp_get_attachment_image($settings['front_image']['id'], $settings['front_image']['size']);
									echo '</div>';
								}
							}
							echo '<div class="bultr-inner-content">';
							if (isset($settings['front_title'])) {
								echo '<h3 class="bultr-fb-title">' . $this->render_dynamic_data($settings['front_title']) . '</h3>';
							}
							if (isset($settings['front_desc'])) {
								echo '<div class="bultr-fb-desc">' . $this->render_dynamic_data($settings['front_desc']) . '</div>';
							}
							echo '</div>';
							?>
						</div>
					</div>
				</div>
				<div <?php echo $this->render_attributes('bultr-back-box'); ?> style="visibility: visible;">
					<div class="bultr-flip-box-content-wrapper">
						<div class="bultr-flip-box-content">
							<?php
							if ($graphic_element_back === 'icon') {
								echo $helper->render_icon_html($this, $settings, 'back_icon', 'bultr-fb-icon-wrapper');
							} elseif ($graphic_element_back === 'image') {
								if (isset($settings['back_image'])) {
									echo '<div class="bultr-fb-image">';
									echo wp_get_attachment_image($settings['back_image']['id'], $settings['back_image']['size']);
									echo '</div>';
								}
							}
							echo '<div class="bultr-inner-content">';
							if (isset($settings['back_title'])) {
								echo '<h3 class="bultr-fb-title">' . $this->render_dynamic_data($settings['back_title']) . '</h3>';
							}
							if (isset($settings['back_desc'])) {
								echo '<div class="bultr-fb-desc">' . $this->render_dynamic_data($settings['back_desc']) . '</div>';
							}
							if (isset($settings['button_text'])) {
								$button_icon = $settings['button_icon'] ?? false;
								echo '<div ' . $this->render_attributes('bultr-button-wrapper') . '>';
								echo '<a ' . $this->render_attributes('bultr-back-button') . '>';
								if ($button_icon) {
									echo self::render_icon($button_icon);
								}
								echo $this->render_dynamic_data($settings['button_text']);
								echo '</a>';
								echo '</div>';
							}
							echo '</div>';
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}
