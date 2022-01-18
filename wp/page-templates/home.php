<?php
/**
 * Template Name: Home
*/
get_header();
$taxonomy='product_cat';
?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="first-screen-section small-buttons">
            <div class="container">
                <div class="first-screen-slider">
                    <?php if( have_rows('slider') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('slider') ): the_row(); ?>
                            <div class="slide">
                                <div class="first-screen-card">
                                    <picture class="card-bg">

                                        <source srcset="<?php echo get_sub_field('image_mobile')['url'];?>" media="(max-width: 575px)" />
                                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                    </picture>
                                    <div class="card-content">
                                        <h3 class="card-caption <?php if(get_sub_field('main_font')){ echo 'main-font'; }?>"><?php echo get_sub_field('title');?></h3>
                                        <a href="<?php echo get_sub_field('link_button');?>" class="btn"><?php echo get_sub_field('text_button');?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>


                </div>
            </div>
        </section>

        <section class="categories-section">
            <div class="container">
                <div class="categories-grid">
                    <?php if( have_rows('categoryes_1') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('categoryes_1') ): the_row(); ?>
                            <div class="category-card">
                                <picture class="card-bg">
                                    <img src="<?php echo get_field('image_category',$taxonomy.'_'.get_sub_field('category'))['url'];?>" alt="<?php echo get_sub_field('image_category',$taxonomy.'_'.get_sub_field('category'))['alt'];?>">
                                </picture>

                                <div class="card-content">

                                    <a href="<?php echo get_term_link(get_sub_field('category'),$taxonomy); ?>" class="btn"><?php echo get_term(get_sub_field('category'),$taxonomy)->name;?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>


                    <div class="category-slider-card">
                        <div class="products-slider small">
                            <?php
                            $args = array(
                                'post_type'      => 'product',
                                'posts_per_page' => 10,
                                'post__in' => get_sub_field('products_slider'),

                            );
                            $loop = new WP_Query( $args );

                            while ( $loop->have_posts() ) : $loop->the_post();
                                global $product;
                                the_post();
                                ?>
                                <div class="slide">
                                    <?php
                                    wc_get_template_part( 'content', 'product' );
                                    ?>
                                </div>
                            <?php
                            endwhile;

                            wp_reset_query();
                            ?>
                        </div>
                    </div>

                    <div class="category-card with-text">
                        <picture class="card-bg">
                            <!-- <source srcset="" media="(max-width: 575px)" /> -->
                            <img src="<?php echo get_field('about_image')['url']?>" alt="<?php echo get_field('about_image')['alt']?>">
                        </picture>
                        <div class="card-content">
                            <h3 class="card-caption"><?php echo get_field('about_title');?></h3>
                            <div class="card-text">
                                <p><?php echo get_field('about_text');?></p>
                            </div>
                            <a href="<?php echo get_field('about_link');?>" class="btn"><?php echo get_field('about_text_button');?></a>
                        </div>
                    </div>

                    <?php if( have_rows('categoryes_2') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('categoryes_2') ): the_row(); ?>
                            <div class="category-card">
                                <picture class="card-bg">
                                    <img src="<?php echo get_field('image_category',$taxonomy.'_'.get_sub_field('category'))['url'];?>" alt="<?php echo get_sub_field('image_category',$taxonomy.'_'.get_sub_field('category'))['alt'];?>">
                                </picture>

                                <div class="card-content">

                                    <a href="<?php echo get_term_link(get_sub_field('category'),$taxonomy); ?>" class="btn"><?php echo get_term(get_sub_field('category'),$taxonomy)->name;?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <div class="category-card wide with-text">
                        <picture class="card-bg">
                            <!-- <source srcset="" media="(max-width: 575px)" /> -->
                            <img src="<?php echo get_field('banner_')['url']?>" alt="<?php echo get_field('banner_')['alt']?>">
                        </picture>
                        <div class="card-content">
                            <h3 class="card-caption white"><?php echo get_field('banner_title');?></h3>
                            <a href="<?php echo get_field('banner_link_button');?>" class="btn btn-stroke"><?php echo get_field('banner_text_button');?></a>
                        </div>
                        <?php if(get_field('banner_watermark')){ ?>
                            <div class="card-badge"><?php echo get_field('banner_watermark');?></div>
                        <?php } ?>
                    </div>

                    <?php if( have_rows('categoryes_3') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('categoryes_3') ): the_row(); ?>
                            <div class="category-card">
                                <picture class="card-bg">
                                    <img src="<?php echo get_field('image_category',$taxonomy.'_'.get_sub_field('category'))['url'];?>" alt="<?php echo get_sub_field('image_category',$taxonomy.'_'.get_sub_field('category'))['alt'];?>">
                                </picture>

                                <div class="card-content">

                                    <a href="<?php echo get_term_link(get_sub_field('category'),$taxonomy); ?>" class="btn"><?php echo get_term(get_sub_field('category'),$taxonomy)->name;?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="top-products-section">
            <div class="container">
                <div class="section-caption">
                    <h2 class="sc-title"><?php echo get_field('products_title');?></h2>
                </div>

                <div class="products-grid">
                    <?php
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 10,
                        'post__in' => get_sub_field('products_1'),

                    );
                    $loop = new WP_Query( $args );

                    while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        the_post();
                        ?>
                            <?php
                            wc_get_template_part( 'content', 'product' );
                            ?>
                    <?php
                    endwhile;

                    wp_reset_query();
                    ?>
                </div>

                <div class="products-slider">
                    <?php
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 10,
                        'post__in' => get_sub_field('products_2'),

                    );
                    $loop = new WP_Query( $args );

                    while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        the_post();
                        ?>
                        <div class="slide">
                            <?php
                            wc_get_template_part( 'content', 'product' );
                            ?>
                        </div>
                    <?php
                    endwhile;

                    wp_reset_query();
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