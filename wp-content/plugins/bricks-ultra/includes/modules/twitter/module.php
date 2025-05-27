<?php
namespace BricksUltra\includes\Twitter;

use Bricks\Element;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-twitter';
	public $icon         = 'ti-twitter';
	public $css_selector = '';
	public $scripts      = [ 'bultrTwitter' ];
	
	public function get_label() {
		return esc_html__( 'Twitter', 'wpv-bu' );
	}
	public function get_keywords() {
		return [ 'twitter', 'tweet', ];
	}

	public function set_control_groups() {
		$this->control_groups['layout'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}

	public function set_controls()
	{
		$this->controls['embed_type'] = [
				'tab'     => 'content',
				'group'   => 'layout',
				'label'   => __( 'Embed Type', 'wts-eae' ),
				'type'    => 'select',
				'default' => 'handle',
				'options' => [
					'handle'  => 'Handle',
					'tweet'   => 'Tweet',
					'hashtag' => 'Hashtag'
				],
				'clearable' => false,
				'inline' => true,
		];

		$this->controls['tweet_url'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => __( 'Tweet URL', 'wpv-bu' ),
			'type'    => 'text',

			'default' => 'https://twitter.com/Interior/status/463440424141459456',
			'placeholder' => 'https://twitter.com/Interior/status/463440424141459456',
			'required'	=>	[
				['embed_type', '=', 'tweet']
			],
		];

		$this->controls['username'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'       => __( 'Enter UserName', 'wts-eae' ),
			'type'        => 'text',
			'placeholder' => '@username',
			'default'     => '@wordpress',
			'required'	=>	[
				['embed_type', '=', 'handle']
			],
			'inline' => true,
		];


		$this->controls['hashtag'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'       => __( 'Enter Hashtag', 'wts-eae' ),
			'type'        => 'text',
			'placeholder' => '#hashtag',
			'inline' => true,
			'required'	=>	[
				['embed_type', '=', 'hashtag']
			]
		];

		$this->controls['display_mode_profile'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label'     => __( 'Display Mode', 'wts-eae' ),
			'type'      => 'select',
			'default'   => 'timeline',
			'inline' => true,
			'options'   => [
				'timeline' => 'Timeline',
				'button'   => 'Button',
			],
			'required'	=>	[
				['embed_type', '=', 'handle']
			]
		];

		$this->controls['no_of_tweets'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'       => __( 'Max Tweets', 'wts-eae' ),
			'type' => 'number',
			'inline' => true,
			'placeholder' => '5',
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ]
			]
		];

		$this->controls['timeline_width'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Width', 'bricks' ),
			'type' => 'number',
			'inline' => true,
			'min'	=>	180,
			'max'	=>	520,
			'step'  => 1,
			'placeholder' => '180',
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ]
			],	
		];

		$this->controls['timeline_height'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Height', 'bricks' ),
			'type' => 'number',
			'inline' => true,
			'min'	=>	250,
			'max'	=>	2000,
			'step'  => 1,
			'default' => 500,
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ]
			],	
		];

		$this->controls['show_header'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Show Header', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ],
			],
			'rerender'  => true,
		];

		$this->controls['show_footer'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Show Footer', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ],
			],
			'rerender'  => true,
		];

		$this->controls['show_borders'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Show Borders', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ],
			],
			'rerender'  => true,
		];

		$this->controls['show_scrollbar'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Show Scrollbar', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ],
			],
			'rerender'  => true,
		];

		$this->controls['show_transparent'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Transparent', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => false, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ],
			],
			'rerender'  => true,
		];



		

		$this->controls['button_type'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => __( 'Button Type', 'wts-eae' ),
			'type'    => 'select',
			'default' => 'follow-button',
			'options'   => [
				'follow-button'  =>  'Follow',
				'mention-button' =>  'Mention',
				'dm-button'		 =>  'Message'	
			],
			'clearable' => false,
			'rerender'  => true,
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'button' ]
			],
			'inline'	=>	true,
		];

		$this->controls['recipient_id'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'       => __( 'Recipient Id', 'wts-eae' ),
			'type'        => 'text',
			'default'  => '3805104374', 
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'button' ],
				['button_type', '=', 'dm-button' ],
			],
			'inline'	=>	true,
		];

		$this->controls['prefill_text'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'       => __( 'Tweet Text', 'wts-eae' ),
			'type'     => 'textarea',
			'description' => __( 'Do you want to prefill the Tweet text?', 'wts-eae' ),
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'button' ],
				['button_type', '=', 'mention-button' ],
			],
		];

		$this->controls['prefill_text_hashtag'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'       => __( 'Tweet Text', 'wts-eae' ),
			'type'     => 'textarea',
			'description' => __( 'Do you want to prefill the Tweet text?', 'wts-eae' ),
			'required'	=>	[
				['embed_type', '=', 'hashtag'],
			],
		];

		$this->controls['hide_name'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Hide Name', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'button' ],
				['button_type', '=', 'follow-button' ],
			],
			'rerender'  => true,
		];

		$this->controls['show_count'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => __( 'Show Count', 'wts-eae' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'button' ],
				['button_type', '=', 'follow-button' ],
			],
			'rerender'  => true,
		];


		$this->controls['large_button'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Large Button', 'bricks' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => false, // Default: false
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'button' ]
			],
			'rerender'  => true,
		];

		$this->controls['large_button_hashtag'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Large Button', 'bricks' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => false, // Default: false
			'required'	=>	[
				['embed_type', '=', 'hashtag'],
			],
			'rerender'  => true,
		];

		// Tweet Controls Start
		$this->controls['preview_card'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Preview Card', 'bricks' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'tweet']
			],
			'rerender'  => true,
		];

		$this->controls['show_conversation'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Show Conversation', 'bricks' ),
			'type' => 'checkbox',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
			'required'	=>	[
				['embed_type', '=', 'tweet']
			],
			'rerender'  => true,
		];
		$this->controls['tweet_width'] = [
			'tab' => 'content',
			'group'   => 'layout',
			'label' => esc_html__( 'Width', 'bricks' ),
			'type' => 'number',
			'inline' => true,
			'min'	=>	250,
			'max'	=>	550,
			'step'  => 1,
			'default' => 325,
			'required'	=>	[
				['embed_type', '=', 'tweet' ],
			],	
		];
		// Tweet Controls End
		$this->controls['theme'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => __( 'Theme', 'wts-eae' ),
			'type'    => 'select',
			'default' => 'light',
			'options' => [
				'light'  => 'Light',
				'dark'   => 'Dark',
			],
			'inline' => true,
			'clearable' => false,
			'rerender'  => true,
			'required'	=>	[
				['embed_type', '=', 'handle'],
				['display_mode_profile', '=', 'timeline' ]
			],
		];

		$this->controls['language'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => __( 'Language', 'wts-eae' ),
			'type'    => 'select',
			'default' => 'en',
			'options' => $this->languages(),
			'clearable' => false,
			'rerender'  => true,
			'inline' => true,
		];
	}	

	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
		if ( bricks_is_builder() ) {
			wp_enqueue_script( 'bultr-tweet-script','https://platform.twitter.com/widgets.js' , [], WPV_BU_VERSION, false );
		}
	}

	public function render(){

		$settings = $this->settings;
		$embed_type = $settings['embed_type'];
		?>
		<div <?php echo $this->render_attributes( '_root' ); ?>>
		<?php switch ( $embed_type ) {
			case 'tweet' :	$this->get_tweet_html( $settings );
							break;
			case 'handle':	$this->get_handle_html( $settings );
							break;
			case 'hashtag':	$this->get_hashtag_html( $settings );
			break;
		}
		?>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>	
		<?php
	}

	public function get_tweet_html($settings){
		$this->set_attribute( 'tweet', 'class', 'twitter-tweet' );
		$this->set_attribute( 'tweet', 'data-lang', $settings['language'] );
		$this->set_attribute( 'tweet', 'data-theme', $settings['theme'] );
		if(!isset($settings['preview_card'])){
			$this->set_attribute( 'tweet', 'data-cards', 'hidden' );
		}
		if(!isset($settings['show_conversation'])){
			$this->set_attribute( 'tweet', 'data-conversation', 'none' );
		}
		if(isset($settings['tweet_width'])){
			$this->set_attribute( 'tweet', 'data-width', $settings['tweet_width'] );
		}

		if(isset($settings['tweet_url'])){
		?>
			<blockquote <?php echo $this->render_attributes('tweet');?>>
				<a href="https://publish.twitter.com/oembed?url=<?php echo $settings['tweet_url'];?>"></a>
			</blockquote> 
		<?php
		}
	}

	public function get_handle_html( $settings ) {	
		$this->set_attribute( 'handle', 'data-lang', $settings['language'] );
		if(isset($settings['display_mode_profile'])){
			if ( $settings['display_mode_profile'] === 'timeline' ) {
				//echo '<pre>';  print_r($settings); echo '</pre>';
				
				$this->set_attribute( 'handle', 'data-theme', $settings['theme'] );
				$this->set_attribute( 'handle', 'href', 'https://www.twitter.com/' . $this->render_dynamic_data_tag($settings['username']) );
				$this->set_attribute( 'handle', 'class', 'twitter-' . $settings['display_mode_profile'] );
				$this->set_attribute( 'handle', 'data-partner', 'twitter-deck' );
				if(isset($settings['timeline_height'])){
					$this->set_attribute( 'handle', 'data-height', $settings['timeline_height'] );
				}
				if(isset($settings['timeline_width'])){
					$this->set_attribute( 'handle', 'data-width', $settings['timeline_width'] );
				}
				if(!isset($settings['show_header'])){
					$this->set_attribute( 'handle', 'data-chrome', "noheader" );
				}
				if(!isset($settings['show_footer'])){
					$this->set_attribute( 'handle', 'data-chrome', "nofooter" );
				}	
				if(!isset($settings['show_borders'])){
					$this->set_attribute( 'handle', 'data-chrome', "noborders" );
				}
				if(!isset($settings['show_scrollbar'])){
					$this->set_attribute( 'handle', 'data-chrome', " noscrollbar" );	
				}
				if(isset($settings['show_transparent'])){
					$this->set_attribute( 'handle', 'data-chrome', " transparent" );	
				}
				if(isset($settings['no_of_tweets'])){
					$this->set_attribute( 'handle', 'data-tweet-limit', $settings['no_of_tweets'] );
				}
			}else{
				$this->set_attribute( 'handle', 'class', 'twitter-' . $settings['button_type'] );
				if($settings['button_type'] === 'follow-button'){
					if(!isset($settings['username'])){
						if ( bricks_is_builder_call() ) {
							echo "<div class='bu-notice'>To Render button Add UserName</div>";
						}
						return;
					}
					$this->set_attribute( 'handle', 'href', 'https://www.twitter.com/' . $settings['username'] );
					if ( isset($settings['hide_name'])) {
						$this->set_attribute( 'handle', 'data-show-screen-name', 'false' );
					}
					if (!isset($settings['show_count'])) {
						$this->set_attribute( 'handle', 'data-show-count', 'false' );
					}
				}elseif($settings['button_type'] === 'mention-button'){
					if(!isset($settings['username'])){
						if ( bricks_is_builder_call() ) {
							echo "<div class='bu-notice'>To render button Add UserName</div>";					
						}
						return;
					}
					$this->set_attribute( 'handle', 'href', 'https://www.twitter.com/intent/tweet ?screen_name=' . $settings['username'] );
					if(isset($settings['prefill_text'])){
						$this->set_attribute( 'handle', 'data-text', $settings['prefill_text'] );
					}
				}else{
					if(!isset($settings['recipient_id'])){
						if ( bricks_is_builder_call() ) {
							echo "<div class='bu-notice'>Add Recipient Id to render button</div>";					
						}
						return;
					}
					$this->set_attribute( 'handle', 'href', 'https://twitter.com/messages/compose?recipient_id=' . $settings['recipient_id'] );
				}
				if ( isset($settings['large_button']) ) {
					$this->set_attribute( 'handle', 'data-size', 'large' );
				}
			}
		}
		?>
		<a <?php echo $this->render_attributes( 'handle' ); ?>> </a>
		<?php
	}

	public function get_hashtag_html( $settings ) {
		if(!isset($settings['hashtag'])){
			if ( bricks_is_builder_call() ) {
				echo "<div class='bu-notice'>To Render button Add Hashtag</div>";
			}
			return;
		}
		$this->set_attribute( 'hashtag', 'class', 'twitter-hashtag-button' );
		$this->set_attribute( 'hashtag', 'href', 'https://twitter.com/intent/tweet?button_hashtag=' . $settings['hashtag'] );
		$this->set_attribute( 'hashtag', 'data-lang', $settings['language'] );

		if ( isset($settings['prefill_text_hashtag']) ) {
			$this->set_attribute( 'hashtag', 'data-text', $settings['prefill_text_hashtag'] );
		}
		if ( isset($settings['large_button'])) {
			$this->set_attribute( 'hashtag', 'data-size', 'large' );
		}
		//$this->set_attribute( 'hashtag', 'data-url', $settings['hashtag_url'] );

		?>
		<a <?php echo $this->render_attributes( 'hashtag' ); ?> >Tweet<?php echo $settings['hashtag']; ?> </a>
		<?php
	}

	public function languages() {
		$languages = [
			''      => __( 'Automatic', 'wts-eae' ),
			'en'    => __( 'English', 'wts-eae' ),
			'ar'    => __( 'Arabic', 'wts-eae' ),
			'bn'    => __( 'Bengali', 'wts-eae' ),
			'cs'    => __( 'Czech', 'wts-eae' ),
			'da'    => __( 'Danish', 'wts-eae' ),
			'de'    => __( 'German', 'wts-eae' ),
			'el'    => __( 'Greek', 'wts-eae' ),
			'es'    => __( 'Spanish', 'wts-eae' ),
			'fa'    => __( 'Persian', 'wts-eae' ),
			'fi'    => __( 'Finnish', 'wts-eae' ),
			'fil'   => __( 'Filipino', 'wts-eae' ),
			'fr'    => __( 'French', 'wts-eae' ),
			'he'    => __( 'Hebrew', 'wts-eae' ),
			'hi'    => __( 'Hindi', 'wts-eae' ),
			'hu'    => __( 'Hungarian', 'wts-eae' ),
			'id'    => __( 'Indonesian', 'wts-eae' ),
			'it'    => __( 'Italian', 'wts-eae' ),
			'ja'    => __( 'Japanese', 'wts-eae' ),
			'ko'    => __( 'Korean', 'wts-eae' ),
			'msa'   => __( 'Malay', 'wts-eae' ),
			'nl'    => __( 'Dutch', 'wts-eae' ),
			'no'    => __( 'Norwegian', 'wts-eae' ),
			'pl'    => __( 'Polish', 'wts-eae' ),
			'pt'    => __( 'Portuguese', 'wts-eae' ),
			'ro'    => __( 'Romania', 'wts-eae' ),
			'ru'    => __( 'Rus', 'wts-eae' ),
			'sv'    => __( 'Swedish', 'wts-eae' ),
			'th'    => __( 'Thai', 'wts-eae' ),
			'tr'    => __( 'Turkish', 'wts-eae' ),
			'uk'    => __( 'Ukrainian', 'wts-eae' ),
			'ur'    => __( 'Urdu', 'wts-eae' ),
			'vi'    => __( 'Vietnamese', 'wts-eae' ),
			'zh-cn' => __( 'Chinese (Simplified)', 'wts-eae' ),
			'zh-tw' => __( 'Chinese (Traditional)', 'wts-eae' ),
		];

		return $languages;
	}
}		