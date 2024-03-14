<?php
get_header();

$smartcity_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$smartcity_class_elementor =   '';

if ( $smartcity_check_elementor ) :
    $smartcity_class_elementor =   ' site-container-elementor';
endif;
?>

    <main class="site-container<?php echo esc_attr( $smartcity_class_elementor ); ?>">
        <?php
        if ( $smartcity_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>
    </main>

<?php 

get_footer();