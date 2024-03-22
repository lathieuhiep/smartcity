<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Safety_Principles extends Widget_Base
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
		return 'smartcity-safety-principles';
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
		return esc_html__('Điểm nổi bật', 'smartcity');
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
		return 'eicon-text';
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
		return ['image', 'text', 'list'];
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
		// image
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'smartcity' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		// list
		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'Danh sách quy tắc', 'smartcity' ),
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

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'smartcity' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Tiêu đề #1', 'smartcity' ),
					],
					[
						'list_title' => __( 'Tiêu đề #2', 'smartcity' ),
					],
					[
						'list_title' => __( 'Tiêu đề #3', 'smartcity' ),
					],
					[
						'list_title' => __( 'Tiêu đề #4', 'smartcity' ),
					],
					[
						'list_title' => __( 'Tiêu đề #5', 'smartcity' ),
					],
					[
						'list_title' => __( 'Tiêu đề #6', 'smartcity' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// style title
		$this->start_controls_section(
			'style_title_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_title_color',
			[
				'label' => esc_html__( 'Color', 'smartcity' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-safety-principles__warp .item-group .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_title_typography',
				'selector' => '{{WRAPPER}} .element-safety-principles__warp .item-group .title',
			]
		);

		$this->end_controls_section();

		// style number
		$this->start_controls_section(
			'style_number_section',
			[
				'label' => esc_html__( 'Số', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_number_color',
			[
				'label' => esc_html__( 'Color', 'smartcity' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-safety-principles__warp .item-group .number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_number_typography',
				'selector' => '{{WRAPPER}} .element-safety-principles__warp .item-group .number',
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

		$listFirst = $listLast = [];
        if ( !empty( $list ) ) {
            $size = ceil(count($list) / 2);
	        $listChuck = array_chunk($list, $size, true);

	        $listFirst = $listChuck[0];
	        $listLast = $listChuck[1] ?? [];
        }
	?>
		<div class="element-safety-principles">
			<div class="element-safety-principles__warp">
                <?php $this->listContent($listFirst, 'item-left'); ?>

				<div class="item item-thumbnail h-100">
					<?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
				</div>

				<?php $this->listContent($listLast, 'item-right'); ?>
			</div>
		</div>
		<?php
	}

    protected function listContent($list, $class): void {
    ?>
        <div class="item item-group <?php echo esc_attr( $class ); ?>">
		    <?php
		    if ( $list ) :
			    foreach ( $list as $key => $item):
            ?>
                <div class="repeater-item text-end-lg elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                    <strong class="number">
		                <?php echo esc_html( addZeroBeforeNumber($key + 1) ); ?>
                    </strong>

                    <h4 class="title text-uppercase">
		                <?php echo esc_html( $item['list_title'] ); ?>
                    </h4>
                </div>
            <?php
			    endforeach;
		    endif;
		    ?>
        </div>
    <?php
    }
}