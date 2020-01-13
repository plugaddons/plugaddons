<?php


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

class Plugaddons_Accordion extends \Elementor\Widget_Base
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
        return 'accordion_widget';
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
        return __('Accordion', 'plugaddons');
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
            '_section_accordions',
            [
                'label' => __('Accordions', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'plugaddons'),
                'label_block' => true,
                'default' => __('Lets have Fun With PlugAddons', 'plugaddons'),
                'placeholder' => __('Type a Accordion name', 'plugaddons'),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => __('Description', 'plugaddons'),
                'label_block' => true,
                'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.', 'plugaddons'),
                'placeholder' => __('Type a Accordion name', 'plugaddons'),
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
                'description' => __('You can customize this Accordion color from here or customize from Style tab', 'plugaddons'),
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'title_options',
            [
                'label' => __('Title Options', 'plugaddons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['customize' => 'yes'],
            ]
        );
        $repeater->start_controls_tabs('_tab_title');
        $repeater->start_controls_tab(
            '_tab_title_normal',
            [
                'label' => __('Normal', 'plugaddons'),
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'tab_title_options',
            [
                'label' => __('Title & Icons Options', 'plugin-name'),
                'type' => Controls_Manager::HEADING,
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'title_bg',
            [
                'label' => __('Background', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-title' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'label' => __( 'Border', 'plugaddons' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-title',
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'title_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-title h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-title .pla-accordion-icon' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'number_options',
            [
                'label' => __('Number Options', 'plugin-name'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'number_bg',
            [
                'label' => __('Background', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-number' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'number_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-number' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            '_tab_title_active',
            [
                'label' => __('Active', 'plugaddons'),
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'active_number_options',
            [
                'label' => __('Title & Icons Options', 'plugaddons'),
                'type' => Controls_Manager::HEADING,
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'title_active_bg',
            [
                'label' => __('Background Active', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.open .pla-accordion-title' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'active_title_border',
                'label' => __( 'Border', 'plugaddons' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.open .pla-accordion-title',
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'active_title_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.open .pla-accordion-title h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.open .pla-accordion-title .pla-accordion-icon' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'tab_active_number_options',
            [
                'label' => __('Number Options', 'plugin-name'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'active_number_bg',
            [
                'label' => __('Background', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.open .pla-accordion-number' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'active_number_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.open .pla-accordion-number' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $repeater->add_control(
            'content_options',
            [
                'label' => __('Content Options', 'plugaddons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['customize' => 'yes'],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color_content',
                'label' => __('Background', 'plugaddons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-content',
                'condition' => ['customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'content_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pla-accordion-content' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'accordions',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name) ? (name): "Accordions") #>',
                'default' => [
                    [
                        'name' => 'Lets have Fun With PlugAddons!'
                    ],
                    [
                        'name' => 'What is Plugaddons?'
                    ],
                    [
                        'name' => 'What is Elementor?'
                    ],
                    [
                        'name' => 'What is WordPress?'
                    ],
                    [
                        'name' => 'Plugaddons Feture!'
                    ]
                ]
            ]
        );
        $this->add_control(
            'show_number',
            [
                'label' => __('Show Number', 'plugaddons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'plugaddons'),
                'label_off' => __('Hide', 'plugaddons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'number_align',
            [
                'label' => __('Alignment', 'plugin-domain'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugin-domain'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugin-domain'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'condition' => ['show_number' => 'yes']
            ]
        );
        $this->add_control(
            'selected_icon',
            [
                'label' => __('Icon', 'plugaddons'),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'plus',
                        'plus-square',
                        'folder-plus',
                        'cart-plus',
                        'calendar-plus',
                        'search-plus',
                    ],
                    'fa-regular' => [
                        'plus-square',
                        'plus-circle',
                        'calendar-plus',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        $this->add_control(
            'selected_active_icon',
            [
                'label' => __('Active Icon', 'plugaddons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'minus',
                        'minus-circle',
                        'minus-square',
                        'folder-minus',
                        'calendar-minus',
                        'search-minus',
                    ],
                    'fa-regular' => [
                        'minus-square',
                        'calendar-minus',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );
        $this->add_control(
            'icon_align',
            [
                'label' => __('Icon Alignment', 'plugin-domain'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugin-domain'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugin-domain'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => false,
                'condition' => ['selected_icon[value]!' => '',]
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
            '_section_style_accordion',
            [
                'label' => __('Accordions', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'accordion_border',
                'selector' => '{{WRAPPER}} .accordion',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 52,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-accordion-title' => 'height: {{SIZE}}{{UNIT}};',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pla-accordion-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pla-accordion-title:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .pla-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '_section_title',
            [
                'label' => __('Title', 'plugaddons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('_tab_style_title');
        $this->start_controls_tab(
            '_tab_title_normal',
            [
                'label' => __('Normal', 'plugaddons'),
            ]
        );
        $this->add_control(
            'normal_style_title_bg',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-accordion-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'normal_style_title_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-accordion-title h1,{{WRAPPER}} .pla-accordion-title h2,{{WRAPPER}} .pla-accordion-title h3,{{WRAPPER}} .pla-accordion-title h4,{{WRAPPER}} .pla-accordion-title h5,{{WRAPPER}} .pla-accordion-title h6,{{WRAPPER}} .pla-accordion-title .pla-accordion-icon,{{WRAPPER}} .pla-accordion-title .pla-accordion-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'normal_style_border',
                'label' => __( 'Border', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .pla-accordion-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'normal_style_title_typography',
                'selector' => '{{WRAPPER}} .pla-accordion-title h5',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'normal_style_title_text_shadow',
                'selector' => '{{WRAPPER}} .pla-accordion-title h5',
            ]
        );
        $this->add_control(
            'normal_style_number_color',
            [
                'label' => __('Number Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pla-accordion-number' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['show_number' => 'yes']
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            '_tab_style_active',
            [
                'label' => __('Active', 'plugaddons'),
            ]
        );
        $this->add_control(
            'active_style_bg',
            [
                'label' => __('Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-accordion.open .pla-accordion-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'active_style_title_color',
            [
                'label' => __('Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-accordion.open .pla-accordion-title h1,{{WRAPPER}} .single-accordion.open .pla-accordion-title h2,{{WRAPPER}} .single-accordion.open .pla-accordion-title h3,{{WRAPPER}} .single-accordion.open .pla-accordion-title h4,{{WRAPPER}} .single-accordion.open .pla-accordion-title h5,{{WRAPPER}} .single-accordion.open .pla-accordion-title h6,{{WRAPPER}} .single-accordion.open .pla-accordion-title .pla-accordion-icon,{{WRAPPER}} .single-accordion.open .pla-accordion-title .pla-accordion-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'active_style_border',
                'label' => __( 'Border', 'plugaddons' ),
                'selector' => '{{WRAPPER}} .single-accordion.open .pla-accordion-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'active_style_title_typography',
                'selector' => '{{WRAPPER}} .single-accordion.open .pla-accordion-title h5',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'active_title_text_shadow',
                'selector' => '{{WRAPPER}} .single-accordion.open .pla-accordion-title h5',
            ]
        );
        $this->add_control(
            'active_style_number_color',
            [
                'label' => __('Number Background Color', 'plugaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-accordion.open .pla-accordion-number' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['show_number' => 'yes']
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


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
                    '{{WRAPPER}} .pla-accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .pla-accordion-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .pla-accordion-content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'content_text_shadow',
                'selector' => '{{WRAPPER}} .pla-accordion-content',
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
        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            $settings['icon'] = 'fa fa-plus';
            $settings['icon_active'] = 'fa fa-minus';
            $settings['icon_align'] = $this->get_settings('icon_align');
        }

        $is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();
        $has_icon = (!$is_new || !empty($settings['selected_icon']['value']));
        if (!is_array($settings['accordions'])) {
            return;
        }
        ?>

        <div class="accordion">
            <?php
            foreach ($settings['accordions'] as $index => $accordion) :
                $name_key = $this->get_repeater_setting_key('name', 'bars', $index);
                $this->add_inline_editing_attributes($name_key, 'none');
                ?>
                <div class="single-accordion elementor-repeater-item-<?php echo $accordion['_id']; ?>">
                    <div class="pla-accordion-title pla-accordion-title--<?php echo esc_attr($index + 1); ?> pla-accordion-title-number--<?php echo esc_attr($settings['number_align']); ?>">
                        <?php if ($settings['show_number'] == 'yes'): ?>
                            <span class="pla-accordion-number"><?php echo esc_html($index + 1); ?></span>
                        <?php endif; ?>
                        <h5><?php echo esc_html($accordion['name']); ?></h5>
                        <?php if ($has_icon) : ?>
                            <span class="pla-accordion-icon pla-accordion-icon-<?php echo esc_attr($settings['icon_align']); ?>"
                                  aria-hidden="true">
                        <?php
                        if ($is_new || $migrated) { ?>
                            <span class="pla-accordion-icon-closed"><?php Icons_Manager::render_icon($settings['selected_icon']); ?></span>
                            <span class="pla-accordion-icon-opened"><?php Icons_Manager::render_icon($settings['selected_active_icon']); ?></span>
                        <?php } else { ?>
                            <i class="pla-accordion-icon-closed <?php echo esc_attr($settings['icon']); ?>"></i>
                            <i class="pla-accordion-icon-opened <?php echo esc_attr($settings['icon_active']); ?>"></i>
                        <?php } ?>
                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="pla-accordion-content">
                        <?php echo wp_kses_post($accordion['description']) ?>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>


        <?php
    }


}