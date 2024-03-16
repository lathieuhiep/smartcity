<?php

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Project_List extends Widget_Base
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
		return 'clinic-project-list';
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
		return esc_html__('Danh sách dự án', 'clinic');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-price-table';
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
		return ['contact', 'list' ];
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
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_image', [
				'label' => esc_html__( 'Ảnh dự án', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_image_banner', [
				'label' => esc_html__( 'Ảnh banner', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Nội dung' , 'clinic' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'list_link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Danh sách', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'clinic' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'clinic' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'clinic' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'clinic' ),
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
	?>
		<div class="element-project-list">
			<?php if ( $settings['list'] ) : ?>
				<div class="warp">
					<?php
                    foreach ($settings['list'] as $index => $item):
	                    $link_key = 'link_' . $index;
	                    $this->add_link_attributes( $link_key, $item['list_link'] );
					?>
						<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <a class="link" <?php $this->print_render_attribute_string( $link_key ); ?>></a>

							<div class="thumbnail">
								<?php if ( $item['list_image_banner'] ) : ?>
                                    <div class="banner">
										<?php echo wp_get_attachment_image( $item['list_image_banner']['id'], 'medium' ); ?>
                                    </div>
								<?php endif; ?>

								<?php echo wp_get_attachment_image( $item['list_image']['id'], 'large', false, array(
                                    'class' => 'image-feature'
                                ) ); ?>
							</div>

							<h3 class="title">
								<?php echo esc_html( $item['list_title'] ); ?>
							</h3>

							<div class="content">
								<?php echo wpautop( $item['list_content'] ); ?>
							</div>

							<div class="actions">
								<p class="sell">
                                    <?php esc_html_e('ĐANG MỞ BÁN', 'smartcity'); ?>
                                </p>

                                <p class="detail">
									<?php esc_html_e('XEM CHI TIẾT', 'smartcity'); ?>
                                </p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php
	}
}