<?php

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class SmartCity_Elementor_Button_Modal_Form extends Widget_Base {

	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'smartcity-button-modal-form';
	}

	public function get_title() {
		return esc_html__( 'Button Modal Form', 'smartcity' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	protected function register_controls(): void {

		// content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nôi dung', 'smartcity' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'smartcity' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'NHẬN BÁO GIÁ', 'smartcity' ),
				'placeholder' => esc_html__( 'Type your title here', 'smartcity' ),
			]
		);

		$this->end_controls_section();

        // popup form section
		$this->start_controls_section(
			'form_section',
			[
				'label' => esc_html__( 'Form', 'smartcity' ),
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

		$this->end_controls_section();

		// Style button
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'smartcity' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'align',
			[
				'label'     =>  esc_html__( 'Alignment', 'smartcity' ),
				'type'      =>  Controls_Manager::CHOOSE,
				'options'   =>  [
					'left'  =>  [
						'title' =>  esc_html__( 'Left', 'smartcity' ),
						'icon'  =>  'eicon-text-align-left',
					],

					'center' => [
						'title' =>  esc_html__( 'Center', 'smartcity' ),
						'icon'  =>  'eicon-text-align-center',
					],

					'right' => [
						'title' =>  esc_html__( 'Right', 'smartcity' ),
						'icon'  =>  'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .element-btn-modal-form .btn-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'smartcity' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-btn-modal-form .btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_number_typography',
				'selector' => '{{WRAPPER}} .element-btn-modal-form .btn',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .element-btn-modal-form .btn',
			]
		);

		$this->end_controls_section();

		// style form
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

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$id_modal = 'btn-modal-form';
		if ( $settings['shortcode_form'] ) :
			$id_int = substr( $this->get_id_int(), 0, 3 );
			$id_modal = 'btn-modal-form-' . $id_int;
		endif;
    ?>

		<div class="element-btn-modal-form">
			<div class="btn-box">
				<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#<?php echo esc_attr( $id_modal ); ?>">
					<?php echo esc_html( $settings['text'] ); ?>
				</button>
			</div>
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