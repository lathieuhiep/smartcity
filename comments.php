<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-area__title">
            <?php
            $smartcity_comments_number = get_comments_number();

            if ( $smartcity_comments_number == 1 ) :
                /* translators: %s: post title */
                printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'smartcity'), get_the_title());
            else :
                printf(
                /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $smartcity_comments_number,
                        'comments title',
                        'smartcity'
                    ),
                    number_format_i18n($smartcity_comments_number),
                    get_the_title()
                );
            endif;
            ?>
        </h2>

        <?php smartcity_comment_nav(); ?>

        <ul class="comments-area__list">
            <?php
            wp_list_comments(array(
                'type' => 'comment',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => 'smartcity_comments'
            ));
            ?>
        </ul>
    <?php
        smartcity_comment_nav();
    endif;

    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments">
            <?php esc_html_e('Comments are closed.', 'smartcity'); ?>
        </p>
    <?php
    endif;

    $smartcity_commenter = wp_get_current_commenter();
    $smartcity_req = get_option('require_name_email');
    $smartcity_comments_args = ($smartcity_req ? " aria-required='true'" : '');

    $smartcity_comments_args = array(
        'title_reply' => '<span>' . esc_html__('Leave a comment', 'smartcity') . '</span>',
        'fields' => apply_filters('comment_form_default_fields',
            array(
                'comment_notes_before' => '<div class="comment-fields-row order-1"><div class="row">',
                'author' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="author" placeholder="' . esc_html__('Full Name', 'smartcity') . '" class="form-control" name="author" type="text" value="' . esc_attr($smartcity_commenter['comment_author']) . '" size="30" ' . $smartcity_comments_args . ' /></div></div>',
                'email' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="email" placeholder="' . esc_html__('Your Email', 'smartcity') . '" class="form-control" name="email" type="text" value="' . esc_attr($smartcity_commenter['comment_author_email']) . '" size="30" ' . $smartcity_comments_args . ' /></div></div>',
                'comment_notes_after' => '</div></div>',
            )
        ),
        'comment_field' => '<div class="form-comment-item form-comment-field order-3"><textarea rows="7" id="comment" placeholder="' . esc_html__('Comment', 'smartcity') . '" name="comment" class="form-control"></textarea></div>',
    );

    comment_form($smartcity_comments_args);
    ?>
</div>
