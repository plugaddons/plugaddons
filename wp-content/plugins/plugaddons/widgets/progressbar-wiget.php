<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

class Plugaddons_Progressbar_Widget extends \Elementor\Widget_Base {

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
    public function get_name() {
        return 'progressbar_widget';
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
    public function get_title() {
        return __( 'Progressbar Widget', 'plugaddons' );
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
    public function get_icon() {
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
    public function get_categories() {
        return [ 'plugaddons-category' ];
    }

    /**
     * Register Plugaddons widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

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
    protected function register_content_controls() {
        $this->start_controls_section(
            '_section_skills',
            [
                'label' => __( 'Skills', 'plugaddons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Name', 'plugaddons' ),
                'default' => __( 'Design', 'plugaddons' ),
                'placeholder' => __( 'Type a skill name', 'plugaddons' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => __( 'Level (Out Of 100)', 'plugaddons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ]
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => __( 'Want To Customize?', 'plugaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugaddons' ),
                'label_off' => __( 'No', 'plugaddons' ),
                'return_value' => 'yes',
                'description' => __( 'You can customize this skill bar color from here or customize from Style tab', 'happy-elementor-addons' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ha-skill-info' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'level_color',
            [
                'label' => __( 'Level Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ha-skill-level' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => __( 'Base Color', 'plugaddons' ),
                'type' => Controls_Manager::COLOR,
//                'selectors' => [
//                    '{{WRAPPER}} {{CURRENT_ITEM}}.ha-skill' => 'background-color: {{VALUE}};',
//                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Design',
                        'level' => ['size' => 97, 'unit' => '%']
                    ],
                    [
                        'name' => 'UX',
                        'level' => ['size' => 88, 'unit' => '%']
                    ],
                    [
                        'name' => 'Coding',
                        'level' => ['size' => 92, 'unit' => '%']
                    ],
                    [
                        'name' => 'Speed',
                    ],
                    [
                        'name' => 'Passion',
                        'level' => ['size' => 100, 'unit' => '%']
                    ]
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Text Position', 'plugaddons' ),
                'separator' => 'before',
                'default' => 'inside',
                'options' => [
                    'inside' => __( 'Text Inside', 'plugaddons' ),
                    'outside' => __( 'Text Outside', 'plugaddons' ),
                ],
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
    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_style_bars',
            [
                'label' => __( 'Skill Bars', 'happy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __( 'Height', 'happy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-skill--outside' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ha-skill--inside' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => __( 'Spacing Between', 'happy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-skill--outside' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ha-skill--inside:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'happy-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-skill, {{WRAPPER}} .ha-skill-level' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .ha-skill'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_content',
            [
                'label' => __( 'Content', 'happy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'happy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-skill-info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'level_color',
            [
                'label' => __( 'Level Color', 'happy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-skill-level' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'base_color',
            [
                'label' => __( 'Base Color', 'happy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-skill' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .ha-skill-info',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'info_text_shadow',
                'selector' => '{{WRAPPER}} .ha-skill-info',
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

    	protected function render() {
        $settings = $this->get_settings_for_display();
        if ( ! is_array( $settings['skills'] ) ) {
            return;
        }
?>
            <div class="onscrollActivate"></div>
            <?php
        foreach ( $settings['skills'] as $index => $skill ) :
            $name_key = $this->get_repeater_setting_key( 'name', 'bars', $index );
            $this->add_inline_editing_attributes( $name_key, 'none' );
            $this->add_render_attribute( $name_key, 'class', 'ha-skill-name' );
            ?>
            <div class="ha-skill ha-skill--<?php echo esc_attr( $settings['view'] ); ?> elementor-repeater-item-<?php echo $skill['_id']; ?>">
                <div class="ha-skill-level" data-level="<?php echo esc_attr( $skill['level']['size'] ); ?>">
                    <div class="ha-skill-info"><span <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html( $skill['name'] ); ?></span><span class="ha-skill-level-text"></span></div>
                </div>
            </div>
            <?php
        endforeach;
    }


    /**
     * Render Plugaddons widget output on the frontend.
     *
     * Written in JS and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template_() {

    }

}