<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Image_Box_Grid extends Widget_Base
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
		return 'smartcity-image-box-grid';
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
		return esc_html__('Image box grid', 'smartcity');
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
		return 'eicon-gallery-grid';
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
		return ['image', 'grid'];
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
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tiêu đề' , 'smartcity' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_image', [
				'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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
						'list_title' => esc_html__( 'Title #1', 'smartcity' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'smartcity' ),
					],
					[
						'list_title' => esc_html__( 'Title #3', 'smartcity' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// setting
		$this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Cài đặt', 'smartcity' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label' => esc_html__( 'Cột', 'smartcity' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 3,
				'selectors' => [
					'{{WRAPPER}} .element-image-box-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Chiều cao ảnh', 'smartcity' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .element-image-box-grid .item__thumbnail' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        // style title
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_align',
			[
				'label'     =>  esc_html__( 'Alignment', 'smartcity' ),
				'type'      =>  Controls_Manager::CHOOSE,
				'options'   =>  [
					'text-start'  =>  [
						'title' =>  esc_html__( 'Left', 'smartcity' ),
						'icon'  =>  'eicon-text-align-left',
					],

					'text-center' => [
						'title' =>  esc_html__( 'Center', 'smartcity' ),
						'icon'  =>  'eicon-text-align-center',
					],

					'text-end' => [
						'title' =>  esc_html__( 'Right', 'smartcity' ),
						'icon'  =>  'eicon-text-align-right',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'smartcity' ),
				'selector' => '{{WRAPPER}} .element-image-box-grid .item__title',
			]
		);

		// style tabs
		$this->start_controls_tabs(
			'style_tabs'
		);

		// style normal tab
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     =>  esc_html__( 'Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid .item__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_background_color',
			[
				'label'     =>  esc_html__( 'Background color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid .item__title' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// style hover tab
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     =>  esc_html__( 'Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid .item:hover .item__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_background_color_hover',
			[
				'label'     =>  esc_html__( 'Background color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid .item:hover .item__title' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		if ( !$list ) {
			return;
		}
	?>
		<div class="element-image-box-grid">
			<?php foreach ( $list as $item) : ?>
			<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
				<div class="item__thumbnail">
					<?php echo wp_get_attachment_image( $item['list_image']['id'], 'medium_large' ); ?>
				</div>

				<h3 class="item__title <?php echo $settings['title_align'] ?>">
					<?php echo esc_html( $item['list_title'] ); ?>
				</h3>
			</div>
			<?php endforeach; ?>
		</div>
	<?php
	}
}