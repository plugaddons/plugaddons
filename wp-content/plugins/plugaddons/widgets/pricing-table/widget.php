<?php

use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use \Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

class Plugaddons_Pricing extends Widget_Base
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
        return 'pricing';
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
        return __('Pricing Table', 'plugaddons');
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
        return 'fa fa-spinner';
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
            '_section_pricing_header',
            [
                'label' => __('Header', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_icon',
            [
                'label' => __( 'Show Icon', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'plugaddons' ),
                'label_off' => __( 'Hide', 'plugaddons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'header_icon_select',
            [
                'label' => __('Select Icon Type', 'plugaddons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => __('Icon', 'plugaddons'),
                    'image' => __('Image', 'plugaddons'),
                ],
                'condition' => ['show_icon' => 'yes']
            ]
        );
        $this->add_control(
            'header_icon',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-smile-o',
                    'library' => 'solid',
                ],
                'condition' => ['header_icon_select' => 'icon', 'show_icon' => 'yes']
            ]
        );
        $this->add_control(
            'header_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => ['header_icon_select' => 'image', 'show_icon' => 'yes']
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
                'condition' => ['header_icon_select' => 'image', 'show_icon' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
                'condition' => ['image_customize' => 'yes', 'header_icon_select' => 'image', 'show_icon' => 'yes']
            ]
        );
        $this->add_control(
            'show__title',
            [
                'label' => __( 'Show Title', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'plugaddons' ),
                'label_off' => __( 'Hide', 'plugaddons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'header_title',
            [
                'label' => __('Title', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Silver', 'plugaddons'),
                'placeholder' => __('Type your title here', 'plugaddons'),
                'condition' => ['show__title' => 'yes']
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section__price_badge',
            [
                'label' => __('Badge', 'plugaddons'),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __('Show', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'allows_show_badge',
            [
                'label' => __('Allows Show', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
                'condition'=> ['show_badge' => 'yes']
            ]
        );
        $this->add_control(
            'show_badge__on_hover',
            [
                'label' => __('Show On Hover', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'hide',
                'style_transfer' => true,
                'condition'=> ['show_badge' => 'yes']
            ]
        );


        $this->add_control(
            'badge_position',
            [
                'label' => __('Offset', 'plugaddons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'plugaddons'),
                'label_on' => __('Custom', 'plugaddons'),
                'return_value' => 'yes',
                'condition' => ['show_badge' => 'yes']
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'badge_offset_x',
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
                'condition' => ['badge_position' => 'yes'],
                'render_type' => 'ui'
            ]
        );
        $this->add_responsive_control(
            'badge_offset_y',
            [
                'label' => __('Offset Top', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'badge_position' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-pricing-badge' => '-ms-transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-pricing-badge' => '-ms-transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-pricing-badge' => '-ms-transform: translate({{badge_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{badge_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{badge_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();
        $this->add_control(
            'badge_text',
            [
                'label' => __('Badge Text', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Populer', 'plugaddons'),
                'placeholder' => __('Type badge text', 'plugaddons'),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_pricing_price',
            [
                'label' => __('Pricing', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_price',
            [
                'label' => __( 'Show Price', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'plugaddons' ),
                'label_off' => __( 'Hide', 'plugaddons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'price_type',
            [
                'label' => __('Currency', 'plugaddons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'plugaddons'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'plugaddons'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'plugaddons'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'plugaddons'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'plugaddons'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'plugaddons'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'plugaddons'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'plugaddons'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'plugaddons'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'plugaddons'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'plugaddons'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'plugaddons'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'plugaddons'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'plugaddons'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'plugaddons'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'plugaddons'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'plugaddons'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'plugaddons'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'plugaddons'),
                    'custom' => __('Custom', 'plugaddons'),
                ],
                'default' => 'dollar',
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [ 'show_price' => 'yes'],
            ]
        );
        $this->add_control(
            'custom_symbol',
            [
                'label' => __('Custom Symbol', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'price_type' => 'custom',
                    'show_price' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'price',
            [
                'label' => __('Price', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'show_price' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'period',
            [
                'label' => __('Period', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Per Month', 'plugaddons'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'show_price' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section__price_features',
            [
                'label' => __('Features', 'plugaddons'),
            ]
        );
        $this->add_control(
            'show_fetures__title',
            [
                'label' => __( 'Show Title', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'features_text',
            [
                'label' => __('Title', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Features', 'plugaddons'),
                'placeholder' => __('Type Features text', 'plugaddons'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => ['show_fetures__title' => 'yes']
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
                'default' => 'center',
                'prefix_class' => 'pla-pricing-align--',
                'style_transfer' => true,

            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __('Text', 'plugaddons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'plugaddons'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $repeater->add_control(
            'show_icon',
            [
                'label' => __( 'Enable Icon', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $repeater->add_control(
            'icon',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICON,
                'label_block' => false,
                'options' => ha_get_happy_icons(),
                'default' => 'fa fa-check',
                'include' => [
                    'fa fa-check',
                    'fa fa-close',
                ],
                'condition'=>[ 'show_icon' => 'yes']
            ]
        );
        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => __('Ultimate Addons', 'plugaddons'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('1 Month subscription', 'plugaddons'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Money protechtion', 'plugaddons'),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => __('Unlimited Access', 'plugaddons'),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print(ha_get_feature_label(text)); #>',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section__price_footer',
            [
                'label' => __('Footer', 'plugaddons'),
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Subscribe', 'plugaddons'),
                'placeholder' => __('Type button text here', 'plugaddons'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'plugaddons'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'https://plugaddons.com/',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'button__toggle',
            [
                'label' => __('Offset', 'plugaddons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'plugaddons'),
                'label_on' => __('Custom', 'plugaddons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'button__offset_x',
            [
                'label' => __('Offset X', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'button__toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-price-btn' => '-ms-transform: translate({{button__offset_x.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{button__offset_x.SIZE || 0}}{{UNIT}}); transform: translate({{button__offset_x.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-price-btn' => '-ms-transform: translate({{button__offset_x_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{button__offset_x_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{button__offset_x_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-price-btn' => '-ms-transform: translate({{button__offset_x_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{button__offset_x_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{button__offset_x_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
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
            '_section_style_pricing_table',
            [
                'label' => __('Pricing Table', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'pricing_table_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' =>[
                    'top' => 30,
                    'right' => 11,
                    'bottom' => 30,
                    'left' => 11,
                    'isLinked' => true,
                ]
            ]
        );
        $this->add_control(
            'pricing_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->start_controls_tabs('_tab_pricing__s');
        $this->start_controls_tab(
            '_tab_pricing_normal',
            [
                'label' => __('Normal', 'plugaddons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pla-pricing-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing__border',
                'selector' => '{{WRAPPER}} .pla-pricing-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-pricing-box',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_pricing__hover',
            [
                'label' => __('Hover', 'plugaddons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pla-pricing-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing__border_hover',
                'selector' => '{{WRAPPER}} .pla-pricing-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-pricing-box:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_pricing_badge',
            [
                'label' => __('Badge', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->add_control(
            'badge_width',
            [
                'label' => __( 'Width', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 83,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-badge' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->add_control(
            'badge_height',
            [
                'label' => __( 'Height', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-badge' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->add_control(
            'badge_border_radius',
            [
                'label' => __( 'Border Radius', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->add_control(
            'badge_bg_color',
            [
                'label' => __( 'Badge background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-badge' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->add_control(
            'badge_color',
            [
                'label' => __( 'Badge Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-badge' => 'color: {{VALUE}}',
                ],
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => __( 'Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-pricing-badge',
                'condition' => ['show_badge' => 'yes']
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_pricing_header',
            [
                'label' => __('Header', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'header_position',
            [
                'label' => __('Alignment', 'plugaddons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugaddons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'plugaddons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugaddons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'center',
                'prefix_class' => 'pla-pricing-header--',
                'style_transfer' => true,
                'condition' => [
                    'image_customize' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'margin',
            [
                'label' => __( 'Margin', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'header_color',
            [
                'label' => __( 'Title Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-head-title' => 'color: {{VALUE}}',
                ],
                'condition' => ['show__title' => 'yes']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'label' => __( 'Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-head-title',
                'condition' => ['show__title' => 'yes']
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_pricing_price',
            [
                'label' => __('Pricing', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'show_price' => 'yes']
            ]
        );
        $this->add_control(
            'price_position',
            [
                'label' => __('Alignment', 'plugaddons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugaddons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'plugaddons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugaddons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'center',
                'prefix_class' => 'pla-pricing-price--',
                'style_transfer' => true,
                'condition' => [
                    'image_customize' => 'yes',
                    'show_price' => 'yes'
                ],

            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-price' => 'color: {{VALUE}}',
                ],
                'condition' => [ 'show_price' => 'yes']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __( 'Price Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-pricing-price',
                'condition' => [ 'show_price' => 'yes']
            ]
        );
        $this->add_control(
            'currency_hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [ 'show_price' => 'yes']
            ]
        );
        $this->add_control(
            'currency_color',
            [
                'label' => __( 'Currency Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .currency' => 'color: {{VALUE}}',
                ],
                'condition' => [ 'show_price' => 'yes']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'crrency_typography',
                'label' => __( 'Currency Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .currency',
                'condition' => [ 'show_price' => 'yes']
            ]
        );
        $this->add_control(
            'period_hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [ 'show_price' => 'yes']
            ]
        );
        $this->add_control(
            'period_color',
            [
                'label' => __( 'Period Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-period' => 'color: {{VALUE}}',
                ],
                'condition' => [ 'show_price' => 'yes']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'label' => __( 'Currency Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-pricing-period',
                'condition' => [ 'show_price' => 'yes']
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_pricing_features',
            [
                'label' => __('Features', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'fetures__title_color',
            [
                'label' => __( 'Title Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-features .pla-pricing-fetures-title' => 'color: {{VALUE}}',
                ],
                'condition' => ['show_fetures__title' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features__title_typography',
                'label' => __( 'Title Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-pricing-features .pla-pricing-fetures-title',
                'condition' => ['show_fetures__title' => 'yes']
            ]
        );
        $this->add_control(
            'show_border',
            [
                'label' => __( 'Enable Border', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'features_border',
                'selector' => '{{WRAPPER}} .pla-pricing-features ul.pla-pricing-features-list li',
                'condition' => [
                    'show_border' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'features_color',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-features ul.pla-pricing-features-list li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_typography',
                'label' => __( 'Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-pricing-features ul.pla-pricing-features-list li',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_pricing_button',
            [
                'label' => __('Footer', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'pricing_button_padding',
            [
                'label' => __('Padding', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-footer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' =>[
                    'top' => 4,
                    'right' => 26,
                    'bottom' => 4,
                    'left' => 26,
                    'isLinked' => true,
                ]
            ]
        );
        $this->add_control(
            'pricing_style_button_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-pricing-footer a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' =>[
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'isLinked' => true,
                ]
            ]
        );
        $this->start_controls_tabs('_tab_pricing_button_s');
        $this->start_controls_tab(
            '_tab_pricing_button_normal',
            [
                'label' => __('Normal', 'plugaddons'),
            ]
        );
        $this->add_control(
            'pricing__button_color',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-price-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing__button_background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pla-price-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_s__button_border',
                'selector' => '{{WRAPPER}} .pla-price-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing__button_shadow',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-price-btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_pricing__button_hover',
            [
                'label' => __('Hover', 'plugaddons'),
            ]
        );
        $this->add_control(
            'pricing__button_color_hover',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-price-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing__hover_background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pla-price-btn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing__button_border_hover',
                'selector' => '{{WRAPPER}} .pla-price-btn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing__button_shadow_hover',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-price-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing__button_typography',
                'label' => __( 'Typography', 'plugaddons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pla-price-btn',
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
        $badgetext = isset($settings['badge_text']) ? $settings['badge_text'] : '';
        $this->add_inline_editing_attributes('badge_text', 'none');
        $this->add_render_attribute('badge_text', [
            'class' => "pla-pricing-badge"
        ]);
        $htitle = isset($settings['header_title']) ? $settings['header_title'] : '';
        $this->add_inline_editing_attributes('header_title', 'none');
        $this->add_render_attribute('header_title', [
            'class' => "pla-head-title"
        ]);
        $features = isset($settings['features_list']) ? $settings['features_list'] : array();

        $price = isset($settings['price']) ? $settings['price'] : array();
        $this->add_inline_editing_attributes('price', 'none');
        $this->add_render_attribute('price', [
            'class' => "pla-pricing-price"
        ]);
        $period = isset($settings['period']) ? $settings['period'] : array();
        $this->add_inline_editing_attributes('period', 'none');
        $this->add_render_attribute('period', [
            'class' => "pla-pricing-period"
        ]);
        $fetures_title = isset($settings['features_text']) ? $settings['features_text'] : '';
        $this->add_inline_editing_attributes('features_text', 'none');
        $this->add_render_attribute('features_text', [
            'class' => "pla-pricing-fetures-title"
        ]);

        $this->add_inline_editing_attributes( 'button_text', 'none' );
        $this->add_render_attribute( 'button_text', 'class', 'pla-price-btn' );

        $this->add_render_attribute( 'button_text', 'href', esc_url( $settings['button_link']['url'] ) );
        if ( ! empty( $settings['button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'button_text', 'target', '_blank' );
        }
        if ( ! empty( $settings['button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
        }

        ?>

        <div class="pla-pricing-box">
            <?php if ($settings['show_badge'] == 'yes' && $settings['allows_show_badge']=='yes'):?>
                <span class="pla-pricing-badge <?php echo $settings['allows_show_badge'] ? 'badge-show--allows' : '';?>"><?php echo esc_html($badgetext, 'plugaddons')?></span>
            <?php elseif ($settings['show_badge'] == 'yes' && $settings['show_badge__on_hover']):?>
                <span class="pla-pricing-badge <?php echo $settings['show_badge__on_hover'] ? 'badge-show--hover' : '';?>"><?php echo esc_html($badgetext, 'plugaddons')?></span>
            <?php endif;?>
            <div class="pla-pricing-header">
                <?php if ($settings['show_icon']):?>
                    <?php if ($settings['header_icon_select'] == 'icon'):?>
                        <?php Icons_Manager::render_icon( $settings['header_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php endif;?>
                    <?php if ($settings['header_icon_select'] == 'image'):?>
                        <?php if ($settings['header_image']['url'] || $settings['header_image']['id']) :
                            $this->add_render_attribute('header_image', 'src', $settings['header_image']['url']);
                            $this->add_render_attribute('header_image', 'alt', Control_Media::get_image_alt($settings['header_image']));
                            $this->add_render_attribute('header_image', 'title', Control_Media::get_image_title($settings['header_image']));
                            ?>
                            <div class="pla-table-figure">
                                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'header_image'); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif;?>

                <?php endif;?>
                <?php if ($settings['show__title'] == 'yes'):?>
                    <h3 <?php echo $this->get_render_attribute_string('header_title'); ?>><?php echo esc_html($htitle, 'plugaddons')?></h3>
                <?php endif;?>
            </div>
            <?php if ($settings['show_price'] == 'yes'):?>
            <div class="pla-pricing-price">
                <h3><span <?php echo $this->get_render_attribute_string('price'); ?>><?php echo esc_html($price, 'plugaddons')?></span> <span class="currency"><?php echo esc_html($settings['price_type'], 'plugaddons')?></span></h3>
                <span <?php echo $this->get_render_attribute_string('period'); ?>><?php echo esc_html($period, 'plugaddons')?></span>
            </div>
            <?php endif;?>
            <div class="pla-pricing-features">
                <?php if ($settings['show_fetures__title'] == 'yes'):?>
                <h5 <?php echo $this->get_render_attribute_string('features_text'); ?>><?php echo esc_html($fetures_title);?></h5>
                <?php endif;?>
                <?php if ($features):?>
                <ul class="pla-pricing-features-list <?php echo esc_attr($settings['show_border'] ? 'bordered' : '');?>">
                    <?php foreach ($features as $index => $feature):

                        $text_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
                        $this->add_inline_editing_attributes( $text_key, 'intermediate' );
                        $this->add_render_attribute( $text_key, 'class', 'ha-pricing-table-feature-text' );
                        ?>
                    <li class="elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                        <?php if ($feature['show_icon'] == 'yes'):?>
                        <i class="<?php echo esc_attr($feature['icon']);?>"></i>
                        <?php endif;?>
                        <span <?php $this->print_render_attribute_string( $text_key ); ?>><?php echo esc_html($feature['text'], 'plugaddons')?></span>

                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>
            <div class="pla-pricing-footer">
                <?php if ( $settings['button_text'] ) : ?>
                    <a <?php $this->print_render_attribute_string( 'button_text' ); ?>><?php echo esc_html( $settings['button_text'] ); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }


}