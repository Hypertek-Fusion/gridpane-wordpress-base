<?php 
namespace BricksUltra\includes;

use Bricks\Element;
use Bricks\Helpers;

class Lightgallery_helper{
    public function add_lightgallery_controls($widget, $args){
        if (!isset($args['control_name'])) {
			return;
		}
        
        //loop controls
        $widget->controls[$args['control_name'] . '_loop'] = [
            'label'     => esc_html__('Loop','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_loop']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_loop']['group'] = $args['group'];
		}
        //speed controls
        $widget->controls[$args['control_name'] . '_speed'] = [
            'label'     => esc_html__('Speed','wpv-bu'),
            'type'      => 'number',
            'units'     => false,

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_speed']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_speed']['group'] = $args['group'];
		}
        //slide delay controls
        $widget->controls[$args['control_name'] . '_slide_delay'] = [
            'label'     => esc_html__('Slide Delay','wpv-bu'),
            'type'      => 'number',
            'units'     => false,

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_slide_delay']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slide_delay']['group'] = $args['group'];
		}
        //fullscreen controls
        $widget->controls[$args['control_name'] . '_fullscreen'] = [
            'label'     => esc_html__('Full Screen','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_fullscreen']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_fullscreen']['group'] = $args['group'];
		}
        //zoom controls
        $widget->controls[$args['control_name'] . '_zoom'] = [
            'label'     => esc_html__('Zoom','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_zoom']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_zoom']['group'] = $args['group'];
		}
        //counter controls
        $widget->controls[$args['control_name'] . '_counter'] = [
            'label'     => esc_html__('Counter','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_counter']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_counter']['group'] = $args['group'];
		}
        //download controls
        $widget->controls[$args['control_name'] . '_download'] = [
            'label'     => esc_html__('Download','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_download']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_download']['group'] = $args['group'];
		}
        //media overlap controls
        $widget->controls[$args['control_name'] . '_media_overlap'] = [
            'label'     => esc_html__('Media Overlap','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'If true, toolbar, captions and thumbnails will not overlap with media element.', 'wpv-bu'),


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_media_overlap']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_media_overlap']['group'] = $args['group'];
		}
        // close_on_tap  controls
        $widget->controls[$args['control_name'] . '_close_on_tap'] = [
            'label'     => esc_html__('Close On Tap','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'description'  => __( 'Allows clicks on black area to close gallery.', 'wpv-bu'),


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_close_on_tap']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_close_on_tap']['group'] = $args['group'];
		}
        // esc key  controls
        $widget->controls[$args['control_name'] . '_esc_key'] = [
            'label'     => esc_html__('Esc Key','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'description'  => __( 'Whether the LightGallery could be closed by pressing the "Esc" key.', 'wpv-bu'),


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_esc_key']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_esc_key']['group'] = $args['group'];
		}
        // hide bar delay  controls
        $widget->controls[$args['control_name'] . '_enableDelay'] = [
            'label'     => esc_html__('Hide Gallery Controls','wpv-bu'),
            'type'      => 'checkbox',
            'description' => __("Enable to hide Navigation and Toolbar controls.",'wpv-bu'),
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_enableDelay']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_enableDelay']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_hidebar_delay'] = [
            'label'     => esc_html__('Delay','wpv-bu'),
            'type'      => 'number',
            'units'     => false,
            'default'   => 1000,
            'info'      => __("Provide delay in ms to hide gallery controls.", 'wpv-bu'),
            'required'  => [[$args['control_name'] . '_enableDelay', '=', true]],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_hidebar_delay']['required'] = array_merge($widget->controls[$args['control_name'] . '_hidebar_delay']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_hidebar_delay']['group'] = $args['group'];
		}

        //video label
        $widget->controls[$args['control_name'] . '_video_label'] = [
            'label'     => esc_html__('Video','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_video_label']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_video_label']['group'] = $args['group'];
		}
        // autoplay
        $widget->controls[$args['control_name'] . '_autoplay'] = [
            'label'     => esc_html__('Autoplay','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'Video will autoplay on slide change.', 'wpv-bu'),

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_autoplay']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_autoplay']['group'] = $args['group'];
		}
        //Navigation controls----------------------------------------
        $widget->controls[$args['control_name'] . '_navigation_separator'] = [
            'label'     => esc_html__('Navigation','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_navigation_separator']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_navigation_separator']['group'] = $args['group'];
		}
        // navigation controls
        $widget->controls[$args['control_name'] . '_navigation'] = [
            'label'     => esc_html__('Navigation','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_navigation']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_navigation']['group'] = $args['group'];
		}
        // enable Arrows
        $widget->controls[$args['control_name'] . '_enable_arrows'] = [
            'label'     => esc_html__('Enable Arrows','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_enable_arrows']['required'] = array_merge($widget->controls[$args['control_name'] . '_enable_arrows']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_enable_arrows']['group'] = $args['group'];
		}
        // enable drag
        $widget->controls[$args['control_name'] . '_enable_drag'] = [
            'label'     => esc_html__('Enable Drag','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_enable_drag']['required'] = array_merge($widget->controls[$args['control_name'] . '_enable_drag']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_enable_drag']['group'] = $args['group'];
		}
        // enable swipe
        $widget->controls[$args['control_name'] . '_enable_swipe'] = [
            'label'     => esc_html__('Enable Swipe','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_enable_swipe']['required'] = array_merge($widget->controls[$args['control_name'] . '_enable_swipe']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_enable_swipe']['group'] = $args['group'];
		}
        // enable keypress
        $widget->controls[$args['control_name'] . '_enable_keypress'] = [
            'label'     => esc_html__('Keyboard','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_enable_keypress']['required'] = array_merge($widget->controls[$args['control_name'] . '_enable_keypress']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_enable_keypress']['group'] = $args['group'];
		}
        // enable mouse wheel
        $widget->controls[$args['control_name'] . '_enable_mousewheel'] = [
            'label'     => esc_html__('Mouse Wheel','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_enable_mousewheel']['required'] = array_merge($widget->controls[$args['control_name'] . '_enable_mousewheel']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_enable_mousewheel']['group'] = $args['group'];
		}
        // next html
        $widget->controls[$args['control_name'] . '_nextHtml'] = [
            'label'     => esc_html__('Next','wpv-bu'),
            'type'      => 'text',
            'placeholder'   => __('Next Text', 'wpv-bu'),
            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
                [$args['control_name'] . '_enable_arrows', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_nextHtml']['required'] = array_merge($widget->controls[$args['control_name'] . '_nextHtml']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_nextHtml']['group'] = $args['group'];
		}
        // prev html
        $widget->controls[$args['control_name'] . '_prevHtml'] = [
            'label'     => esc_html__('Previous','wpv-bu'),
            'type'      => 'text',
            'placeholder'   => __('Previous Text', 'wpv-bu'),

            'required' => [
                [$args['control_name'] . '_navigation', '=', true],
                [$args['control_name'] . '_enable_arrows', '=', true],

            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_prevHtml']['required'] = array_merge($widget->controls[$args['control_name'] . '_prevHtml']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_prevHtml']['group'] = $args['group'];
		}
        // rotate controls-----------------------------
        $widget->controls[$args['control_name'] . '_rotate_separator'] = [
            'label'     => esc_html__('Rotate','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_rotate_separator']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_rotate_separator']['group'] = $args['group'];
		}
        // rotate controls
        $widget->controls[$args['control_name'] . '_rotation'] = [
            'label'     => esc_html__('Rotate','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_rotation']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_rotation']['group'] = $args['group'];
		}
        //rotate speed
        $widget->controls[$args['control_name'] . '_rotate_speed'] = [
            'label'     => esc_html__('Speed','wpv-bu'),
            'type'      => 'number',
            'units'     => false,
            'required'  => [
                [$args['control_name'] . '_rotation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_rotate_speed']['required'] = array_merge($widget->controls[$args['control_name'] . '_rotate_speed']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_rotate_speed']['group'] = $args['group'];
		}
        // rotateleft controls
        $widget->controls[$args['control_name'] . '_rotateLeft'] = [
            'label'     => esc_html__('Rotate Left','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'Whether the rotate left button should be visible or not.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_rotation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_rotateLeft']['required'] = array_merge($widget->controls[$args['control_name'] . '_rotateLeft']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_rotateLeft']['group'] = $args['group'];
		}
        // rotateright controls
        $widget->controls[$args['control_name'] . '_rotateRight'] = [
            'label'     => esc_html__('Rotate Right','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'Whether the rotate right button should be visible or not.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_rotation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_rotateRight']['required'] = array_merge($widget->controls[$args['control_name'] . '_rotateRight']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_rotateRight']['group'] = $args['group'];
		}
        // flip horizontal controls
        $widget->controls[$args['control_name'] . '_flipHrz'] = [
            'label'     => esc_html__('Flip Horizontal','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'Whether the flip horizontal button should be visible or not.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_rotation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_flipHrz']['required'] = array_merge($widget->controls[$args['control_name'] . '_flipHrz']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_flipHrz']['group'] = $args['group'];
		}
        // flip vertical controls
        $widget->controls[$args['control_name'] . '_flipVrt'] = [
            'label'     => esc_html__('Flip Vertical','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'Whether the flip vertical button should be visible or not.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_rotation', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_flipVrt']['required'] = array_merge($widget->controls[$args['control_name'] . '_flipVrt']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_flipVrt']['group'] = $args['group'];
		}
        // thumbnail controls ------------------------------------------
        $widget->controls[$args['control_name'] . '_thumbnail_separator'] = [
            'label'     => esc_html__('Thumbnail','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_thumbnail_separator']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_thumbnail_separator']['group'] = $args['group'];
		}
        // thumbnail controls
        $widget->controls[$args['control_name'] . '_thumbnail'] = [
            'label'     => esc_html__('Thumnail','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_thumbnail']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_thumbnail']['group'] = $args['group'];
		}
        // alignment
        $widget->controls[$args['control_name'] . '_aligthumb'] = [
            'label'     => esc_html__('Alignment','wpv-bu'),
            'type'      => 'select',
            'options'   => [
                'left'  => __('Left', 'wpv-bu'),
                'middle'=> __('Middle', 'wpv-bu'),
                'right' => __('Right', 'wpv-bu'),
            ],
            'inline'    => true,
            'small'     => true,
            'required'  => [
                [$args['control_name'] . '_thumbnail', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_aligthumb']['required'] = array_merge($widget->controls[$args['control_name'] . '_aligthumb']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_aligthumb']['group'] = $args['group'];
		}
        // toggle thumb
        $widget->controls[$args['control_name'] . '_toggleThumb'] = [
            'label'     => esc_html__('Toggle Thumb','wpv-bu'),
            'type'      => 'checkbox',
            'description'  => __( 'Enable toggle captions and thumbnails, not applicable if "Media Overlap" is false.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_thumbnail', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_toggleThumb']['required'] = array_merge($widget->controls[$args['control_name'] . '_toggleThumb']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_toggleThumb']['group'] = $args['group'];
		}
        // width
        $widget->controls[$args['control_name'] . '_thumbnailWidth'] = [
            'label'     => esc_html__('Width','wpv-bu'),
            'type'      => 'number',
            'description'  => __( 'Width of the thumbnail in pixels.', 'wpv-bu'),

            'units'     => false,
            'required'  => [
                [$args['control_name'] . '_thumbnail', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_thumbnailWidth']['required'] = array_merge($widget->controls[$args['control_name'] . '_thumbnailWidth']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_thumbnailWidth']['group'] = $args['group'];
		}
        // height
        $widget->controls[$args['control_name'] . '_thumbnailHeight'] = [
            'label'     => esc_html__('Height','wpv-bu'),
            'type'      => 'number',
            // 'units'      =>  false ,
            'description'  => __( 'Height of the thumbnail in pixels.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_thumbnail', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_thumbnailHeight']['required'] = array_merge($widget->controls[$args['control_name'] . '_thumbnailHeight']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_thumbnailHeight']['group'] = $args['group'];
		}
         // margin
         $widget->controls[$args['control_name'] . '_thumbnailMargin'] = [
            'label'     => esc_html__('Margin','wpv-bu'),
            'type'      => 'number',
            'units'      =>  false ,
            'description'  => __( 'Margin of the thumbnail in pixels.', 'wpv-bu'),

            'required'  => [
                [$args['control_name'] . '_thumbnail', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_thumbnailMargin']['required'] = array_merge($widget->controls[$args['control_name'] . '_thumbnailMargin']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_thumbnailMargin']['group'] = $args['group'];
		}

        //hashurl  controls ------------------------------------------
        $widget->controls[$args['control_name'] . '_hashurl_separator'] = [
            'label'     => esc_html__('Hash Url','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_hashurl_separator']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_hashurl_separator']['group'] = $args['group'];
		}
        // hash url controls
        $widget->controls[$args['control_name'] . '_hashurl'] = [
            'label'     => esc_html__('Hash URL','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_hashurl']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_hashurl']['group'] = $args['group'];
		}
        // hash url controls
        $widget->controls[$args['control_name'] . '_customSlide'] = [
            'label'     => esc_html__('Custom Slide Name','wpv-bu'),
            'type'      => 'checkbox',
            'required'  => [
                [$args['control_name'] . '_hashurl', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_customSlide']['required'] = array_merge($widget->controls[$args['control_name'] . '_customSlide']['required'], $args['required']);

		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_customSlide']['group'] = $args['group'];
		}
        // gallery id controls
        $widget->controls[$args['control_name'] . '_hashgalleryid'] = [
            'label'     => esc_html__('Gallery Id','wpv-bu'),
            'type'      => 'text',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_customSlide', '=', true],
                [$args['control_name'] . '_hashurl', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_hashgalleryid']['required'] = array_merge($widget->controls[$args['control_name'] . '_hashgalleryid']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_hashgalleryid']['group'] = $args['group'];
		}
        //share  controls ------------------------------------------
        $widget->controls[$args['control_name'] . '_share_separator'] = [
            'label'     => esc_html__('Share','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_share_separator']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_share_separator']['group'] = $args['group'];
		}
        // share controls
        $widget->controls[$args['control_name'] . '_share'] = [
            'label'     => esc_html__('Share','wpv-bu'),
            'type'      => 'checkbox',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_share']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_share']['group'] = $args['group'];
		}
        // facebook controls
        $widget->controls[$args['control_name'] . '_shareFacebook'] = [
            'label'     => esc_html__('Facebook','wpv-bu'),
            'type'      => 'checkbox',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_shareFacebook']['required'] = array_merge($widget->controls[$args['control_name'] . '_shareFacebook']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_shareFacebook']['group'] = $args['group'];
		}
        // facebook
        $widget->controls[$args['control_name'] . '_shareFacebook'] = [
            'label'     => esc_html__('Facebook','wpv-bu'),
            'type'      => 'checkbox',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_shareFacebook']['required'] = array_merge($widget->controls[$args['control_name'] . '_shareFacebook']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_shareFacebook']['group'] = $args['group'];
		}
        //facebook text
        $widget->controls[$args['control_name'] . '_shareFbdropdownText'] = [
            'label'     => esc_html__('Facebook Text','wpv-bu'),
            'type'      => 'text',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
                [$args['control_name'] . '_shareFacebook', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_shareFbdropdownText']['required'] = array_merge($widget->controls[$args['control_name'] . '_shareFbdropdownText']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_shareFbdropdownText']['group'] = $args['group'];
		}
        // Twitter
        $widget->controls[$args['control_name'] . '_shareTwitter'] = [
            'label'     => esc_html__('Twitter','wpv-bu'),
            'type'      => 'checkbox',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_shareTwitter']['required'] = array_merge($widget->controls[$args['control_name'] . '_shareTwitter']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_shareTwitter']['group'] = $args['group'];
		}
        //Twitter text
        $widget->controls[$args['control_name'] . '_shareTwitterdropdownText'] = [
            'label'     => esc_html__('Twitter Text','wpv-bu'),
            'type'      => 'text',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
                [$args['control_name'] . '_shareTwitter', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_shareTwitterdropdownText']['required'] = array_merge($widget->controls[$args['control_name'] . '_shareTwitterdropdownText']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_shareTwitterdropdownText']['group'] = $args['group'];
		}

        // Pinterest
        $widget->controls[$args['control_name'] . '_sharePinterest'] = [
            'label'     => esc_html__('Pinterest','wpv-bu'),
            'type'      => 'checkbox',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_sharePinterest']['required'] = array_merge($widget->controls[$args['control_name'] . '_sharePinterest']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_sharePinterest']['group'] = $args['group'];
		}
        //Pinterest text
        $widget->controls[$args['control_name'] . '_sharePindropdownText'] = [
            'label'     => esc_html__('Pinterest Text','wpv-bu'),
            'type'      => 'text',
            'inline'    => true,
            'required'  => [
                [$args['control_name'] . '_share', '=', true],
                [$args['control_name'] . '_sharePinterest', '=', true],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_sharePindropdownText']['required'] = array_merge($widget->controls[$args['control_name'] . '_sharePindropdownText']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_sharePindropdownText']['group'] = $args['group'];
		}


    }

    public static function get_lightgallery_data($settings,$controlName){
        // $controlName should be exactly same to the name $args['control_name] given at the time of creating controls in add_lightgallery_controls() function.
        $lightgallery_data = [];
        $lightgallery_data['loop']  = isset($settings[$controlName. '_loop']) ? $settings[$controlName. '_loop'] : false;
        $lightgallery_data['speed'] = isset($settings[$controlName.'_speed']) ? (int)$settings[$controlName.'_speed'] : 500;
		$lightgallery_data['slideDelay']    = isset($settings[$controlName.'_slide_delay']) ? (int)$settings[$controlName.'_slide_delay'] : 0;
		$lightgallery_data['fullScreen']    = isset($settings[$controlName.'_fullscreen']) ? $settings[$controlName.'_fullscreen'] : false;
        $lightgallery_data['zoom']  = isset($settings[$controlName.'_zoom']) ? $settings[$controlName.'_zoom'] : false;
        $lightgallery_data['counter']   = isset($settings[$controlName.'_counter']) ? $settings[$controlName.'_counter'] : false;
        $lightgallery_data['download']  = isset($settings[$controlName.'_download']) ? $settings[$controlName.'_download'] : false;
        $lightgallery_data['allowMediaOverlap']  = isset($settings[$controlName.'_media_overlap']) ? $settings[$controlName.'_media_overlap'] : false;
		$lightgallery_data['closeOnTap']    = isset($settings[$controlName.'_close_on_tap']) ? $settings[$controlName.'_close_on_tap'] : false;
        $lightgallery_data['escKey']    = isset($settings[$controlName.'_esc_key']) ? $settings[$controlName.'_esc_key'] : false ;
        // video
        $lightgallery_data['autoplayVideoOnSlide'] = isset($settings[$controlName.'_autoplay']) ? $settings[$controlName.'_autoplay'] : false;
        // navigation
        $lightgallery_data['controls'] = isset($settings[$controlName.'_enable_arrows']) ? $settings[$controlName.'_enable_arrows'] : false;
        $lightgallery_data['enableDrag'] = isset($settings[$controlName.'_enable_drag']) ? $settings[$controlName.'_enable_drag'] : false;
        $lightgallery_data['enableSwipe'] = isset($settings[$controlName.'_enable_swipe']) ? $settings[$controlName.'_enable_swipe'] : false;
        $lightgallery_data['keyPress'] = isset($settings[$controlName.'_enable_keypress']) ? $settings[$controlName.'_enable_keypress'] : false;
        $lightgallery_data['mousewheel'] = isset($settings[$controlName.'_enable_mousewheel']) ? $settings[$controlName.'_enable_mousewheel'] : false;
        $lightgallery_data['nextHtml'] = !empty($settings[$controlName.'_nextHtml']) ? $settings[$controlName.'_nextHtml'] : "";
        $lightgallery_data['prevHtml'] = !empty($settings[$controlName.'_prevHtml']) ? $settings[$controlName.'_prevHtml'] : "";
        // rotation 
        $lightgallery_data['rotate']    = isset($settings[$controlName.'_rotation']) ? $settings[$controlName.'_rotation'] : false;
        $lightgallery_data['rotateSpeed']    = isset($settings[$controlName.'_rotate_speed']) ? (int)$settings[$controlName.'_rotate_speed'] : 400;
        $lightgallery_data['rotateLeft']    = isset($settings[$controlName.'_rotateLeft']) ? $settings[$controlName.'_rotateLeft'] : false;
        $lightgallery_data['rotateRight']    = isset($settings[$controlName.'_rotateRight']) ? $settings[$controlName.'_rotateRight'] : false;
        $lightgallery_data['flipHorizontal']    = isset($settings[$controlName.'_flipHrz']) ? $settings[$controlName.'_flipHrz'] : false;
        $lightgallery_data['flipVertical']    = isset($settings[$controlName.'_flipVrt']) ? $settings[$controlName.'_flipVrt'] : false;
        // thumbnail
        $lightgallery_data['thumbnails']    = isset($settings[$controlName.'_thumbnail']) ? $settings[$controlName.'_thumbnail'] : false;
        $lightgallery_data['alignThumbnails']   = isset($settings[$controlName.'_aligthumb']) ? $settings[$controlName.'_aligthumb'] : "bottom";
        $lightgallery_data['toggleThumb']   = isset($settings[$controlName.'_toggleThumb']) ? $settings[$controlName.'_toggleThumb'] : false;
        $lightgallery_data['thumbWidth']   = isset($settings[$controlName.'_thumbnailWidth']) ? (int)$settings[$controlName.'_thumbnailWidth'] : "100px";
        $lightgallery_data['thumbHeight']   = isset($settings[$controlName.'_thumbnailHeight']) ? $settings[$controlName.'_thumbnailHeight'] : "80px";
        $lightgallery_data['thumbMargin']   = isset($settings[$controlName.'_thumbnailMargin']) ? (int)$settings[$controlName.'_thumbnailMargin'] : 5;
        // hash url
        $lightgallery_data['hash'] = isset($settings[$controlName.'_hashurl']) ? $settings[$controlName.'_hashurl'] : false;
        $lightgallery_data['customSlideName'] = isset($settings[$controlName.'_customSlide']) ? $settings[$controlName.'_customSlide'] : false;
        $lightgallery_data['galleryId'] = isset($settings[$controlName.'_hashgalleryid']) ? $settings[$controlName.'_hashgalleryid'] : "1";
        // share
        $lightgallery_data['share'] = isset($settings[$controlName.'_share']) ? $settings[$controlName.'_share'] : false;
        $lightgallery_data['facebook'] = isset($settings[$controlName.'_shareFacebook']) ? $settings[$controlName.'_shareFacebook'] : false;
        $lightgallery_data['twitter'] = isset($settings[$controlName.'_shareTwitter']) ? $settings[$controlName.'_shareTwitter'] : false;
        $lightgallery_data['pinterest'] = isset($settings[$controlName.'_sharePinterest']) ? $settings[$controlName.'_sharePinterest'] : false;
        $lightgallery_data['facebookDropdownText'] = isset($settings[$controlName.'_shareFbdropdownText']) ? $settings[$controlName.'_shareFbdropdownText'] : "Facebook";
        $lightgallery_data['twitterDropdownText'] = isset($settings[$controlName.'_shareTwitterdropdownText']) ? $settings[$controlName.'_shareTwitterdropdownText'] : "Twitter";
        $lightgallery_data['pinterestDropdownText'] = isset($settings[$controlName.'_sharePindropdownText']) ? $settings[$controlName.'_sharePindropdownText'] : "Pinterest";
        $lightgallery_data['swipeDirection'] = is_rtl() ? 'right' : 'left';
        if(isset($settings[$controlName.'_enableDelay'])){
            $lightgallery_data['hideBarsDelay'] = isset($settings[$controlName.'_hidebar_delay']) ? (int)$settings[$controlName.'_hidebar_delay'] : 1000;
        }
        else{
            $lightgallery_data['hideBarsDelay'] = 0;
        }


        return $lightgallery_data;
    }

    
}




?>