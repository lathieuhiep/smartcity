<?php

use Elementor\Controls_Manager;
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
				<div class="warp">
					<?php foreach ($settings['list'] as $item): ?>
						<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <div class="thumbnail">
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

                            <?php if ( $settings['shortcode_form'] ) : ?>
                                <div class="actions">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#<?php echo esc_attr( $id_modal ); ?>">
			                            <?php esc_html_e( 'NHẬN BÁO GIÁ', 'smartcity' ); ?>
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
        <div class="modal fade modal-project-list" id="<?php echo esc_attr( $id_modal ); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
