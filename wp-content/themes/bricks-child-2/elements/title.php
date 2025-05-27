<?php 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Map_Element_Test extends \Bricks\Element {
  // Element properties
  public $category     = 'general'; // Use predefined element category 'general'
  public $name         = 'Service Map'; // Make sure to prefix your elements
  public $icon         = 'fas fa-map'; // Themify icon font class
  public $scripts = ['prefixCityListManager'];
  private $api_key;
  // Return localised element label
  public function get_label() {
    return esc_html__( 'Hypersite Map', 'bricks' );
  }
  // Set builder control groups
  public function set_control_groups() {
    $this->control_groups['map_core'] = [
      'title' => esc_html__('Map', 'bricks'),
      'tab' => 'content',
    ];
    $this->control_groups['section_heading'] = [
      'title' => esc_html__('Section Heading', 'bricks'),
      'tab' => 'content',
    ];
    $this->control_groups['city_list_settings'] = [
        'title' => esc_html__('City List Settings', 'bricks'),
        'tab' => 'content',
      ];
    $this->control_groups['list_item_settings'] = [
      'title' => esc_html__('List Item Settings', 'bricks'),
      'tab' => 'content',
    ];
    $this->control_groups['locations'] = [
      'title' => esc_html__( 'Locations', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['marker'] = [ 
      'title' => esc_html__( 'Marker', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['circle_settings'] = [ 
      'title' => esc_html__( 'Circle Settings', 'bricks' ),
      'tab' => 'content',
    ];
    $this->control_groups['settings'] = [
      'title' => esc_html__( 'Settings', 'bricks' ),
      'tab' => 'content',
    ];
  }
  // Set builder controls
  public function set_controls() {
    $this->controls['content'] = [ // Unique control identifier (lowercase, no spaces)
      'tab' => 'content', // Control tab: content/style
      'group' => 'text', // Show under control group
      'label' => esc_html__( 'Content', 'bricks' ), // Control label
      'type' => 'text', // Control type 
      'default' => esc_html__( 'Content goes here ..', 'bricks' ), // Default setting
    ];
    $this->controls['locations'] = [
      'tab' => 'content',
      'group' => 'locations',
      'label' => esc_html__( 'Manually Enter Locations', 'bricks' ),
      'type' => 'repeater',
      'titleProperty' => 'title', // Default 'title'
      'placeholder' => esc_html__( 'Title placeholder', 'bricks' ),
      'fields' => [
        'city' => [
          'label' => esc_html__( 'City', 'bricks' ),
          'type' => 'text',
        ],
        'state' => [
          'label' => esc_html__( 'State', 'bricks' ),
          'type' => 'text',
        ],
        'coordinates' => [
          'label' => esc_html__('Coordinates', 'bricks'),
        ],
        'longitude' => [
          'label' => esc_html__('Longitude', 'bricks'),
          'type' => 'number',
        ],
        'latitude' => [
          'label' => esc_html__('Latitude', 'bricks'),
          'type' => 'number',
        ],
      ],
    ];
    $this->controls['defaultMarkerColor'] = [
      'tab' => 'content',
      'group' => 'marker',
      'label' => esc_html__( 'Default Marker Color', 'bricks' ),
      'type' => 'color',
      'inline' => true,
      'default' => [
        'hex' => '#FFFFFF',
        'rgb' => 'rgba(255, 255, 255, 1)',
      ],
    ];
    $this->controls['selectedMarkerColor'] = [
      'tab' => 'content',
      'group' => 'marker',
      'label' => esc_html__( 'Selected Marker Color', 'bricks' ),
      'type' => 'color',
      'inline' => false,
      'default' => [
        'hex' => '#000000',
        'rgb' => 'rgba(0, 0, 0, 1)',
      ],
    ];
    $this->controls['center_long'] = [
      'tab' => 'content',
      'group' => 'map_core',
      'label' => esc_html__( 'Map Center (Longitude)', 'bricks' ),
      'type' => 'number',
    ];
    $this->controls['center_lat'] = [
      'tab' => 'content',
      'group' => 'map_core',
      'label' => esc_html__( 'Map Center (Latitude)', 'bricks' ),
      'type' => 'number',
    ];
    $this->controls['defaultZoom'] = [
      'tab' => 'content',
      'group' => 'map_core',
      'label' => esc_html__( 'Default Zoom', 'bricks' ),
      'type' => 'number',
    ];  
    $this->controls['mapWidth'] = [
      'tab' => 'content',
      'group' => 'settings',
      'label' => esc_html__( 'Width', 'bricks' ),
      'type' => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'width',
          'selector' => '.hyperMap',
        ],
      ],
    ];
    $this->controls['mapHeight'] = [
      'tab' => 'content',
      'group' => 'settings',
      'label' => esc_html__( 'Height', 'bricks' ),
      'type' => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'height',
          'selector' => '.hyperMap',
        ],
      ],
    ];
    $this->controls['numRows'] = [
      'tab' => 'content',
      'group' => 'city_list_settings',
      'label' => esc_html__( 'Number of Rows', 'bricks' ),
      'type' => 'number',
      'units' => false,
      'default' => 10,
    ];
    $this->controls['listIcon'] = [
        'tab' => 'content',
        'label' => esc_html__( 'Icon', 'bricks' ),
        'group' => 'list_item_settings',
        'type' => 'icon',
        'default' => [
            'library' => 'ionicons', // fontawesome/ionicons/themify
            'icon' => 'ion-md-pin',    // Example: Themify icon class
        ],
        'css' => [
            [
                'selector' => '.cities-list__icon', // Use to target SVG file
            ],
        ],
    ];
    $this->controls['parentDirection'] = [ // Setting key
        'tab'   => 'content',
        'group' => 'settings',
        'label' => esc_html__( 'Direction', 'bricks' ),
        'type'  => 'direction',
        'css'   => [
            [
            'property' => 'flex-direction',
            ],
        ],
    ];
    $this->controls['wrapperDirection'] = [ // Setting key
        'tab'   => 'content',
        'group' => 'list_item_settings',
        'label' => esc_html__( 'Direction', 'bricks' ),
        'type'  => 'direction',
        'css'   => [
            [
            'property' => 'flex-direction',
            'selector' => '.cities-list__city-wrapper',
            ],
        ],
    ];
    $this->controls['cityListItemMarkerColor'] = [
        'tab' => 'content',
        'group' => 'list_item_settings',
        'label' => esc_html__( 'Icon Color', 'bricks' ),
        'type' => 'color',
        'inline' => false,
        'css' => [
            [
                'property' => 'color',
                'selector' => '.cities-list__icon',
            ]
            ],
        'default' => [
          'hex' => '#000000',
          'rgb' => 'rgba(0, 0, 0, 1)',
        ],
    ];
    $this->controls['cityIconHeight'] = [
      'tab' => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Icon Height', 'bricks' ),
      'type' => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'font-size',
          'selector' => '.cities-list__icon',
        ],
      ],
      'default' => 28,
  ];
  $this->controls['wrapperColumnGap'] = [
      'tab' => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Column Gap', 'bricks' ),
      'type' => 'number',
      'inline' => true,
      'units' => true,
      'css' => [
        [
          'property' => 'column-gap',
          'selector' => '.cities-list__city-wrapper',
        ],
      ],
      'default' => 5,
  ];
  $this->controls['wrapperRowGap'] = [
      'tab' => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Row Gap', 'bricks' ),
      'type' => 'number',
      'inline' => true,
      'units' => true,
      'css' => [
        [
          'property' => 'row-gap',
          'selector' => '.cities-list__city-wrapper',
        ],
      ],
      'default' => 5,
  ];
  $this->controls['alignItemsCityListItemWrapper'] = [
      'tab'   => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Align items', 'bricks' ),
      'type'  => 'align-items',
      'css'   => [
      [
          'property' => 'align-items',
          'selector' => '.cities-list__city-wrapper',
      ],
      ],
  ];
  $this->controls['justifyContentCityListItemWrapper'] = [
      'tab'   => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Justify content', 'bricks' ),
      'type'  => 'justify-content',
      'css'   => [
        [
          'property' => 'justify-content',
          'selector' => '.cities-list__city-wrapper',
        ],
      ],
  ];
  $this->controls['typographyCityListItemWrapper'] = [
      'tab' => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
      [
          'property' => 'typography',
          'selector' => '.cities-list__name',
      ],
      ],
      'inline' => true,
      ];
      $this->controls['listColumnGap'] = [
        'tab' => 'content',
        'group' => 'city_list_settings',
        'label' => esc_html__( 'Column Gap', 'bricks' ),
        'type' => 'number',
        'inline' => true,
        'units' => true,
        'css' => [
          [
            'property' => 'column-gap',
            'selector' => '.cities-list',
          ],
        ],
        'default' => 5,
    ];
    $this->controls['listRowGap'] = [
        'tab' => 'content',
        'group' => 'city_list_settings',
        'label' => esc_html__( 'Row Gap', 'bricks' ),
        'type' => 'number',
        'inline' => true,
        'units' => true,
        'css' => [
          [
            'property' => 'row-gap',
            'selector' => '.cities-list__col',
          ],
        ],
        'default' => 5,
    ];
    $this->controls['wrapperBoxShadow'] = [
      'tab' => 'content',
      'group' => 'list_item_settings',
      'label' => esc_html__( 'Box Shadow', 'bricks' ),
      'type' => 'box-shadow',
      'css' => [
        [
          'property' => 'box-shadow',
          'selector' => '.cities-list__city-wrapper',
        ],
      ],
      'inline' => true,
      'small' => true,
    ];
    $this->controls['wrapperBorder'] = [
        'tab' => 'content',
        'group' => 'list_item_settings',
        'label' => esc_html__( 'Border', 'bricks' ),
        'type' => 'border',
        'css' => [
          [
            'property' => 'border',
            'selector' => '.cities-list__city-wrapper',
          ],
        ],
        'inline' => true,
        'small' => true,  
      ];
      $this->controls['wrapperPadding'] = [
        'tab' => 'content',
        'group' => 'list_item_settings',
        'label' => esc_html__( 'Padding', 'bricks' ),
        'type' => 'dimensions',
        'css' => [
          [
            'property' => 'padding',
            'selector' => '.cities-list__city-wrapper',
          ]
        ],
      ];
      $this->controls['wrapperMargin'] = [
        'tab' => 'content',
        'group' => 'list_item_settings',
        'label' => esc_html__( 'Margin', 'bricks' ),
        'type' => 'dimensions',
        'css' => [
          [
            'property' => 'margin',
            'selector' => '.cities-list__city-wrapper',
          ]
        ],
      ];
      $this->controls['parentColumnGap'] = [
        'tab' => 'content',
        'group' => 'settings',
        'label' => esc_html__( 'Column Gap', 'bricks' ),
        'type' => 'number',
        'inline' => true,
        'css' => [
        [
          'property' => 'column-gap',
        ],
        ],
        'default' => 5,
    ];
    $this->controls['parentRowGap'] = [
        'tab' => 'content',
        'group' => 'settings',
        'label' => esc_html__( 'Row Gap', 'bricks' ),
        'type' => 'number',
        'inline' => true,
        'css' => [
        [
          'property' => 'row-gap',
        ],
        ],
        'default' => 5,
    ];
    $this->controls['mapBoxShadow'] = [
      'tab' => 'content',
      'group' => 'map_core',
      'label' => esc_html__( 'Box Shadow', 'bricks' ),
      'type' => 'box-shadow',
      'css' => [
        [
          'property' => 'box-shadow',
          'selector' => '.hyperMap',
        ],
      ],
      'inline' => true,
      'small' => true,
    ];
    $this->controls['mapBorder'] = [
        'tab' => 'content',
        'group' => 'map_core',
        'label' => esc_html__( 'Border', 'bricks' ),
        'type' => 'border',
        'css' => [
          [
            'property' => 'border',
            'selector' => '.hyperMap',
          ],
        ],
        'inline' => true,
        'small' => true,  
      ];
    $this->controls['breakpoints'] = [
      'tab' => 'content',
      'group' => 'map_core',
      'label' => esc_html__( 'Breakpoints', 'bricks' ),
      'type' => 'repeater',
      'titleProperty' => 'title', // Default 'title'
      'placeholder' => esc_html__( 'Breakpoints', 'bricks' ),
      'fields' => [
        'maxWidth' => [
          'label' => esc_html__( 'Max Width', 'bricks' ),
          'type' => 'text',
        ],
        'zoomLevel' => [
          'label' => esc_html__( 'Zoom Level', 'bricks' ),
          'type' => 'text',
        ],
      ],
    ];
      $this->controls['parentPadding'] = [
        'tab' => 'content',
        'group' => 'settings',
        'label' => esc_html__( 'Padding', 'bricks' ),
        'type' => 'dimensions',
        'css' => [
          [
            'property' => 'padding',
          ]
        ],
      ];
      $this->controls['parentMargin'] = [
        'tab' => 'content',
        'group' => 'settings',
        'label' => esc_html__( 'Margin', 'bricks' ),
        'type' => 'dimensions',
        'css' => [
          [
            'property' => 'margin',
          ]
        ],
      ];
    $this->controls['circleColor'] = [
      'tab' => 'content',
      'group' => 'circle_settings',
      'label' => esc_html__( 'Circle Color', 'bricks' ),
      'type' => 'color',
      'inline' => false,
      'default' => [
        'rgb' => 'rgba(0, 0, 0, 0.1)',
      ],
    ];
    $this->controls['circle_long'] = [
      'tab' => 'content',
      'group' => 'circle_settings',
      'label' => esc_html__( 'Circle Center (Longitude)', 'bricks' ),
      'type' => 'number',
    ];
    $this->controls['circle_lat'] = [
      'tab' => 'content',
      'group' => 'circle_settings',
      'label' => esc_html__( 'Circle Center (Latitude)', 'bricks' ),
      'type' => 'number',
    ];
    $this->controls['circleZoomsRadius'] = [
      'tab' => 'content',
      'group' => 'circle_settings',
      'label' => esc_html__( 'Circle Radius Levels', 'bricks' ),
      'type' => 'repeater',
      'titleProperty' => 'title', // Default 'title'
      'placeholder' => esc_html__( 'Levels', 'bricks' ),
      'fields' => [
        'zoomLevel' => [
          'label' => esc_html__( 'Zoom Level', 'bricks' ),
          'type' => 'text',
        ],
        'radius' => [
          'label' => esc_html__( 'Radius', 'bricks' ),
          'type' => 'text',
        ],
      ],
    ];
    $this->controls['preheaderText'] = [
      'tab' => 'content',
      'group' => 'section_heading',
      'label' => esc_html__( 'Preheader', 'bricks' ),
      'type' => 'text',
      'default' => 'Example Preheader',
    ];
    $this->controls['headingText'] = [
      'tab' => 'content',
      'group' => 'section_heading',
      'label' => esc_html__( 'Heading', 'bricks' ),
      'type' => 'text',
      'default' => 'Example Heading',
    ];
    $this->controls['bodyText'] = [
      'tab' => 'content',
      'group' => 'section_heading',
      'label' => esc_html__( 'Body Text', 'bricks' ),
      'type' => 'textarea',
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    ];
    $this->controls['sectionHeadingTitleTag'] = [
      'tab' => 'content',
      'group' => 'section_heading',
      'label' => esc_html__( 'Title tag', 'bricks' ),
      'type' => 'select',
      'options' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
        'span' => 'span',
        'p' => 'p',
      ],
      'inline' => true,
      'placeholder' => esc_html__( 'h3', 'bricks' ),
      'multiple' => false, 
      'searchable' => true,
      'clearable' => true,
      'default' => 'h3',
    ];
      $this->controls['sectionHeadingPadding'] = [
        'tab' => 'content',
        'group' => 'section_heading',
        'label' => esc_html__( 'Padding', 'bricks' ),
        'type' => 'dimensions',
        'css' => [
          [
            'property' => 'padding',
            'selector' => 'div[data-type="content-wrapper"] > div:first-child',
          ]
        ],
      ];
      $this->controls['sectionHeadingMargin'] = [
        'tab' => 'content',
        'group' => 'section_heading',
        'label' => esc_html__( 'Margin', 'bricks' ),
        'type' => 'dimensions',
        'css' => [
          [
            'property' => 'margin',
            'selector' => 'div[data-type="content-wrapper"] > div:first-child',
          ]
        ],
      ];
    $this->controls['sectionHeadingRowGap'] = [
        'tab' => 'content',
        'group' => 'section_heading',
        'label' => esc_html__( 'Row Gap', 'bricks' ),
        'type' => 'number',
        'inline' => true,
        'units' => true,
        'css' => [
        [
          'property' => 'row-gap',
          'selector' => 'div[data-type="content-wrapper"] > div:first-child',
        ],
        ],
        'default' => 5,
    ];
  $this->controls['typographySectionHeading'] = [
      'tab' => 'content',
      'group' => 'section_heading',
      'label' => esc_html__( 'Heading Typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
      [
          'property' => 'typography',
          'selector' => 'div[data-type="content-wrapper"] > div:first-child > :nth-child(2)',
      ],
      ],
      'inline' => true,
      ];
      $this->controls['typographySectionHeadingBody'] = [
          'tab' => 'content',
          'group' => 'section_heading',
          'label' => esc_html__( 'Body Typography', 'bricks' ),
          'type' => 'typography',
          'css' => [
          [
              'property' => 'typography',
              'selector' => 'div[data-type="content-wrapper"] > div:first-child > :last-child',
          ],
          ],
          'inline' => true,
          ];
        $this->controls['parentBoxShadow'] = [
          'tab' => 'content',
          'group' => 'settings',
          'label' => esc_html__( 'Box Shadow', 'bricks' ),
          'type' => 'box-shadow',
          'css' => [
            [
              'property' => 'box-shadow',
            ],
          ],
          'inline' => true,
          'small' => true,
        ];
        $this->controls['parentBorder'] = [
            'tab' => 'content',
            'group' => 'settings',
            'label' => esc_html__( 'Border', 'bricks' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
              ],
            ],
            'inline' => true,
            'small' => true,  
          ];
        $this->controls['parentBgColor'] = [
          'tab' => 'content',
          'group' => 'settings',
          'label' => esc_html__( 'Background Color', 'bricks' ),
          'type' => 'color',
            'css' => [
              [
                'property' => 'background-color',
              ],
            ],
            'inline' => false,
            'default' => [
              'rgb' => 'rgba(255, 255, 255, 0.1)',
            ],
          ];
      $this->controls['contentWidth'] = [
        'tab' => 'content',
        'group' => 'section_heading',
        'label' => esc_html__( 'Width', 'bricks' ),
        'type' => 'number',
        'units' => true,
        'css' => [
          [
            'property' => 'width',
            'selector' => 'div[data-type="content-wrapper"]',
          ],
        ],
      ];
      $this->controls['contentHeight'] = [
        'tab' => 'content',
        'group' => 'section_heading',
        'label' => esc_html__( 'Height', 'bricks' ),
        'type' => 'number',
        'units' => true,
        'css' => [
          [
            'property' => 'height',
            'selector' => 'div[data-type="content-wrapper"]',
          ],
        ],
      ];
    }
    // Render element HTML
    public function render() {
    $this->$api_key = get_field('mapbox_api_key', 'option');
    $heading_tag = isset( $this->settings['sectionHeadingTitleTag'] ) ? $this->settings['sectionHeadingTitleTag'] : 'h3';
    $section_heading_container = "{$this->element["id"]}-section-heading__container";
    // Render element HTML
    // '_root' attribute is required since Bricks 1.4 (contains element ID, class, etc.)
    echo "<div {$this->render_attributes( '_root' )}>"; // Element root attributes
    echo "<div id=\"{$this->element["id"]}-content-wrapper\" data-type=\"content-wrapper\">";
    echo "<div id=\"{$this->element["id"]}-section-heading__container\">";
    echo "<div id=\"map-sa-preheader\"><span class=\"icon\"><svg class=\"\" xmlns=\"http://www.w3.org/2000/svg\" width=\"25\" height=\"21\" viewBox=\"0 0 25 21\" fill=\"none\"><path d=\"M12.52 0.00404487C14.9682 0.00404487 17.4158 0.00958103 19.864 1.85739e-05C20.4048 -0.00199458 20.8565 0.159561 21.2579 0.523437C22.3077 1.47515 23.3731 2.40925 24.4264 3.35745C25.0869 3.95183 25.1905 4.84516 24.6668 5.55732C21.0461 10.4805 17.4229 15.4016 13.7936 20.3182C13.1251 21.2241 11.8892 21.2282 11.2197 20.3248C8.71414 16.9437 6.21968 13.5546 3.7222 10.1679C2.61757 8.67015 1.51697 7.16985 0.413352 5.67106C-0.206868 4.82906 -0.128901 4.00065 0.645746 3.3036C1.67391 2.37805 2.71164 1.46257 3.73427 0.530987C4.13467 0.166103 4.58538 -0.000988001 5.12562 0.000521861C7.5904 0.00857446 10.0552 0.00404487 12.52 0.00404487ZM16.0954 4.81396C13.688 4.81396 11.3117 4.81396 8.92139 4.81396C8.92944 4.89197 8.93044 4.9584 8.94402 5.02232C10.0084 9.99128 11.0753 14.9597 12.1332 19.9302C12.1809 20.1552 12.2901 20.2216 12.4898 20.2211C12.691 20.2206 12.8218 20.1778 12.8736 19.9317C13.8328 15.4026 14.8032 10.8756 15.7705 6.34798C15.8786 5.84268 15.9848 5.33688 16.0954 4.81396ZM11.1477 18.9357C10.1342 14.1957 9.13165 9.50712 8.12763 4.81195C5.68296 4.81195 3.2554 4.81195 0.826329 4.81195C0.869589 5.04749 10.4314 18.1355 11.1477 18.9357ZM16.8756 4.80994C15.8696 9.51366 14.8671 14.2023 13.8595 18.9146C14.2956 18.4913 24.1422 5.01779 24.1688 4.80994C21.7478 4.80994 19.3278 4.80994 16.8756 4.80994ZM20.5069 0.877248C19.5044 1.92962 18.5265 2.95683 17.5159 4.01726C19.7031 4.01726 21.8318 4.01726 24.0265 4.01726C22.8318 2.9518 21.6834 1.92711 20.5069 0.877248ZM4.49735 0.881275C3.31928 1.93013 2.16737 2.95532 0.975222 4.01675C3.17391 4.01675 5.30318 4.01675 7.48376 4.01675C6.47471 2.95733 5.49986 1.93365 4.49735 0.881275ZM12.5059 0.909962C11.4727 1.97693 10.4692 3.0127 9.49332 4.02028C11.4802 4.02028 13.5275 4.02028 15.528 4.02028C14.5361 2.99961 13.529 1.96334 12.5059 0.909962ZM11.4501 0.783637C9.49533 0.783637 7.49885 0.783637 5.45208 0.783637C6.45811 1.83953 7.42994 2.8602 8.42742 3.90704C9.45459 2.8456 10.4601 1.80632 11.4501 0.783637ZM19.5486 0.783134C17.4908 0.783134 15.4953 0.783134 13.6045 0.783134C14.5688 1.78518 15.5753 2.83151 16.5914 3.88791C17.5773 2.85265 18.5461 1.83551 19.5486 0.783134Z\" fill=\"black\"></path></svg></span><p class=\"preheader\">{$this->settings["preheaderText"]}</p></div>";
    echo "<{$heading_tag} id=\"{$this->element["id"]}__section-heading\">{$this->settings["headingText"]}</{$heading_tag}>";
    echo "<p>{$this->settings["bodyText"]}</p>";
    echo "</div>";
    echo "<div id=\"cities-list-{$this->element["id"]}\" class=\"cities-list\">";
    echo "</div>";
    echo "</div>";
    echo "<div id=\"hyperMap-{$this->element["id"]}\" class=\"hyperMap\">";
    echo "</div>";
    echo "
    <script>
    (async () => {
    document.addEventListener(\"DOMContentLoaded\", async () => {
    let mapCoordinates = await (async () => {
    try {
      const res = await fetch('" . get_site_url() . '/wp-json/hypermap/v1/geojson' . "')
      if (!res.ok)
      {
        throw new Error('Invalid Response');
      }
      return await res.json();
    } catch (error) {
      console.error('HTTP Request Error: ', error);
      return null;
    }
    })();
    if(!mapCoordinates) {
    console.error('Failed to retrieve coordinate data.')
    }
    let init = true;
    const defaultZoom = {$this->settings['defaultZoom']};                                                                                                        
    const defaultLongLat = [{$this->settings['center_long']},{$this->settings['center_lat']}];                                                                              
    const primaryColor = ";
    if(is_countable($this->settings['defaultMarkerColor']) && count( $this->settings['defaultMarkerColor'] ) > 0 && array_key_exists('raw', $this->settings['defaultMarkerColor']))
    {
      if(str_contains($this->settings['defaultMarkerColor']["raw"], 'var'))
      {
          echo 'window.getComputedStyle(document.documentElement).getPropertyValue(\'--'. $this->settings['defaultMarkerColor']['name'] .'\');';
      }
      else
      {
          echo '\'' . end($this->settings['defaultMarkerColor']) . '\'';
      }
    }
    else
    {
      echo '\'' . end($this->settings['defaultMarkerColor']) . '\'';
    }
    echo "
    const selectedMarkerColor = ";
    if(is_countable($this->settings['selectedMarkerColor']) && count( $this->settings['selectedMarkerColor'] ) > 0 && array_key_exists('raw', $this->settings['selectedMarkerColor']))
    {
      if(str_contains($this->settings['selectedMarkerColor']["raw"], 'var'))
      {
          echo 'window.getComputedStyle(document.documentElement).getPropertyValue(\'--'. $this->settings['selectedMarkerColor']['name'] .'\');';
      }
      else
      {
          echo '\'' . end($this->settings['selectedMarkerColor']) . '\'';
      }
    }
    else
    {
      echo '\'' . end($this->settings['selectedMarkerColor']) . '\'';
    }  
    echo "
    const citiesListWrapperName = \".cities-list__city-wrapper\";
    let markerWrapperList;                                                                                                          
    let mapBoxStyling;                                                                                                              
    const mapboxContainer = \"hyperMap-{$this->element["id"]}\";                                                                                      
    let breakpoints = [];                                                                                                           
    let circleZooms = ['interpolate',['linear'],['zoom']];
    let selectedCity = null;
    const createColumn = (index) => {
    return `<div id=\"col-\${index}\" class=\"cities-list__col\"></div>`
    }
    const buildCityList = (container, rows) => {
    let citiesAdded = [];
    let columnIndex = 1;
    let currentColumn = document.getElementById(`col-\${columnIndex}`);
    let sheet = new CSSStyleSheet();
    sheet.insertRule(\".cities-list {display: flex;  flex-direction: row;  column-gap: 8px;  align-items: center; justify-content: space-between;}\", sheet.cssRules.length)
    if (typeof(currentColumn) === 'undefined' || currentColumn === null)
    {
      currentColumn = createColumn(columnIndex);
      container.insertAdjacentHTML(\"beforeend\", currentColumn);
      currentColumn = document.getElementById(`col-\${columnIndex}`);
    }
    let index = 1;
    for (let item of mapCoordinates.features) {
      const template = `  
      <div class=\"cities-list__city-wrapper\" cityname=\"\${item.properties.city}\">
          " . self::render_icon( $this->settings['listIcon'], ['cities-list__icon']) . "
          <p class=\"brxe-text-basic cities-list__name\">\${item.properties.city}</p>
      </div>
      `
      if(citiesAdded.includes(item.properties.city))
      {
        continue;
      }
      else
      {
          currentColumn.insertAdjacentHTML(\"beforeend\", template);
          citiesAdded.push(item.properties.city);
      }
      if(index != 0 && index % rows === 0)
      {
        columnIndex++;
        createColumn(columnIndex);
        currentColumn = createColumn(columnIndex);
        container.insertAdjacentHTML(\"beforeend\", currentColumn);
        currentColumn = document.getElementById(`col-\${columnIndex}`);
      }
      index++;
    }
    sheet.insertRule(`.brxe-ServiceMap{ 
      display: flex;
      align-items: start;
    }`, sheet.cssRules.length)
    sheet.insertRule(`#cur-cities-list{ 
      display: grid; 
      grid-template-columns: repeat(\${columnIndex}, 1fr);
    }`, sheet.cssRules.length)
    sheet.insertRule(`        
      .cities-list__city-wrapper{
        display: flex;
    }`, sheet.cssRules.length)
    sheet.insertRule(`        
      .cities-list__col{
        display: flex;
        flex-direction: column;
        align-self: stretch;
    }`, sheet.cssRules.length)
    sheet.insertRule(`
        #{$this->element["id"]}-section-heading__container {
        display: flex;
        flex-direction: column;
        }`)
    document.adoptedStyleSheets = [sheet, ...document.adoptedStyleSheets];
    }
    let source = document.getElementById(\"cities-list-{$this->element["id"]}\");
    buildCityList(source, {$this->settings["numRows"]});
    mapboxgl.accessToken = \"" . get_field('mapbox_api_key', 'option') . "\";
    const map = new mapboxgl.Map({
    container: mapboxContainer,                                                 
    style: 'mapbox://styles/zlewallen/clw9qm6dz008c01qldz3l86mp',
    center: defaultLongLat,
    zoom: defaultZoom,
    interactive: false
    });
    const addZooms = (zoomLevel, radius) => {
    circleZooms.push(zoomLevel);
    circleZooms.push(radius);
    }
    ";
    if(is_countable($circleZooms) && count( $circleZooms ) > 0) {
    foreach($circleZooms as $item) {
        echo 'addZooms(' . $item["zoomLevel"] . ',' . $item["radius"] . ');';
    }
    }
    echo "
    const sortZoomArray = (arr) => {
    let elementsToSort = [];
    for (let i = 3; i < arr.length; i += 2) {
        elementsToSort.push([arr[i], arr[i + 1]]);
    }
    elementsToSort.sort((a, b) => a[0] - b[0]);
    let result = arr.slice(0, 3);
    for (let i = 0; i < elementsToSort.length; i++) {
        result.push(elementsToSort[i][0], elementsToSort[i][1]);
    }
    return result;
    }
    map.on('load', () => {
      map.resize();
mapBoxStyling = document.querySelectorAll( \"div.mapboxgl-ctrl-bottom-right, div.mapboxgl-ctrl-bottom-left\")
mapBoxStyling.forEach((el) => {
      el.style.display = \"none\";
        });
                  map.loadImage('https://mapsandbox.hypertek.dev/wp-content/uploads/2024/05/map-pin-xs.png', (error, image) => {
                      if (error) throw error;
                      map.addImage('sdf-icon', image, { sdf: true });
                  });
                map.addSource('service-area-locations', {
                  type: 'geojson',
                  data: mapCoordinates // Replace with your tileset URL
              });
              map.addLayer({
                  id: 'service-area-symbols',
                  type: 'symbol',
                  source: 'service-area-locations',
                  layout: {
                      'icon-image': 'sdf-icon',
                      'icon-size': 1,
                      'icon-allow-overlap': false,
                  },          
                  paint: {
                      'icon-color': [
                          'case',
                          ['==', ['get', 'city'], selectedCity],
                          selectedMarkerColor,
                          primaryColor
                      ]
                  }
              });
        const addBreakpoint = (maxWidth, zoom) => {
          breakpoints.push({ maxWidth, zoom });
          }
          ";
          $items = $this->settings["breakpoints"];    
          if(is_countable($items) && count( $items ) > 0) {
              foreach($items as $item) {
                  echo '
          addBreakpoint(' . $item["maxWidth"] . ',' . $item["zoomLevel"] . ');
                  ';
              }
          }
          echo "
          const adjustMapZoom = () => {
            let zoomSet = false;                                                        
            breakpoints.sort((a,b) => a.maxWidth - b.maxWidth);                         
            if(breakpoints.length > 0)
             {
              for (const element of breakpoints)                          
              {
                if(window.matchMedia(`(max-width: \${element.maxWidth}px)`).matches)
                {        
                  map.setZoom(element.zoom);
                  zoomSet = true;
                  break;
                }
              }
            }
            if(!zoomSet && !init)
            {
            console.warn(\"Could not find breakpoint. Setting default\");
            map.setZoom(defaultZoom);
            } else {
            init = false;
            }
          }
          window.addEventListener('resize', adjustMapZoom);
          adjustMapZoom();
          }) 
          })
        })();
        </script>"; 
        echo '</div>';
        }
        }
