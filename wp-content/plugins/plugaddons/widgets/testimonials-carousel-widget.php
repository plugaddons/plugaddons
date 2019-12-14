<?php


use Elementor\Controls_Manager;

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
        return 'testimonials-carousel';
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
        return __('Testimonials Carousel', 'plugaddons');
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
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'carousel_view',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => __('Testimonials Carousel Style', 'plugaddons'),
                'separator' => 'before',
                'default' => 'style-one',
                'options' => [
                    'style-one' => __('Style One', 'plugaddons'),
                    'style-two' => __('Style Two', 'plugaddons'),
                    'style-three' => __('Style Three', 'plugaddons'),
                    'style-four' => __('Style Four', 'plugaddons'),
                    'style-five' => __('Style Five', 'plugaddons'),
                    'style-six' => __('Style Six', 'plugaddons'),
                ],
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'style_select_hidden',
            [
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'label' => __('Testimonials Carousel Style', 'plugaddons'),
                'default' => 'style_select_hidden'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'items_hidden_selector',
            [
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'label' => __('Items Hidden Selector', 'plugaddons'),
                'default' => 'items_hidden_selector'
            ]
        );
        $repeater->add_control(
            'testimonial_name',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => __('Name', 'plugaddons'),
                'default' => __('SHEHAB KHAN', 'plugaddons'),
                'placeholder' => __('Type a name', 'plugaddons'),
            ]
        );

        $repeater->add_control(
            'testimonial_designation',
            [
                'label' => __('Designation', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Programming', 'plugaddons'),
                'placeholder' => __('Type a Designation', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'testimonial_content',
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

        $this->add_control(
            'testimonials',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((testimonial_name) ? (testimonial_name) : "") #>',
                'default' => [
                    [
                        'testimonial_name' => 'SHEHAB KHAN',
                    ],
                    [
                        'testimonial_name' => 'SHARIAR HOSSAIN',
                    ],
                    [
                        'testimonial_name' => 'SHOHEL KHAN',
                    ],
                    [
                        'testimonial_name' => 'AL SHAHRIAR',
                    ],
                    [
                        'testimonial_name' => 'ABDULL AL AHAD',
                    ]
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'plugaddons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop?', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay?', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 3000,
                'description' => __('Autoplay speed in milliseconds', 'plugaddons'),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 300,
                'description' => __('Slide speed in milliseconds', 'plugaddons'),
                'frontend_available' => true,
            ]
        );


        $this->add_control(
            'center',
            [
                'label' => __('Center Mode?', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'description' => __('Best works with odd number of slides (Slides To Show) and loop (Infinite Loop)', 'plugaddons'),
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'animation_fade',
            [
                'label' => __('Fade?', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'description' => __('Best works with odd number of slides (Slides To Show) and loop (Infinite Loop)', 'plugaddons'),
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __('Navigation', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'plugaddons'),
                    'arrow' => __('Arrow', 'plugaddons'),
                    'dots' => __('Dots', 'plugaddons'),
                    'both' => __('Arrow & Dots', 'plugaddons'),
                ],
                'default' => 'arrow',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => __('Slides To Show', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    1 => __('1 Slide', 'plugaddons'),
                    2 => __('2 Slides', 'plugaddons'),
                    3 => __('3 Slides', 'plugaddons'),
                    4 => __('4 Slides', 'plugaddons'),
                    5 => __('5 Slides', 'plugaddons'),
                    6 => __('6 Slides', 'plugaddons'),
                ],
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'frontend_available' => true,
                'style_transfer' => true,
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
            'section_carousel_style',
            [
                'label' => __( 'Style', 'plugaddons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'background_colors',
            [
                'label' => __('Background Color', 'plugaddons'),
                'condition' => ['carousel_view!' => 'style-six'],
            ]
        );
        $this->start_controls_tab(
            'bg_colors_normal',
            [
                'label' => __( 'Normal', 'plugaddons' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .testimonial-carousel.style-one .pla-testimonial-box,{{WRAPPER}} .testimonial-carousel.style-two .pla-testimonial-box-inner,{{WRAPPER}} .testimonial-carousel.style-three .pla-testimonial-box,{{WRAPPER}} .testimonial-carousel.style-four,{{WRAPPER}} .testimonial-carousel.style-five .pla-testimonial-box-inner',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'bg_colors_hover',
            [
                'label' => __( 'Hover', 'plugaddons' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hvr-background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .testimonial-carousel.style-two .slick-current.slick-active .pla-testimonial-box-inner, {{WRAPPER}} .testimonial-carousel.style-two .pla-testimonial-box-inner:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel .pla-testimonial-box,{{WRAPPER}} .pla-testimonial-box, {{WRAPPER}} .pla-testimonial-box:after, {{WRAPPER}} .testimonial-carousel.style-two .pla-testimonial-box-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['carousel_view!' => array('style-six', 'style-four')],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .pla-testimonial-box',
                'condition' => ['carousel_view!' => array('style-six', 'style-four')],
            ]
        );
        $this->add_control(
            'inner_border',
            [
                'label' => __('Border Color', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-testimonial-box:after,{{WRAPPER}} .testimonial-carousel.style-six .pla-author-img-wrap, {{WRAPPER}} .pla-testimonial-box.pla-testimonial--grid-style-five .pla-authoe-img-wrap img' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-carousel.style-six .pla-author-img-wrap:after' => 'border-right-color: {{VALUE}};',
                ],
                'condition' => ['carousel_view' => array('style-one', 'style-six')],
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'image_bg',
            [
                'label' => __('Image Background Color', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel .pla-testimonial-box.pla-testimonial--style-three .pla-author-img-wrap:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['carousel_view' => array('style-three')],
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_tes_content',
            [
                'label' => __('Content', 'plugaddons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-testimonial-box-inner p,{{WRAPPER}} .testimonial-carousel .pla-testimonial-box.pla-testimonial--style-two .pla-testimonial--style-two span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label' => __('Name Color', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel .pla-testimonial-box h6,{{WRAPPER}} .testimonial-carousel .pla-testimonial-box span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => 'Name Typography',
                'selector' => '{{WRAPPER}} .testimonial-carousel .pla-testimonial-box h6',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .pla-testimonial-box .grid-designation, {{WRAPPER}} .pla-testimonial-box p',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
            ]
        );
        $this->end_controls_section();
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
        $view = $settings['carousel_view'];
        $testimonials = $settings['testimonials'];

        ?>
        <div class="testimonial-carousel <?php echo $this->get_name();?> <?php echo esc_attr($view); ?>">
            <?php foreach ($testimonials as $index => $testimonial):
                $content = isset($testimonial['testimonial_content']) ? $testimonial['testimonial_content'] : '';
                $name = isset($testimonial['testimonial_name']) ? $testimonial['testimonial_name'] : '';
                $designation = isset($testimonial['testimonial_designation']) ? $testimonial['testimonial_designation'] : '';
                $rating = $testimonial['testimonial_rating'];
                $img = isset($testimonial['testimonial_image']) ? $testimonial['testimonial_image'] : array();

                $name_inline_edit = $this->get_repeater_setting_key('testimonial_name', 'testimonials', $index);
                $this->add_inline_editing_attributes($name_inline_edit, 'none');
                $info_inline_edit = $this->get_repeater_setting_key('testimonial_content', 'testimonials', $index);
                $this->add_inline_editing_attributes($info_inline_edit, 'none');
                $this->add_render_attribute($info_inline_edit, [
                    'class' => "carousel-name carousel-name--{$view}"
                ]);
                $name_inline_designation = $this->get_repeater_setting_key('testimonial_designation', 'testimonials', $index);
                $this->add_inline_editing_attributes($name_inline_designation, 'none');
                ?>
                <div class="pla-testimonial-box pla-testimonial--<?php echo esc_attr($view); ?>">
                    <div class="pla-testimonial-box-inner clearfix">
                        <div class="pla-testimonial">
                            <?php if ($view == 'style-three' || ($view == 'style-six' && $img['id'] != '')): ?>
                                <div class="pla-author-img-wrap">
                                    <?php echo wp_get_attachment_image($img['id'], 'thumbnail'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($view == 'style-four' || $view == 'style-six'): ?>
                                <h6 <?php echo $this->get_render_attribute_string($name_inline_edit) ?>><?php echo esc_html($name); ?></h6>
                                <span <?php echo $this->get_render_attribute_string($name_inline_designation) ?>><?php echo esc_html($designation); ?></span>
                            <?php endif; ?>
                            <p <?php echo $this->get_render_attribute_string($info_inline_edit) ?>><?php echo wp_kses_post($content); ?></p>
                            <?php if ($view == 'style-one' || $view == 'style-three'): ?>
                                <div class="ratings <?php echo esc_attr($rating); ?>"></div>
                                <h6 <?php echo $this->get_render_attribute_string($name_inline_edit) ?>><?php echo esc_html($name); ?></h6>
                                <span <?php echo $this->get_render_attribute_string($name_inline_designation) ?>><?php echo esc_html($designation); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($view != 'style-one' && $view != 'style-three' && $view != 'style-four' && $view != 'style-six'): ?>
                        <div class="pla-author-img-wrap pla-author-img-wrap-<?php echo esc_attr($view); ?>">
                            <?php echo wp_get_attachment_image($img['id'], 'thumbnail'); ?>
                        </div>
                        <div class="pla-testimonial--<?php echo esc_attr($view); ?>">
                            <div class="ratings <?php echo esc_attr($rating); ?>"></div>
                            <h6 <?php echo $this->get_render_attribute_string($name_inline_edit) ?>><?php echo esc_html($name); ?></h6>
                            <span <?php echo $this->get_render_attribute_string($name_inline_designation) ?>><?php echo esc_html($designation); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="quote-one"></div>
                    <div class="quote-two"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

}