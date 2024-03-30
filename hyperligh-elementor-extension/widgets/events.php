<?php
namespace Elementor;
class hyperlight_events_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-events-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Events', 'hyperlight-elementor-elements' );
    }

    public function get_script_depends() {
        return [
            'myew-scripts'
        ];
    }
    public function get_icon() {
        return 'eicon-text-field';
    }

    public function get_categories() {
        return [ 'hyperlight-for-elementor' ];
    }
   
     public function _register_controls(){
    
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'hyperlight-elementor-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
     
       
    //***************REpeater 
        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'date',
            [
                'label' => esc_html__( 'Type Date', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'December 9, 2021', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type your Date here', 'hyperlight-elementor-elements' ),
            ]
        );
           $repeater->add_control(
        'location',
        [
            'label' => esc_html__( 'Location', 'hyperlight-elementor-elements' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => esc_html__( 'Event', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
        ]
        );

        $repeater->add_control(
      'map_url',
      [
        'label' => esc_html__( 'Google Map Url', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__( 'https://your-link.com', 'plugin-name' ),
        'default' => [
          'url' => '',
          'is_external' => true,
          'nofollow' => true,
          'custom_attributes' => '',
        ],
      ]
    );
        
         //Image
                $repeater->add_control(
                    'image',
                    [
                        'label' => esc_html__( 'Choose Image', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );
      
      $this->add_control(
                    'hyperlight_events_repeater',
                    [
                        'label' => esc_html__( 'Events List', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'list_title' => esc_html__( 'Title #1', 'raysittech-elementor-elements' ),
                                'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'hyperlight-elementor-elements' ),
                            ],
                           
                        ],
                         'title_field' => '{{{ location }}}',
                         
                    ]
                );

		 
   // Repeater end/////////////////             

		

       $this->end_controls_section();

      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
      
        ?>
  <!-- =======Body SECTION========= -->
                     <div class="container custom-container mt-5 mb-5">
                
                        <?php 
                        foreach($settings['hyperlight_events_repeater'] as $item){
                          
                           if ( ! empty( $item['map_url']['url'] ) ) {
                            $this->add_link_attributes( 'map_url', $item['map_url'] );
                        }
                   ?>

                        <div class="event-sec mb-4">                            
                            <div class="event-desc">
                                <div class="event_date"><span>Date:</span><?php echo $item['date']; ?></div>
                                <div class="event_location"><span>location :</span> 
                                    <a  <?php echo $this->get_render_attribute_string( 'map_url' ); ?>  target="_blank"><?php echo $item['location']; ?></a>
                                </div>
                            </div>
                            <div class="event-logo r-float-none">
                                <a  <?php echo $this->get_render_attribute_string( 'map_url' ); ?>  target="_blank"><img src="<?php echo $item['image']['url']; ?>"></a>
                            </div>
                        </div>
                  <?php } ?>

                      </div>
  <!-- =======Body SECTION========= -->


     <?php 
   }//end of render
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_events_section() );