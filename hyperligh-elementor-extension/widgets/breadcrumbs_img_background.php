<?php
namespace Elementor;
class hyperlight_breadcrumb_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-breadcrumb-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Breadrumb', 'hyperlight-elementor-elements' );
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
                    'bg_image',
                    [
                        'label' => esc_html__( 'Choose Background Image', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );
                

		

       $this->end_controls_section();

      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
        

        ?>
<!-- =======ABOUT SECTION========= -->
               <section class="career_img">
                            <!-- <video width="100%" loop="true" autoplay="true" muted>
                                    <source src="video/news-video.mp4" type="">
                                </video> -->
                                <div class="product-thumbnail breadcrumb-bg-image">
                                    <img src="<?php echo $settings['bg_image']['url']; ?>" alt="img">
                                </div>
                                <div class="breadcrumb_title">
                                    <h3><?php echo get_the_title(); ?></h3>
                                    <ul>
                                        <li class="active"><a href="<?php echo home_url(); ?>">Home</a></li>
                                        <li><a href="#"><?php echo get_the_title(); ?></a></li>
                                    </ul>
                                </div>
                        </section>
            <!-- =======ABOUT SECTION========= -->


     <?php 
   }//end of render
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_breadcrumb_section() );