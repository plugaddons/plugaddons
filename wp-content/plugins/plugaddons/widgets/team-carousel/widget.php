<?php


use Elementor\Widget_Base;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

class Plugaddons_Team_carousel extends Widget_Base
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
        return 'team-carousel';
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
        return __('Team Carousel', 'plugaddons');
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
            '_section_team',
            [
                'label' => __('Testimonials', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'style_select_hidden',
            [
                'type' => Controls_Manager::HIDDEN,
                'label' => __('Testimonials Carousel Style', 'plugaddons'),
                'default' => 'style_select_hidden'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'team_image',
            [
                'label' => __('Choose Image', 'plugaddons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'items_hidden_selector',
            [
                'type' => Controls_Manager::HIDDEN,
                'label' => __('Items Hidden Selector', 'plugaddons'),
                'default' => 'items_hidden_selector'
            ]
        );
        $repeater->add_control(
            'team_name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Name', 'plugaddons'),
                'default' => __('SHEHAB KHAN', 'plugaddons'),
                'placeholder' => __('Type a name', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'enable_designation',
            [
                'label' => __('Enable Designation?', 'plugin-domain'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'team_designation',
            [
                'label' => __('Designation', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Programming', 'plugaddons'),
                'condition' => ['enable_designation' => 'yes'],
                'placeholder' => __('Type a Designation', 'plugaddons')
            ]
        );
        $repeater->add_control(
            'enable_bio',
            [
                'label' => __('Enable Bio?', 'plugin-domain'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'team_content',
            [
                'label' => __('Bio', 'plugaddons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => ['enable_bio' => 'yes'],
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'show_profiles',
            [
                'label' => __('Social Profiles', 'plugin-domain'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'separator' => 'before',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->start_controls_tabs(
            '_section_team_social',
            [
                'condition' => ['show_profiles' => 'yes']
            ]

        );

        $repeater->start_controls_tab(
            'style_social_tab',
            [
                'label' => __('Social Profiles', 'plugin-name'),
            ]
        );

        $repeater->add_control(
            'social_icon1',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'fa fa-facebook',
                    'fa fa-flickr',
                    'fa fa-google-plus',
                    'fa fa-instagram',
                    'fa fa-linkedin',
                    'fa fa-pinterest',
                    'fa fa-reddit',
                    'fa fa-twitch',
                    'fa fa-twitter',
                    'fa fa-vimeo',
                    'fa fa-youtube',
                ],
                'default' => 'fa fa-facebook',
            ]
        );
        $repeater->add_control(
            'social_link1',
            [
                'label' => __('URL', 'plugin-domain'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://facebook.com', 'plugin-domain'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'social_icon2',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICON,
                'separator' => 'before',
                'include' => [
                    'fa fa-twitter',
                    'fa fa-facebook',
                    'fa fa-flickr',
                    'fa fa-google-plus',
                    'fa fa-instagram',
                    'fa fa-linkedin',
                    'fa fa-pinterest',
                    'fa fa-reddit',
                    'fa fa-twitch',
                    'fa fa-vimeo',
                    'fa fa-youtube',
                ],
                'default' => 'fa fa-twitter',
            ]
        );
        $repeater->add_control(
            'social_link2',
            [
                'label' => __('URL', 'plugin-domain'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://twitter.com', 'plugin-domain'),
                'show_external' => true,
                'separator' => 'after',
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'social_icon3',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'fa fa-linkedin',
                    'fa fa-pinterest',
                    'fa fa-facebook',
                    'fa fa-flickr',
                    'fa fa-google-plus',
                    'fa fa-instagram',
                    'fa fa-reddit',
                    'fa fa-twitch',
                    'fa fa-twitter',
                    'fa fa-vimeo',
                    'fa fa-youtube',
                ],
                'default' => 'fa fa-linkedin',
            ]
        );
        $repeater->add_control(
            'social_link3',
            [
                'label' => __('URL', 'plugin-domain'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://linkedin.com', 'plugin-domain'),
                'separator' => 'after',
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'social_icon4',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'fa fa-pinterest',
                    'fa fa-facebook',
                    'fa fa-flickr',
                    'fa fa-google-plus',
                    'fa fa-instagram',
                    'fa fa-linkedin',
                    'fa fa-reddit',
                    'fa fa-twitch',
                    'fa fa-twitter',
                    'fa fa-vimeo',
                    'fa fa-youtube',
                ],
                'default' => 'fa fa-pinterest',
            ]
        );
        $repeater->add_control(
            'social_link4',
            [
                'label' => __('URL', 'plugin-domain'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://pinterest.com', 'plugin-domain'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((team_name) ? (team_name) : "") #>',
                'default' => [
                    [
                        'team_name' => 'SHEHAB KHAN',
                        'team_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'team_name' => 'SHARIAR HOSSAIN',
                        'team_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'team_name' => 'SHOHEL KHAN',
                        'team_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'team_name' => 'AL SHAHRIAR',
                        'team_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'team_name' => 'ABDULL AL AHAD',
                        'team_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop?', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
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
                'type' => Controls_Manager::SWITCHER,
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
                'type' => Controls_Manager::NUMBER,
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
                'type' => Controls_Manager::NUMBER,
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
                'type' => Controls_Manager::SWITCHER,
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
                'type' => Controls_Manager::SWITCHER,
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
                'type' => Controls_Manager::SELECT,
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
                'type' => Controls_Manager::SELECT,
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
            '_section_style_team',
            [
                'label' => __('Team', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->start_controls_tabs('_tab_team_s');
        $this->start_controls_tab(
            '_tab_team_normal',
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
                'selector' => '{{WRAPPER}} .pla-team-box, {{WRAPPER}} .pla-team-box.box-overlap',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'team_border',
                'selector' => '{{WRAPPER}} .pla-team-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-team-box',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_team_hover',
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
                'selector' => '{{WRAPPER}} .pla-team-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'team_border_hover',
                'selector' => '{{WRAPPER}} .pla-team-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => __('Box Shadow', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-team-box:hover',
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

        $this->add_control(
            'image_overlap',
            [
                'label' => __('Image Overlap', 'plugin-domain'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'your-plugin'),
                'label_off' => __('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'no',
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-header img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-team-box.box-overlap' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Height', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-header img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-team-box.box-overlap' => 'height: {{SIZE}}{{UNIT}};',
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
                'condition' => ['image_overlap!' => 'yes'],
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'image_offset_x',
            [
                'label' => __('Offset Left', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => ['offset_toggle' => 'yes'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui'
            ]
        );
        $this->add_responsive_control(
            'image_offset_y',
            [
                'label' => __('Offset Top', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => ['offset_toggle' => 'yes'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-team-header img' => '-ms-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-team-header img' => '-ms-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-team-header img' => '-ms-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();

        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-header img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pla-team-box.box-overlap,{{WRAPPER}} .share,{{WRAPPER}} .box-overlap .pla-team-header .share .pla-social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label_block' => true,
                'label' => __('Border', 'plugaddons'),
                'selector' => '{{WRAPPER}} .pla-team-header img',
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
            'text_position',
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
                'prefix_class' => 'pla-team-align--',
                'style_transfer' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlap_background',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient', 'video'],
                'condition' => ['image_overlap' => 'yes'],
                'selector' => '{{WRAPPER}} .box-overlap .pla-team-desc:after',
            ]
        );
        $this->add_control(
            'bio_position',
            [
                'label' => __('Position', 'happy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'middle-left' => __('Middle Left', 'happy-elementor-addons'),
                    'middle-center' => __('Middle Center', 'happy-elementor-addons'),
                    'middle-right' => __('Middle Right', 'happy-elementor-addons'),
                    'bottom-left' => __('Bottom Left', 'happy-elementor-addons'),
                    'bottom-center' => __('Bottom Center', 'happy-elementor-addons'),
                    'bottom-right' => __('Bottom Right', 'happy-elementor-addons'),
                ],
                'default' => 'middle-left',
                'condition' => ['image_overlap' => 'yes']
            ]
        );

        $this->add_control(
            'bio_width',
            [
                'label' => __('Width', 'plugin-domain'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .box-overlap .pla-team-desc' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['image_overlap' => 'yes']
            ]
        );
        $this->add_control(
            'enable_skew',
            [
                'label' => __('Enable Skew?', 'plugin-domain'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'your-plugin'),
                'label_off' => __('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => ['image_overlap' => 'yes']
            ]
        );


        $this->add_control(
            'overlap_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'condition' => ['image_overlap' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .box-overlap .pla-team-desc:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_team');

        $this->start_controls_tab(
            '_tab_team_name',
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
                    '{{WRAPPER}} .carousel-name' => 'margin-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .carousel-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .carousel-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .carousel-name',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_designation',
            [
                'label' => __('Designation', 'plugaddons'),
            ]
        );
        $this->add_control(
            'designation_top_spacing',
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
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'designation_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .carousel-designation',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_team_info',
            [
                'label' => __('Bio', 'plugaddons'),
            ]
        );
        $this->add_control(
            'info_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .carousel-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .carousel-desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_social',
            [
                'label' => __('Social Profiles', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'popup_view',
            [
                'label' => __('Popup View', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => ['image_overlap' => 'yes']
            ]
        );
        $this->add_control(
            'toggle_options',
            [
                'label' => __( 'Toggle Options', 'plugaddons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );


        $this->start_controls_tabs('_tab_links_colors');
        $this->start_controls_tab(
            '_tab_links_normal',
            [
                'label' => __('Normal', 'plugaddons'),
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_control(
            'toggle_bg_color',
            [
                'label' => __( 'Background', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .share .toggle:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_control(
            'toggle_color',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .share .toggle:after' => 'color: {{VALUE}}',
                ],
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_links_hover',
            [
                'label' => __('Hover', 'plugaddons'),
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_control(
            'toggle_bg_color_hover',
            [
                'label' => __( 'Background', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .share .toggle:hover:after,{{WRAPPER}} .box-overlap:hover .share .toggle:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_control(
            'toggle_color_hover',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .share .toggle:hover:after, {{WRAPPER}} .box-overlap:hover .share .toggle:after' => 'color: {{VALUE}}',
                ],
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'toggle_border_radius',
            [
                'label' => __( 'Border Radius', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .share .toggle,{{WRAPPER}} .share .toggle:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_control(
            'toggle_offset',
            [
                'label' => __('Offset', 'plugaddons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'plugaddons'),
                'label_on' => __('Custom', 'plugaddons'),
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes'],
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'toggle_offset_x',
            [
                'label' => __('Offset Left', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => ['offset_toggle' => 'yes'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'render_type' => 'ui',
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_responsive_control(
            'toggle_offset_y',
            [
                'label' => __('Offset Top', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => ['offset_toggle' => 'yes'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .pla-team-header .share .toggle' => '-ms-transform: translate({{toggle_offset_x.SIZE || 0}}{{UNIT}}, {{toggle_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{toggle_offset_x.SIZE || 0}}{{UNIT}}, {{toggle_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{toggle_offset_x.SIZE || 0}}{{UNIT}}, {{toggle_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .pla-team-header .share .toggle' => '-ms-transform: translate({{toggle_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{toggle_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{toggle_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{toggle_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{toggle_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{toggle_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .pla-team-header .share .toggle' => '-ms-transform: translate({{toggle_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{toggle_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{toggle_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{toggle_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{toggle_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{toggle_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->end_popover();


        $this->add_control(
            'popup_bg_options',
            [
                'label' => __( 'Background Options', 'plugaddons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'social_background',
                'label' => __( 'Social Background', 'plugaddons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .box-overlap .pla-team-header .share .pla-social',
                'condition' => ['image_overlap' => 'yes', 'popup_view'=>'yes']
            ]

        );
        $this->add_control(
            'link_options',
            [
                'label' => __( 'Link Options', 'plugaddons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'social_top_spacing',
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
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-social' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'links_spacing',
            [
                'label' => __('Right Spacing', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li:not(:last-child) a' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'links_width',
            [
                'label' => __('Width', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'links_height',
            [
                'label' => __('Height', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-social li > a' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'links_icon_size',
            [
                'label' => __('Icon Size', 'plugaddons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'links_border',
                'selector' => '{{WRAPPER}} .pla-social li > a',
            ]
        );
        $this->add_responsive_control(
            'links_border_radius',
            [
                'label' => __('Border Radius', 'plugaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('_tab_links_colors');
        $this->start_controls_tab(
            '_tab_links_normal',
            [
                'label' => __('Normal', 'plugaddons'),
            ]
        );
        $this->add_control(
            'links_color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'links_bg_color',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_links_hover',
            [
                'label' => __('Hover', 'plugaddons'),
            ]
        );
        $this->add_control(
            'links_hover_color',
            [
                'label' => __('Text Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a:hover, {{WRAPPER}} .pla-social li > a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'links_hover_bg_color',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a:hover, {{WRAPPER}} .pla-social li > a:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'links_hover_border_color',
            [
                'label' => __('Border Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a:hover, {{WRAPPER}} .pla-social li > a:focus' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'links_border_border!' => '',
                ]
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

        $teams = $settings['teams'];

        ?>

        <div class="team-carousel">

            <?php foreach ($teams as $index => $team):
                $content = isset($team['team_content']) ? $team['team_content'] : '';
                $name = isset($team['team_name']) ? $team['team_name'] : '';
                $designation = isset($team['team_designation']) ? $team['team_designation'] : '';
                $name_inline_edit = $this->get_repeater_setting_key('team_name', 'teams', $index);
                $this->add_inline_editing_attributes($name_inline_edit, 'none');
                $this->add_render_attribute($name_inline_edit, [
                    'class' => "carousel-name"
                ]);
                $info_inline_edit = $this->get_repeater_setting_key('team_content', 'teams', $index);
                $this->add_inline_editing_attributes($info_inline_edit, 'none');
                $this->add_render_attribute($info_inline_edit, [
                    'class' => "carousel-desc"
                ]);
                $designation_inline_edit = $this->get_repeater_setting_key('team_designation', 'teams', $index);
                $this->add_inline_editing_attributes($designation_inline_edit, 'none');
                $this->add_render_attribute($designation_inline_edit, [
                    'class' => "carousel-designation"
                ]);
                ?>
                <div class="pla-team-box <?php echo esc_attr(($settings['enable_skew'] == 'yes') ? 'skew' : ''); ?> <?php echo esc_attr($settings['bio_position'] ? $settings['bio_position'] : ''); ?> <?php echo esc_attr(($settings['image_overlap'] == 'yes') ? 'box-overlap' : ''); ?>">
                    <div class="pla-team-header">
                        <?php if ($team['team_image']['url'] || $team['team_image']['id']) :
                            $this->add_render_attribute('team_image', 'src', $team['team_image']['url']);
                            $this->add_render_attribute('team_image', 'alt', Control_Media::get_image_alt($team['team_image']));
                            $this->add_render_attribute('team_image', 'title', Control_Media::get_image_title($team['team_image']));
                            ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($team, 'thumbnail', 'team_image'); ?>

                            <?php if ($settings['image_overlap'] == 'yes'): ?>
                            <div class="pla-team-desc">
                                <h6 <?php echo $this->get_render_attribute_string($name_inline_edit); ?>>
                                    <?php echo esc_html($name); ?>
                                </h6>
                                <?php if ($team['enable_designation'] == 'yes'): ?>
                                    <span <?php echo $this->get_render_attribute_string($designation_inline_edit) ?>><?php echo esc_html($designation); ?></span>
                                <?php endif; ?>
                                <?php if ($team['enable_bio'] == 'yes'): ?>
                                    <p <?php echo $this->get_render_attribute_string($info_inline_edit) ?>>
                                        <?php echo wp_kses_post($content); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($team['show_profiles'] == 'yes' && $settings['popup_view'] == 'no' && !empty($team['social_icon1']) && !empty($team['social_link1']['url'])): ?>
                                    <ul class="pla-social">
                                        <?php if (!empty($team['social_icon1']) && !empty($team['social_link1']['url'])): ?>
                                            <li><a href="<?php echo esc_url($team['social_link1']['url']); ?>"><i
                                                            class="<?php echo esc_attr($team['social_icon1']); ?>"></i></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($team['social_icon2']) && !empty($team['social_link2']['url'])): ?>
                                            <li><a href="<?php echo esc_url($team['social_link2']['url']); ?>"><i
                                                            class="<?php echo esc_attr($team['social_icon2']); ?>"></i></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($team['social_icon3']) && !empty($team['social_link3']['url'])): ?>
                                            <li><a href="<?php echo esc_url($team['social_link3']['url']); ?>"><i
                                                            class="<?php echo esc_attr($team['social_icon3']); ?>"></i></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($team['social_icon4']) && !empty($team['social_link4']['url'])): ?>
                                            <li><a href="<?php echo esc_url($team['social_link4']['url']); ?>"><i
                                                            class="<?php echo esc_attr($team['social_icon4']); ?>"></i></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>


                            <?php if ($settings['popup_view'] == 'yes' && $team['show_profiles'] == 'yes' && !empty($team['social_icon1']) && !empty($team['social_link1']['url'])): ?>

                            <div class="share">
                                <div class="toggle"></div>
                                <ul class="pla-social">
                                    <?php if (!empty($team['social_icon1']) && !empty($team['social_link1']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link1']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon1']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($team['social_icon2']) && !empty($team['social_link2']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link2']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon2']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($team['social_icon3']) && !empty($team['social_link3']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link3']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon3']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($team['social_icon4']) && !empty($team['social_link4']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link4']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon4']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>

                    <?php if ($settings['image_overlap'] != 'yes'): ?>
                        <div class="pla-team-desc">
                            <h6 <?php echo $this->get_render_attribute_string($name_inline_edit); ?>>
                                <?php echo esc_html($name); ?>
                            </h6>
                            <?php if ($team['enable_designation'] == 'yes'): ?>
                                <span <?php echo $this->get_render_attribute_string($designation_inline_edit) ?>><?php echo esc_html($designation); ?></span>
                            <?php endif; ?>
                            <?php if ($team['enable_bio'] == 'yes'): ?>
                                <p <?php echo $this->get_render_attribute_string($info_inline_edit) ?>>
                                    <?php echo wp_kses_post($content); ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($team['show_profiles'] == 'yes' && !empty($team['social_icon1']) && !empty($team['social_link1']['url'])): ?>
                                <ul class="pla-social">
                                    <?php if (!empty($team['social_icon1']) && !empty($team['social_link1']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link1']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon1']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($team['social_icon2']) && !empty($team['social_link2']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link2']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon2']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($team['social_icon3']) && !empty($team['social_link3']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link3']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon3']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($team['social_icon4']) && !empty($team['social_link4']['url'])): ?>
                                        <li><a href="<?php echo esc_url($team['social_link4']['url']); ?>"><i
                                                        class="<?php echo esc_attr($team['social_icon4']); ?>"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>


                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

}