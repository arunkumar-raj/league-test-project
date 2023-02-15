<?php

/**
 * The file that defines the core elementor widget class
 *
 * Registering the Teams Widgets
 *
 * @link       https://github.com/arunkumar-raj
 * @since      1.0.0
 *
 * @package    Ltp
 * @subpackage Ltp/includes/widgets
 */

/**
 * The Teams Widget.
 *
 * This is used to define elementor widgets
 * *
 * @since      1.0.0
 * @package    Ltp
 * @subpackage Ltp/includes/widgets
 * @author     Arunkumar <arunkumar.ram87@gmail.com>
 */


use \Elementor\Widget_Base;

class Ltp_Teams extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve Teams widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'league_teams';
    }

    /**
     * Get widget title.
     *
     * Retrieve Teams widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Teams', 'ltp');
    }

    /**
     * Get widget icon.
     * from https://elementor.github.io/elementor-icons/
     * 
     * Retrieve Teams widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-animation';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url()
    {
        return '#';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Teams widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['basic'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the Teams widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['league', 'Teams', 'sports', 'football'];
    }

    /**
     * Register Teams widget controls.
     *
     * Add fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        // Query Section - Start
        $this->start_controls_section(
            'query_section',
            [
                'label' => esc_html__('Query', 'ltp'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'query',
			[
				'label' => esc_html__( 'Select Query', 'ltp' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'terms',
				'options' => [	
					'terms'  => esc_html__( 'Leagues & Keywords', 'ltp' ),
					'post_id' => esc_html__( 'Number or Post ID', 'ltp' ),
				],
			]
		);

        
        $allterms = get_terms(array('taxonomy' => 'league'));
        $terms = array();
        foreach ($allterms as $term) {
            $terms[$term->term_id] = esc_attr($term->name);
        }

        $this->add_control(
            'tax_terms',
            [
                'label' => esc_html__('Select Leagues', 'ltp'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $terms,
                'condition' => [
                    'query' => 'terms',
                ],
            ],
        );

        $allkeywords = get_terms(array('taxonomy' => 'keyword'));
        $keys = array();
        foreach ($allkeywords as $key) {
            $keys[$key->term_id] = esc_attr($key->name);
        }

        $this->add_control(
            'keywords',
            [
                'label' => esc_html__('Select Keywords', 'ltp'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $keys,
                'condition' => [
                    'query' => 'terms',
                ],
            ]
        );

        $this->add_control(
			'relation',
			[
				'label' => esc_html__( 'Select Relation', 'ltp' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'OR',
				'options' => [	
                    'OR' => esc_html__( 'OR', 'ltp' ),
					'AND'  => esc_html__( 'AND', 'ltp' ),					
				],
                'condition' => [
                    'query' => 'terms',
                ],
			]
		);

       
        $this->add_control(
			'post_ids',
			[
				'label' => esc_html__( 'Add Team numbers separated by comma', 'ltp' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'condition' => [
                    'query' => 'post_id',
                ],
			]
		);
        

        $this->add_control(
			'order_by',
			array(
				'label'   => esc_html__( 'Order by', 'ltp' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'ID',
				'options' => array(
					'ID'         => esc_html__( 'ID', 'ltp' ),
					'title'      => esc_html__( 'Title', 'ltp' ),
					'name'       => esc_html__( 'Slug', 'ltp' ),
					'date'       => esc_html__( 'Date', 'ltp' ),
					'menu_order' => esc_html__( 'Menu Order', 'ltp' ),
				),
			)
		);

		$this->add_control(
			'order',
			array(
				'label' => esc_html__( 'Order', 'ltp' ),
				'type'  => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__('Asc', 'ltp'),
					'desc' => esc_html__('Desc', 'ltp'),
				],
			)
		);
       

        $this->end_controls_section();
        // Query Section - End

        // Layout Section - Start
        $this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'ltp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);       
        
        $this->add_control(
			'show_image',
			[
				'label' => esc_html__( 'Show Image', 'ltp' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ltp' ),
				'label_off' => esc_html__( 'Hide', 'ltp' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'ltp' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ltp' ),
				'label_off' => esc_html__( 'Hide', 'ltp' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        

        $this->end_controls_section();
        // Layout Section - End
        // Content Tab End


        // Style Tab Start
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'ltp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'ltp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .team-title a',
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
            'section_excerpt_style',
            [
                'label' => esc_html__('Excerpt', 'ltp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'ltp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .team-excerpt',
			]
		);

        $this->end_controls_section();
        // Style Tab End

    }

    /**
     * Render Teams widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        //echo "<pre>";print_r($settings);echo "</pre>";
        $order_by = $settings['order_by'];
		$order = $settings['order'];
		$query = $settings['query'];

        $args = array(
			'post_type' => 'team',
			'orderby' => $order_by,
			'order'   => $order,
			'posts_per_page' => -1			
		);
       
        if($query == "terms"){
             //Append Tax query if query is set as "League or Keywords"
            $relation = $settings['relation'];
            $terms = $settings['tax_terms'];
            $keywords = $settings['keywords'];

            $tax_query =  array(
                'relation' => $relation,
                array(
                    'taxonomy' => 'league',
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ),
                array(
                    'taxonomy' => 'keyword',
                    'field'    => 'term_id',
                    'terms'    => $keywords,                    
                ),
            );

            $args['tax_query'] = $tax_query;
            if($terms ==null && $keywords == null){
                $args['tax_query'] = array();
            }
        }
        else{
             //Append post__in if query is set as "Number or Post Ids "
            $post_ids = $settings['post_ids'];
            $post__in = explode(',',$post_ids);
            $args['post__in'] = $post__in;
        }

        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
            echo '<div class="ltp_teams_container">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                echo '<div class="ltp_team">';

                    //Check Excerpt Condition
                    if ( 'yes' === $settings['show_image'] ) {
                        echo '<div class="ltp_media">';
                            if(has_post_thumbnail()){
                                the_post_thumbnail();
                            }
                        echo '</div>';
                    }

                    echo '<div class="ltp_content">';
                        the_title(
                            sprintf( '<h3 class="team-title"><a href="%s" rel="bookmark">', esc_attr( esc_url( get_permalink() ) ) ),
                            '</a></h3>'
                        );

                        //Check Excerpt Condition
                        if ( 'yes' === $settings['show_excerpt'] ) {
                            echo "<p class='team-excerpt'>" .get_the_excerpt(). "</p>";
                        }
                    echo '</div>';

                echo '</div>';
            }
            echo '</div>';
        }
        else {
            _e( 'Sorry, no teams matched your criteria.','ltp' );
        }
        wp_reset_postdata();
    }
}
