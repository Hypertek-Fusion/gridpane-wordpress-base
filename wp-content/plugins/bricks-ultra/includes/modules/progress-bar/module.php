<?php
namespace BricksUltra\includes\ProgressBar;

use Bricks\Element;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-progress-bar';
	public $icon         = 'ti-line-double';
	public $css_selector = '';
	public $scripts      = [ 'progressBar' ];
	
	public function get_label() {
		return esc_html__( 'Progress Bar', 'wpv-bu' );
	}
	public function get_keywords() {
		return [ 'bar', 'progress-bar'];
	}

	public function set_control_groups() {
		$this->control_groups['progress_layout'] = [
			'title' => esc_html__( 'Progress Bar', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['progress_layout_style'] = [
			'title' => esc_html__( 'Progress Bar Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}

	
	public function set_controls(){
		$this->controls['progress_title'] = [
			'tab'     => 'content',
			'group'   => 'progress_layout',
			'label'   => __( 'Title', 'wpv-bu' ),
			'type'    => 'text',
			'default' => 'MySkill',
		];
		$this->controls['progress_type'] = [
			'tab'     => 'content',
			'group'   => 'progress_layout',
			'label'   => __( 'Type', 'wpv-bu' ),
			'type' => 'select',
			'options' => [
			  'layout1' => 'Layout 1',
			  'layout2' => 'Layout 2',
			  'layout3' => 'Layout 3',
			  'layout4' => 'Layout 4',
			  'layout5' => 'Layout 5',
			],
			'inline' => true,	
			'default'=>'layout1',	
			'clearable' => false,
		];
		$this->controls['progress_percentage'] = [
			'tab' => 'content',
			'label' => esc_html__( 'Percentage(%)', 'wpv-bu' ),
			'group'   => 'progress_layout',
			'type' => 'number',
			// 'css' => [
			//   [
			// 	'property' => 'font-size',
			//   ],
			// ],
			'unit'	=>	'%',
			'unitless' => true,
			'default'  => '50%',
			'max'      => 100,
			'min'		=> 1,
			'step'		=>	1,
			'description' => esc_html__( 'Number should be 1 to 100', 'wpv-bu' ),
   
		];
		
		$this->controls['progress_title_show'] = [
				'tab' => 'content',
				'label' => esc_html__( 'Show Title', 'wpv-bu' ),
				'type' => 'checkbox',
				'group'   => 'progress_layout',
				'inline' => true,
				'small' => true,
				'default' => true, // Default: false
		];
		$this->controls['show_percentage'] = [
			'tab' => 'content',
			'label' => esc_html__( 'Show Percentage', 'wpv-bu' ),
			'type' => 'checkbox',
			'group'   => 'progress_layout',
			'inline' => true,
			'small' => true,
			'default' => true, // Default: false
	];

		$this->controls['progress_bar_color'] = [
			'tab'    => 'content',
			'group'  => 'progress_layout_style',
			'label'  => esc_html__( 'Progress Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-pb-bar-inner',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-pb-bar-inner.bultr-pb-bar-inner-layout4::after',
				],
				[
					'property' => 'border-top-color',
					'selector' => '.bultr-pb-bar-value.bultr-pb-bar-value-layout3::after',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-pb-bar-value.bultr-pb-bar-value-layout3',
				],
			],
			'required'    => [ 'progress_type', '!=', 'layout2' ],
			
		];
		$this->controls['progress_bar_color_1'] = [
			'tab'    => 'content',
			'group'  => 'progress_layout_style',
			'label'  => esc_html__( 'Progress Color1', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'selector' => '',
					'property' => '--color1',
				],
					
				],
				'required'    => [ 'progress_type', '=', 'layout2' ],
			
			
		];
		
		$this->controls['progress_color_2'] = [
			'tab'    => 'content',
			'group'  => 'progress_layout_style',
			'label'  => esc_html__( 'Progress Color2', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
		
			'css'    => [
				[
					'selector' => '',
					'property' => '--color2',
				],
					
				],
				'required'    => [ 'progress_type', '=', 'layout2' ],
			
		];
		
	  


		$this->controls['progress_bar_backgroundcolor'] = [
			'tab'    => 'content',
			'group'  => 'progress_layout_style',
			'label'  => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-pb-bar',
				],
				
			],
		];

		$this->controls['progress_title_typo'] = [
			'tab'     => 'content',
			'group'   => 'progress_layout_style',
			'label'   => esc_html__( 'Title Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-pb-bar-skill',
				],
			],
			'required'    => [ 'progress_title_show', '=', true ],
			'exclude' => [
				'text-align',]
			];
		
			$this->controls['progress_percentage_typo'] = [
				'tab'     => 'content',
				'group'   => 'progress_layout_style',
				'label'   => esc_html__( 'Percentage Typography', 'wpv-bu' ),
				'type'    => 'typography',
				'css'     => [
					[
						'property' => 'typography',
						'selector' => '.bultr-pb-bar-value',
					],
				],
				'required'    => [ 'show_percentage', '=', true ],
				'exclude' => [
					'text-align',]
				];
			

	}	

	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
		wp_enqueue_script( 'bultr-waypoint', WPV_BU_URL . 'assets/vendor/waypoint/waypoints.js', [], '0.0.1', true );
	}


	public function render(){
		
		 $settings = $this->settings;
		
		 $this->set_attribute( '_root', 'class', 'bultr-progress-element' );
		
		 $this->set_attribute( 'box', 'class', 'bultr-progress-bar-wrapper'  );
		 $this->set_attribute( 'box', 'class', 'bultr-progress-bar ' );
		 $this->set_attribute( 'box', 'class', 'bultr-progress-bar-' .$settings['progress_type'] );
		 $this->set_attribute( 'box', 'data-layout ='.$settings['progress_type']   );
		 $this->set_attribute( 'box', 'data-value ='.$settings['progress_percentage']  );
		
		 $this->set_attribute( 'per', 'class', 'bultr-pb-bar-value'  );
		 $this->set_attribute( 'per', 'class', 'bultr-pb-bar-value-'.$settings['progress_type'] );


		 $this->set_attribute( 'bar', 'class', 'bultr-pb-bar'  );
		 $this->set_attribute( 'bar', 'class', 'bultr-pb-bar-'.$settings['progress_type'] );
		if($settings['progress_type'] == 'layout2'){
		}
		 $this->set_attribute( 'set', 'class', 'bultr-pb-bar-inner'  );
		 $this->set_attribute( 'set', 'class', 'bultr-pb-bar-inner-'.$settings['progress_type'] );
		 $this->set_attribute( 'set', 'style='.$settings['progress_percentage'] );

		 $this->set_attribute( 'text', 'class', 'bultr-pb-bar-skill'  );
		 $this->set_attribute( 'text', 'class', 'bultr-pb-bar-skill-'.$settings['progress_type'] );

		
		
		?>
	<div <?php echo $this->render_attributes( '_root' ); ?>>
		<div <?php echo $this->render_attributes( 'box' ); ?>>
			<?php if ( $settings['show_percentage'] ) { ?>
			<span <?php echo $this->render_attributes( 'per' ); ?>>
			<?php echo $settings['progress_percentage']; ?>
			</span>
			<?php } ?>
			<div  <?php echo $this->render_attributes( 'bar' ); ?>>
				<div <?php echo $this->render_attributes( 'set' ); ?>>
				</div>
			</div>
			<?php if ( $settings['progress_title_show'] ) { ?>
			<span <?php echo $this->render_attributes('text'); ?>>
			<?php echo $settings['progress_title']; ?>
			</span>
			<?php } ?>
		</div>
	</div>
	
		<?php
	}
	
}		
