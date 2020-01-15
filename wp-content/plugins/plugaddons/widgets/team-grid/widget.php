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
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;

class Plugaddons_Team_Grid extends Widget_Base
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
        return 'team-grid';
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
        return __('Team Grid', 'plugaddons');
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


    protected static function get_social_profiles() {
        $profile_name = [
            'facebook' => __( 'Facebook', 'plugaddons' ),
            'behance' => __( 'Behance', 'plugaddons' ),
            'twitter' => __( 'Twitter', 'plugaddons' ),
            'linkedin' => __( 'LinkedIn', 'plugaddons' ),
            'dribbble' => __( 'Dribbble', 'plugaddons' ),
            'instagram' => __( 'Instagram', 'plugaddons' ),
            'tumblr' => __( 'Tumblr', 'plugaddons' ),
            'youtube' => __( 'YouTube', 'plugaddons' ),
            'vimeo' => __( 'Vimeo', 'plugaddons' ),
            'medium' => __( 'Medium', 'plugaddons' ),
            'flickr' => __( 'Flicker', 'plugaddons' ),
            'reddit' => __( 'Reddit', 'plugaddons' ),
            'email' => __( 'Email', 'plugaddons' ),
            'codepen' => __( 'CodePen', 'plugaddons' ),
            'github' => __( 'Github', 'plugaddons' ),
            'bitbucket' => __( 'BitBucket', 'plugaddons' ),
            '500px' => __( '500px', 'plugaddons' ),
            'apple' => __( 'Apple', 'plugaddons' ),
            'delicious' => __( 'Delicious', 'plugaddons' ),
            'deviantart' => __( 'DeviantArt', 'plugaddons' ),
            'digg' => __( 'Digg', 'plugaddons' ),
            'foursquare' => __( 'FourSquare', 'plugaddons' ),
            'houzz' => __( 'Houzz', 'plugaddons' ),
            'jsfiddle' => __( 'JS Fiddle', 'plugaddons' ),
            'pinterest' => __( 'Pinterest', 'plugaddons' ),
            'product-hunt' => __( 'Product Hunt', 'plugaddons' ),
            'slideshare' => __( 'Slide Share', 'plugaddons' ),
            'snapchat' => __( 'Snapchat', 'plugaddons' ),
            'soundcloud' => __( 'SoundCloud', 'plugaddons' ),
            'spotify' => __( 'Spotify', 'plugaddons' ),
            'stack-overflow' => __( 'StackOverflow', 'plugaddons' ),
            'tripadvisor' => __( 'TripAdvisor', 'plugaddons' ),
            'twitch' => __( 'Twitch', 'plugaddons' ),
            'vk' => __( 'VK', 'plugaddons' ),
            'website' => __( 'Website', 'plugaddons' ),
            'whatsapp' => __( 'WhatsApp', 'plugaddons' ),
            'wordpress' => __( 'WordPress', 'plugaddons' ),
            'xing' => __( 'Xing', 'plugaddons' ),
            'yelp' => __( 'Yelp', 'plugaddons' ),
        ];
        return $profile_name;
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
                'label' => __('Image', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'team_image',
            [
                'label' => __( 'Choose Image', 'plugaddons' ),
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
                'label' => __( 'Customize?', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugaddons' ),
                'label_off' => __( 'No', 'plugaddons' ),
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
                'label' => __( 'Border Radius', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-header img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['image_customize' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'team_image_border',
                'label_block' => true,
                'label' => __( 'Border', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .pla-team-header img',
                'condition' => ['image_customize' => 'yes']
            ]
        );
        $this->add_control(
            'image_position',
            [
                'label' => __( 'Image Position', 'plugaddons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugaddons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __( 'Top', 'plugaddons' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugaddons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'top',
                'prefix_class' => 'pla-team--',
                'style_transfer' => true,
                'condition' => [
                    'image_customize' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'offset_toggle',
            [
                'label' => __( 'Offset', 'plugaddons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'plugaddons' ),
                'label_on' => __( 'Custom', 'plugaddons' ),
                'return_value' => 'yes',
                'condition' => ['image_customize' => 'yes']
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'image_offset_x',
            [
                'label' => __( 'Offset Left', 'happy-elementor-addons' ),
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
                'label' => __( 'Offset Top', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'offset_toggle' => 'yes','image_customize' => 'yes'
                ],
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
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_team_title',
            [
                'label' => __('Title & Bio', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'team_name',
            [
                'label' => __('Name', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before',
                'default' => __('John Doe', 'plugaddons'),
            ]
        );
        $this->add_control(
            'team_designation',
            [
                'label' => __('Designation', 'plugaddons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Programming', 'plugaddons'),
            ]
        );
        $this->add_control(
            'enable_bio',
            [
                'label' => __( 'Enable Bio?', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugaddons' ),
                'label_off' => __( 'No', 'plugaddons' ),
                'return_value' => 'yes',
                'style_transfer' => true,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'team_content',
            [
                'label' => __('Bio', 'plugaddons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => ['enable_bio' => 'yes'],
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt. ', 'plugaddons'),
            ]
        );
        $this->add_control(
            'text_position',
            [
                'label' => __( 'Position', 'plugaddons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugaddons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Top', 'plugaddons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugaddons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'center',
                'prefix_class' => 'pla-team-align--',
                'style_transfer' => true,

            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_social',
            [
                'label' => __( 'Social Profiles', 'plugaddons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_profiles',
            [
                'label' => __( 'Show Profiles', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'plugaddons' ),
                'label_off' => __( 'Hide', 'plugaddons' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'show_profiles_popup',
            [
                'label' => __( 'Show Popup', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'plugaddons' ),
                'label_off' => __( 'Hide', 'plugaddons' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'none',
                'style_transfer' => true,
                'condition' => ['show_profiles' => 'yes']
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => __( 'Profile Name', 'plugaddons' ),
                'type' => Controls_Manager::SELECT2,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_social_profiles()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => __( 'Profile Link', 'plugaddons' ),
                'placeholder' => __( 'Add your profile link', 'plugaddons' ),
                'type' => Controls_Manager::URL,
                'label_block' => false,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email', [
                'label' => __( 'Email Address', 'plugaddons' ),
                'placeholder' => __( 'Add your email address', 'plugaddons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'input_type' => 'email',
                'condition' => [
                    'name' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => __( 'Customize?', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugaddons' ),
                'label_off' => __( 'No', 'plugaddons' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_icon_colors',
            [
                'condition' => ['customize' => 'yes']
            ]
        );
        $repeater->start_controls_tab(
            '_tab_icon_normal',
            [
                'label' => __( 'Normal', 'plugaddons' ),
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            '_tab_icon_hover',
            [
                'label' => __( 'Hover', 'plugaddons' ),
            ]
        );

        $repeater->add_control(
            'hover_color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hover_bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hover_border_color',
            [
                'label' => __( 'Border Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .pla-social li > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'social_profiles',
            [
                'show_label' => true,
                'label' => __( 'Social List', 'plugin-domain' ),
                'label_block' => true,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => ['show_profiles'=>'yes'],
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://www.behance.net/'],
                        'name' => 'behance'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://dribbble.com/'],
                        'name' => 'dribbble'
                    ]
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
        $this->start_controls_tabs( '_tab_team_s' );
        $this->start_controls_tab(
            '_tab_team_normal',
            [
                'label' => __( 'Normal', 'plugaddons' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .pla-team-box',
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
                'label' => __( 'Box Shadow', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .pla-team-box',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_team_hover',
            [
                'label' => __( 'Hover', 'plugaddons' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_background',
                'label' => __( 'Background', 'plugaddons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
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
                'label' => __( 'Box Shadow', 'plugaddons' ),
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_background',
                'label' => __( 'Background', 'plugaddons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .pla-team-header-customize',
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Width', 'happy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
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
                    '{{WRAPPER}} .pla-team-header' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.pla-team--right .pla-team-desc, {{WRAPPER}}.pla-team--left .ha-card-desc' => 'flex: 0 0 calc(100% - {{SIZE || 50}}{{UNIT}}); max-width: calc(100% - {{SIZE || 50}}{{UNIT}});',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Height', 'happy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-header, {{WRAPPER}} .pla-team-header img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'background_height',
            [
                'label' => __( 'Background Height', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .pla-team-header-customize' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['image_customize' => 'yes']
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pla-team-header img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label_block' => true,
                'label' => __( 'Border', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .pla-team-header img'
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

        $this->start_controls_tabs( '_tabs_team' );

        $this->start_controls_tab(
            '_tab_team_name',
            [
                'label' => __( 'Name', 'plugaddons' ),
            ]
        );
        $this->add_control(
            'top_spacing',
            [
                'label' => __( 'Top Spacing', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .grid-name' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .grid-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .grid-name',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_designation',
            [
                'label' => __( 'Designation', 'plugaddons' ),
            ]
        );

        $this->add_control(
            'designation_color',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .grid-designation',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_team_info',
            [
                'label' => __( 'Bio', 'plugaddons' ),
                'condition' => ['enable_bio' => 'yes'],
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => __( 'Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .grid-content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_social',
            [
                'label' => __( 'Social Icons', 'plugaddons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['show_profiles' => 'yes']
            ]
        );
        $this->add_control(
            'social_bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-popup .pla-social' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .social-popup .pla-social:after' => 'border-color: {{VALUE}} transparent transparent transparent',
                ],
                'condition' => ['show_profiles_popup' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'links_spacing',
            [
                'label' => __( 'Right Spacing', 'plugaddons' ),
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
                'label' => __( 'Width', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'condition' => ['show_profiles_popup!' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'links_height',
            [
                'label' => __( 'Height', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'condition' => ['show_profiles_popup!' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-social li > a' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'links_icon_size',
            [
                'label' => __( 'Icon Size', 'plugaddons' ),
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
                'condition' => ['show_profiles_popup!' => 'yes'],
            ]
        );

        $this->add_responsive_control(
            'links_border_radius',
            [
                'label' => __( 'Border Radius', 'plugaddons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => ['show_profiles_popup!' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tab_links_colors' );
        $this->start_controls_tab(
            '_tab_links_normal',
            [
                'label' => __( 'Normal', 'plugaddons' ),
            ]
        );

        $this->add_control(
            'links_color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'links_bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
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
                'label' => __( 'Hover', 'plugaddons' ),
            ]
        );

        $this->add_control(
            'links_hover_color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a:hover, {{WRAPPER}} .pla-social li > a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'links_hover_bg_color',
            [
                'label' => __( 'Background Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-social li > a:hover, {{WRAPPER}} .pla-social li > a:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'links_hover_border_color',
            [
                'label' => __( 'Border Color', 'plugaddons' ),
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
        $content = isset($settings['team_content']) ? $settings['team_content'] : '';
        $name = isset($settings['team_name']) ? $settings['team_name'] : '';
        $designation = isset($settings['team_designation']) ? $settings['team_designation'] : '';
        $this->add_inline_editing_attributes('team_content', 'none');
        $this->add_render_attribute('team_content', [
            'class' => "grid-content"
        ]);
        $this->add_inline_editing_attributes('team_name', 'none');
        $this->add_render_attribute('team_name', [
            'class' => "grid-name"
        ]);
        $this->add_inline_editing_attributes('team_designation', 'none');
        $this->add_render_attribute('team_designation', [
            'class' => "grid-designation"
        ]);
        ?>
        <div class="pla-team-box <?php echo esc_attr($settings['text_position']);?> <?php echo esc_attr(($settings['show_profiles_popup'] == 'yes') ? 'social-popup' : '');?>">
            <?php if ( $settings['team_image']['url'] || $settings['team_image']['id'] ) :
                $this->add_render_attribute( 'team_image', 'src', $settings['team_image']['url'] );
                $this->add_render_attribute( 'team_image', 'alt', Control_Media::get_image_alt( $settings['team_image'] ) );
                $this->add_render_attribute( 'team_image', 'title', Control_Media::get_image_title( $settings['team_image'] ) );

                ?>
                <?php if (is_array( $settings['social_profiles' ] ) && $settings['show_profiles' ] && $settings['show_profiles_popup'] == 'yes') : ?>
                    <ul class="pla-social pla-team-wewak-color">
                        <?php
                        foreach ( $settings['social_profiles'] as $profile ) :
                            $icon = $profile['name'];
                            $url = esc_url( $profile['link']['url'] );
                            if ($profile['name'] === 'website') {
                                $icon = 'globe';
                            } elseif ($profile['name'] === 'email') {
                                $icon = 'envelope';
                                $url = 'mailto:' . antispambot( $profile['email'] );
                            }
                            printf( '<li><a class="elementor-repeater-item-%s" target="_blank" rel="noopener" href="%s"><i class="fa fa-%s" aria-hidden="true"></i></a></li>',
                                esc_attr( $profile['_id'] ),
                                $url,
                                esc_attr( $icon )
                            );
                        endforeach; ?>
                    </ul>
                <?php endif;?>
                <div class="pla-team-header <?php echo esc_attr(($settings['image_customize'] == 'yes')? 'pla-team-header-customize' : '');?>">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'team_image' ); ?>
                </div>
            <?php endif; ?>
            <div class="pla-team-desc">
                <h5 <?php echo $this->get_render_attribute_string('team_name') ?>>
                    <?php echo esc_html($name); ?>
                </h5>
                <span <?php echo $this->get_render_attribute_string('team_designation') ?>><?php echo esc_html($designation); ?></span>
                <?php if ($settings['enable_bio'] == 'yes'):?>
                <p <?php echo $this->get_render_attribute_string('team_content') ?>>
                    <?php echo wp_kses_post($content); ?>
                </p>
                <?php endif;?>
                <?php if (is_array( $settings['social_profiles' ] ) && $settings['show_profiles' ] && $settings['show_profiles_popup'] != 'yes') : ?>
                    <ul class="pla-social">
                        <?php
                        foreach ( $settings['social_profiles'] as $profile ) :
                            $icon = $profile['name'];
                            $url = esc_url( $profile['link']['url'] );
                            if ($profile['name'] === 'website') {
                                $icon = 'globe';
                            } elseif ($profile['name'] === 'email') {
                                $icon = 'envelope';
                                $url = 'mailto:' . antispambot( $profile['email'] );
                            }
                            printf( '<li><a class="elementor-repeater-item-%s" target="_blank" rel="noopener" href="%s"><i class="fa fa-%s" aria-hidden="true"></i></a></li>',
                                esc_attr( $profile['_id'] ),
                                $url,
                                esc_attr( $icon )
                            );
                        endforeach; ?>
                    </ul>
                <?php endif;?>
            </div>
        </div>
        <?php

    }



}