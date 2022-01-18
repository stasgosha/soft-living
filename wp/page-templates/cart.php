<?php
/**
 * Template Name: cart
*/
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="page-first-screen-section">
            <div class="container">
                <div class="section-header default-section-header">
                    <div class="section-caption">
                        <h1 class="sc-title"><?php echo get_the_title();?></h1>
                    </div>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>

            <section class="single-page-section">
                <div class="container">
                    <div class="section-content tpg">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>