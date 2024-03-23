<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Project_List_Style2 extends Widget_Base
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
		return 'clinic-project-list-2';
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
		return esc_html__('Danh sách dự án 2', 'clinic');
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

		$this->add_control(
			'column',
			[
				'label' => esc_html__('Cột', 'clinic'),
				'type' => Controls_Manager::SELECT,
				'default' => 'column-4',
				'options' => [
					'column-3' => esc_html__('3 cột', 'clinic'),
					'column-4' => esc_html__('4 cột', 'clinic'),
				],
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
			'list_content', [
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Nội dung' , 'clinic' ),
				'show_label' => false,
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

		$this->add_control(
			'text_button',
			[
				'label'         =>  esc_html__( 'Text button', 'smartcity' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'NHẬN BÁO GIÁ', 'smartcity' ),
				'label_block'   =>  true
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'popup_contact_section',
			[
				'label' => esc_html__( 'Popup liên hệ', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label'         =>  esc_html__( 'Tiêu đề', 'smartcity' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Tiêu đề', 'smartcity' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'logo',
			[
				'label' => esc_html__( 'Logo', 'smartcity' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'shortcode_form',
			[
				'label' => esc_html__('Select Form', 'smartcity'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => smartcity_get_form_cf7(),
				'default' => '0',
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

        // style item
		$this->start_controls_section(
			'style_item_section',
			[
				'label' => esc_html__( 'Item', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_background',
			[
				'label' => esc_html__( 'Background', 'smartcity' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-project-list .warp .item' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .element-project-list .warp .item',
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'textdomain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .element-project-list .warp .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        // title style
		$this->start_controls_section(
			'style_title_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     =>  esc_html__( 'Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-project-list .warp .item .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'smartcity' ),
				'selector' => '{{WRAPPER}} .element-project-list .warp .item .title',
			]
		);

		$this->end_controls_section();

        // content style
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'Nội dung', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     =>  esc_html__( 'Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-project-list .warp .item .content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'smartcity' ),
				'selector' => '{{WRAPPER}} .element-project-list .warp .item .content',
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label'     =>  esc_html__( 'Background Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-project-list .warp .item .content' => 'background-color: {{VALUE}}; padding: 1.6rem 1.2rem',
					'{{WRAPPER}} .element-project-list .warp .item .content ul li:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .element-project-list .warp .item .content',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'textdomain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .element-project-list .warp .item .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// button style
		$this->start_controls_section(
			'style_button_section',
			[
				'label' => esc_html__( 'Button', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     =>  esc_html__( 'Color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-project-list .warp .item .actions .btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'smartcity' ),
				'selector' => '{{WRAPPER}} .element-project-list .warp .item .actions .btn',
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     =>  esc_html__( 'Background color', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-project-list .warp .item .actions .btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

        // style popup form
		$this->start_controls_section(
			'style_popup_form_section',
			[
				'label' => esc_html__( 'Form', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .modal-form-cf7 .modal-content',
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

		$id_modal = 'btn-modal-form';
		if ( $settings['shortcode_form'] ) :
			$id_int = substr( $this->get_id_int(), 0, 3 );
			$id_modal = 'btn-modal-form-' . $id_int;
		endif;
	?>
		<div class="element-project-list style-2">
			<?php if ( $settings['list'] ) : ?>
				<div class="warp <?php echo esc_attr( $settings['column'] ); ?>">
					<?php foreach ($settings['list'] as $item): ?>
						<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <h3 class="title">
								<?php echo esc_html( $item['list_title'] ); ?>
                            </h3>

                            <div class="thumbnail">
								<?php echo wp_get_attachment_image( $item['list_image']['id'], 'medium_large' ); ?>
							</div>

							<div class="content">
								<?php echo wpautop( $item['list_content'] ); ?>
							</div>

                            <?php if ( $settings['shortcode_form'] ) : ?>
                                <div class="actions">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#<?php echo esc_attr( $id_modal ); ?>">
			                            <?php echo esc_html( $settings['text_button'] ); ?>
                                    </button>
                                </div>
                            <?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $settings['shortcode_form'] ) : ?>
        <!-- Modal -->
        <div class="modal fade modal-form-cf7" id="<?php echo esc_attr( $id_modal ); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php echo esc_html( $settings['form_title'] ); ?>
                        </h5>

                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <?php if ( $settings['logo'] ) : ?>
                            <div class="form-logo">
		                        <?php echo wp_get_attachment_image( $settings['logo']['id'], 'medium' ); ?>
                            </div>
                        <?php endif; ?>

	                    <?php echo do_shortcode('[contact-form-7 id="' . $settings['shortcode_form'] . '" ]'); ?>

                        <p class="note-modal">
                            <?php esc_html_e( '*Báo giá sẽ được gửi ngay đến quý khách qua Ứng dụng Zalo', 'smartcity' ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
	    <?php endif; ?>
	<?php
	}
}
