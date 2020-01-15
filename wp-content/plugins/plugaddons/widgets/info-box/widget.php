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

class Plugaddons_InfoBox extends Widget_Base
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
        return 'Info Box';
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
        return __('Info Box', 'plugaddons');
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
            '_section_info_box',
            [
                'label' => __('Icon & Tag', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'icon_tag',
            [
                'label' => __('Icon or Tag', 'plugaddons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => __('Icon', 'plugaddons'),
                    'tag' => __('Tag', 'plugaddons')
                ],
            ]
        );
        $this->add_control(
            'info_tag',
            [
                'label' => __('Tag', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Default Tag', 'plugaddons'),
                'placeholder' => __('Type your title here', 'plugaddons'),
                'condition' => ['icon_tag' => 'tag']
            ]
        );
        $this->add_control(
            'icon_type',
            [
                'label' => __('Icon Type', 'plugaddons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => __('Icon', 'plugaddons'),
                    'image' => __('Image', 'plugaddons')
                ],
                'condition' => ['icon_tag' => 'icon']
            ]
        );
        $this->add_control(
            'info_icon',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'media',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => ['icon_tag' => 'icon', 'icon_type' => 'icon']

            ]
        );
        $this->add_control(
            'info_box_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => ['icon_tag' => 'icon', 'icon_type' => 'image']
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
                'condition' => ['icon_tag' => 'icon', 'icon_type' => 'image']

            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
                'condition' => ['icon_tag' => 'icon', 'image_customize' => 'yes', 'icon_type' => 'image']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_box_image_border',
                'label_block' => true,
                'label' => __('Border', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-info-box-icon img',
                'condition' => ['icon_tag' => 'icon', 'image_customize' => 'yes', 'icon_type' => 'image']
            ]
        );
        $this->add_control(
            'info_box_image_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'icon', 'image_customize' => 'yes', 'icon_type' => 'image']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_info_box_title',
            [
                'label' => __('Title & Info', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'info_box_name',
            [
                'label' => __('Name', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Listen our Voice', 'plugaddons'),
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
            'info_box_content',
            [
                'label' => __('Bio', 'plugaddons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => ['enable_bio' => 'yes'],
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam', 'plugaddons'),
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
                'prefix_class' => 'pla-info-box-align--',
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
            'show_button',
            [
                'label' => __('Show Button', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'your-plugin'),
                'label_off' => __('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
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
                ],
                'condition' => ['show_button' => 'yes']
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
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
                'condition' => ['show_button' => 'yes']
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
                'condition' => ['show_button' => 'yes']
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
                'condition' => ['show_button' => 'yes']
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
            '_section_style_info_box',
            [
                'label' => __('Info Box', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_control(
            'info_box_style_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
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
                    '{{WRAPPER}} .pla-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->start_controls_tabs('_tab_info_box_s');
        $this->start_controls_tab(
            '_tab_info_box_normal',
            [
                'label' => __('Normal', 'plugaddons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .pla-info-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_box_border',
                'selector' => '{{WRAPPER}} .pla-info-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-info-box',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_info_box_hover',
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
                'selector' => '{{WRAPPER}} .pla-info-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_box_border_hover',
                'selector' => '{{WRAPPER}} .pla-info-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-info-box:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Icon & Tag', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tag_background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .info-tag',
                'condition' => ['icon_tag' => 'tag']
            ]
        );
        $this->add_control(
            'tag_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .info-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'tag']
            ]
        );
        $this->add_control(
            'tag_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .info-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'tag']
            ]
        );
        $this->add_control(
            'tag_color',
            [
                'label' => __('Tag Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .info-tag' => 'color: {{VALUE}}',
                ],
                'condition' => ['icon_tag' => 'tag']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tag_typography',
                'label' => __('Typography', 'plugaddons'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .info-tag',
                'condition' => ['icon_tag' => 'tag']
            ]
        );


        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'desktop_default' => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
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
                    '{{WRAPPER}} .pla-info-box-icon img, {{WRAPPER}} .pla-info-box-icon i' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'icon']

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
                    '{{WRAPPER}} .pla-info-box-icon, {{WRAPPER}} .pla-info-box-icon img, {{WRAPPER}} .pla-info-box-icon i' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'icon']
            ]
        );
        $this->add_control(
            'image_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box-icon img, {{WRAPPER}} .pla-info-box-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'icon']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label_block' => true,
                'label' => __('Border', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-info-box-icon img, {{WRAPPER}} .pla-info-box-icon i',
                'condition' => ['icon_tag' => 'icon']
            ]
        );
        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box-icon img, {{WRAPPER}} .pla-info-box-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_tag' => 'icon']
            ]
        );
        $this->add_control(
            'image_bg_color',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box-icon img, {{WRAPPER}} .pla-info-box-icon i' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['icon_tag' => 'icon']
            ]
        );
        $this->add_control(
            'icon_bg_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => ['icon_tag' => 'icon', 'icon_type' => 'icon']
            ]
        );
        $this->add_control(
            'style_offset_toggle',
            [
                'label' => __('Offset', 'plugaddons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'plugaddons'),
                'label_on' => __('Custom', 'plugaddons'),
                'return_value' => 'yes',
                'condition' => ['icon_tag' => 'icon'],
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            'style_image_offset_x',
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
                'condition' => ['icon_tag' => 'icon'],
                'render_type' => 'ui'
            ]
        );
        $this->add_responsive_control(
            'style_image_offset_y',
            [
                'label' => __('Offset Top', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'offset_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-info-box-icon img' => '-ms-transform: translate({{style_image_offset_x.SIZE || 0}}{{UNIT}}, {{style_image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{style_image_offset_x.SIZE || 0}}{{UNIT}}, {{style_image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{style_image_offset_x.SIZE || 0}}{{UNIT}}, {{style_image_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-info-box-icon img' => '-ms-transform: translate({{style_image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{style_image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{style_image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-info-box-icon img' => '-ms-transform: translate({{style_image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{style_image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{style_image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                    '(desktop){{WRAPPER}} .pla-info-box-icon i' => '-ms-transform: translate({{style_image_offset_x.SIZE || 0}}{{UNIT}}, {{style_image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{style_image_offset_x.SIZE || 0}}{{UNIT}}, {{style_image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{style_image_offset_x.SIZE || 0}}{{UNIT}}, {{style_image_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-info-box-icon i' => '-ms-transform: translate({{style_image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{style_image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{style_image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-info-box-icon i' => '-ms-transform: translate({{style_image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{style_image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{style_image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{style_image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();
        $this->add_control(
            'tag_offset_toggle',
            [
                'label' => __('Offset', 'plugaddons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'plugaddons'),
                'label_on' => __('Custom', 'plugaddons'),
                'return_value' => 'yes',
                'condition' => ['icon_tag' => 'tag'],
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            'tag_offset_x',
            [
                'label' => __('Offset Left', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'tag_offset_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => ['icon_tag' => 'tag'],
                'render_type' => 'ui'
            ]
        );
        $this->add_responsive_control(
            'tag_offset_y',
            [
                'label' => __('Offset Top', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'tag_offset_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-info-box-icon .info-tag' => '-ms-transform: translate({{tag_offset_x.SIZE || 0}}{{UNIT}}, {{tag_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{tag_offset_x.SIZE || 0}}{{UNIT}}, {{tag_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{tag_offset_x.SIZE || 0}}{{UNIT}}, {{tag_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-info-box-icon .info-tag' => '-ms-transform: translate({{tag_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{tag_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{tag_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{tag_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{tag_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{tag_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-info-box-icon .info-tag' => '-ms-transform: translate({{tag_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{tag_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{tag_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{tag_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{tag_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{tag_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_content',
            [
                'label' => __('Title & Bio', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'info_box_content_style_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pla-info-box .pla-info-box-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'isLinked' => true,
                ]
            ]
        );
        $this->start_controls_tabs('_tabs_info_box');
        $this->start_controls_tab(
            '_tab_info_box_name',
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
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .info-box-title' => 'margin-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .info-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .info-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .info-box-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_info_box_info',
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
                    '{{WRAPPER}} .info-box-info' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .info-box-info',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __('Button', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_top_space',
            [
                'label' => __('Top Spacing', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .btn-pla' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .btn-pla',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .btn-pla',
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .btn-pla',
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->start_controls_tabs('_tabs_button');
        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __('Normal', 'plugaddons'),
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'color: {{VALUE}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-pla' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __('Hover', 'plugaddons'),
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-pla:hover, {{WRAPPER}} .btn-pla:focus' => 'color: {{VALUE}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-pla:hover, {{WRAPPER}} .btn-pla:focus' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['show_button' => 'yes']
            ]
        );
        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                    'show_button' => 'yes'
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
        $content = isset($settings['info_box_content']) ? $settings['info_box_content'] : '';
        $name = isset($settings['info_box_name']) ? $settings['info_box_name'] : '';
        $tag = isset($settings['info_tag']) ? $settings['info_tag'] : '';
        $this->add_inline_editing_attributes('info_box_content', 'none');
        $this->add_render_attribute('info_box_content', [
            'class' => "info-box-info"
        ]);
        $this->add_inline_editing_attributes('info_box_name', 'none');
        $this->add_render_attribute('info_box_name', [
            'class' => "info-box-title"
        ]);
        $this->add_inline_editing_attributes('info_tag', 'none');
        $this->add_render_attribute('info_tag', [
            'class' => "info-tag"
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
        <div class="pla-info-box <?php echo esc_attr($settings['text_position']); ?>">
            <?php if ($settings['info_box_image']['url'] || $settings['info_box_image']['id'] || $settings['info_icon'] || $settings['info_tag']) :
                $this->add_render_attribute('info_box_image', 'src', $settings['info_box_image']['url']);
                $this->add_render_attribute('info_box_image', 'alt', Control_Media::get_image_alt($settings['info_box_image']));
                $this->add_render_attribute('info_box_image', 'title', Control_Media::get_image_title($settings['info_box_image']));
                ?>
                <div class="pla-info-box-icon">
                    <?php if ($settings['icon_tag'] == 'tag'): ?>
                        <span <?php echo $this->get_render_attribute_string('info_tag'); ?>><?php echo esc_html($tag) ?></span>
                    <?php endif; ?>
                    <?php Icons_Manager::render_icon($settings['info_icon'], ['aria-hidden' => 'true']); ?>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'info_box_image'); ?>

                </div>
            <?php endif; ?>
            <div class="pla-info-box-desc">
                <h5 <?php echo $this->get_render_attribute_string('info_box_name'); ?>>
                    <?php echo esc_html($name); ?>
                </h5>
                <?php if ($settings['enable_bio'] == 'yes'): ?>
                    <p <?php echo $this->get_render_attribute_string('info_box_content'); ?>>
                        <?php echo wp_kses_post($content); ?>
                    </p>
                <?php endif; ?>
                <?php
                if ($settings['show_button'] == 'yes'):
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
                endif;
                ?>

            </div>
        </div>
        <?php

    }


}