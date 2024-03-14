<?php $smartcity_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $smartcity_unique_id; ?>">
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'smartcity' ); ?></span>
    </label>

    <input type="search" id="<?php echo $smartcity_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'smartcity' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

    <button type="submit" class="btn search-submit">
        <span class="search-reader-text">
            <?php echo _x( 'Search', 'submit button', 'smartcity' ); ?>
        </span>
    </button>
</form>