<?php
namespace Elementor;




function avocado_product_list( ) {

        $args = wp_parse_args( array(
            'post_type'   => 'products',
            'numberposts' => -1,
            'orderby' => 'title',
            'order' => 'DESC',
        ) );
    
        $query_query = get_posts( $args );
    
        $dropdown_array = array();
        if ( $query_query ) {
            foreach ( $query_query as $query ) {
                $dropdown_array[ $query->ID ] = $query->post_title;
            }
        }
    
        return $dropdown_array;
    }

class hyperlight_product_listing extends Widget_Base{
    public function get_name() {
        return  'hyperlight-Product-Listing-Id';
    }
    public function get_title() {
        return esc_html__( 'Hyperlight Products', 'hyperlight-elementor-elements' );
    }

    public function get_script_depends() {
        return [
            'myew-script'
        ];
    }
    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return [ 'hyperlight-for-elementor' ];
    }
   
    public function _register_controls(){
          
          //start section
          $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
                 );


      $this->add_control(
            'product_section_title',
            [
                'label' => esc_html__( 'Our Solutong Title', 'hyperlight-elementor-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Solution Title', 'hyperlight-elementor-elements' ),
                'placeholder' => esc_html__( 'Type your title here', 'hyperlight-elementor-elements' ),
            ]
        );

        $this->add_control(
        'product_section_subtitle',
        [
            'label' => esc_html__( 'Sub Title', 'hyperlight-elementor-elements' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => esc_html__( 'Subtitle', 'hyperlight-elementor-elements' ),
            'placeholder' => esc_html__( 'Type your description here', 'hyperlight-elementor-elements' ),
        ]
        );


        $this->add_control(
            'limit',
            [
                'label' => __( 'Count', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '3',
            ]
        );
         
       
          $this->add_control(
                'p_ids',
                [
                    'label' => __( 'Select Products', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => avocado_product_list(),
                    'default' => [ 'all' ],
                ]
            );


          
 


                $this->end_controls_section();
            //end section
        

      
    
        //style tab
        
    }
  
    protected function render(){
       $settings = $this->get_settings_for_display();
       

           $q = new \WP_Query( array(
                    'posts_per_page' => $settings['limit'], 
                    'post_type' => 'products',
                    'post__in' => $settings['p_ids'],
                ));
           
                 ?>
               
 <!-- =======PRODUCT SECTION========= -->
                <section class="product-sec" id="product">
                
                <div class="all_heading_design">
                    <div class="all_heading_design-title-box">
                        <div class="all_heading_design-title-box-bg">
                        </div>
                        <h2 style="background-image: url(<?php bloginfo('template_url'); ?>/img/try4.jpg);" class="all_heading_design-title"><?php echo $settings['product_section_title'] ?></h2>
                    </div>
                    <div class="circuit-back-img shape-pos-product">
                        <img src="<?php bloginfo('template_url'); ?>/img/circuit-back-img.png" alt="">
                    </div>
                </div>
                <h2 class="text-center text-black imapct-heading pt-0"><?php echo $settings['product_section_subtitle']; ?></h2>
                <div class="container product_custom_container">
                    <div class="row mt-4">
             
             <?php 
                while($q->have_posts()) : $q->the_post();
             ?>
                    <div class="col-md-4">
                        <div class="latest-product">
                            <div class="product-img">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>">
                            </div>
                            <div class="product-info">
                                <h4><?php the_title(); ?></h4>
                                <p><?php the_excerpt(); ?>
                                </p>
                                <div class="read-btn">
                                    <a href="<?php the_permalink(); ?>" target="_blank">Learn More</a>
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
             <?php  endwhile; wp_reset_query();  ?>

                    
                    
                    
                </div>
                </div>
                </section>
        

 <?php
    }
    //protected function content_template(){
      
 //   }

}
Plugin::instance()->widgets_manager->register_widget_type( new hyperlight_product_listing() ); 