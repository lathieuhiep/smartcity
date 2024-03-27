<?php
$chat_zalo = smartcity_get_opt_chat_zalo();
$link_messenger = smartcity_get_opt_link_chat_messenger()
?>

<div class="chat-with-us">
	<?php
	if ( !empty( $chat_zalo ) && !empty( $chat_zalo['phone'] )  && !empty( $chat_zalo['qr_code'] ) ) :
		$zalo_phone = $chat_zalo['phone'];
		$zalo_qr_code = $chat_zalo['qr_code'];
		?>
		<a class="link chat-with-us__zalo" href="tel:<?php echo esc_attr( smartcity_preg_replace_ony_number($zalo_phone) ); ?>" data-phone="<?php echo esc_attr( smartcity_preg_replace_ony_number($zalo_phone) ); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
			<img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-icon-contact.png' ) ) ?>" width="50" height="" />
		</a>
	<?php endif; ?>

	<?php if ( $link_messenger ) : ?>
		<a class="link chat-with-us__messenger" href="<?php echo esc_url( $link_messenger ); ?>" target="_blank">
			<img alt="facebook" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/mess-facebook-contact.png' ) ) ?>" width="50" height="" />
		</a>
	<?php endif; ?>
</div>