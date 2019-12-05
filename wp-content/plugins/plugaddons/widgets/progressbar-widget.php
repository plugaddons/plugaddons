<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

class Plugaddons_Progressbar_Widget extends \Elementor\Widget_Base
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
    public function get_title()
    {
        return __('Skills', 'plugaddons');
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
            '_section_skills',
            [
                'label' => __('Skills', 'plugaddons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Skill Bar Style', 'plugaddons'),
                'separator' => 'before',
                'default' => 'style-one',
                'options' => [
                    'style-one' => __('Style One', 'plugaddons'),
                    'style-two' => __('Style Two', 'plugaddons'),
                    'style-three' => __('Style Three', 'plugaddons'),
                    'style-four' => __('Style Four', 'plugaddons'),
                    'style-five' => __('Style Five', 'plugaddons'),
                ],
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Name', 'plugaddons'),
                'default' => __('HTML5', 'plugaddons'),
                'placeholder' => __('Type a skill name', 'plugaddons'),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => __('Level (Out Of 100)', 'plugaddons'),
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
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'HTML5',
                        'level' => ['size' => 94, 'unit' => '%']
                    ],
                    [
                        'name' => 'CSS3',
                        'level' => ['size' => 96, 'unit' => '%']
                    ],
                    [
                        'name' => 'PHP',
                        'level' => ['size' => 95, 'unit' => '%']
                    ],
                    [
                        'name' => 'WordPress',
                        'level' => ['size' => 90, 'unit' => '%']
                    ],
                    [
                        'name' => 'jQuery',
                        'level' => ['size' => 85, 'unit' => '%']
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
        if (!is_array($settings['skills'])) {
            return;
        }
        ?>
        <?php
        foreach ($settings['skills'] as $index => $skill) :
            $name_key = $this->get_repeater_setting_key('name', 'bars', $index);
            $this->add_inline_editing_attributes($name_key, 'none');
            $this->add_render_attribute($name_key, 'class', 'pla-skill-name');
            ?>
            <div class="pla-skill pla-skill--<?php echo esc_attr($settings['view']); ?> elementor-repeater-item-<?php echo $skill['_id']; ?>">
                <div class="pla-skill-level" data-level="<?php echo esc_attr($skill['level']['size']); ?>">
                    <div class="pla-skill-info">
                        <span <?php echo $this->get_render_attribute_string($name_key); ?>><?php echo esc_html($skill['name']); ?></span><span
                                class="pla-skill-level-text <?php echo esc_attr(($settings['view'] == 'style-four') ? "pla-skill-level-text-four" : '');?> <?php echo esc_attr(($settings['view'] == 'style-five') ? "pla-skill-level-text-five" : '');?>"></span></div>
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
    protected function _content_template_()
    {

    }

}