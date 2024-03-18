<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Tabs extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @access public
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'smartcity-advantage-tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @access public
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('Custom Tabs', 'smartcity');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string {
        return 'eicon-tabs';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['tabs', 'list'];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['my-theme'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @access protected
     */
    protected function register_controls(): void
    {
        // list
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'smartcity' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tiêu đề tab', 'smartcity' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tab' , 'smartcity' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__( 'Nội dung', 'smartcity' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung' , 'smartcity' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'List', 'smartcity' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Tab #1', 'smartcity' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Tab #2', 'smartcity' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
    ?>
        <div class="element-tabs">
            <?php if ( !empty( $list ) ) : ?>
                <ul class="nav nav-pills">
                    <?php foreach ( $list as $key => $item ) : ?>
                        <li class="nav-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <button class="nav-link<?php echo esc_attr( $key == 0 ? ' active' : '' );?>" data-bs-toggle="pill" data-bs-target="#pills-<?php echo esc_attr( $item['_id'] ); ?>" type="button">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content">
                    <?php foreach ( $list as $key => $item ) : ?>
                        <div class="tab-pane fade elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); echo esc_attr( $key == 0 ? ' show active' : '' );?>" id="pills-<?php echo esc_attr( $item['_id'] ); ?>">
                            <div class="content">
		                        <?php echo wpautop( $item['list_content'] ); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
}