<?php

namespace BricksUltra\includes\VideoBox;

use Bricks\Element;
use BricksUltra\includes\Plugin;
use BricksUltra\Plugin as BricksUltraPlugin;

class Module extends Element
{
    public $category     = 'ultra';
    public $name         = 'wpvbu-video-box';
    public $icon         = 'ion-md-play-circle';
    public $css_selector = '';
    public $scripts      = ['buVideoBox'];
    public $loop_index   = 0;
    public function get_label()
    {
        return esc_html__('Video Box', 'wpv-bu');
    }
    public function get_keywords()
    {
        return ['video', 'video-box', 'youtube', 'player', 'media'];
    }
    public function enqueue_scripts()
    {
        $lightbox = isset($this->settings['vb_lightbox']) ? true : false;
        if($lightbox === true){
            wp_enqueue_script( 'bultr-lightgallery-script');
            wp_enqueue_script( 'bu-lg-video-js');
            wp_enqueue_script( 'bu-lg-fullscreen-js');
            wp_enqueue_script( 'bu-lg-hash-js');
            wp_enqueue_script( 'bu-lg-share-js');
            wp_enqueue_style('bultr-lightgallery-style');
            if(isset($this->settings['vb_video_type']) && $this->settings['vb_video_type'] === 'vimeo'){
                wp_enqueue_script( 'bu-player-js');
            }
            if(isset($this->settings['vb_video_type']) && $this->settings['vb_video_type'] === 'hosted'){
                wp_enqueue_script( 'bu-video-js');
            }


        }
        wp_enqueue_style('bultr-module-style');
        wp_enqueue_script('bultr-module-script');
        wp_enqueue_script( 'bultr-waypoint', WPV_BU_URL . 'assets/vendor/waypoint/waypoints.js', [], '0.0.1', true );

    }

    public function set_control_groups()
    {
        $this->control_groups['video_settings'] = [
            'title' => esc_html__('Video', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['video_overlay'] = [
            'title' => esc_html__('Thumbnail & Overlay', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['video_playIcon'] = [
            'title' => esc_html__('Play Button', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['video_sticky'] = [
            'title' => esc_html__('Sticky Video', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['video_schema'] = [
            'title' => esc_html__('Video Schema', 'wpv-bu'),
            'tab'   => 'content',
        ];
        
        $this->control_groups['video_style'] = [
            'title' => esc_html__('Video Style', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['video_details'] = [
            'title' => esc_html__('Video Details Style', 'wpv-bu'),
            'tab'   => 'content',
            'required' => ['vb_enableDetails', '=', true],
        ];

        
        
    }

    public function set_controls(){

        $this->controls['vb_video_type'] = [
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Video Type', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'youtube'       => esc_html__( 'YouTube', 'wpv-bu' ),
                'vimeo'         => esc_html__( 'Vimeo', 'wpv-bu' ),
                'wistia'        => esc_html__( 'Wistia', 'wpv-bu' ),
                'dailymotion'   => esc_html__( 'Dailymotion', 'wpv-bu' ),
                'hosted'        => esc_html__( 'Self Hosted', 'wpv-bu' ),
            ],
            'default'  => 'youtube',
            'inline'   => true,
            'small'    => true,
        ];

        $this->get_youtube_controls();
        $this->get_vimeo_controls();
        $this->get_wistia_controls();
        $this->get_dailymotion_controls();
        $this->get_hosted_controls();

        $this->controls['vb_start_time']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Start Time', 'wpv-bu'),
            'type'    => 'number',
            'description' => __( 'Specify a start time (in seconds)', 'wpv-bu' ),
            'required' => ['vb_video_type','!=', 'wistia'],

        ];
        $this->controls['vb_end_time']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('End Time', 'wpv-bu'),
            'type'    => 'number',
            'description' => __( 'Specify a end time (in seconds)', 'wpv-bu' ),
            'required' => ['vb_video_type','=', ['youtube','hosted']],

        ];
        //video Options
        $this->controls['vb_options']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Video Options', 'wpv-bu'),
            'type'    => 'separator',
        ];
        $this->controls['vb_aspect']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Aspect Ratio', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                '16/9' => '16:9',
                '21/9' => '21:9',
                '4/3' => '4:3',
                '3/2' => '3:2',
                '1/1' => '1:1',
                '9/16' => '9:16',
            ],
            'default' => '16/9',
            'inline' => true,
            'small' => true,
            'css' => [
                [
                    'property' => 'aspect-ratio',
                    'selector' => '&.bultr-videobox-wrapper',
                ],
            ],
        ];
        //lightbox controls
        $this->controls['vb_lightbox']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('LightBox', 'wpv-bu'),
            'type'    => 'checkbox',
            'description' => __('Autoplay will not work in lightbox', 'wpv-bu'),
        ];
        $this->controls['vb_lightboxFull']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Fullscreen', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'  => ['vb_lightbox', '=', true],
        ];
        $this->controls['vb_lightboxShare']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Enable Share', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'  => ['vb_lightbox', '=', true],
        ];
        $this->controls['vb_lightboxHash']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Hash URL', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'  => ['vb_lightbox', '=', true],
        ];
        $this->controls['vb_galleryID']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Gallery ID', 'wpv-bu'),
            'type'    => 'text',
            'default'  => 'gallery-'.rand(1,100),
            'description' => __('Add a unique ID for the gallery. This is required for the hash URL to work.', 'wpv-bu'),
            'required'  => [
                ['vb_lightbox', '=', true],
                ['vb_lightboxHash','=', true],
            ],
        ]; 
        
