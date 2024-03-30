<?php
namespace Elementor;
class hyperlight_solution_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-Solution-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Solution', 'hyperlight-elementor-elements' );
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
			'solution_title',
			[
				'label' => esc_html__( 'Our Solutong Title', 'hyperlight-elementor-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Solution Title', 'hyperlight-elementor-elements' ),
				'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
			]
		);

		$this->add_control(
		'solution_subtitle',
		[
			'label' => esc_html__( 'Sub Title', 'hyperlight-elementor-elements' ),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'rows' => 10,
			'default' => esc_html__( 'Subtitle', 'hyperlight-elementor-elements' ),
			'placeholder' => esc_html__( 'Type your description here', 'hyperlight-elementor-elements' ),
		]
		);
        
        	$this->add_control(
			'solution_description',
			[
				'label' => esc_html__( 'Solution Description', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type your description here', 'plugin-name' ),
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
<!-- =======ABOUT SECTION========= -->
            <div class="about-bg-all">
            <section class="about-sec" id="about">
                <div class="all_heading_design">
                    <div class="all_heading_design-title-box">
                        <div class="all_heading_design-title-box-bg">
                        </div>
                        <h2 style="background-image: url(<?php bloginfo('template_url'); ?>/img/try4.jpg);" class="all_heading_design-title"><?php echo $settings['solution_title'] ?></h2>
                    </div>
                    <div class="circuit-back-img">
                        <img src="<?php bloginfo('template_url'); ?>/img/circuit-back-img.png" alt="">
                    </div>
                </div>
                <div class="about-info">
                <h2 class="text-black text-center"><?php echo $settings['solution_subtitle']; ?></h2>
                    <?php echo $settings['solution_description'] ?>
                </div> 
                <div class="know-more text-center">
                    <a <?php echo $this->get_render_attribute_string( 'button_link' ); ?>target="_blank"> <?php echo $settings['button_title'] ?> <i class="fas fa-search"></i></a>
                </div>
            </section>
            </div>
            <!-- =======ABOUT SECTION========= -->


     <?php 
   }
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_solution_section() );