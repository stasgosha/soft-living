<?php
/**
 * Template Name: About
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
                <div class="section-inner">
                    <div class="section-content tpg">
                       <?php the_content(); ?>
                    </div>
                    <div class="section-image">
                        <img src="<?php echo get_field('image_text')['url'];?>" alt="<?php echo get_field('image_text')['alt'];?>">
                    </div>
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