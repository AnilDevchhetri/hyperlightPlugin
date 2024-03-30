<?php
namespace Elementor;
class hyperlight_article_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-article-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight News', 'hyperlight-elementor-elements' );
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
        'title',
        [
            'label' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => esc_html__( 'Article Title', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
        ]
        );


        $repeater->add_control(
            'journal',
            [
                'label' => esc_html__( 'Type Date', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type your Date here', 'hyperlight-elementor-elements' ),
            ]
        );

         $repeater->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Subtile', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type Category here', 'hyperlight-elementor-elements' ),
            ]
        );

         $repeater->add_control(
            'button_title',
            [
                'label' => esc_html__( 'Button Title', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read the article', 'hyperlight-elementor-elements' ),
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
                    'hyperlight_article_repeater',
                    [
                        'label' => esc_html__( 'Article List', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'list_title' => esc_html__( 'Title #1', 'raysittech-elementor-elements' ),
                                'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'hyperlight-elementor-elements' ),
                            ],
                           
                        ],
                         'title_field' => '{{{ title }}}',
                         
                    ]
                );

		 
   // Repeater end/////////////////             

		

       $this->end_controls_section();

      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
      
        ?>
  <!-- =======Body SECTION========= -->
      <section class="bg-resources">
            <section class="container-fluid custom-container">
                <div class="row">
                 <?php 
                        foreach($settings['hyperlight_article_repeater'] as $item){
                          
                           if ( ! empty( $item['button_link']['url'] ) ) {
                            $this->add_link_attributes( 'button_link', $item['button_link'] );
                        }
                   ?>    

                    <div class="col-md-6">
                        <div class="resource-box clearfix">
                           <div class="res-wid">
                                 <div class="resource-title res-fsize-title">
                                <h4><?php echo $item['title']; ?></h4>
                            </div>
                            <div class="resource-info">
                                <p><span>Journal:</span><?php echo $item['journal']; ?></p>
                                <p><span>Title:</span> <?php echo $item['sub_title']; ?></p>
                            </div>
                           </div>
                            <div class="btn-readarticle">
                                <a class="" <?php echo $this->get_render_attribute_string( 'button_link' ); ?> target="_blank">
                                <?php echo $item['button_title']; ?>                   
                                <i class="fas fa-chevron-right"></i>
                            </a>                          
                            </div>

                           

                     </div>
                    </div>
                <?php } ?>



                </div>
        </section>      
        </section>            
  <!-- =======Body SECTION========= -->


     <?php 
   }//end of render
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_article_section() );