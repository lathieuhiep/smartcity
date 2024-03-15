<?php

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class SmartCity_Elementor_Contact_Form_7 extends Widget_Base {

	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'smartcity-contact-form-7';
	}

	public function get_title(): string {
		return esc_html__( 'Contact Form 7', 'smartcity' );
	}

	public function get_icon(): string {
		return 'eicon-form-horizontal';
	}

	protected function register_controls(): void {

		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nôi dung', 'smartcity' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'style_layout',
            [
                'label' => esc_html__('Kiểu giao diện', 'clinic'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Kiểu 1', 'clinic'),
                    '2' => esc_html__('Kiểu 2', 'clinic'),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Chọn ảnh', 'smartcity' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'smartcity' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Tiêu đề', 'smartcity' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        // List text
        $this->start_controls_section(
            'list_section',
            [
                'label' => esc_html__( 'Nôi dung mô tả', 'smartcity' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tiêu đề' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image', [
                'label' => esc_html__( 'Image', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'List', 'clinic' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
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
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // Form section
        $this->start_controls_section(
            'form_section',
            [
                'label' => esc_html__( 'Form', 'smartcity' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
            'note',
            [
                'label'       => esc_html__( 'Mô tả', 'clinic' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Vui lòng nhập đầy đủ thông tin, chúng tôi sẽ gửi tài liệu đến quý khách qua ứng dụng Zalo.', 'clinic' ),
                'label_block' => true
            ]
        );

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if ( !empty( $settings['contact_form_list'] ) ) :
	?>

		<div class="element-contact-form-7 style-<?php echo esc_attr( $settings['style_layout'] ); ?>">
            <div class="warp">
                <div class="thumbnail-box">
                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                </div>

                <h3 class="heading">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h3>

                <?php if ( $settings['list'] ) : ?>
                    <ul class="list">
                        <?php foreach ( $settings['list'] as $item ): ?>
                        <li class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <?php echo wp_get_attachment_image( $item['list_image']['id'], 'full' ); ?>

                            <span><?php echo esc_html( $item['list_title'] ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php echo do_shortcode('[contact-form-7 id="' . $settings['shortcode_form'] . '" ]'); ?>

                <div class="note">
                    <?php echo esc_html( $settings['note'] ); ?>
                </div>
            </div>
		</div>

	<?php
		endif;
	}
}