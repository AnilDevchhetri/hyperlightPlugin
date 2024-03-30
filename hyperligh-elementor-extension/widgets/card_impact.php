<?php
namespace Elementor;
class hyperlight_card_impact extends Widget_Base{

    public function get_name() {
        return  'Hyperligt-Impact-card-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Impact card', 'hyperlight-elementor-elements' );
    }

    public function get_script_depends() {
        return [
            'myew-scripts'
        ];
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'hyperlight-for-elementor' ];
    }
   
     public function _register_controls(){
    
		$this->start_controls_section(
			'impact_section_content',
			[
				'label' => esc_html__( 'Impact Header', 'hyperlight-elementor-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


      $this->add_control(
      'impact_title',
      [
        'label' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'Our Impact', 'hyperlight-elementor-elements' ),
        'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
      ]
    );
      $this->add_control(
    'impact_subtitle',
    [
      'label' => esc_html__( 'Sub Title', 'hyperlight-elementor-elements' ),
      'type' => \Elementor\Controls_Manager::TEXTAREA,
      'rows' => 10,
      'default' => esc_html__( 'Subtitle', 'hyperlight-elementor-elements' ),
      'placeholder' => esc_html__( 'Type your description here', 'hyperlight-elementor-elements' ),
    ]
    );

    
             

        $this->end_controls_section();

  /////////start of repeater////////////////
    $this->start_controls_section(
      'impact_card_section_content',
      [
        'label' => esc_html__( 'Card', 'hyperlight-elementor-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
        //***************REpeater 
                //$repeater = new \Elementor\Repeater();

                $repeater = new \Elementor\Repeater();

                    //video
                $repeater->add_control(
                    'impact_image',
                    [
                        'label' => esc_html__( 'Choose Image', 'hyperlight-elementor-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );
                            $repeater->add_control(
      'impact_card_description',
      [
        'label' => esc_html__( 'Description', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => esc_html__( 'Default description', 'plugin-name' ),
        'placeholder' => esc_html__( 'Type your description here', 'plugin-name' ),
      ]
    );
        $repeater->add_control(
      'impact_card_title',
      [
        'label' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
        'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
      ]
    );
    $this->add_control(
      'list',
      [
        'label' => esc_html__( 'Repeater List', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'list_title' => esc_html__( 'Title #1', 'plugin-name' ),
            'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'plugin-name' ),
          ],
          [
            'list_title' => esc_html__( 'Title #2', 'plugin-name' ),
            'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'plugin-name' ),
          ],
        ],
        'title_field' => '{{{ list_title }}}',
      ]
    );

    //             //video
    //             $repeater->add_control(
    //                 'impact_image',
    //                 [
    //                     'label' => esc_html__( 'Choose Image', 'hyperlight-elementor-elements' ),
    //                     'type' => \Elementor\Controls_Manager::MEDIA,
    //                     'default' => [
    //                         'url' => \Elementor\Utils::get_placeholder_image_src(),
    //                     ],
    //                 ]
    //             );
                

    //          $repeater->add_control(
    //   'impact_card_description',
    //   [
    //     'label' => esc_html__( 'Description', 'plugin-name' ),
    //     'type' => \Elementor\Controls_Manager::WYSIWYG,
    //     'default' => esc_html__( 'Default description', 'plugin-name' ),
    //     'placeholder' => esc_html__( 'Type your description here', 'plugin-name' ),
    //   ]
    // );
    //     $repeater->add_control(
    //   'impact_card_title',
    //   [
    //     'label' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
    //     'type' => \Elementor\Controls_Manager::TEXT,
    //     'default' => esc_html__( 'Title', 'hyperlight-elementor-elements' ),
    //     'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
    //   ]
    // );

    //     $this->add_control(
    //         'hyperlight_card_slides',
    //         [
    //             'label' => esc_html__( 'Repeater List', 'hyperlight-elementor-elements' ),
    //             'type' => \Elementor\Controls_Manager::REPEATER,
    //             'fields' => $repeater->get_controls(),
    //             'default' => [
    //                 [
    //                     'list_title' => esc_html__( 'Title #1', 'hyperlight-elementor-elements' ),
    //                     'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'hyperlight-elementor-elements' ),
    //                 ],
                   
    //             ],
    //              'title_field' => '{{{ impact_title }}}',
                 
    //         ]
    //     );
        $this->end_controls_section();


  //////////End of repeater/////////////////      
 


      }//end of register_controlses
   
   protected function render(){
        $settings = $this->get_settings_for_display();
       
        ?>
            <!-- =======Card Impact SECTION========= -->
 <section class="team-sec" id="team">
                <div class="all_heading_design">
                    <div class="all_heading_design-title-box">
                        <div class="all_heading_design-title-box-bg">
                        </div>
                        <h2 style="background-image: url(<?php bloginfo('template_url'); ?>/img/quantum.jpg);" class="all_heading_design-title"><?php echo $settings['impact_title']; ?></h2>
                    </div>
                    <div class="circuit-back-img">
                        <img src="<?php bloginfo('template_url'); ?>/img/circuit-back-img.png" alt="">
                    </div>
                </div>
                <h2 class="text-center text-white imapct-heading"><?php echo $settings['impact_subtitle']; ?></h2>
                <div class="container">
                    <div class="row">

                    <?php 
        foreach($settings['list'] as $item){
           
             ?>
                        <div class="col-md-4 mb-team">
                           <div class="team-pos">
                                <div class="blob"></div>
                            <div class="team-detail">
                                <div class="team-image">
                                    <img src="<?php echo esc_url($item['impact_image']['url']); ?>">
                                    <div class="team-info">
                                        <h4><?php echo $item['impact_card_title'] ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="more-desc">
                                <a href="#product" target="_blank">
                               <!--  <ul>
                                    <li>Low power consumption beyond 100 Gb/s per lane</li>
                                    <li>High signal fidelity</li>
                                    <li>Drop-in integration</li>
                                </ul> -->
                                <?php echo $item['impact_card_description']; ?>
                                </a>
                            </div>
                           </div>
                        </div>

       <?php } ?>
                       
                    </div>
                </div>
            </section>

            <!-- =======Card Impact SECTION========= -->


     <?php 
   }
 }
 Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_card_impact() );