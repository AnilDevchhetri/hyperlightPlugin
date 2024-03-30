<?php
namespace Elementor;
class hyperlight_careers_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-careers-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Career Section', 'hyperlight-elementor-elements' );
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
     
        $this->add_control(
			'career_title',
			[
				'label' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Careers', 'hyperlight-elementor-elements' ),
				'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
			]
		);

		$this->add_control(
		'career_subtitle',
		[
			'label' => esc_html__( 'Sub Title', 'hyperlight-elementor-elements' ),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'rows' => 10,
			'default' => esc_html__( 'Subtitle', 'hyperlight-elementor-elements' ),
			'placeholder' => esc_html__( 'Type your description here', 'hyperlight-elementor-elements' ),
		]
		);
        
          $this->add_control(
        'career_description',
        [
            'label' => esc_html__( 'Description', 'hyperlight-elementor-elements' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => esc_html__( 'description', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your description here', 'hyperlight-elementor-elements' ),
        ]
        );


		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
       
        $this->add_control(
			'button_title',
			[
				'label' => esc_html__( 'Button Title', 'hyperlight-elementor-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'hyperlight-elementor-elements' ),
				'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
			]
		);

		$this->add_control(
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

       $this->end_controls_section();

      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
        if ( ! empty( $settings['button_link']['url'] ) ) {
            $this->add_link_attributes( 'button_link', $settings['button_link'] );
        }

        ?>
           <!-- =======CAREERS SECTION========= -->
              <section class="carrers-sec clearfix" id="carrers">
                   <div class="moving_image_wraper">
                    <div class="jp_slide_img_overlay"></div>
                        <div class="position-relative">
                        <div class="all_heading_design">
                    <div class="all_heading_design-title-box">
                        <div class="all_heading_design-title-box-bg">
                        </div>
                        <h2 style="background-image: url(<?php bloginfo('template_url'); ?>/img/quantum.jpg);" class="all_heading_design-title career-set-heading"><?PHP echo $settings['career_title']; ?></h2>
                    </div>
                    <div class="circuit-back-img shape-career-pos">
                        <img src="<?php bloginfo('template_url'); ?>/img/circuit-back-img.png" alt="">
                    </div>
                </div>
                <h2 class="text-center text-white imapct-heading pt-0 "><?php echo $settings['career_subtitle'] ?></h2>
                        <p class="career-slogan"><?php echo $settings['career_description']; ?></p>
                        <div class="btn_explorejobs">
                            <a  <?php echo $this->get_render_attribute_string( 'button_link' ); ?> target="_blank"><?php echo $settings['button_title']; ?>
                                <i class="fas fa-search"></i>
                             </a>

                        </div>
                        </div>
                 </div> 
                </section>

            <!-- =======CAREERS SECTION========= -->


     <?php 
   }
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_careers_section() );