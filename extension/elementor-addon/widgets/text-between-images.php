<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Text_Between_Images extends Widget_Base
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
		return 'smartcity-text-between-images';
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
		return esc_html__('Văn bản giữa hai ảnh', 'smartcity');
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
		return 'eicon-animation-text';
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
		return ['text'];
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
		// content
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'smartcity' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'         =>  esc_html__( 'Tiêu đề', 'smartcity' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Heading', 'smartcity' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'image_left',
			[
				'label' => esc_html__( 'Chọn ảnh bên trái', 'smartcity' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'image_right',
			[
				'label' => esc_html__( 'Chọn ảnh bên phải', 'smartcity' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

        // style
		$this->start_controls_section(
			'heading_style_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     =>  __( 'Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-text-between-images .grid .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __( 'Typography', 'smartcity' ),
				'selector' => '{{WRAPPER}} .element-text-between-images .grid .title',
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

    ?>
		<div class="element-text-between-images">
			<div class="grid">
                <div class="image">
	                <?php echo wp_get_attachment_image( $settings['image_left']['id'] ); ?>
                </div>

                <h3 class="title">
                    <?php echo esc_html( $settings['heading'] ); ?>
                </h3>

                <div class="image">
					<?php echo wp_get_attachment_image( $settings['image_right']['id'] ); ?>
                </div>
            </div>
		</div>
    <?php
	}
}