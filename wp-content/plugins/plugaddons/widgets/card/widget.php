<?php


use Elementor\Widget_Base;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Icons_Manager;

class Plugaddons_Card extends Widget_Base
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
        return 'card';
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
        return __('Card', 'plugaddons');
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
            '_section_card',
            [
                'label' => __('Image', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'card_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'image_customize',
            [
                'label' => __('Customize?', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
                'condition' => ['image_customize' => 'yes']
            ]
        );
        $this->add_control(
            'team_image_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['image_customize' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'team_image_border',
                'label_block' => true,
                'label' => __('Border', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-card-figure img',
                'condition' => ['image_customize' => 'yes']
            ]
        );
        $this->add_control(
            'image_position',
            [
                'label' => __('Image Position', 'plugaddons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugaddons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __('Top', 'plugaddons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugaddons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'top',
                'prefix_class' => 'pla-card--',
                'style_transfer' => true,
                'condition' => [
                    'image_customize' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'offset_toggle',
            [
                'label' => __('Offset', 'plugaddons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'plugaddons'),
                'label_on' => __('Custom', 'plugaddons'),
                'return_value' => 'yes',
                'condition' => ['image_customize' => 'yes']
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'image_offset_x',
            [
                'label' => __('Offset Left', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'offset_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => ['image_customize' => 'yes', 'image_position!' => 'top'],
                'render_type' => 'ui'
            ]
        );
        $this->add_responsive_control(
            'image_offset_y',
            [
                'label' => __('Offset Top', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'offset_toggle' => 'yes', 'image_customize' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-card-figure img' => '-ms-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-card-figure img' => '-ms-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-card-figure img' => '-ms-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_card_title',
            [
                'label' => __('Title & Bio', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'card_name',
            [
                'label' => __('Name', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Entertainment of magic', 'plugaddons'),
            ]
        );
        $this->add_control(
            'enable_bio',
            [
                'label' => __('Enable Bio?', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'plugaddons'),
                'label_off' => __('No', 'plugaddons'),
                'return_value' => 'yes',
                'style_transfer' => true,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'card_content',
            [
                'label' => __('Bio', 'plugaddons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => ['enable_bio' => 'yes'],
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et nonumy eirmod tempor.', 'plugaddons'),
            ]
        );
        $this->add_control(
            'text_position',
            [
                'label' => __('Position', 'plugaddons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugaddons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Top', 'plugaddons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugaddons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'left',
                'prefix_class' => 'pla-card-align--',
                'style_transfer' => true,

            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
                'placeholder' => __('Type button text here', 'plugaddons'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'plugaddons'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://plugaddons.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',


            ]
        );
        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'plugaddons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'plugaddons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'plugaddons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .pla-btn--icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-btn--icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
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
            '_section_style_card',
            [
                'label' => __('Team', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_control(
            'card_style_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' =>[
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => true,
                ]
            ]
        );
        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->start_controls_tabs('_tab_card_s');
        $this->start_controls_tab(
            '_tab_card_normal',
            [
                'label' => __('Normal', 'plugaddons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .pla-card-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .pla-card-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-card-box',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_card_hover',
            [
                'label' => __('Hover', 'plugaddons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .pla-card-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border_hover',
                'selector' => '{{WRAPPER}} .pla-card-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-card-box:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-figure' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.pla-card--right .pla-card-desc, {{WRAPPER}}.pla-card--left .pla-card-desc' => 'flex: 0 0 calc(100% - {{SIZE || 50}}{{UNIT}}); max-width: calc(100% - {{SIZE || 50}}{{UNIT}});',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Height', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-figure, {{WRAPPER}} .pla-card-figure img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label_block' => true,
                'label' => __('Border', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-card-figure img'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_content',
            [
                'label' => __('Title & Bio', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'card_content_style_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-box .pla-card-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' =>[
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'isLinked' => true,
                ]
            ]
        );

        $this->start_controls_tabs('_tabs_card');

        $this->start_controls_tab(
            '_tab_card_name',
            [
                'label' => __('Name', 'plugaddons'),
            ]
        );
        $this->add_control(
            'top_spacing',
            [
                'label' => __('Top Spacing', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .card-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_card_info',
            [
                'label' => __('Bio', 'plugaddons'),
                'condition' => ['enable_bio' => 'yes'],
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .card-info' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .card-info',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'plugaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button_top_space',
            [
                'label' => __( 'Top Spacing', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-card-desc .btn-pla' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .btn-pla',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .btn-pla',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .btn-pla',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'plugaddons' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'plugaddons' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-pla:hover, {{WRAPPER}} .btn-pla:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-pla:hover, {{WRAPPER}} .btn-pla:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-pla:hover, {{WRAPPER}} .btn-pla:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

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
        $content = isset($settings['card_content']) ? $settings['card_content'] : '';
        $name = isset($settings['card_name']) ? $settings['card_name'] : '';
        $this->add_inline_editing_attributes('card_content', 'none');
        $this->add_render_attribute('card_content', [
            'class' => "card-info"
        ]);
        $this->add_inline_editing_attributes('card_name', 'none');
        $this->add_render_attribute('card_name', [
            'class' => "card-title"
        ]);


        $this->add_inline_editing_attributes('button_text', 'none');
        $this->add_render_attribute('button_text', 'class', 'pla-btn-text');
        $this->add_render_attribute('button', 'class', 'btn-pla');
        $this->add_render_attribute('button', 'href', esc_url($settings['button_link']['url']));
        if (!empty($settings['button_link']['is_external'])) {
            $this->add_render_attribute('button', 'target', '_blank');
        }
        if (!empty($settings['button_link']['nofollow'])) {
            $this->add_render_attribute('button', 'rel', 'nofollow');
        }
        ?>
        <div class="pla-card-box <?php echo esc_attr($settings['text_position']); ?>">
            <?php if ($settings['card_image']['url'] || $settings['card_image']['id']) :
                $this->add_render_attribute('card_image', 'src', $settings['card_image']['url']);
                $this->add_render_attribute('card_image', 'alt', Control_Media::get_image_alt($settings['card_image']));
                $this->add_render_attribute('card_image', 'title', Control_Media::get_image_title($settings['card_image']));
                ?>
                <div class="pla-card-figure">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'card_image'); ?>
                </div>
            <?php endif; ?>
            <div class="pla-card-desc">
                <h5 <?php echo $this->get_render_attribute_string('card_name'); ?>>
                    <?php echo esc_html($name, 'plugaddons'); ?>
                </h5>
                <?php if ($settings['enable_bio'] == 'yes'): ?>
                    <p <?php echo $this->get_render_attribute_string('card_content'); ?>>
                        <?php echo wp_kses_post($content); ?>
                    </p>
                <?php endif; ?>
                <?php
                if ($settings['button_text'] && empty($settings['button_icon']['value'])):
                    printf('<a %1$s>%2$s</a>',
                        $this->get_render_attribute_string('button'),
                        sprintf('<span %1$s>%2$s</span>', $this->get_render_attribute_string('button_text'), esc_html($settings['button_text']))
                    );
                elseif (empty($settings['button_text']) && !empty($settings['button_icon']['value'])):?>
                    <a <?php $this->print_render_attribute_string('button'); ?>>
                        <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                    </a>
                <?php
                elseif ($settings['button_text'] && !(empty($settings['button_icon']['value']))) :
                    if ($settings['button_icon_position'] === 'before') :
                        $this->add_render_attribute('button', 'class', 'pla-btn--icon-before');
                        $button_text = sprintf('<span %1$s>%2$s</span>', $this->get_render_attribute_string('button_text'), esc_html($settings['button_text']));
                        ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>>
                            <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                            <?php echo $button_text; ?>
                        </a>
                    <?php
                    else :
                        $this->add_render_attribute('button', 'class', 'pla-btn--icon-after');
                        $button_text = sprintf('<span %1$s>%2$s</span>', $this->get_render_attribute_string('button_text'), esc_html($settings['button_text']));
                        ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>>
                            <?php echo $button_text; ?>
                            <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                        </a>
                    <?php
                    endif;
                endif;
                ?>

            </div>
        </div>
        <?php

    }


}