<?php
namespace Elementor;
class hyperlight_jobs_section extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-jobs-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Jobs List', 'hyperlight-elementor-elements' );
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
            'default' => esc_html__( 'Job Title', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
        ]
        );



         $repeater->add_control(
            'location',
            [
                'label' => esc_html__( 'Type Address', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Cambridge, MA', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type Address here', 'hyperlight-elementor-elements' ),
            ]
        );

         
         $repeater->add_control(
            'apply_button_title',
            [
                'label' => esc_html__( 'Apply Now', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Apply Now', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
            ]
        );

        $repeater->add_control(
            'apply_button_link',
            [
                'label' => esc_html__( 'Apply Now Link', 'plugin-name' ),
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


        $repeater->add_control(
            'rm_button_title',
            [
                'label' => esc_html__( 'Read More Button Title', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
            ]
        );

      $repeater->add_control(
            'rm_button_model_id',
            [
                'label' => esc_html__( 'Read More Popup Model ID', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type Read More Popup Model ID', 'hyperlight-elementor-elements' ),
            ]
        );

      $repeater->add_control(
      'popup_content',
      [
        'label' => esc_html__( 'Popup Model content', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => esc_html__( '', 'plugin-name' ),
        'placeholder' => esc_html__( 'Type Model Poupup content', 'plugin-name' ),
      ]
    );   
     
      
      $this->add_control(
                    'hyperlight_jobs_repeater',
                    [
                        'label' => esc_html__( 'Jobs List', 'hyperlight-elementor-elements' ),
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
      <section class="container custom-container mt-5">
                        <div class="row">
                       <?php 
                        foreach($settings['hyperlight_jobs_repeater'] as $item){
                          
                           if ( ! empty( $item['apply_button_link']['url'] ) ) {
                            $this->add_link_attributes( 'apply_button_link', $item['apply_button_link'] );
                        }
                   ?>

                                    <div class="col-md-12"  >
                                        <div class="career-box clearfix">
                                            <div class="float-left job-detail">
                                               <div class="job-title">
                                                <h4><?php echo $item['title']; ?></h4>
                                                <h6><?php echo $item['location']; ?></h6>
                                               </div>
                                            </div>
                                            <div class="float-right clearfix r-float-none">
                                                <div class="btn-readmore job-btn r-job-mg" data-toggle="modal" data-target="#<?php echo $item['rm_button_model_id']; ?>" button type="button">
                                                   <span><?php echo $item['rm_button_title']; ?></span>                   
                                                        <i class="fas fa-chevron-right"></i>    
                                                    </div>
                                                <div class="btn-readmore btn-career">
                                                    <a class="" <?php echo $this->get_render_attribute_string( 'apply_button_link' ); ?>  target="_blank">
                                                         <?php echo $item['apply_button_title']; ?>                    
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                        <?php } ?>     
                                    
                                </div>
                        </section>


      <!-- /////////////////////////////////////////model start////////////////////////////// 
      -->
       <?php 
          foreach($settings['hyperlight_jobs_repeater'] as $item){
        ?>

               <!-- Modal -->
                <div class="modal fade" id="<?php echo $item['rm_button_model_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $item['title']; ?><br>
                        <!-- <p>One Position is currently Avilable</p> -->
                    </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>                        
                      </div>

                      <div class="modal-body">
                        <div class="job-detail">
                            <?php echo $item['popup_content']; ?>
                        </div>
                      </div>
                     <!--  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div> -->
                    </div>
                  </div>
                </div>

                 <!-- Modal -->
          <?php } ?>

      <!-- //////////////////////////////////////Model end/////////////////////////////////////// -->















  <!-- =======Body SECTION========= -->


     <?php 
   }//end of render
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_jobs_section() );