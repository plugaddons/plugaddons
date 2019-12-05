<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

class Plugaddons_Testimonials_Widget extends \Elementor\Widget_Base
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
        return 'testimonials_widget';
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
        return __('Testimonials Widget', 'plugaddons');
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
        return 'fa fa-ravelry';
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
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Testimonials Style', 'plugaddons'),
                'separator' => 'before',
                'default' => 'style-one',
                'options' => [
                    'style-one' => __('Grid', 'plugaddons'),
                    'style-two' => __('Carousel', 'plugaddons'),
                ],
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'grid_view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Testimonials Grid Style', 'plugaddons'),
                'separator' => 'before',
                'default' => 'grid-style-one',
                'options' => [
                    'grid-style-one' => __('Style One', 'plugaddons'),
                    'grid-style-two' => __('Style Two', 'plugaddons'),
                    'grid-style-three' => __('Style Three', 'plugaddons'),
                    'grid-style-four' => __('Style Four', 'plugaddons'),
                    'grid-style-five' => __('Style Five', 'plugaddons')
                ],
                'condition' => ['view' => 'style-one'],
                'style_transfer' => true,
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
                'condition' => ['view' => 'style-two'],
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'testimonial_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                        'view' => 'style-one',
                        'grid_view' => array('grid-style-two', 'grid-style-five'),
                ],
            ]
        );
        $this->add_control(
            'testimonial_name',
            [
                'label' => __('Name', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('SHEHAB KHAN', 'plugaddons'),
                'condition' => ['view' => 'style-one'],
            ]
        );
        $this->add_control(
            'testimonial_designation',
            [
                'label' => __('Designation', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Programming', 'plugaddons'),
                'condition' => ['view' => 'style-one'],
            ]
        );
        $this->add_control(
            'testimonial_content',
            [
                'label' => __('Description', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. ', 'plugaddons'),
                'condition' => ['view' => 'style-one'],
            ]
        );
        $this->add_control(
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
                    'rating-one-half' => __('3.5', 'plugaddons'),
                    'rating-four' => __('4', 'plugaddons'),
                    'rating-one-half' => __('4.5', 'plugaddons'),
                    'rating-five' => __('5', 'plugaddons'),
                ],
                'default' => 'rating-five',
                'condition' => ['view' => 'style-one'],
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
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. ', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'testimonial_carousel_rating',
            [
                'label' => __('Rating', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'default' => 'rating-five',
                'options' => [
                    'rating-one' => __('1', 'plugaddons'),
                    'rating-one-half' => __('1.5', 'plugaddons'),
                    'rating-two' => __('2', 'plugaddons'),
                    'rating-two-half' => __('2.5', 'plugaddons'),
                    'rating-three' => __('3', 'plugaddons'),
                    'rating-one-half' => __('3.5', 'plugaddons'),
                    'rating-four' => __('4', 'plugaddons'),
                    'rating-one-half' => __('4.5', 'plugaddons'),
                    'rating-five' => __('5', 'plugaddons'),
                ],
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
                'condition' => ['view' => 'style-two'],
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
                'label' => __('Skill Bars', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __('Height', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-skill--style-two' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-one' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-three' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-four' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-five' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => __('Spacing Between', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-skill--style-two' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-one:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-three' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-four' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-skill--style-five' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-skill, {{WRAPPER}} .pla-skill-level' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pla-skill'
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
                    '{{WRAPPER}} .pla-skill-info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'level_color',
            [
                'label' => __('Level Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-skill-level' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .pla-skill-level-text-five' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .pla-skill-level-text-four:after' => 'border-color: transparent transparent transparent {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'base_color',
            [
                'label' => __('Base Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-skill' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .pla-skill-info',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'info_text_shadow',
                'selector' => '{{WRAPPER}} .pla-skill-info',
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
        $grid_view = $settings['grid_view'];
        $img = isset($settings['testimonial_image']) ? $settings['testimonial_image'] : array();
        $content = isset($settings['testimonial_content']) ? $settings['testimonial_content'] : '';
        $name = isset($settings['testimonial_name']) ? $settings['testimonial_name'] : '';
        $designation = isset($settings['testimonial_designation']) ? $settings['testimonial_designation'] : '';
        $this->add_inline_editing_attributes('testimonial_content', 'none');
        $this->add_render_attribute('testimonial_content', [
            'class' => "grid-content grid-content--{$grid_view}"
        ]);
        $this->add_inline_editing_attributes('testimonial_name', 'none');
        $this->add_render_attribute('testimonial_name', [
            'class' => "grid-name grid-name--{$grid_view}"
        ]);
        $this->add_inline_editing_attributes('testimonial_designation', 'none');
        $this->add_render_attribute('testimonial_designation', [
            'class' => "grid-designation grid-designation--{$grid_view}"
        ]);
        ?>
        <div class="pla-testimonial-box pla-testimonial--<?php echo esc_attr($grid_view); ?>">
            <div class="pla-testimonial-box-inner clearfix">
                <div class="pla-testimonial-style-one">
                    <p <?php echo $this->get_render_attribute_string('testimonial_content') ?>><?php echo wp_kses_post($content); ?></p>
                    <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h6 <?php echo $this->get_render_attribute_string('testimonial_name') ?>><?php echo esc_html($name); ?></h6>
                    <span <?php echo $this->get_render_attribute_string('testimonial_designation') ?>><?php echo esc_html($designation); ?></span>

                </div>
                <div class="pla-testimonial-style-two clearfix">
                    <div class="pla-author-img">
                        <div class="pla-authoe-img-wrap">
                            <?php echo wp_get_attachment_image($img['id'], 'thumbnail'); ?>
                        </div>
                        <h6 <?php echo $this->get_render_attribute_string('testimonial_name') ?>><?php echo esc_html($name); ?></h6>
                        <span <?php echo $this->get_render_attribute_string('testimonial_designation') ?>><?php echo esc_html($designation); ?></span>
                    </div>
                    <div class="pla-author-content">
                        <p <?php echo $this->get_render_attribute_string('testimonial_content') ?>><?php echo wp_kses_post($content); ?></p>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quote-one"></div>
            <div class="quote-two"></div>
        </div>
        <?php

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
        ?>

        <#
        view.addInlineEditingAttributes('testimonial_content', 'none');
        view.addRenderAttribute('testimonial_content',{
            'class':"grid-content grid-content--{{{settings.grid_view}}}"
        });
        view.addInlineEditingAttributes('testimonial_name', 'none');
        view.addRenderAttribute('testimonial_name',{
            'class':"grid-name grid-name--{{{settings.grid_view}}}"
        });
        view.addInlineEditingAttributes('testimonial_designation', 'none');
        view.addRenderAttribute('testimonial_designation',{
            'class':"grid-designation grid-designation--{{{settings.grid_view}}}"
        });
        #>
        <div class="pla-testimonial-box pla-testimonial--{{{settings.grid_view}}}">
            <div class="pla-testimonial-box-inner clearfix">
                <div class="pla-testimonial-style-one">
                    <p {{{view.getRenderAttributeString('testimonial_content')}}}>{{{settings.testimonial_content}}}</p>
                    <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h6 {{{view.getRenderAttributeString('testimonial_name')}}}>{{{settings.testimonial_name}}}</h6>
                    <span {{{view.getRenderAttributeString('testimonial_designation')}}}>{{{settings.testimonial_designation}}}</span>

                </div>
                <div class="pla-testimonial-style-two clearfix">
                    <div class="pla-author-img">
                        <div class="pla-authoe-img-wrap">
                            <img src="{{ settings.testimonial_image.url }}">
                        </div>
                        <h6 {{{view.getRenderAttributeString('testimonial_name')}}}>{{{settings.testimonial_name}}}</h6>
                        <span {{{view.getRenderAttributeString('testimonial_designation')}}}>{{{settings.testimonial_designation}}}</span>
                    </div>
                    <div class="pla-author-content">
                        <p {{{view.getRenderAttributeString('testimonial_content')}}}>{{{settings.testimonial_content}}}</p>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quote-one"></div>
            <div class="quote-two"></div>
        </div>
        <?php
    }

}