        //video details
        $this->controls['vb_details']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Video Details', 'wpv-bu'),
            'type'    => 'separator',
        ];
        $this->controls['vb_enableDetails']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Enable Video Details', 'wpv-bu'),
            'type'    => 'checkbox',
        ];
        $this->controls['vb_detailsTitle']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Video Title', 'wpv-bu'),
            'type'    => 'text',
            'default' => esc_html__( 'Video Title', 'wpv-bu' ),
            'placeholder' => esc_html__( 'Type your title here', 'wpv-bu' ),
            'required' => ['vb_enableDetails','=',true],
        ];
        $this->controls['vb_detailsDesc']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Video Description', 'wpv-bu'),
            'type'    => 'text',
            'default' => esc_html__( '', 'wpv-bu' ),
            'placeholder' => esc_html__( 'Type your Description here', 'wpv-bu' ),
            'required' => ['vb_enableDetails','=',true],
        ];
        $this->controls['vb_previewDetails']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Preview Video Details', 'wpv-bu'),
            'type'    => 'checkbox',
            'info'  => __('It is only for editor preview. It helps you to design your layout properly', 'wpv-bu'),
            'required' => ['vb_enableDetails','=',true],

        ];
        //Mask Shape
        $this->controls['vb_maskSept']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mask', 'wpv-bu'),
            'type'    => 'separator',
        ];
        $this->controls['vb_enableMask']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Enable Mask', 'wpv-bu'),
            'type'    => 'checkbox',
        ];
        $this->controls['vb_chooseMask']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mask Shape', 'wpv-bu'),
            'type'    => 'image',
            'css'     => [
                [
                    'property' => 'mask-image',
                    'selector' => '&.bultr-videobox-wrapper.bultr-video-mask-media .bultr-video-content:not(.bultr-sticky-apply)',
                ],
                [
                    'property' => '-webkit-mask-image',
                    'selector' => '&.bultr-videobox-wrapper.bultr-video-mask-media .bultr-video-content:not(.bultr-sticky-apply)',
                ],
            ],
            'required' => ['vb_enableMask', '=', true],
        ];
        $this->get_overlay_controls();
        $this->get_playBtn_controls();
        $this->get_video_style_controls();
        $this->get_details_style_controls();
        $this->get_sticky_controls();
        $this->get_schema_controls();
        $this->controls['vb_info']=[
            'tab'     => 'content',
            'content' => esc_html__('Video will not play in editor. Autoplay will also not work in editor','wpv-bu'),
            'type'    => 'info',
        ];

    }
    //youtube related controls
    public function get_youtube_controls(){
        $default_youtube = apply_filters( 'bultr_video_default_youtube_link', 'https://www.youtube.com/watch?v=XoIWJDPsLBk' );
        $this->controls['youtube_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('URL', 'wpv-bu'),
            'type'    => 'text',
            'default' => $default_youtube,
            'required'=> [
                ['vb_video_type', '=', 'youtube'],
            ],
        ];
        $this->controls['yt_autoplay']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Autoplay', 'wpv-bu'),
            'type'    => 'checkbox',
            'description' => __('To enable autoplay, you must also enable the muted option.', 'wpv-bu'),
            'required'=> [
                ['vb_video_type', '=', 'youtube'],
            ],
        ];
        $this->controls['yt_rel']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Related Videos From', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'current' => __('Current Video Channel','wpv-bu'),
                'random'  => __('Any Random videos','wpv-bu'),
            ],
            'inline'   => true,
            'small'    => true,
            'required' => [
                ['vb_video_type', '=', 'youtube'],
            ],
        ];
        $this->controls['yt_controls']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Player Controls', 'wpv-bu'),
            'type'    => 'checkbox',
            'default' => true,
            'required'=> [
                ['vb_video_type', '=', 'youtube'],
            ],
        ];
        $this->controls['yt_mute']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mute', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'youtube'],
            ],
        ];
        $this->controls['yt_modestbranding']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Modest Branding', 'wpv-bu'),
            'info' => __( 'This option lets you use a YouTube player that does not show a YouTube logo.', 'wpv-bu' ),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'youtube'],
                ['yt_controls', '=', true],
            ],
        ];
        $this->controls['yt_privacy']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Privacy', 'wpv-bu'),
            'info' => __( 'When you turn on privacy mode, YouTube won\'t store information about visitors on your website unless they play the video.', 'wpv-bu' ),

            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'youtube'],
            ],
        ];
    }
    //vimeo related controls
    public function get_vimeo_controls(){
        $default_vimeo = apply_filters( 'bultr_video_default_vimeo_link', 'https://vimeo.com/838671376' );
        $this->controls['vimeo_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('URL', 'wpv-bu'),
            'type'    => 'text',
            'default' => $default_vimeo,
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_autoplay']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Autoplay', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_loop']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Loop', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_muted']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mute', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_title']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Intro Title', 'wpv-bu'),
            'type'    => 'checkbox',
            'default' => true,
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_portrait']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Intro Portrait', 'wpv-bu'),
            'type'    => 'checkbox',
            'default' => true,
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_byline']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Intro Byline', 'wpv-bu'),
            'type'    => 'checkbox',
            'default' => true,
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
        $this->controls['vimeo_color']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Controls Color', 'wpv-bu'),
            'type'    => 'color',
            'required'=> [
                ['vb_video_type', '=', 'vimeo'],
            ],
        ];
    }
    public function get_wistia_controls(){
        $default_wistia = apply_filters( 'bultr_video_default_wistia_link', '<p><a href="https://wpvwebmaster.wistia.com/medias/82tscaz1gr?wvideo=82tscaz1gr"><img src="https://embed-ssl.wistia.com/deliveries/778f315db911722d46d7ae50d4d567f23ce009c5.jpg?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=174bd2e0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://wpvwebmaster.wistia.com/medias/82tscaz1gr?wvideo=82tscaz1gr">Time Lapse of the Milky Way over the Beach</a></p>' );
        $this->controls['wistia_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('URL', 'wpv-bu'),
            'type'    => 'text',
            'default' => $default_wistia,
            'required'=> [
                ['vb_video_type', '=', 'wistia'],
            ],
        ];
        $this->controls['wistia_autoplay']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Autoplay', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'wistia'],
            ],
        ];
        $this->controls['wistia_loop']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Loop', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'wistia'],
            ],
        ];
        $this->controls['wistia_muted']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mute', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'wistia'],
            ],
        ];
        $this->controls['wistia_playbar']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Show Playbar', 'wpv-bu'),
            'type'    => 'checkbox',
            'default' => true,
            'required'=> [
                ['vb_video_type', '=', 'wistia'],
            ],
        ];
    }
    //Daily Motion Controls
    public function get_dailymotion_controls(){
        $default_dailymotion = apply_filters( 'bultr_video_default_dailymotion_link', 'https://www.dailymotion.com/video/k1T8t2sBqRaROEzevL8' );
        $this->controls['dailymotion_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('URL', 'wpv-bu'),
            'type'    => 'text',
            'default' => $default_dailymotion,
            'required'=> [
                ['vb_video_type', '=', 'dailymotion'],
            ],
        ];
        $this->controls['dailymotion_autoplay']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Autoplay', 'wpv-bu'),
            'type'    => 'checkbox',
            'description' => __('To enable autoplay, you must also enable the muted option.', 'wpv-bu'),
            'required'=> [
                ['vb_video_type', '=', 'dailymotion'],
            ],
        ];
        $this->controls['dailymotion_mute']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mute', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'dailymotion'],
            ],
        ];
        $this->controls['dailymotion_controls']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Player Control', 'wpv-bu'),
            'type'    => 'checkbox',
            'default' => true,
            'required'=> [
                ['vb_video_type', '=', 'dailymotion'],
            ],
        ];
        $this->controls['dailymotion_sharing-enable']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Enable Sharing', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'dailymotion'],
            ],
        ];
    }
    //Hosted Controls
    public function get_hosted_controls(){
        $this->controls['insert_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('External Url', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> ['vb_video_type', '=', 'hosted'],
        ];
        $this->controls['external_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('URL', 'wpv-bu'),
            'type'    => 'text',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
                ['insert_link','=',true],
            ],
        ];
        $this->controls['hosted_link']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Choose File', 'wpv-bu'),
            'type'    => 'video',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
                ['insert_link','=',false],
            ],
        ];
        $this->controls['self_autoplay']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Autoplay', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
            ],
        ];
        $this->controls['self_loop']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Loop', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
            ],
        ];
        $this->controls['self_controls']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Player Controls', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
            ],
        ];
        $this->controls['self_muted']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Mute', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
            ],
        ];
        $this->controls['self_downloadbtn']=[
            'tab'     => 'content',
            'group'   => 'video_settings',
            'label'   => esc_html__('Download Button', 'wpv-bu'),
            'type'    => 'checkbox',
            'required'=> [
                ['vb_video_type', '=', 'hosted'],
            ],
        ];
    }
    public function get_overlay_controls(){
        $this->controls['vb_thumbSize']=[
            'tab'     => 'content',
            'group'   => 'video_overlay',
            'label'   => esc_html__('Thumbnail Size', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'maxresdefault' => __( 'Maximum Resolution', 'wpv-bu' ),
                'hqdefault'     => __( 'High Quality', 'wpv-bu' ),
                'mqdefault'     => __( 'Medium Quality', 'wpv-bu' ),
                'sddefault'     => __( 'Standard Quality', 'wpv-bu' ),
            ],
            'required'  => ['vb_video_type', '=', 'youtube'],
        ];
        $this->controls['vb_customThumb']=[
            'tab'     => 'content',
            'group'   => 'video_overlay',
            'label'   => esc_html__('Custom Thumbnail', 'wpv-bu'),
            'type'    => 'checkbox',

        ];
        $this->controls['vb_chooseImage']=[
            'tab'     => 'content',
            'group'   => 'video_overlay',
            'label'   => esc_html__('Select Image', 'wpv-bu'),
            'type'    => 'image',
            'required' => ['vb_customThumb', '=', true],
        ];
        $this->controls['vb_overlayHover']=[
            'tab'     => 'content',
            'group'   => 'video_overlay',
            'label'   => esc_html__('Overlay Hover Animation', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'none' => __('None', 'wpv-bu'),
                'zoomin' => __('Zoom In', 'wpv-bu'),
                'zoomout' => __('Zoom Out', 'wpv-bu'),
                'scale' => __('Scale', 'wpv-bu'),
                'translate' => __('Translate', 'wpv-bu'),
                'greyscale' => __('Greyscale', 'wpv-bu'),
                'sepia' => __('Sepia', 'wpv-bu'),
                'blur' => __('Blur', 'wpv-bu'),
                'bright' => __('Bright', 'wpv-bu'),
            ],
        ];
    }
    public function get_video_style_controls(){
        $this->controls['vb_Bgcolor']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Background', 'wpv-bu'),
            'type'    => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-videobox-wrapper:not(:has(.bultr-sticky-apply))',
                ],
            ],
        ];
        $this->controls['vb_padding']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Padding', 'wpv-bu'),
            'type'    => 'dimensions',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-videobox-wrapper:not(:has(.bultr-sticky-apply))',
                ],
            ],
        ];
        $this->controls['vb_Border']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Border', 'wpv-bu'),
            'type'    => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '&.bultr-videobox-wrapper:not(:has(.bultr-sticky-apply))',
                ],
            ],
        ];
        $this->controls['vb_Boxshd']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Box Shadow', 'wpv-bu'),
            'type'    => 'box-shadow',
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-videobox-wrapper:not(:has(.bultr-sticky-apply))',
                ],
            ],
        ];
        $this->controls['vb_rotate']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Rotate', 'wpv-bu'),
            'type'    => 'number',
            'units'    => false,
            'clearable'=> false,
            'default' => 0,
            'css'     => [
                [
                    'property' => '--bu-transform-rotate',
                    'selector' => '',
                    'value' => '%sdeg',
                ],
            ],
        ];
        
        $this->controls['vb_skew']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Skew', 'wpv-bu'),
            'type'    => 'number',
            'units'    => false,
            'default' => 0,
            'clearable'=> false,
            'css'     => [
                [
                    'property' => '--bu-transform-skew',
                    'selector' => '',
                    'value' => '%sdeg',
                ],
            ],
        ];
        $this->controls['vb_scale']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Scale', 'wpv-bu'),
            'type'    => 'number',
            'placeholders' => 1,
            'clearable'=> false,
            'units'    => false,
            'min' => 0.1,
            'max' => 2,
            'step' => 0.1,
            'css'     => [
                [
                    'property' => '--bu-transform-scale',
                    'selector' => '',
                    'value' => '%s',
                ],
            ],
        ];
        $this->controls['vb_overlaySept']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Overlay', 'wpv-bu'),
            'type'    => 'separator',
        ];
        $this->controls['vb_overlay']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Overlay Type', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'bgcolor' => __('Color / Image', 'wpv-bu'),
                'bggradient' => __('Gradient', 'wpv-bu'),
            ],
            'inline' => true,
        ];
        $this->controls['vb_overlaybgColor']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Overlay Color', 'wpv-bu'),
            'type'    => 'background',
            'css'     => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-videobox-wrapper:has(.bultr-vb-bgcolor) .bultr-videobox-container::before',
                ],
            ],
            'required' => ['vb_overlay', '=', 'bgcolor'],
        ];
        $this->controls['vb_overlaybgGrad']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Overlay Gradient', 'wpv-bu'),
            'type'    => 'gradient',
            'css'     => [
                [
                    'property' => 'background-image',
                    'selector' => '&.bultr-videobox-wrapper:has(.bultr-vb-bggradient) .bultr-videobox-container::before',
                ],
            ],
            'required' => ['vb_overlay', '=', 'bggradient'],
        ];
        $this->controls['vb_maskSepta']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Mask', 'wpv-bu'),
            'type'    => 'separator',
            'required' => ['vb_enableMask', '=', true],

        ];
        $this->controls['vb_maskPosition']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Background Position', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'left top' => esc_html__( 'Left Top', 'wpv-bu' ),
                'left center' => esc_html__( 'Left Center', 'wpv-bu' ),
                'left bottom' => esc_html__( 'Left Bottom', 'wpv-bu' ),
                'center top' => esc_html__( 'Center Top', 'wpv-bu' ),
                'center center' => esc_html__( 'Center Center', 'wpv-bu' ),
                'center bottom' => esc_html__( 'Center Bottom', 'wpv-bu' ),
                'right top' => esc_html__( 'Right Top', 'wpv-bu' ),
                'right center' => esc_html__( 'Right Center', 'wpv-bu' ),
                'right bottom' => esc_html__( 'Right Bottom', 'wpv-bu' ),
            ],
            'css' => [
                [
                    'property' => '-webkit-mask-position',
                    'selector' => '&.bultr-videobox-wrapper.bultr-video-mask-media .bultr-video-content',
                ],
            ],
            'inline' => true,
            'required' => ['vb_enableMask', '=', true],
        ];
        $this->controls['vb_maskSize']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Background Size', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'auto' => esc_html__( 'Auto', 'wpv-bu' ),
                'cover' => esc_html__( 'Cover', 'wpv-bu' ),
                'contain' => esc_html__( 'Contain', 'wpv-bu' ),
            ],
            'css' => [
                [
                    'property' => '-webkit-mask-size',
                    'selector' => '&.bultr-videobox-wrapper.bultr-video-mask-media .bultr-video-content',
                ],
            ],
            'inline' => true,
            'required' => ['vb_enableMask', '=', true],
        ];
        $this->controls['vb_maskRepeat']=[
            'tab'     => 'content',
            'group'   => 'video_style',
            'label'   => esc_html__('Background Repeat', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'no-repeat' => esc_html__( 'No Repeat', 'wpv-bu' ),
                'repeat' => esc_html__( 'Repeat', 'wpv-bu' ),
                'repeat-x' => esc_html__( 'Repeat-x', 'wpv-bu' ),
                'repeat-y' => esc_html__( 'Repeat-y', 'wpv-bu' ),
            ],
            'css' => [
                [
                    'property' => '-webkit-mask-repeat',
                    'selector' => '&.bultr-videobox-wrapper.bultr-video-mask-media .bultr-video-content',
                ],
            ],
            'inline' => true,
            'required' => ['vb_enableMask', '=', true],
        ];

    }
    public function get_details_style_controls(){
        $this->controls['vb_detailsBgcolor']=[
            'tab'     => 'content',
            'group'   => 'video_details',
            'label'   => esc_html__('Background', 'wpv-bu'),
            'type'    => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-video-details',
                ],
            ],
        ];
        $this->controls['vb_detailsBorder']=[
            'tab'     => 'content',
            'group'   => 'video_details',
            'label'   => esc_html__('Border', 'wpv-bu'),
            'type'    => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-video-details',
                ],
            ],
        ];
        $this->controls['vb_detailsPadding']=[
            'tab'     => 'content',
            'group'   => 'video_details',
            'label'   => esc_html__('Padding', 'wpv-bu'),
            'type'    => 'dimensions',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-video-details',
                ],
            ],
        ];
        $this->controls['vb_detailsTitlestyle']=[
            'tab'     => 'content',
            'group'   => 'video_details',
            'label'   => esc_html__('Title', 'wpv-bu'),
            'type'    => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-video-details .bultr-video-title',
                ],
            ],
        ];
        $this->controls['vb_detailsDescptstyle']=[
            'tab'     => 'content',
            'group'   => 'video_details',
            'label'   => esc_html__('Description', 'wpv-bu'),
            'type'    => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-video-details .bultr-video-description',
                ],
            ],
        ];
    }
    public function get_playBtn_controls(){
        $this->controls['vb_playIcon']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Play Icon', 'wpv-bu'),
            'type'    => 'icon',
            'default' => [
                'library' => 'fontawesome',
                'icon' => 'fas fa-circle-play'
            ],
            'rerender' => true,
        ];
        $this->controls['vb_iconColor']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Color', 'wpv-bu'),
            'type'    => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-video-play-icon i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '.bultr-video-play-icon svg',
                ],
            ],
            'required' => ['vb_playIcon','!=', ''],
        ];
        $this->controls['vb_iconSecColor']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Background Color', 'wpv-bu'),
            'type'    => 'color',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-video-play-icon',
                ],
            ],
            'required' => ['vb_playIcon','!=', ''],

        ];
        $this->controls['vb_iconSize']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Icon Size', 'wpv-bu'),
            'type'    => 'number',
            'units'    => true,
            'css' => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-video-play-icon i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-video-play-icon svg',
                ],
                // [
                //     'property' => 'height',
                //     'selector' => '.bultr-video-play-icon svg',
                // ],
            ],
            'required' => ['vb_playIcon','!=', ''],

        ];
        $this->controls['vb_iconBorder']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Border', 'wpv-bu'),
            'type'    => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-video-play-icon',
                ],
            ],
            'required' => ['vb_playIcon','!=', ''],

        ];
        
        $this->controls['vb_iconPadding']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Icon Padding', 'wpv-bu'),
            'type'    => 'dimensions',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-video-play-icon',
                ],
            ],
            'required' => ['vb_playIcon','!=', ''],

        ];
        $this->controls['vb_iconRotate']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Icon Rotate', 'wpv-bu'),
            'type'    => 'number',
            'css' => [
                [
                    'property' => 'transform',
                    'selector' => '.bultr-video-play-icon i',
                    'value' => 'rotate(%sdeg)',
                ],
                [
                    'property' => 'transform',
                    'selector' => '.bultr-video-play-icon svg',
                    'value' => 'rotate(%sdeg)',
                ],
            ],
            'required' => ['vb_playIcon','!=', ''],

        ];
        $this->controls['vb_iconShd']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Icon Shadow', 'wpv-bu'),
            'type'    => 'text-shadow',
            'css' => [
                [
                    'property' => 'text-shadow',
                    'selector' => '.bultr-video-play-icon i',
                ],
            ],
            'inline' => true,
            'required' => ['vb_playIcon','!=', ''],

        ];
        $this->controls['vb_iconAnimation']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Animation', 'wpv-bu'),
            'type'    => 'select',
            'options' => [
                'floating' => __('Floating', 'wpv-bu'),
                'ripple'   => __('Ripple Effect', 'wpv-bu'),
                'pulse'    => __('Pulsing', 'wpv-bu'),
            ],
            'inline' => true,
            'required' => ['vb_playIcon','!=', ''],

        ];
        $this->controls['vb_AnmtRipple']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Waves Color', 'wpv-bu'),
            'type'    => 'color',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-video-play-icon.bultr-play-anmt-ripple::after',
                ],
                [
                    'property' => 'background',
                    'selector' => '.bultr-video-play-icon.bultr-play-anmt-ripple::before',
                ],
            ],
            'inline' => true,
            'required' => [['vb_playIcon','!=', ''],['vb_iconAnimation','=', 'ripple']],

        ];
        $this->controls['vb_AnmtRippleBorder']=[
            'tab'     => 'content',
            'group'   => 'video_playIcon',
            'label'   => esc_html__('Waves Border Radius', 'wpv-bu'),
            'type'    => 'number',
            'css' => [
                [
                    'property' => 'border-radius',
                    'selector' => '.bultr-video-play-icon.bultr-play-anmt-ripple::after',
                ],
                [
                    'property' => 'border-radius',
                    'selector' => '.bultr-video-play-icon.bultr-play-anmt-ripple::before',
                ],
            ],
            'default' => '50%',
            'inline' => true,
            'required' => [['vb_playIcon','!=', ''],['vb_iconAnimation','=', 'ripple']],

        ];
    }
    //sticky Controls
    public function get_sticky_controls(){
        $this->controls['vb_enableSticky']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Enable Sticky Video', 'wpv-bu'),
            'type'    => 'checkbox',
        ];
        $this->controls['vb_enableStickyPrvew']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Enable Sticky Video Preview', 'wpv-bu'),
            'type'    => 'checkbox',
        ];
        $this->controls['vb_Stickyclose']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Enable Close Button', 'wpv-bu'),
            'type'    => 'checkbox',
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_enableDraggable']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Enable Draggable', 'wpv-bu'),
            'type'    => 'checkbox',
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_stkVideoWidth']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Video Width(px)', 'wpv-bu'),
            'type'    => 'number',
            'css'     => [
                [
                    'property' => '--bu-sticky-width',
                    'selector' => '',
                    'value' => '%spx',
                ],
            ],
            'placeholder' => '320',
            'required' => ['vb_enableSticky', '=', true],
        ];
        $this->controls['vb_StickyHrztPost']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Horizontal Position', 'wpv-bu'),
            'type'    => 'select',
            'options' =>[
                'left' => __('Left', 'wpv-bu'),
                'center' => __('Center', 'wpv-bu'),
                'right' => __('Right','wpv-bu'),
            ],
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_StickyVertPost']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Vertical Position', 'wpv-bu'),
            'type'    => 'select',
            'options' =>[
                'top' => __('Top', 'wpv-bu'),
                'middle' => __('Middle', 'wpv-bu'),
                'bottom' => __('Bottom','wpv-bu'),
            ],
            'required' => ['vb_enableSticky', '=', true],
        ];
        $this->controls['vb_StickyHrztlOffset']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Horizontal Offset', 'wpv-bu'),
            'type'    => 'number',
            'units' => true,
            'css'   =>[
                [
                    'property' => 'left',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply.bultr-sticky-hrztl-pos-left',
                ],
                [
                    'property' => 'right',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply.bultr-sticky-hrztl-pos-right',
                ],
            ],
            'placeholder' => '40px',
            'required' => [
                ['vb_enableSticky', '=', true],
                ['vb_StickyHrztPost', '!=', 'center'],
            ],
        ];
        $this->controls['vb_StickyVertlOffset']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Vertical Offset', 'wpv-bu'),
            'type'    => 'number',
            'units' => true,
            'css'   =>[
                [
                    'property' => 'top',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply.bultr-sticky-vertl-pos-top',
                ],
                [
                    'property' => 'bottom',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply.bultr-sticky-vertl-pos-bottom',
                ],
            ],
            'placeholder' => '40px',
            'required' => [
                ['vb_enableSticky', '=', true],
                ['vb_StickyVertPost', '!=', 'middle'],
            ],
        ];
        $this->controls['vb_StickyStyle']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Sticky Style', 'wpv-bu'),
            'type'    => 'separator',
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_StickyBgcolor']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Background', 'wpv-bu'),
            'type'    => 'background',
            'css'   => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply',
                ],
            ],
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_StickyBorder']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Border', 'wpv-bu'),
            'type'    => 'border',
            'css'   => [
                [
                    'property' => 'border',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply',
                ],
            ],
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_StickyBoxShd']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Box Shadow', 'wpv-bu'),
            'type'    => 'box-shadow',
            'css'   => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply',
                ],
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-video-details',
                ],
            ],
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_StickySpacing']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Paddingsc', 'wpv-bu'),
            'type'    => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply',
                ],
                
            ],
            'required' => ['vb_enableSticky', '=', true],

        ];
        $this->controls['vb_StickycloseStyle']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Close Button Style', 'wpv-bu'),
            'type'    => 'separator',
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closeColor']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Color', 'wpv-bu'),
            'type'    => 'color',
            'css'   => [
                [
                    'property' => 'color',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn i',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closeBg']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Background', 'wpv-bu'),
            'type'    => 'color',
            'css'   => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closeBorder']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Border', 'wpv-bu'),
            'type'    => 'border',
            'css'   => [
                [
                    'property' => 'border',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closeBoxShd']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Box Shadow', 'wpv-bu'),
            'type'    => 'box-shadow',
            'css'   => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        
        $this->controls['vb_closeSize']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Size', 'wpv-bu'),
            'type'    => 'number',
            'css'   => [
                [
                    'property' => 'font-size',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn i',
                ],
                [
                    'property' => 'width',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
                [
                    'property' => 'height',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closePosTop']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Position Top ', 'wpv-bu'),
            'type'    => 'number',
            'css'   => [
                [
                    'property' => 'top',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closePosLeft']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Position Left ', 'wpv-bu'),
            'type'    => 'number',
            'css'   => [
                [
                    'property' => 'left',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closePosBottom']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Position Bottom ', 'wpv-bu'),
            'type'    => 'number',
            'css'   => [
                [
                    'property' => 'bottom',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];
        $this->controls['vb_closePosRight']=[
            'tab'     => 'content',
            'group'   => 'video_sticky',
            'label'   => esc_html__('Position Right', 'wpv-bu'),
            'type'    => 'number',
            'css'   => [
                [
                    'property' => 'right',
                    'selector' => '&.bultr-videobox-wrapper .bultr-video-content.bultr-sticky-apply .bultr-vbsticky-close-btn',
                ],
            ],
            'required' => ['vb_Stickyclose', '=', true],
        ];


    }
    //Schema controls 
    public function get_schema_controls(){
        $this->controls['vb_enableSchema']=[
            'tab'     => 'content',
            'group'   => 'video_schema',
            'label'   => esc_html__('Enable Schema', 'wpv-bu'),
            'type'    => 'checkbox',
        ];
        $this->controls['vb_SchemaTitle']=[
            'tab'     => 'content',
            'group'   => 'video_schema',
            'label'   => esc_html__('Video Title', 'wpv-bu'),
            'type'    => 'text',
            'placeholder' => __('Title of video','wpv-bu'),
            'required' => ['vb_enableSchema', '=', true],
        ];
        $this->controls['vb_SchemaDescpt']=[
            'tab'     => 'content',
            'group'   => 'video_schema',
            'label'   => esc_html__('Video Description', 'wpv-bu'),
            'type'    => 'text',
            'placeholder' => __('Description of the video.','wpv-bu'),
            'required' => ['vb_enableSchema', '=', true],
        ];
        $this->controls['vb_SchemaThumb']=[
            'tab'     => 'content',
            'group'   => 'video_schema',
            'label'   => esc_html__('Video Thumbnail', 'wpv-bu'),
            'type'    => 'image',
            'required' => ['vb_enableSchema', '=', true],
        ];
        $date= gmdate( 'Y-m-d H:i' );
        $this->controls['vb_SchemaDate']=[
            'tab'     => 'content',
            'group'   => 'video_schema',
            'label'   => esc_html__('Video Upload Date & Time', 'wpv-bu'),
            'type'    => 'datepicker',
            'placeholder' => __( $date, 'wpv-bu' ),

            'required' => ['vb_enableSchema', '=', true],
        ];
    }

    //render
    public function render(){

        $settings = $this->settings;

        $videoType = isset($settings['vb_video_type']) ? $settings['vb_video_type'] : 'youtube';
        $videoLink = $this->get_video_link($settings,$videoType);
        $hostedvideo_params = $this->bu_get_hosted_params($settings);
        if($videoType != 'hosted'){
            $videoID = $this->get_video_Id($settings,$videoType);
        }
        //Bricks is not frontend
        if(!bricks_is_builder()){
            if(empty($videoID) && ($videoType != 'hosted')){
                return;
            }
        }
        
        // Params
		if(method_exists($this,$videoType.'_embed_params')){
			$embedParams = call_user_func( array( $this, $videoType.'_embed_params' ));
		}
        if($videoType !== 'hosted'){
            $src = $this->bu_get_url($settings,$videoID,$embedParams, $videoType);
        }
        else{
            $src = $this->bu_get_hosted_url($settings);
        }


        //checking empty validation
        if($videoType === ''){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No Video Type is selected.', 'wpv-bu' ),
				]
			);
        }
      
        if($videoType != ''){
            if($videoLink === ''){
                return $this->render_element_placeholder(
                    [
                        'title' => esc_html__( 'No Video link  is given.', 'wpv-bu' ),
                    ]
                );
            }
            
        }
        if(empty($src)){
            return $this->render_element_placeholder(
                [
                    'title' => esc_html__( 'No Video Added. Please add video.', 'wpv-bu' ),
                ]
            );
        }


        // schema
        $enableSchema = isset($settings['vb_enableSchema']) ? $settings['vb_enableSchema'] : 'false';
        if(isset($settings['vb_enableSchema'])){
            $no_schema = false;
            $customThumb = isset($settings['vb_customThumb']) ? true : false;
            $customThumbnailImg = isset($settings['vb_chooseImage']) ? $this->get_normalized_image_settings($settings, 'vb_chooseImage') : ''; 
            if(is_array($customThumbnailImg) && isset($customThumbnailImg['url'])){
                $customThumbnailImg = $customThumbnailImg['url'];
            }
            $schemaThumb = isset($settings['vb_SchemaThumb']) ? $this->get_normalized_image_settings($settings, 'vb_SchemaThumb'): '';
            if(is_array($schemaThumb) && isset($schemaThumb['url'])){
                $schemaThumb = $schemaThumb['url'];
            }
            if($enableSchema === true){
                if((empty($settings['vb_SchemaTitle']) || empty($settings['vb_SchemaDescpt']) || empty($settings['vb_SchemaDate']) || ($customThumb === false && isset($settings['vb_SchemaThumb']['url']) === '')) || ($customThumb === true && $customThumbnailImg === '') ||  ($videoLink === '') ){
                    $no_schema = true;
                }
            }
            if($no_schema === false){
                $video_schema_data = array(
					'@context'     => 'https://schema.org',
					'@type'        => 'VideoObject',
					'name'         => $settings['vb_SchemaTitle'],
					'description'  => $settings['vb_SchemaDescpt'],
					'thumbnailUrl' => ( $customThumb ) ? $customThumbnailImg : $schemaThumb,
					'uploadDate'   => $settings['vb_SchemaDate'],
					'contentUrl'   => $videoLink,
					'embedUrl'     => $videoLink,
				);
                BricksUltraPlugin::$schemas[] = $video_schema_data ;
            }
            
        }


        //getting data autoplay value
        $autoplay = '';
        if(!isset($settings['vb_lightbox'])){
            switch($videoType){
                case 'youtube' :
                    $autoplay = isset($settings['yt_autoplay']) ? 'true' : 'false';
                break;
                case 'vimeo' :
                    $autoplay = isset($settings['vimeo_autoplay']) ? 'true' : 'false';
                break;
                case 'wistia' :
                    $autoplay = isset($settings['wistia_autoplay']) ? 'true' : 'false';
                break;
                case 'dailymotion' :
                    $autoplay = isset($settings['dailymotion_autoplay']) ? 'true' : 'false';
                break;
                case 'hosted' :
                    $autoplay = isset($settings['self_autoplay']) ? 'true' : 'false';
                break;
                default:
                    $autoplay = 'false';
                break;
            }
        }


        //root attributes
        $rootclass = ['bultr-videobox-wrapper'];
        $rootclass[] = 'bultr-video-type-'.$videoType;
        $this->set_attribute('_root', 'class', $rootclass);
        $this->set_attribute('_root', 'data-video-type-vb', $videoType);
        if(isset($autoplay)){
            $this->set_attribute('_root', 'data-vb-autoplay', $autoplay);
        }
        //hosted video html to pass as data attribute to outer wrapper
        if ( $videoType === 'hosted') {
			$video_url = $this->bu_get_hosted_url($settings);
            $this->set_attribute('_root','data-vbhosted-url',$video_url);
            
            $this->set_attribute('_root','data-vbhosted-param',esc_attr(implode(" ", $hostedvideo_params)));

		}
        if(isset($settings['vb_overlay'])){
            $this->set_attribute('_root', 'class', 'bultr-vb-'.$settings['vb_overlay']);
        }
        
        //mask class
        if(isset($settings['vb_enableMask'])){
            $this->set_attribute('_root', 'class', 'bultr-video-mask-media');

        }
    
        //content div 
        $contentClass = ['bultr-video-content'];
       
        //details editor class 
        if(isset($settings['vb_previewDetails'])){
            
            if(bricks_is_builder() === true){
                
                $contentClass[] = 'bultr-vb-previewInfo';
            }
        }
        
        $this->set_attribute('vb_content','class',$contentClass);
        // sticky
        if(isset($settings['vb_enableSticky'])){
            
            $stickyClass = ['bultr-video-sticky'];
            if(isset($settings['vb_aspect'])){
                $aspect= '';
                switch($settings['vb_aspect']){
                    case '16/9' :
                        $aspect = '169';
                        break;
                    case '21/9' :
                        $aspect = '219';
                        break;
                    case '4/3' : 
                        $aspect = '43';
                        break;
                    case '3/2' :
                        $aspect = '32';
                        break;
                    case '1/1' :
                        $aspect = '11';
                        break;
                    case '9/16' :
                        $aspect = '916';
                        break;
                    default :
                        $aspect = '169';
                        break;

                };
                $stickyClass[] = 'bultr-asp-ratio-'.$aspect;
            }
            // horizontal position
            $stickyClass[] =  isset($settings['vb_StickyHrztPost']) ? 'bultr-sticky-hrztl-pos-'.$settings['vb_StickyHrztPost'] : 'bultr-sticky-hrztl-pos-left';
            // vertical Position
            $stickyClass[] =  isset($settings['vb_StickyVertPost']) ? 'bultr-sticky-vertl-pos-'.$settings['vb_StickyVertPost'] : 'bultr-sticky-vertl-pos-top';
            if(isset($settings['vb_enableStickyPrvew'])){
                $this->set_attribute('vb_content', 'data-editor-sticky-preview', 'true');
            }
            $this->set_attribute('vb_content', 'class', $stickyClass);  
            $this->set_attribute('vb_content', 'data-video-sticky-vb', 'true');
            if(isset($settings['vb_enableDraggable'])){
                $this->set_attribute('vb_content', 'data-sticky-draggable', 'true');
            }
        }

        //video wrapper attributes
        $this->set_attribute('bu-video-wrap', 'class',['bultr-videobox-container', 'bultr-video-play']);
        if($videoType === 'hosted' && isset($settings['self_downloadbtn'])){
            $this->set_attribute('bu-video-wrap', 'data-vb-download','nodownload');
        }
        if($videoType !== 'hosted'){
            if(!isset($settings['vb_lightbox'])){
                $this->set_attribute('bu-video-wrap', 'data-src-vb',$src);
            }
        }
        if(isset($settings['vb_overlay'])){
            $this->set_attribute('bu-video-wrap', 'class', 'bultr-vb-'.$settings['vb_overlay']);
        }
        
        //lightbox data
        if(isset($settings['vb_lightbox'])){
            $this->set_attribute('_root', 'data-vb-lightbox', 'true');
            if(isset($settings['vb_lightboxFull'])){
                $this->set_attribute('bu-video-wrap', 'data-vb-fullscreen', 'true');
            }
            if(isset($settings['vb_lightboxShare'])){
                $this->set_attribute('bu-video-wrap', 'data-vb-share', 'true');
            }
            if(isset($settings['vb_lightboxHash'])){
                $this->set_attribute('bu-video-wrap', 'data-vb-galleryid', isset($settings['vb_galleryID']) ? $settings['vb_galleryID'] : 1 );
            }
            if($videoType !== 'hosted'){
                $this->set_attribute('bu-video-wrap', 'data-src', $videoLink);
                $this->set_attribute('bu-video-wrap', 'data-params', json_encode($embedParams));
            }
            else{
                $controls = isset($settings['self_controls']) ? true : false;
                $lbhostedParmas = [
                    'muted' => isset($settings['self_muted']) ? true : false,
                    'controls' => isset($settings['self_controls']) ? true : false,
                    'loop'  => isset($settings['self_loop']) ? true : false,
                    'autoplay'  => isset($settings['self_autoplay']) ? true : false,
                ];
                $this->set_attribute('bu-video-wrap', 'data-params', json_encode($lbhostedParmas));
                $this->set_attribute('bu-video-wrap', 'data-video','{
					"source": [{"src":"'.$videoLink['url'].'", "type":"video/mp4"}], 
					"attributes": {"preload": false, "controls":'. $controls  .'}
				}'
            
                );
            }

        }



        //thumb attributes
        $this->set_attribute('bu-video-thumb', 'class', 'bultr-video-thumb');
        if(isset($settings['vb_overlayHover'])){
            $this->set_attribute('bu-video-thumb', 'class', 'bultr-video-hvr-'.$settings['vb_overlayHover']);
        }
        if($videoType !== 'hosted'){
            $this->set_attribute('bu-video-thumb', 'src', $this->bu_get_video_thumb($settings,$videoID, $videoType));
        }
        else{
            if(isset($settings['vb_customThumb'])){
                $thumb = isset($settings['vb_chooseImage']) ? $this->get_normalized_image_settings($settings,'vb_chooseImage') : '';
                if(isset($thumb['url']) && is_array($thumb)){
                    $thumb = $thumb['url'];
                }
                
            }
            else{
                $thumb = $this->bu_get_hosted_url($settings);
            }
            $this->set_attribute('bu-video-thumb', 'src', $thumb);
        }
        if($videoType === 'hosted' && isset($settings['vb_customThumb']) === false){
            $customTag = 'video';
        }
        else{
            $customTag = 'img';
        }
        //play icon attributes
        $this->set_attribute('bu-video-play', 'class', 'bultr-video-play-icon');
        if(isset($settings['vb_iconAnimation'])){
            $this->set_attribute('bu-video-play', 'class', 'bultr-play-anmt-'.$settings['vb_iconAnimation']);
        }
        $playicon = isset($settings['vb_playIcon']) ? $settings['vb_playIcon'] : '';
        $playicon = self::render_icon($playicon, []);

        //if no url
        if(empty($src)){ ?>
			<div class= "message">
				<p class="bultr-alert ">No video added. Please add video.</p>
			</div>
		<?php }
		else{
        
        ?>
        <div <?php echo $this->render_attributes('_root')?>>
            <div <?php echo $this->render_attributes('vb_content')?>>
                <div <?php echo $this->render_attributes('bu-video-wrap')?>>
                    <<?php echo esc_attr( $customTag ); ?> <?php echo wp_kses_post( $this->render_attributes( 'bu-video-thumb' ) );?>></<?php echo esc_attr( $customTag ); ?>>
                    <div <?php echo $this->render_attributes('bu-video-play')?>>
                        <?php echo $playicon; ?>
                    </div>
                </div>
                <?php if(isset($settings['vb_enableSticky']) === true && isset($settings['vb_Stickyclose']) === true){?>
                <div class = 'bultr-vbsticky-close-btn'>
                    <i class="fas fa-xmark bultr-sticky-close-icon"></i>
                </div>
                <?php } ?>
                <?php if(isset($settings['vb_enableDetails'])){
                        $this->set_attribute('vb-details', 'class', 'bultr-video-details');
                ?>
                <div  <?php echo $this->render_attributes('vb-details')?>>
                    <?php if(!empty($settings['vb_detailsTitle'])){?>
                    <span class = "bultr-video-title"><?php echo $settings['vb_detailsTitle']; ?></span>
                    <?php }?>
                    <?php if(!empty($settings['vb_detailsDesc'])){?>
                    <span class = "bultr-video-description"><?php echo $settings['vb_detailsDesc']; ?></span>
                    <?php }?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php
        }
    }
    public function get_video_link($settings,$videoType){
        $videoLink = '';
        switch($videoType){
            case 'youtube' : 
                $videoLink = isset($settings['youtube_link']) ? $settings['youtube_link'] : '';
                break;
            case 'vimeo' :
                $videoLink = isset($settings['vimeo_link']) ? $settings['vimeo_link'] : '';
                break;
            case 'wistia' :
                $videoLink = isset($settings['wistia_link']) ? $settings['wistia_link'] : '';
                break;
            case 'dailymotion' :
                $videoLink = isset($settings['dailymotion_link']) ? $settings['dailymotion_link'] : '';
                break;
            case 'hosted' :
                if(isset($settings['insert_link']) ){
                    $videoLink = !empty($settings['external_link']) ?$settings['external_link'] : '' ;
                }
                else{
                    $videoLink = isset($settings['hosted_link']) ? $settings['hosted_link'] : '';
                }
                break;
            default:
        }
        return $videoLink;
    }
    public function get_video_Id($settings,$videoType){
        $id = '';
        $url = isset($settings[$videoType.'_link']) ? $this->render_dynamic_data($settings[$videoType.'_link']) : '';
        if($videoType === 'youtube'){
            if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches ) ) {
				$id = $matches[1];	
			}
        }
        elseif($videoType === 'vimeo'){
            if ( preg_match( '%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs ) ) {
				$id = $regs[3];
			}
        }
        elseif($videoType === 'wistia'){
            $id = $this->getStringBetween( $url, 'wvideo=', '"' );
        }
        elseif($videoType === 'dailymotion'){
            $id = $this->getDailyMotionId($url);
        }
        
        return $id;

    }
    public function getDailyMotionId($url){

		if (preg_match('!^.+dailymotion\.com/(video|hub)/([^_]+)[^#]*(#video=([^_&]+))?|(dai\.ly/([^_]+))!', $url, $m)) {
			if (isset($m[6])) {
				return $m[6];
			}
			if (isset($m[4])) {
				return $m[4];
			}
			return $m[2];
		}
		return false;
	}
    protected function getStringBetween( $url, $from, $to ) {
		$sub = substr( $url, strpos( $url, $from ) + strlen( $from ), strlen( $url ) );
		$id  = substr( $sub, 0, strpos( $sub, $to ) );

		return $id;
	}
    // youtube embed params
    public function youtube_embed_params(){
        $settings = $this->settings;
        $youtube_options = ['autoplay', 'rel', 'controls', 'mute', 'modestbranding' ];
        foreach($youtube_options as $options){
            if($options === 'autoplay'){
                if(isset($settings['yt_autoplay'])){
                    $params[$options] = 1;

                }
                continue;
            }
            $value = (isset($settings['yt_'.$options]) &&  $settings['yt_'.$options] === true) ? 1 :0;
            $params[$options] = $value;
            $params['start'] = !empty($settings['vb_start_time']) ? $settings['vb_start_time'] : '';
            $params['end'] = !empty($settings['vb_end_time']) ? $settings['vb_end_time'] : '';
        }
        $params = apply_filters('bultr-youtube-params',$params);
        return $params;
    }
    // vimeo embed params
    public function vimeo_embed_params(){
        $settings = $this->settings;
        $vimeo_options = ['autoplay', 'loop', 'title', 'portrait', 'byline', 'muted' ];
        foreach ( $vimeo_options as $option ) {
            if ( 'autoplay' === $option ) {
                if ( isset($settings['vimeo_autoplay']) ) {
                    $params[ $option ] = 1;
                }
                continue;
            }
            $value = (isset($settings[ 'vimeo_' . $option ]) && $settings[ 'vimeo_' . $option ] === true ) ? 1 : 0;
            $params[$option] = $value;
            
        }
        if(isset($settings['vimeo_color']) ){
            $params['color']     = str_replace( '#', '', $settings['vimeo_color']['hex'] );

        }
        else{
            $params['color'] = '';
        }
			$params['autopause'] = '0';
			$params = apply_filters( 'bultr_vimeo_params', $params );
			return $params;
    }
    //dailymotion embed params
    public function dailymotion_embed_params(){
        $settings = $this->settings;
		$dailymotion_options = ['autoplay', 'mute', 'controls', 'sharing-enable'];
        foreach($dailymotion_options as $option){
            if($option === 'autoplay'){
                if(isset($settings['dailymotion_autoplay'])){
                    $params[$option] = 'true';

                }
                continue;
            }
            if(!empty($settings['vb_start_time'])){
				$params[ 'start' ] = $settings['vb_start_time'];
			}
            $value = ( isset($settings[ 'dailymotion_' . $option ]) && $settings[ 'dailymotion_' . $option ] === true ) ? 'true' : 'false';
		    $params[ $option ] = $value;
        }
        $params = apply_filters( 'bultr_dailymotion_params', $params );
		return $params;	
    }
    // wistia embed params
    public function wistia_embed_params(){
        $settings = $this->settings;
        $wistia_options = ['autoplay', 'muted', 'playbar', 'loop'];
        foreach($wistia_options as $option){
            if($option === 'autoplay'){
                if(isset($settings['wistia_autoplay'])){
                    $params[$option ] = '1';
                }
                continue;
            }
            if($option === 'loop'){
                if(isset($settings['wistia_loop'])){
                    $params['endVideoBehavior' ] = 'loop';
                }
                continue;
            }
            $value = (isset($settings['wistia_'.$option]) && $settings['wistia_'.$option] === true )  ? '1' : '0';
            $params[$option] = $value;

        }
        $params['videoFoam'] = '1';
		$params = apply_filters( 'bultr_wistia_params', $params );
		return $params;

    }
    //creating url
    public function bu_get_url($settings, $id, $params, $videoType){
        
        $url = '';
        if ( 'vimeo' === $videoType ) {

			$url = 'https://player.vimeo.com/video/';

		}
        elseif($videoType === 'youtube'){
            $cookie = '';
            if(isset($settings['yt_privacy'])){
                $cookie = '-nocookie';

            }
            $url = 'https://www.youtube' . $cookie . '.com/embed/';
        }
        elseif ( $videoType === 'wistia' ) {
			$url = 'https://fast.wistia.net/embed/iframe/';
		}

		elseif($videoType === 'dailymotion' ){
			$url = 'https://dailymotion.com/embed/video/';
		}

        $url = add_query_arg( $params, $url . $id );
		
		$url .= ( empty( $params ) ) ? '?' : '&';
        
		$url .= 'autoplay=1';
        // start time for vimeo 
        if ( $videoType === 'vimeo') {
            if(!empty($settings['vb_start_time'] )){
                $time = gmdate( 'H\hi\ms\s', $settings['vb_start_time'] );
                $url .= '#t=' . $time;
            }
			else{
			$url .= '#t=';
            }
		}
		$url = apply_filters( 'bultr_video_url_filter', $url, $id );
        
        return $url;
    }
    public function bu_get_hosted_url($settings){
        $videoUrl = '';
        if(isset($settings['insert_link']) ){
            $videoUrl = !empty($settings['external_link']) ? $this->render_dynamic_data($settings['external_link']) : ''; //by url
        }
        else{
            $videoUrl = isset($settings['hosted_link']) ? $settings['hosted_link']['url'] : ''; //media choose 

        }
        if ( empty( $videoUrl ) ) {
			return '';
		}
        if ( !empty($settings['vb_start_time']) || !empty($settings['vb_end_time']) ) {
			$videoUrl .= '#t=';
		}

		if ( !empty($settings['vb_start_time']) ) {
			$videoUrl .= !empty($settings['vb_start_time']) ? $settings['vb_start_time'] : '';
		}

		if ( !empty($settings['vb_end_time']) ) {
            $endTime = !empty($settings['vb_end_time']) ? $settings['vb_end_time'] : '';
			$videoUrl .= ',' . $endTime;
		}
		return $videoUrl;
    }
    public function bu_get_hosted_params($settings){
        
		$hosted_options = ['loop','controls','muted'];
		if(!isset($settings['vb_lightbox'])){
			$hosted_options[] = 'autoplay';
		}	
        $params = [];
		foreach ($hosted_options as $option ) {
			if ( isset($settings[ 'self_'.$option ]) ) {
                $params[] = $option;
			}
		}
		
		if ( !isset($settings['self_downloadbtn'])) {
			$params['controlslist'] = "nodownload";
		}

		return $params;
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

    public function bu_get_video_thumb($settings,$videoID,$videoType){
        $thumb = '';
       
        if(isset($settings['vb_customThumb']) && isset($settings['vb_chooseImage'])){
            $thumb = $this->get_normalized_image_settings( $settings, 'vb_chooseImage');
            if(is_array($thumb) && isset($thumb['url'])){
                $thumb = $thumb['url'];
            }
            
            
        }
        elseif(isset($settings['vb_customThumb']) && !isset($settings['vb_chooseImage'])){
            if($videoType === 'youtube'){
                $thumbsize = isset($settings['vb_thumbSize']) ? $settings['vb_thumbSize'] : 'maxresdefault';
                $thumb = 'https://i.ytimg.com/vi/' . $videoID . '/' . apply_filters( 'eae_video_youtube_image_quality', $thumbsize ) . '.jpg';
            }
            elseif($videoType === 'wistia'){
                $url   = $settings['wistia_link'];
				$thumb = 'https://embedwistia-a.akamaihd.net/deliveries/' . $this->getStringBetween( $url, 'deliveries/', '?' );
            }
            elseif($videoType === 'dailymotion'){
                $video_data = wp_remote_get( 'https://api.dailymotion.com/video/' . $videoID . '?fields=thumbnail_url' );
                if ( isset( $video_data['response']['code'] ) ) {
					if ( 404 === $video_data['response']['code'] ) {
						return $thumb;
					}else{
						 $thumb_data = json_decode($video_data['body']);
						 $thumb = $thumb_data->thumbnail_url;
					}
				}
            }
            elseif($videoType === 'vimeo'){
                $video_data = wp_remote_get("https://vimeo.com/api/v2/video/$videoID.php");
                if ( isset( $video_data['response']['code'] ) ) {
                    if ( 404 === $video_data['response']['code'] ) {
                        return $thumb;
                    }else{
                        $vimeo = maybe_unserialize($video_data['body']);
                        $thumb = ( isset( $vimeo[0]['thumbnail_large'] ) && ! empty( $vimeo[0]['thumbnail_large'] ) ) ? str_replace( '_640', '_840', $vimeo[0]['thumbnail_large'] ) : '';
                    }
				}
            }
        }
        else{
            if($videoType === 'youtube'){
                $thumbsize = isset($settings['vb_thumbSize']) ? $settings['vb_thumbSize'] : 'maxresdefault';
                $thumb = 'https://i.ytimg.com/vi/' . $videoID . '/' . apply_filters( 'eae_video_youtube_image_quality', $thumbsize ) . '.jpg';
            }
            elseif($videoType === 'wistia'){
                $url   = $settings['wistia_link'];
				$thumb = 'https://embedwistia-a.akamaihd.net/deliveries/' . $this->getStringBetween( $url, 'deliveries/', '?' );
            }
            elseif($videoType === 'dailymotion'){
                $video_data = wp_remote_get( 'https://api.dailymotion.com/video/' . $videoID . '?fields=thumbnail_url' );
                if ( isset( $video_data['response']['code'] ) ) {
					if ( 404 === $video_data['response']['code'] ) {
						return $thumb;
					}else{
						 $thumb_data = json_decode($video_data['body']);
						 $thumb = $thumb_data->thumbnail_url;
					}
				}
            }
            elseif($videoType === 'vimeo'){
                $video_data = wp_remote_get("https://vimeo.com/api/v2/video/$videoID.php");
                if ( isset( $video_data['response']['code'] ) ) {
                    if ( 404 === $video_data['response']['code'] ) {
                        return $thumb;
                    }else{
                        $vimeo = maybe_unserialize($video_data['body']);
                        $thumb = ( isset( $vimeo[0]['thumbnail_large'] ) && ! empty( $vimeo[0]['thumbnail_large'] ) ) ? str_replace( '_640', '_840', $vimeo[0]['thumbnail_large'] ) : '';
                    }
				}
            }
        }
        return $thumb;
    }
    
    
}
?>