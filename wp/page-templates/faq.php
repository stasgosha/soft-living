<?php
/**
 * Template Name: Faq
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

        <section class="faq-section">
            <div class="container">
                <div class="faq-grid">
                    <?php if( have_rows('faq') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('faq') ): the_row(); ?>
                            <div class="accordion">
                                <div class="ac-header">
                                    <h3 class="ac-caption"><?php echo get_sub_field('question');?></h3>
                                    <button class="ac-opener"></button>
                                </div>
                                <div class="ac-content">
                                    <p><?php echo get_sub_field('answer');?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>