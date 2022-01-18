<?php
/**
 * Template Name: Wishlist
*/
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="page-first-screen-section">
            <div class="container">
                <picture class="section-image">
                    <source srcset="<?php echo get_field('banner_mobile')['url']?>" media="(max-width: 575px)" />
                    <img src="<?php echo get_field('banner')['url']?>" alt="<?php echo get_field('banner')['alt']?>">
                </picture>

                <div class="section-header default-section-header">
                    <div class="section-caption">
                        <h1 class="sc-title"><?php echo get_field('title');?></h1>
                    </div>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container">

                <div class="products-grid">
                    <?php
                    if(!empty($_SESSION['compare'])) {
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'post__in' => $_SESSION['compare'],

                        );

                        $loop = new WP_Query($args);

                        while ($loop->have_posts()) : $loop->the_post();
                            global $product;
                            the_post();
                            wc_get_template_part('content', 'product');
                        endwhile;

                        wp_reset_query();
                    }else{
                        ?>
                        <h2><?php _e( 'You havent added anything to your favorites!', 'softliving' );?></h2>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="instagram-section">
            <div class="container">
                <div class="section-caption">
                    <h2 class="sc-title"><img src="<?php echo get_field('instagram_logo','option')['url'];?>" alt="<?php echo get_field('instagram_logo','option')['alt'];?>"></h2>
                </div>
                    <?php echo do_shortcode(get_field('instagram_shortcode','option'));?>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>