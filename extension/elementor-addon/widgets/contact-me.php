<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Contact_Me extends Widget_Base {

	public function get_name(): string {
		return 'smartcity-contact-me';
	}

	public function get_title(): ?string {
		return esc_html__( 'Liên hệ với tôi', 'smartcity' );
	}

	public function get_icon(): string {
		return 'eicon-call-to-action';
	}

	public function get_categories(): array {
		return [ 'my-theme' ];
	}

	protected function register_controls(): void {
		// layout section
		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'smartcity' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style_layout',
			[
				'label'   => esc_html__( 'Kiểu giao diện', 'clinic' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => esc_html__( 'Kiểu 1', 'clinic' ),
					'style-2' => esc_html__( 'Kiểu 2', 'clinic' ),
				],
			]
		);

		$this->add_control(
			'show_document_list',
			[
				'label'        => esc_html__( 'Hiển thị tài liệu dự án', 'smartcity' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Có', 'smartcity' ),
				'label_off'    => esc_html__( 'Không', 'smartcity' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		// image section
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Ảnh', 'smartcity' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Chọn ảnh', 'smartcity' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->end_controls_section();

		// heading section
		$this->start_controls_section(
			'heading_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'smartcity' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tiêu đề', 'smartcity' ),
				'label_block' => true
			]
		);

		$this->end_controls_section();

		// document list section
		$this->start_controls_section(
			'document_list_section',
			[
				'label'     => esc_html__( 'Tài liệu dự án', 'smartcity' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_document_list' => 'yes',
				],
			]
		);

		$repeater_document = new Repeater();

		$repeater_document->add_control(
			'list_title', [
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tiêu đề', 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater_document->add_control(
			'list_image', [
				'label'   => esc_html__( 'Ảnh', 'clinic' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater_document->add_control(
			'list_link',
			[
				'label'       => esc_html__( 'Link tải', 'smartcity' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'is_external' => 'true',
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'smartcity' ),
			]
		);

		$this->add_control(
			'document_list',
			[
				'label'       => esc_html__( 'Danh sách', 'clinic' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_document->get_controls(),
				'default'     => [
					[
						'list_title' => __( 'Tiêu đề #1', 'clinic' ),
					],
					[
						'list_title' => __( 'Tiêu đề #2', 'clinic' ),
					],
					[
						'list_title' => __( 'Tiêu đề #3', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}'
			],
		);

		$this->end_controls_section();

		// apartment list section
		$this->start_controls_section(
			'apartment_list_section',
			[
				'label' => esc_html__( 'Căn hộ', 'smartcity' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater_apartment = new Repeater();

		$repeater_apartment->add_control(
			'list_title', [
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tiêu đề', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'apartment_list',
			[
				'label'       => esc_html__( 'Danh sách', 'clinic' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_apartment->get_controls(),
				'default'     => [
					[
						'list_title' => esc_html__( 'Tiêu đề #1', 'clinic' ),
					],
					[
						'list_title' => esc_html__( 'Tiêu đề #2', 'clinic' ),
					],
					[
						'list_title' => esc_html__( 'Tiêu đề #3', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}'
			],
		);

		$this->end_controls_section();

		// content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'smartcity' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'desc',
			[
				'label'       => esc_html__( 'Mô tả', 'smartcity' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Vui lòng liên hệ ngay để tìm căn hộ phù hợp', 'smartcity' ),
				'placeholder' => esc_html__( 'Type your description here', 'smartcity' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

        // get phone theme option
		$phone = smartcity_get_option( 'opt_general_phone' );
		?>
        <div class="element-contact-me">
			<?php if ( ! empty( $settings['image']['id'] ) ) : ?>
                <div class="image-box text-center">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                </div>
			<?php endif; ?>

            <h3 class="heading text-center">
				<?php echo esc_html( $settings['heading'] ); ?>
            </h3>

			<?php if ( ! empty( $settings['document_list'] ) ) : ?>
                <div class="documents">
					<?php foreach ( $settings['document_list'] as $index => $item ) : ?>
                        <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <div class="item__image">
								<?php echo wp_get_attachment_image( $item['list_image']['id'] ); ?>
                            </div>

                            <div class="item__title">
								<?php
								if ( ! empty( $item['list_link']['url'] ) ) :
									$link_key = 'link_' . $index;
									$this->add_link_attributes( $link_key, $item['list_link'] );
									?>

                                    <a class="txt" <?php $this->print_render_attribute_string( $link_key ); ?>>
										<?php echo esc_html( $item['list_title'] ); ?>
                                    </a>

								<?php else: ?>
                                    <span class="txt"><?php echo esc_html( $item['list_title'] ); ?></span>
								<?php endif; ?>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['apartment_list'] ) ) : ?>
                <ul class="apartment">
			        <?php foreach ( $settings['apartment_list'] as $item ) : ?>
                    <li class="item">
                        <?php echo esc_html( $item['list_title'] ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
			<?php endif; ?>

            <?php if ( !empty( $phone ) ) : ?>
            <div class="action-box text-center">
                <a class="phone" href="tel:<?php echo esc_attr( smartcity_preg_replace_ony_number( $phone ) ); ?>">
                    <i class="fa-solid fa-phone alo-circle-anim"></i>
                    <span><?php echo esc_html( $phone ); ?></span>
                </a>
            </div>
            <?php endif; ?>

		    <?php if ( !empty( $settings['desc'] ) ) : ?>
            <div class="content-box text-center">
                <?php echo wpautop( $settings['desc'] ); ?>
            </div>
            <?php endif; ?>
        </div>
		<?php
	}
}