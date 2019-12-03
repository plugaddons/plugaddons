<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

class Plugaddons_Testimonials_carousel_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Plugaddons widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'testimonials_carousel_widget';
    }

    /**
     * Get widget title.
     *
     * Retrieve Plugaddons widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Testimonials Carousel Widget', 'plugaddons');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Plugaddons widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'fa fa-quote-right';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Plugaddons widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['plugaddons-category'];
    }

    /**
     * Register Plugaddons widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {

        $this->register_content_controls();
        $this->register_style_controls();

    }

    /**
     * Register Plugaddons widget content ontrols.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_content_controls()
    {
        $this->start_controls_section(
            '_section_testimonials',
            [
                'label' => __('Testimonials', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'carousel_view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Testimonials Carousel Style', 'plugaddons'),
                'separator' => 'before',
                'default' => 'carousel-style-one',
                'options' => [
                    'carousel-style-one' => __('Style One', 'plugaddons'),
                    'carousel-style-two' => __('Style Two', 'plugaddons'),
                    'carousel-style-three' => __('Style Three', 'plugaddons'),
                    'carousel-style-four' => __('Style Four', 'plugaddons'),
                    'carousel-style-five' => __('Style Five', 'plugaddons'),
                    'carousel-style-six' => __('Style Six', 'plugaddons'),
                ],
                'style_transfer' => true,
            ]
        );  $this->add_control(
            'style_select_hidden',
            [
                'type' => Controls_Manager::HIDDEN,
                'label' => __('Testimonials Carousel Style', 'plugaddons'),
                'default' => 'style_select_hidden'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_carousel_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );

        $repeater->add_control(
            'testimonial_carousel_name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Name', 'plugaddons'),
                'default' => __('SHEHAB KHAN', 'plugaddons'),
                'placeholder' => __('Type a name', 'plugaddons'),
            ]
        );

        $repeater->add_control(
            'testimonial_carousel_designation',
            [
                'label' => __('Designation', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Programming', 'plugaddons'),
                'placeholder' => __('Type a Designation', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'testimonial_carousel_content',
            [
                'label' => __('Description', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => __('Rating', 'plugaddons'),
                'separator' => 'before',
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => [
                    'rating-one' => __('1', 'plugaddons'),
                    'rating-one-half' => __('1.5', 'plugaddons'),
                    'rating-two' => __('2', 'plugaddons'),
                    'rating-two-half' => __('2.5', 'plugaddons'),
                    'rating-three' => __('3', 'plugaddons'),
                    'rating-three-half' => __('3.5', 'plugaddons'),
                    'rating-four' => __('4', 'plugaddons'),
                    'rating-four-half' => __('4.5', 'plugaddons'),
                    'rating-five' => __('5', 'plugaddons'),
                ],
                'default' => 'rating-five',

            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => __('Want To Customize?', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'description' => __('You can customize this skill bar color from here or customize from Style tab', 'plugaddons'),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-skill-info' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'level_color',
            [
                'label' => __('Level Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-skill-level' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-skill-level-text-five' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-skill-level-text-four:after' => 'border-color: transparent transparent transparent {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => __('Base Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.pla-skill' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((testimonial_carousel_name) ? (testimonial_carousel_name) : "") #>',
                'default' => [
                    [
                        'testimonial_carousel_name' => 'SHEHAB KHAN',
                    ],
                    [
                        'testimonial_carousel_name' => 'SHARIAR HOSSAIN',
                    ],
                    [
                        'testimonial_carousel_name' => 'SHOHEL KHAN',
                    ],
                    [
                        'testimonial_carousel_name' => 'AL SHAHRIAR',
                    ],
                    [
                        'testimonial_carousel_name' => 'ABDULL AL AHAD',
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Plugaddons widget style ontrols.
     *
     * Adds different input fields in the style tab to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_style_controls()
    {
        $this->start_controls_section(
            '_section_style_bars',
            [
                'label' => __('Testimonial Style', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );

        $this->add_control(
            'inner_border',
            [
                'label' => __('Box Inner Border Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-testimonial-box:after, {{WRAPPER}} .pla-testimonial-box.pla-testimonial--grid-style-five .pla-authoe-img-wrap img' => 'border-color: {{VALUE}};',
                ],
                'style_transfer' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow',
                'label' => __( 'Inner Box Shadow', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .pla-testimonial-box:after, {{WRAPPER}} .pla-authoe-img-wrap img',
            ]

        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-testimonial-box, {{WRAPPER}} .pla-testimonial-box:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .pla-testimonial-box',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_content',
            [
                'label' => __('Content', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-testimonial-box-inner p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => 'Name Typography',
                'selector' => '{{WRAPPER}} .grid-name',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .pla-testimonial-box .grid-designation, {{WRAPPER}} .pla-testimonial-box p',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );



    }

    /**
     * Render Plugaddons widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render()
    {
        $settings = $this->get_settings_for_display();


    }


    /**
     * Render Plugaddons widget output on the frontend.
     *
     * Written in JS and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template()
    {


    }

}