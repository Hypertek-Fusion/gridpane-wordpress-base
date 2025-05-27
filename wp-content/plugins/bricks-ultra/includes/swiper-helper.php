<?php 
namespace BricksUltra\includes;

use Bricks\Element;
use Bricks\Helpers;
use Bricks\Breakpoints;
use BricksUltra\Plugin;


class Swiper_helper{

    public function add_swiper_controls($widget, $args){
        // default values settings
        $default_values = [
            'control_name'      => 'swiper',
            'tab'               => 'content',
            'effect'            => 'slide',
            'slides_per_view'   => 3,
            'slides_per_group'  => 1,
            'space_between'     => 20,
            'speed'             => 1500,
            'auto_delay'        => 900,
            'pagination'        => 'bullets',
            'nav_position'      => 'inside',
            'nav_h_position'    => 'center',
            'nav_v_position'    => 'middle',

            // checkboxes
            'loop'              => true,
            'autoplay'          => false,
            'pause_on_interaction' => false,
            'pause_on_hover'    => false,
            'auto_height'        => false,
            'clickable'         => true,
            'keyboard'          => true,
            'scrollbar'         => true,
            'navigation'        => true,

            //icon
            'previous_icon'     => [
                'library'   => 'ionicons',
                'icon'      => 'ion-ios-arrow-back',
            ],
            'next_icon'          => [
                'library'   => 'ionicons',
                'icon'      => 'ion-ios-arrow-forward',
            ],
        ];
        $args = wp_parse_args($args, $default_values);
        // sw is for swiper
        //loop controls
        $widget->controls[$args['control_name'] . '_swLoop'] = [
            'label'     => esc_html__('Loop','wpv-bu'),
            'type'      => 'checkbox',
            'default'   => $args['loop'],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swLoop']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swLoop']['group'] = $args['group'];
		}
        //effects controls
        $widget->controls[$args['control_name'] . '_swEffects'] = [
            'label'     => esc_html__('Effects','wpv-bu'),
            'type'      => 'select',
            'options'   => [
                'slide'     => esc_html__('Slide', 'wpv-bu'),
                'fade'      => esc_html__('Fade', 'wpv-bu'),
                'coverflow' => esc_html__('Coverflow', 'wpv-bu'),
                'flip'      => esc_html__('Flip', 'wpv-bu'),
            ],
            'clearable' => false,
            'default'   => $args['effect'],
            'inline'    => true,
            'small'     => true,

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swEffects']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swEffects']['group'] = $args['group'];
		}
        //slides to show controls
        $widget->controls[$args['control_name'] . '_swSlidesPerView'] = [
            'label'     => esc_html__('Slides Per View','wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'max'           => 40,
            'placeholder'   => $args['slides_per_view'],
            'default'       => $args['slides_per_view'],
            'clearable'     => false,
            'breakpoints'   => true, 
            'rerender'      => true,  
            'required'      => [[$args['control_name'] . '_swEffects', '=', ['slide', 'coverflow']]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swSlidesPerView']['required'] = array_merge($widget->controls[$args['control_name'] . '_swSlidesPerView']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swSlidesPerView']['group'] = $args['group'];
		}
        //slides per group controls
        $widget->controls[$args['control_name'] . '_swSlidesPerGroup'] = [
            'label'         => esc_html__('Slides Per Group','wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'max'           => 12,
            'placeholder'   => $args['slides_per_group'],
            'default'       => $args['slides_per_group'],
            'clearable'     => false,
            'breakpoints'   => true, 
            'rerender'      => true,  
            'required'      => [[$args['control_name'] . '_swEffects', '=', ['slide', 'coverflow']]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swSlidesPerGroup']['required'] = array_merge($widget->controls[$args['control_name'] . '_swSlidesPerGroup']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swSlidesPerGroup']['group'] = $args['group'];
		}
        // Space between
        $widget->controls[$args['control_name'] . '_swSpaceBtw'] = [
            'label'         => esc_html__('Space Between','wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'max'           => 100,
            'placeholder'   => $args['space_between'],
            'default'       => $args['space_between'],
            'clearable'     => false,
            'breakpoints'   => true, 
            'rerender'      => true,  
  
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swSpaceBtw']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swSpaceBtw']['group'] = $args['group'];
		}
        // speed 
        $widget->controls[$args['control_name'] . '_swSpeed'] = [
            'label'         => esc_html__('Speed','wpv-bu'),
            'type'          => 'number',
            'units'         => false,
            'placeholder'   => $args['speed'],
            'default'       => $args['speed'],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swSpeed']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swSpeed']['group'] = $args['group'];
		}
        // autoplay
        $widget->controls[$args['control_name'] . '_swAutoplay'] = [
            'label'         => esc_html__('Autoplay','wpv-bu'),
            'type'          => 'checkbox',  
            'default'       => $args['autoplay'],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swAutoplay']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swAutoplay']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_swInterancation'] = [
            'label'         => esc_html__('Pause On Interaction','wpv-bu'),
            'type'          => 'checkbox',  
            'default'       => $args['pause_on_interaction'],
            'required'      => [
                [$args['control_name'] . '_swAutoplay', '=', true]
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swInterancation']['required'] = array_merge($widget->controls[$args['control_name'] . '_swInterancation']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swInterancation']['group'] = $args['group'];
		}
        // autoplay delay duration
        $widget->controls[$args['control_name'] . '_swDelayDuration'] = [
            'label'         => esc_html__('Duration','wpv-bu'),
            'type'          => 'number',
            'units'         => false,
            'placeholder'   => $args['auto_delay'],
            'default'       => $args['auto_delay'],
            'required'      => [
                [$args['control_name'] . '_swAutoplay', '=', true]
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swDelayDuration']['required'] = array_merge($widget->controls[$args['control_name'] . '_swDelayDuration']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swDelayDuration']['group'] = $args['group'];
		}
        // pause on hover
        $widget->controls[$args['control_name'] . '_swPause'] = [
            'label'         => esc_html__('Pause On Hover','wpv-bu'),
            'type'          => 'checkbox',
            'default'       => $args['pause_on_hover'],
            'required'      => [
                [$args['control_name'] . '_swAutoplay', '=', true]
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swPause']['required'] = array_merge($widget->controls[$args['control_name'] . '_swPause']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swPause']['group'] = $args['group'];
		}
        // auto height
        $widget->controls[$args['control_name'] . '_swAutoheight'] = [
            'label'         => esc_html__('Auto Height','wpv-bu'),
            'type'          => 'checkbox',
            'default'       => $args['auto_height'],  

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swAutoheight']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swAutoheight']['group'] = $args['group'];
		}
        // pagination separator ------------------------------------------
        $widget->controls[$args['control_name'] . '_pagination_separator'] = [
            'label'     => esc_html__('Pagination','wpv-bu'),
            'type'      => 'separator',

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_pagination_separator']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_pagination_separator']['group'] = $args['group'];
		}
        //pagination controls
        $widget->controls[$args['control_name'] . '_swPagination'] = [
            'label'     => esc_html__('Pagination','wpv-bu'),
            'type'      => 'select',
            'options'   => [
                'none'  => esc_html__('None', 'wpv-bu'),
                'bullets'  => esc_html__('Bullets', 'wpv-bu'),
                'fraction'  => esc_html__('Fraction', 'wpv-bu'),
                'progressbar'  => esc_html__('Progress Bar', 'wpv-bu'),
            ],
            'default'   => $args['pagination'],
            'inline'    => true,
            'small'     => true,

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swPagination']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swPagination']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_swPaginationInfo'] = [
            'type'      => 'info',
            'content'   => esc_html__( 'Please check Progress bar on frontend.(It does not work in builder.)', 'bricks' ),
            'required'  => [[$args['control_name'] . '_swPagination', '=', 'progressbar']],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swPaginationInfo']['required'] = array_merge($widget->controls[$args['control_name'] . '_swPaginationInfo']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swPaginationInfo']['group'] = $args['group'];
		}
        // clickable
        $widget->controls[$args['control_name'] . '_swClickable'] = [
            'label'         => esc_html__('Clickable','wpv-bu'),
            'type'          => 'checkbox', 
            'default'       => $args['clickable'] ,

            'required'      => [[$args['control_name'] . '_swPagination', '=', 'bullets']],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swClickable']['required'] = array_merge($widget->controls[$args['control_name'] . '_swClickable']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swClickable']['group'] = $args['group'];
		}
        // Keyboard controls
        $widget->controls[$args['control_name'] . '_swKeyControls'] = [
            'label'         => esc_html__('Keyboard Controls','wpv-bu'),
            'type'          => 'checkbox', 
            'default'       => $args['keyboard'],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swKeyControls']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swKeyControls']['group'] = $args['group'];
		}
        // scroll bar controls
        $widget->controls[$args['control_name'] . '_swScrollbar'] = [
            'label'         => esc_html__('Scroll Bar','wpv-bu'),
            'type'          => 'checkbox', 
            'default'       => $args['scrollbar'],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swScrollbar']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swScrollbar']['group'] = $args['group'];
		}
        // navigation separator ------------------------------------------
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
        $widget->controls[$args['control_name'] . '_swNavigation'] = [
            'label'         => esc_html__('Navigation','wpv-bu'),
            'type'          => 'checkbox', 
            'rerender'      => true,
            'default'       => $args['navigation'],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swNavigation']['required'] = $args['required'];
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swNavigation']['group'] = $args['group'];
		}
        // navigation position controls
        $widget->controls[$args['control_name'] . '_swPosition'] = [
            'label'         => esc_html__('Position','wpv-bu'),
            'type'          => 'select',
            'options'       => [
                'inside'    => __('Inside','wpv-bu'),
                'outside'   => __('Outside','wpv-bu'),
            ],
            'clearable'     => false,
            'default'       => $args['nav_position'],
            'inline'        => true,
            'required'      => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swPosition']['required'] = array_merge($widget->controls[$args['control_name'] . '_swPosition']['required'] , $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swPosition']['group'] = $args['group'];
		}
        // prev icon
        $widget->controls[$args['control_name'] . '_swPrevIcon'] = [
            'label'         => esc_html__('Previous Icon','wpv-bu'),
            'type'          => 'icon',
			'default'       => $args['previous_icon'],
            'required'      =>  [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swPrevIcon']['required'] = array_merge($widget->controls[$args['control_name'] . '_swPrevIcon']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swPrevIcon']['group'] = $args['group'];
		}
        // Next icon
        $widget->controls[$args['control_name'] . '_swNextIcon'] = [
            'label'         => esc_html__('Next Icon','wpv-bu'),
            'type'          => 'icon',
			'default'       => $args['next_icon'],
            'required'      => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swNextIcon']['required'] = array_merge($widget->controls[$args['control_name'] . '_swNextIcon']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swNextIcon']['group'] = $args['group'];
		}
        // navigation position controls
        $widget->controls[$args['control_name'] . '_swHrzPosition'] = [
            'label'         => esc_html__('Horizontal Position','wpv-bu'),
            'type'          => 'select',
            'options'       => [
                'left'      => __('Left','wpv-bu'),
                'center'    => __('Center','wpv-bu'),
                'right'     =>__('Right','wpv-bu'),
            ],
            'clearable'     => false,
            'default'       => $args['nav_h_position'],
            'inline'        => true,
            'required'      => [
                [$args['control_name'] . '_swNavigation', '=', true],
                [$args['control_name'] . '_swPosition', '=', 'inside'],
            ],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swHrzPosition']['required'] = array_merge($widget->controls[$args['control_name'] . '_swHrzPosition']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swHrzPosition']['group'] = $args['group'];
		}
        // navigation position controls
        $widget->controls[$args['control_name'] . '_swVrtPosition'] = [
            'label'         => esc_html__('Vertical Position','wpv-bu'),
            'type'          => 'select',
            'options'       => [
                'top'       => __('Top','wpv-bu'),
                'middle'    => __('Middle','wpv-bu'),
                'bottom'    =>__('Bottom','wpv-bu'),
            ],
            'clearable'     => false,
            'default'       => $args['nav_v_position'],
            'inline'        => true,
            'required'      => [
                [$args['control_name'] . '_swNavigation', '=', true],
                [$args['control_name'] . '_swPosition', '=', 'inside'],
            ],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_swVrtPosition']['required'] = array_merge($widget->controls[$args['control_name'] . '_swVrtPosition']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_swVrtPosition']['group'] = $args['group'];
		}
    }
    public function add_swiper_style_controls($widget, $args){
        // navigation separator ------------------------------------------
        $widget->controls[$args['control_name'] . '_arrows_separator'] = [
            'label'     => esc_html__('Navigation','wpv-bu'),
            'type'      => 'separator',
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrows_separator']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrows_separator']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrows_separator']['group'] = $args['group'];
		}
        //arrow color
        $widget->controls[$args['control_name'] . '_arrowsColor'] = [
            'label'     => esc_html__('Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-prev i',
                ],
                [
                    'property' => 'color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-next i',
                ],
            ],
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrowsColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrowsColor']['group'] = $args['group'];
		}
        //arrow background  color
        $widget->controls[$args['control_name'] . '_arrowsBgColor'] = [
            'label'     => esc_html__('Background','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-prev',
                ],
                [
                    'property' => 'background',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-next',
                ],
            ],
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrowsBgColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsBgColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrowsBgColor']['group'] = $args['group'];
		}
        //arrow border 
        $widget->controls[$args['control_name'] . '_arrowsBorder'] = [
            'label'     => esc_html__('Border','wpv-bu'),
            'type'      => 'border',
            'css'       => [
                [
                    'property' => 'border',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-prev',
                ],
                [
                    'property' => 'border',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-next',
                ],
            ],
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrowsBorder']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsBorder']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrowsBorder']['group'] = $args['group'];
		}
        //arrow border 
        $widget->controls[$args['control_name'] . '_arrowsBoxshd'] = [
            'label'     => esc_html__('Box Shadow','wpv-bu'),
            'type'      => 'box-shadow',
            'css'       => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-prev',
                ],
                [
                    'property' => 'box-shadow',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-next',
                ],
            ],
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrowsBoxshd']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsBoxshd']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrowsBoxshd']['group'] = $args['group'];
		}
        //arrow size
        $widget->controls[$args['control_name'] . '_arrowsSize'] = [
            'label'     => esc_html__('Size','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'font-size',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-prev i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-next i',
                ],
            ],
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrowsSize']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsSize']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrowsSize']['group'] = $args['group'];
		}
        
        //arrow horizontal offset
        $widget->controls[$args['control_name'] . '_arrowsHrzOffset'] = [
            'label'     => esc_html__('Horizontal Offset','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'left',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-hpos-left .bultr-swiper-nav-wrapper',
                ],
                [
                    'property' => 'right',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-hpos-right .bultr-swiper-nav-wrapper',
                ],
                [
                    'property' => 'left',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-hpos-center .bultr-swiper-button-prev',
                ],
                [
                    'property' => 'right',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-hpos-center .bultr-swiper-button-next',
                ],
            ],
            'required'      => [
                [$args['control_name'] . '_swNavigation', '=', true],
                [$args['control_name'] . '_swPosition', '=', 'inside'],
            ],
        ];
        if (isset($args['required'])) {
            $widget->controls[$args['control_name'] . '_arrowsHrzOffset']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsHrzOffset']['required'], $args['required']);
        }
        if (isset($args['group'])) {
            $widget->controls[$args['control_name'] . '_arrowsHrzOffset']['group'] = $args['group'];
        }
        //arrow horizontal offset
        $widget->controls[$args['control_name'] . '_arrowsVrtOffset'] = [
            'label'     => esc_html__('Vertical Offset','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'top',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-vpos-top .bultr-swiper-nav-wrapper',
                ],
                [
                    'property' => 'bottom',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-vpos-bottom .bultr-swiper-nav-wrapper',
                ],
                [
                    'property' => 'top',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-vpos-middle .bultr-swiper-button-prev',
                ],
                [
                    'property' => 'top',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-vpos-middle .bultr-swiper-button-next',
                ],
            ],
            'required'      => [
                [$args['control_name'] . '_swNavigation', '=', true],
                [$args['control_name'] . '_swPosition', '=', 'inside'],
            ],
        ];
        if (isset($args['required'])) {
            $widget->controls[$args['control_name'] . '_arrowsVrtOffset']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsVrtOffset']['required'], $args['required']);
        }
        if (isset($args['group'])) {
            $widget->controls[$args['control_name'] . '_arrowsVrtOffset']['group'] = $args['group'];
        }
        $widget->controls[$args['control_name'] . '_arrowsSpacing'] = [
            'label'     => esc_html__('Gap','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'gap',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-hpos-left .bultr-swiper-nav-wrapper',
                ],
                [
                    'property' => 'gap',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-hpos-right .bultr-swiper-nav-wrapper',
                ],
            ],
            'required'      => [
                [$args['control_name'] . '_swNavigation', '=', true],
                [$args['control_name'] . '_swPosition', '=', 'inside'],
                [$args['control_name'] . '_swHrzPosition', '!=', 'center'],
            ],
        ];
        if (isset($args['required'])) {
            $widget->controls[$args['control_name'] . '_arrowsSpacing']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsSpacing']['required'], $args['required']);
        }
        if (isset($args['group'])) {
            $widget->controls[$args['control_name'] . '_arrowsSpacing']['group'] = $args['group'];
        }


        $widget->controls[$args['control_name'] . '_arrowsGap'] = [
            'label'     => esc_html__('Arrows Gap','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'margin-left',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-swiper-nav-outside .bultr-swiper-container',
                ],
                [
                    'property' => 'margin-right',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper.bultr-swiper-nav-outside .bultr-swiper-container',
                ],

            ],
            'required'      => [
                [$args['control_name'] . '_swNavigation', '=', true],
                [$args['control_name'] . '_swPosition', '=', 'outside'],
            ],
        ];
        if (isset($args['required'])) {
            $widget->controls[$args['control_name'] . '_arrowsGap']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsGap']['required'], $args['required']);
        }
        if (isset($args['group'])) {
            $widget->controls[$args['control_name'] . '_arrowsGap']['group'] = $args['group'];
        }
        //arrow size
        $widget->controls[$args['control_name'] . '_arrowsPadding'] = [
            'label'     => esc_html__('Padding','wpv-bu'),
            'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-prev',
                ],
                [
                    'property' => 'padding',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-button-next',
                ],
            ],
            'required'  => [[$args['control_name'] . '_swNavigation', '=', true]],

        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_arrowsPadding']['required'] = array_merge($widget->controls[$args['control_name'] . '_arrowsPadding']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_arrowsPadding']['group'] = $args['group'];
		}
        // PAGINATION separator ------------------------------------------
        $widget->controls[$args['control_name'] . '_dots_separator'] = [
            'label'     => esc_html__('Pagination','wpv-bu'),
            'type'      => 'separator',
            'required'      => [[$args['control_name'] . '_swPagination', '!=', ['','none']]],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dots_separator']['required'] = array_merge($widget->controls[$args['control_name'] . '_dots_separator']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dots_separator']['group'] = $args['group'];
		}
        // PAGINATION size ------------------------------------------
        
        $widget->controls[$args['control_name'] . '_dotsSize'] = [
            'label'     => esc_html__('Size','wpv-bu'),
            'type'      => 'number',
            'units'     => true,

            'css'       => [
                [
                    'property' => 'width',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-pagination-bullet',
                ],
                [
                    'property' => 'height',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-pagination-bullet',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'bullets']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsSize']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsSize']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsSize']['group'] = $args['group'];
		}
        // PAGINATION BULLETS ------------------------------------------
        $widget->controls[$args['control_name'] . '_dotsActiveColor'] = [
            'label'     => esc_html__('Active Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-pagination-bullet.swiper-pagination-bullet-active',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'bullets']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsActiveColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsActiveColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsActiveColor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsInactiveColor'] = [
            'label'     => esc_html__('Inactive Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-pagination-bullet',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'bullets']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsInactiveColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsInactiveColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsInactiveColor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsTopOffset'] = [
            'label'     => esc_html__('Top offset','wpv-bu'),
            'type'      => 'number',
            'units'     => true,

            'css'       => [
                [
                    'property' => 'margin-bottom',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-wrapper',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'bullets']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsTopOffset']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsTopOffset']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsTopOffset']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsMargin'] = [
            'label'     => esc_html__('Bottom offset','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'margin-bottom',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-bullets',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'bullets']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsMargin']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsMargin']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsMargin']['group'] = $args['group'];
		}
        
       
        // PAGINATION Fraction ------------------------------------------
        $widget->controls[$args['control_name'] . '_dotsBgcolor'] = [
            'label'     => esc_html__('Background Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-fraction',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'fraction']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsBgcolor']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsBgcolor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsBgcolor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsColor'] = [
            'label'     => esc_html__('Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-fraction',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'fraction']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsColor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsFont'] = [
            'label'     => esc_html__('Typography','wpv-bu'),
            'type'      => 'typography',
            'css'       => [
                [
                    'property' => 'font',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-fraction',
                ],
            ],
            'exclude'   => [

                'text-align',
                'text-transform',
                'color',
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'fraction']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsFont']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsFont']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsFont']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsfTopOffset'] = [
            'label'     => esc_html__('Top offset','wpv-bu'),
            'type'      => 'number',
            'units'     => true,

            'css'       => [
                [
                    'property' => 'margin-bottom',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-wrapper',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'fraction']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsfTopOffset']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsfTopOffset']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsfTopOffset']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_dotsbottomoffset'] = [
            'label'     => esc_html__('Bottom offset','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'margin-bottom',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-fraction',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'fraction']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsbottomoffset']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsbottomoffset']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsbottomoffset']['group'] = $args['group'];
		}

        $widget->controls[$args['control_name'] . '_dotsPadding'] = [
            'label'     => esc_html__('Padding','wpv-bu'),
            'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-fraction',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'fraction']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_dotsPadding']['required'] = array_merge($widget->controls[$args['control_name'] . '_dotsPadding']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_dotsPadding']['group'] = $args['group'];
		}
        // PAGINATION PROGRESSBAR
        $widget->controls[$args['control_name'] . '_barColor'] = [
            'label'     => esc_html__('Progress Bar Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-progressbar',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'progressbar']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_barColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_barColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_barColor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_progressbarColor'] = [
            'label'     => esc_html__('Progress Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'progressbar']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_progressbarColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_progressbarColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_progressbarColor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_barSize'] = [
            'label'     => esc_html__('Size','wpv-bu'),
            'type'      => 'number',
            'units'     => true,

            'css'       => [
                [
                    'property' => 'height',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-progressbar',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'progressbar']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_barSize']['required'] = array_merge($widget->controls[$args['control_name'] . '_barSize']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_barSize']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_barMargin'] = [
            'label'     => esc_html__('Margin','wpv-bu'),
            'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'margin',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .bultr-swiper-pagination.swiper-pagination-progressbar',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swPagination', '=', 'progressbar']],
        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_barMargin']['required'] = array_merge($widget->controls[$args['control_name'] . '_barMargin']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_barMargin']['group'] = $args['group'];
		}
        // scrollbar 
        $widget->controls[$args['control_name'] . '_scrollbarSep'] = [
            'label'     => esc_html__('Scrollbar','wpv-bu'),
            'type'      => 'separator',
            'required'      => [[$args['control_name'] . '_swScrollbar', '=', true]],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_scrollbarSep']['required'] = array_merge($widget->controls[$args['control_name'] . '_scrollbarSep']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_scrollbarSep']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_scrollbarSize'] = [
            'label'     => esc_html__('Size','wpv-bu'),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'height',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-scrollbar',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swScrollbar', '=', true]],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_scrollbarSize']['required'] = array_merge($widget->controls[$args['control_name'] . '_scrollbarSize']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_scrollbarSize']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_scrollbarDragColor'] = [
            'label'     => esc_html__('Drag Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-scrollbar .swiper-scrollbar-drag',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swScrollbar', '=', true]],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_scrollbarDragColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_scrollbarDragColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_scrollbarDragColor']['group'] = $args['group'];
		}
        $widget->controls[$args['control_name'] . '_scrollbarColor'] = [
            'label'     => esc_html__('Color','wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'background-color',
                    'selector' => '&'.$args['wrapper-class'] . ' .bultr-swiper-outer-wrapper .swiper-scrollbar',
                ],
            ],
            'required'      => [[$args['control_name'] . '_swScrollbar', '=', true]],


        ];
        if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_scrollbarColor']['required'] = array_merge($widget->controls[$args['control_name'] . '_scrollbarColor']['required'], $args['required']);
		}
        if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_scrollbarColor']['group'] = $args['group'];
		}

    }
    public static function get_swiper_data($settings, $controlName){
        // echo "<pre>"; print_r($settings); echo "</pre>";
        $effect = isset($settings[$controlName.'_swEffects']) ? $settings[$controlName.'_swEffects']  :  'slide';
        $swiper_data = [];
        $swiper_data['direction'] = 'horizontal';
        $swiper_data['effect'] =   isset($effect) ?  $effect : 'slide';
        $swiper_data['sliderPerView'] = isset($settings[$controlName.'_swSlidesPerView']) ?  (int)$settings[$controlName.'_swSlidesPerView'] : 3;
        $swiper_data['slidesPerGroup'] = isset($settings[$controlName.'_swSlidesPerGroup']) ?  (int)$settings[$controlName.'_swSlidesPerGroup'] : 1000;
        $swiper_data['spaceBetween'] = isset($settings[$controlName.'_swSpaceBtw']) ?  (int)$settings[$controlName.'_swSpaceBtw'] : 10;
        $swiper_data['loop'] =   isset($settings[$controlName.'_swLoop']) ?  $settings[$controlName.'_swLoop'] : false;
        $swiper_data['speed'] =   isset($settings[$controlName.'_swSpeed']) ?  (int)$settings[$controlName.'_swSpeed'] : 1000;
        $swiper_data['autoheight'] =   isset($settings[$controlName.'_swAutoheight']) ?  $settings[$controlName.'_swAutoheight'] : false;
        $swiper_data['scrollbar'] =   isset($settings[$controlName.'_swScrollbar']) ?  $settings[$controlName.'_swScrollbar'] : false;
        $swiper_data['keyboard'] =   isset($settings[$controlName.'_swKeyControls']) ?  $settings[$controlName.'_swKeyControls'] : false;


        // autoplay data
        if(isset($settings[$controlName.'_swAutoplay'])){
            $sw_autoplay = [
                'delay' =>  isset($settings[$controlName.'_swDelayDuration']) ? (int)$settings[$controlName.'_swDelayDuration'] : 900,
                'pauseOnMouseEnter'    => isset($settings[$controlName.'_swPause']) ?  $settings[$controlName.'_swPause'] : false,
                'disableOnInteraction' => isset($settings[$controlName.'_swInterancation']) ?  true : false,
            ];
            $swiper_data['autoplay'] = $sw_autoplay;
        }
        //pagination
        if(isset($settings[$controlName.'_swPagination']) && $settings[$controlName.'_swPagination'] != 'none'){
            $sw_pagination = [
                'type'  => isset($settings[$controlName.'_swPagination']) ? $settings[$controlName.'_swPagination'] : 'bullets',
                'clickable' => isset($settings[$controlName.'_swClickable']) ?  $settings[$controlName.'_swClickable'] : false,
            ];
            $swiper_data['pagination']  = $sw_pagination;
        }
        // navigation
        if(isset($settings[$controlName.'_swNavigation'])){
            $swiper_data['navigation']  = true;
        }
        



        // breakpoints setting for effect slide and coverflow
        $singleSlideEffects = ['flip', 'fade'];
        if(in_array($effect, $singleSlideEffects)){
            $swiper_data['sliderPerView'] = 1;
            $swiper_data['slidesPerGroup'] = 1;
        }else{
            $breakpoint_options = self::get_swiper_breakpoints_options( $settings, $controlName);
            $swiper_data['breakpoints'] = $breakpoint_options;
        }
        return $swiper_data;
    }

    public static function get_swiper_breakpoints_options( $settings,$controlName ) {

        //declared variables to create widget name
        $slidesPerView = $controlName.'_swSlidesPerView';
        $slidesPerGroup = $controlName.'_swSlidesPerGroup';
        $spaceBetween = $controlName.'_swSpaceBtw';



        $breakpoint_option = [];
        $breakpoints_data = Breakpoints::get_breakpoints();
        $length = count($breakpoints_data);
        foreach($breakpoints_data as $key => $value){      
            if($key === $length-1){
                $smallestDevice = $value['key'];
            }
        }
    
        $breakpoints_len  = count( $breakpoints_data );
        $defaultPerPage   = isset($settings[$slidesPerView]) ? (int)$settings[$slidesPerView] : 3;
        $defaultPerGroup  = isset($settings[$slidesPerGroup]) ? (int)$settings[$slidesPerGroup] : 1;
        $defaultGap       = 13;
        $baseDevice       = Plugin::$buBaseDevice;
    
        if($baseDevice === 'desktop'){
            $defaultPerPage   = isset($settings[$slidesPerView]) ? (int)$settings[$slidesPerView] : 3;
            $defaultPerGroup  = isset($settings[$slidesPerGroup]) ? (int)$settings[$slidesPerGroup] : 1;
            $defaultGap       = isset($settings[$spaceBetween]) ? (int)$settings[$spaceBetween] : 20;
        }
        else{
            $defaultPerPage   = isset($settings[$slidesPerView.':'.$baseDevice]) ? (int)$settings[$slidesPerView.':'.$baseDevice] : $defaultPerPage;
            $defaultPerGroup  = isset($settings[$slidesPerGroup.':'.$baseDevice]) ? (int)$settings[$slidesPerGroup.':'.$baseDevice] : $defaultPerGroup;
            $defaultGap       = isset($settings[$spaceBetween.':'.$baseDevice]) ? $settings[$spaceBetween.':'.$baseDevice] :  $defaultGap;
        }
    
        for($i = 0; $i < $breakpoints_len; $i++){

            
            if($breakpoints_data[$i]['key'] === 'desktop')
            {  
                $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                [
                    'slidesPerView'     => isset($settings[$slidesPerView]) ? (int)$settings[$slidesPerView] : $defaultPerPage,
                    'slidesPerGroup'    => isset($settings[$slidesPerGroup]) ? (int)$settings[$slidesPerGroup] : $defaultPerGroup,
                    'spaceBetween'      => isset($settings[$spaceBetween]) ? (int)$settings[$spaceBetween] :  $defaultGap,
                    'deviceLabel'       => $breakpoints_data[ $i ]['key'],

                ];
            }
            else{
                if($breakpoints_data[$i]['key'] !=  $smallestDevice){
                    $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                    [
                        'slidesPerView' => isset($settings[$slidesPerView .':'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings[$slidesPerView.':'. $breakpoints_data[ $i ]['key']]  : $defaultPerPage,
                        'slidesPerGroup' => isset($settings[$slidesPerGroup.':'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings[$slidesPerGroup.':'. $breakpoints_data[ $i ]['key']]  : $defaultPerGroup,
                        'spaceBetween' => isset($settings[$spaceBetween.':'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings[$spaceBetween.':'. $breakpoints_data[ $i ]['key']]  : $defaultGap,
                        'deviceLabel' => $breakpoints_data[ $i ]['key'],
                    ];
                }
                else{
                    $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                    [
                        'slidesPerView' => isset($settings[$slidesPerView.':'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings[$slidesPerView.':'. $breakpoints_data[ $i ]['key']]  : 1,
                        'slidesPerGroup' => isset($settings[$slidesPerGroup.':'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings[$slidesPerGroup.':'. $breakpoints_data[ $i ]['key']]  : 1,
                        'spaceBetween' => isset($settings[$spaceBetween.':'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings[$spaceBetween.':'. $breakpoints_data[ $i ]['key']]  : $defaultGap,
                        'deviceLabel' => $breakpoints_data[ $i ]['key'],
                    ];
                }
                
            }

        }
        $breakData = $breakpoint_option['breakpoints'];
    
        return $breakData;
    }
    public static function render_swiper_pagination($settings,$controlName){
        if(isset($settings[$controlName.'_swPagination']) && $settings[$controlName.'_swPagination'] != 'none'){
            ?>
			    <div class = "bultr-swiper-pagination swiper-pagination"></div>
            <?php
        }

    }
    public static function render_swiper_scrollbar($settings,$controlName){
        if(isset($settings[$controlName.'_swScrollbar'])){
            ?>
			    <div class = "bultr-swiper-scrollbar swiper-scrollbar"></div>
            <?php
        }

    }
    public static function render_swiper_navigation($settings,$controlName){
        $hrzPosition = isset($settings[$controlName . '_swHrzPosition']);
        $position =    isset($settings[$controlName . '_swPosition']);
        $navigation = isset($settings[$controlName.'_swNavigation']) ? true : false;
        if($navigation){
            if((isset($position) && $settings[$controlName . '_swPosition'] === 'inside') && isset($hrzPosition)){
                if($settings[$controlName . '_swHrzPosition'] === "left" || $settings[$controlName . '_swHrzPosition'] === "right"){
                    ?>
                    <div class = "bultr-swiper-nav-wrapper">
                    <?php
                }
            }
            
            if(!empty($settings[$controlName.'_swPrevIcon'])){
                $prev_arrow = Element::render_icon($settings[$controlName.'_swPrevIcon']);
                ?>
    
                <div class = 'bultr-swiper-button-prev previous swiper-button-prev'>
                    <?php echo $prev_arrow; ?>
                </div>
                <?php
            }
            if(!empty($settings[$controlName.'_swNextIcon'])){
                $next_arrow = Element::render_icon($settings[$controlName.'_swNextIcon']);
                ?>
                <div class = 'bultr-swiper-button-next next swiper-button-next'> <?php echo $next_arrow; ?> </div>
                <?php
            }
            if((isset($position) && $settings[$controlName . '_swPosition'] === 'inside') && isset($hrzPosition)){
                if($settings[$controlName . '_swHrzPosition'] === "left" || $settings[$controlName . '_swHrzPosition'] === "right"){
                    ?>
                    </div>
                    <?php
                }
            }
        }
        
    }


}
?>