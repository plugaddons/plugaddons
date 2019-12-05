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
        return __('Testimonials Grid', 'plugaddons');
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
            'grid_view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Testimonials Grid', 'plugaddons'),
                'separator' => 'before',
                'default' => 'style-one',
                'options' => [
                    'style-one' => __('Style One', 'plugaddons'),
                    'style-two' => __('Style Two', 'plugaddons'),
                    'style-three' => __('Style Three', 'plugaddons'),
                    'style-four' => __('Style Four', 'plugaddons'),
                    'style-five' => __('Style Five', 'plugaddons')
                ],
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
                        'grid_view' => array('style-two', 'style-five'),
                ],
            ]
        );
        $this->add_control(
            'testimonial_name',
            [
                'label' => __('Name', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('John Doe', 'plugaddons'),
            ]
        );
        $this->add_control(
            'testimonial_designation',
            [
                'label' => __('Designation', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Programming', 'plugaddons'),
            ]
        );
        $this->add_control(
            'testimonial_content',
            [
                'label' => __('Description', 'plugaddons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt. ', 'plugaddons'),
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
                    'rating-three-half' => __('3.5', 'plugaddons'),
                    'rating-four' => __('4', 'plugaddons'),
                    'rating-four-half' => __('4.5', 'plugaddons'),
                    'rating-five' => __('5', 'plugaddons'),
                ],
                'default' => 'rating-five',
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
                'condition' => ['grid_view!' => 'style-four']
            ]

        );

        $this->add_control(
            'inner_border',
            [
                'label' => __('Box Inner Border Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-testimonial-box:after, {{WRAPPER}} .pla-testimonial-box.pla-testimonial--style-five .pla-author-img-wrap img' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'grid_view' => array('style-one', 'style-two', 'style-five'),
                ],
                'style_transfer' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow',
                'label' => __( 'Inner Box Shadow', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .pla-testimonial-box:after, {{WRAPPER}} .pla-author-img-wrap img',
                'condition' => [ 'grid_view' => array('style-three', 'style-five')]
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
                'condition' => ['grid_view!' => 'style-four']
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .pla-testimonial-box',
                'condition' => ['grid_view!' => 'style-four']
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
        $rating = $settings['testimonial_rating'];
        ?>
        <div class="pla-testimonial-box pla-testimonial--<?php echo esc_attr($grid_view); ?>">
            <div class="pla-testimonial-box-inner clearfix">
                <?php if ($grid_view == 'style-one'):?>
                <div class="pla-testimonial-<?php echo esc_attr($grid_view);?>">
                    <p <?php echo $this->get_render_attribute_string('testimonial_content') ?>><?php echo wp_kses_post($content); ?></p>
                    <div class="ratings <?php echo esc_attr($rating);?>"></div>
                    <h6 <?php echo $this->get_render_attribute_string('testimonial_name') ?>><?php echo esc_html($name); ?></h6>
                    <span <?php echo $this->get_render_attribute_string('testimonial_designation') ?>><?php echo esc_html($designation); ?></span>
                </div>
                <?php endif;?>
                <?php if ($grid_view == 'style-two' || $grid_view == 'style-five'):?>
                <div class="pla-testimonial-<?php echo esc_attr($grid_view);?> clearfix">
                    <div class="pla-author-img">
                        <div class="pla-author-img-wrap">
                            <?php echo wp_get_attachment_image($img['id'], 'thumbnail'); ?>
                        </div>
                        <h6 <?php echo $this->get_render_attribute_string('testimonial_name') ?>><?php echo esc_html($name); ?></h6>
                        <span <?php echo $this->get_render_attribute_string('testimonial_designation') ?>><?php echo esc_html($designation); ?></span>
                    </div>
                    <div class="pla-author-content">
                        <p <?php echo $this->get_render_attribute_string('testimonial_content') ?>><?php echo wp_kses_post($content); ?></p>
                        <div class="ratings <?php echo esc_attr($rating);?>"></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($grid_view == 'style-three' || $grid_view == 'style-four'):?>
                <div class="pla-testimonial-<?php echo esc_attr($grid_view);?>">
                    <div class="pla-author-content">
                        <h6 <?php echo $this->get_render_attribute_string('testimonial_name') ?>><?php echo esc_html($name); ?></h6>
                        <p <?php echo $this->get_render_attribute_string('testimonial_content') ?>><?php echo wp_kses_post($content); ?></p>
                        <div class="ratings <?php echo esc_attr($rating);?>"></div>
                        <span <?php echo $this->get_render_attribute_string('testimonial_designation') ?>><?php echo esc_html($designation); ?></span>
                    </div>
                </div>
                <?php endif;?>


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
                <# if (settings.grid_view == 'style-one') { #>
                <div class="pla-testimonial-style-one">
                    <p {{{view.getRenderAttributeString('testimonial_content')}}}>{{{settings.testimonial_content}}}</p>
                    <div class="ratings {{{settings.testimonial_rating}}}"></div>
                    <h6 {{{view.getRenderAttributeString('testimonial_name')}}}>{{{settings.testimonial_name}}}</h6>
                    <span {{{view.getRenderAttributeString('testimonial_designation')}}}>{{{settings.testimonial_designation}}}</span>
                </div>
                <# } #>
                <# if (settings.grid_view == 'style-two' || settings.grid_view == 'style-five') { #>
                <div class="pla-testimonial-style-two clearfix">
                    <div class="pla-author-img">
                        <div class="pla-author-img-wrap">
                            <img src="{{ settings.testimonial_image.url }}">
                        </div>
                        <h6 {{{view.getRenderAttributeString('testimonial_name')}}}>{{{settings.testimonial_name}}}</h6>
                        <span {{{view.getRenderAttributeString('testimonial_designation')}}}>{{{settings.testimonial_designation}}}</span>
                    </div>
                    <div class="pla-author-content">
                        <p {{{view.getRenderAttributeString('testimonial_content')}}}>{{{settings.testimonial_content}}}</p>
                        <div class="ratings {{{settings.testimonial_rating}}}"></div>
                    </div>
                </div>
                <# } #>
                <# if (settings.grid_view == 'style-three' || settings.grid_view == 'style-four') { #>
                <div class="pla-testimonial-style-{{{settings.grid_view}}}">
                    <div class="pla-author-content">
                        <h6 {{{view.getRenderAttributeString('testimonial_name')}}}>{{{settings.testimonial_name}}}</h6>                        <p {{{view.getRenderAttributeString('testimonial_content')}}}>{{{settings.testimonial_content}}}</p>
                        <div class="ratings {{{settings.testimonial_rating}}}"></div>
                        <span {{{view.getRenderAttributeString('testimonial_designation')}}}>{{{settings.testimonial_designation}}}</span>
                    </div>
                </div>
                <# } #>
            </div>
            <div class="quote-one"></div>
            <div class="quote-two"></div>
        </div>
        <?php
    }

}