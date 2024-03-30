<?php
namespace Elementor;
class hyperlight_img_par_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-img-par-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Image & Paragraph', 'hyperlight-elementor-elements' );
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
         

                //image
                $this->add_control(
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
			'content',
			[
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( '', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type your description here', 'plugin-name' ),
			]
		);


		
       $this->end_controls_section();

      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
       

        ?>
<!-- =======ABOUT SECTION========= -->
           <section class="container custom-container mt-5">
                                <div class="row mb-5">
                                    <div class="col-md-4">
                                        <div class="avatar-picture">
                                            <img src="<?php echo $settings['image']['url']; ?>">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-8">
                                        <div class="carer-text">
                                            <?php echo $settings['content']; ?>
                                        </div>                                     
                                    </div>
                                </div>
                      </section>
            <!-- =======ABOUT SECTION========= -->


     <?php 
   }
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_img_par_section() );