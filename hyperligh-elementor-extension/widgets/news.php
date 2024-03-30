<?php
namespace Elementor;
class hyperlight_news_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-news-Id';
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
            'default' => esc_html__( 'News Title', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
        ]
        );


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
            'category',
            [
                'label' => esc_html__( 'Type Category', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Cambridge, MA – Business Wire', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type Category here', 'hyperlight-elementor-elements' ),
            ]
        );

         $repeater->add_control(
            'button_title',
            [
                'label' => esc_html__( 'Button Title', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'hyperlight-elementor-elements' ),
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
                    'hyperlight_news_repeater',
                    [
                        'label' => esc_html__( 'News List', 'hyperlight-elementor-elements' ),
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
                   <div class="bg-news-all">
                        <section class="container-fluid custom-container">
                                <div class="row">

                        <?php 
                        foreach($settings['hyperlight_news_repeater'] as $item){
                          
                           if ( ! empty( $item['button_link']['url'] ) ) {
                            $this->add_link_attributes( 'button_link', $item['button_link'] );
                        }
                   ?>

                                    <div class="col-md-6">
                                        <div class="news-box mt-5">
                                           <div class="news-sec">
                                               <div class="news-img">
                                                   <!-- <img src="img/news-one.jpg"> -->
                                                   <div class="col-overlay"></div>
                                                   <div class="link-icon">
                                                    <a  <?php // echo $this->get_render_attribute_string( 'button_link' ); ?> target="_blank"> <i class="fa fa-link"></i></a>
                                                   </div>
                                               </div>
                                               
                                               <div class="news-info">
                                                   <div class="news-title">
                                                      <ul>
                                                        <li><span><i class="fas fa-clock"></i> </span> <?php echo $item['date']; ?></li>
                                                        <!-- <li><span>Posted By: </span>David Kole</li> -->
                                                        <li class="float-right r-float-none"><span>Category: </span><?php echo $item['category']; ?></li>
                                                      </ul> 
                                                      <h4><a  <?php echo $this->get_render_attribute_string( 'button_link' ); ?> target="_blank"><?php echo $item['title'] ?></a></h4>
                                                    
                                                   </div>
                                                    <div class="btn-readmore">
                                                    <a class="" <?php echo $this->get_render_attribute_string( 'button_link' ); ?> target="_blank">
                                                         <?php echo $item['button_title']; ?>                   
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </div>
                                               </div>
                                              
                                           </div>
                                        </div>
                                    </div>                                   
                             <?php } ?>





                                 
                                </div>
                        </section>
                        </div>
  <!-- =======Body SECTION========= -->


     <?php 
   }//end of render
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_news_section() );