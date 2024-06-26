<?php

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
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
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__('Kiểu 1', 'clinic'),
                    'style-2' => esc_html__('Kiểu 2', 'clinic'),
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
                'condition' => [
	                'style_layout' => 'style-1',
                ]
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

		$this->add_control(
			'show_list',
			[
				'label' => esc_html__( 'Hiển thị nội dung mô tả', 'smartcity' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Có', 'smartcity' ),
				'label_off' => esc_html__( 'Không', 'smartcity' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        // List text
        $this->start_controls_section(
            'list_section',
            [
                'label' => esc_html__( 'Nôi dung mô tả', 'smartcity' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
	                'show_list' => 'yes',
                ],
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
                'title_field' => '{{{ list_title }}}'
            ],
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
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => esc_html__( 'Vui lòng nhập đầy đủ thông tin, chúng tôi sẽ gửi tài liệu đến quý khách qua ứng dụng Zalo.', 'clinic' ),
                'label_block' => true
            ]
        );

		$this->end_controls_section();

        // heading style
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     =>  esc_html__( 'Màu sắc', 'smartcity' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-contact-form-7 .warp .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => esc_html__( 'Typography', 'smartcity' ),
				'selector' => '{{WRAPPER}} .element-contact-form-7 .warp .heading',
			]
		);

		$this->end_controls_section();

		// style form
		$this->start_controls_section(
			'style_form_section',
			[
				'label' => esc_html__( 'Form', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .element-contact-form-7',
			]
		);

		$this->add_control(
			'form_background_overlay',
			[
				'label' => esc_html__( 'Background Overlay', 'smartcity' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-contact-form-7:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .element-contact-form-7',
			]
		);

		$this->add_control(
			'form_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'smartcity' ),
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
					'{{WRAPPER}} .element-contact-form-7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
	?>
		<div class="element-contact-form-7 <?php echo esc_attr( $settings['style_layout'] ); ?>">
            <div class="warp">
                <?php if ( $settings['style_layout'] == 'style-1' ) : ?>
                    <div class="thumbnail-box">
		                <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                    </div>
                <?php endif; ?>

                <h3 class="heading">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h3>

                <?php if ( $settings['show_list'] && $settings['list'] ) : ?>
                    <ul class="list reset-list">
                        <?php foreach ( $settings['list'] as $item ): ?>
                        <li class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <?php echo wp_get_attachment_image( $item['list_image']['id'] ); ?>

                            <span><?php echo esc_html( $item['list_title'] ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php echo do_shortcode('[contact-form-7 id="' . $settings['shortcode_form'] . '" ]'); ?>

                <div class="note">
                    <?php echo wpautop( $settings['note'] ); ?>
                </div>
            </div>
		</div>
	<?php

	}
}