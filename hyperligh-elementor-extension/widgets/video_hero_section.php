<?php
namespace Elementor;
class hyperlight_video_herosection extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-video-herosection-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Hero Section', 'hyperlight-elementor-elements' );
    }

    public function get_script_depends() {
        return [
            'myew-scripts'
        ];
    }
    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return [ 'hyperlight-for-elementor' ];
    }
   
     public function _register_controls(){
    
		$this->start_controls_section(
			'hero_section_content',
			[
				'label' => esc_html__( 'Slider', 'hyperlight-elementor-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        //***************REpeater 
                $repeater = new \Elementor\Repeater();

                //video
                $repeater->add_control(
                    'selected_video',
                    [
                        'label' => esc_html__( 'Choose Video', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );
                

         $repeater->add_control(
        'hero_description',
        [
            'label' => esc_html__( 'Description', 'hyperlight-elementor-elements' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => esc_html__( 'description', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your description here', 'hyperlight-elementor-elements' ),
        ]
        );

        $repeater->add_control(
			'hero_slide_title',
			[
				'label' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
				'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
			]
		);

       $repeater->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
       
        $repeater->add_control(
			'button_title',
			[
				'label' => esc_html__( 'Button Title', 'hyperlight-elementor-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'hyperlight-elementor-elements' ),
				'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'plugin-name' ),
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

        
            	$this->add_control(
                    'hyperlight_slider_slides',
                    [
                        'label' => esc_html__( 'Repeater List', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'list_title' => esc_html__( 'Title #1', 'raysittech-elementor-elements' ),
                                'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'hyperlight-elementor-elements' ),
                            ],
                           
                        ],
                         'title_field' => '{{{ hero_slide_title }}}',
                         
                    ]
                );


       $this->end_controls_section();

      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
       
        ?>
            <!-- =======Hero Video SECTION========= -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  

  <div class="carousel-inner">
  
  <!-- start of slider item -->
   <?php 
        foreach($settings['hyperlight_slider_slides'] as $item){
           if ( ! empty( $item['button_link']['url'] ) ) {
            $this->add_link_attributes( 'button_link', $item['button_link'] );
        }
   ?>
    <div class="carousel-item active">
       <video  width="100%" class="home-slide-video" autoplay="true" loop="true" muted>
                <source src="<?php echo esc_url($item['selected_video']['url']); ?>" type="video/mp4"></video>
                    <!-- <img src="img/banner-image.jpg"> -->
                    
                <div class="carousel-caption d-none d-md-block">
                    <div class="main-text">
                      <div class="clearfix">
                        <div class="banner-text-attribute clearfix">
                     
                         <?php echo $item['hero_description']; ?>
                        </div>
                     </div>
                        <h1 class="clearfix"><?php echo $item['hero_slide_title'] ?></h1>                        
                        <div class="mt-btn-banner text-center d-inline">
                            <a <?php echo $this->get_render_attribute_string( 'button_link' ); ?>><?php echo $item['button_title'] ?> <i class="fas fa-search"></i></a>
                        </div>
                    </div>
                </div>
    </div>
   <?php } ?>
      <!-- end of slider item -->
  </div>
                   <!--  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <img src="img/left-arrow.png">
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <img src="img/right-arrow.png" class="">
                    </a> -->
</div>
            <!-- =======Hero Video SECTION========= -->


     <?php 
   }
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_video_herosection() );