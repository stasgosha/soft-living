<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$queried_object = get_queried_object();
$active = get_queried_object()->term_id;
$parrent = get_queried_object()->parent;
$taxonomy = $queried_object->taxonomy;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>
    <main class="page-content">
        <?php if( have_rows('slider',$taxonomy.'_'.$active) ): ?>
        <section class="first-screen-section small-buttons">
            <div class="container">
                <div class="first-screen-slider">

                        <?php
                        $i=0;
                        while( have_rows('slider',$taxonomy.'_'.$active) ): the_row(); ?>
                            <div class="slide">
                                <div class="first-screen-card">
                                    <picture class="card-bg">
                                        <source srcset="<?php echo get_sub_field('image_mobile')['url'];?>" media="(max-width: 575px)" />
                                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                    </picture>
                                    <div class="card-content">
                                        <p class="card-label"><?php echo get_sub_field('title');?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                </div>
            </div>
        </section>
        <?php endif; ?>
        <section class="categories-section">
            <div class="container">
                <div class="categories-grid">
                    <?php if(get_field('subcategoryes',$taxonomy.'_'.$active)){ ?>
                            <?php
                            $i=0;
                            while( have_rows('subcategoryes',$taxonomy.'_'.$active) ): the_row();
                                if(!get_sub_field('show_product_slider')){
                            ?>
                                <div class="category-card">
                                    <picture class="card-bg">
                                        <img src="<?php echo get_field('image_category',$taxonomy.'_'.get_sub_field('category'))['url'];?>" alt="<?php echo get_sub_field('image_category',$taxonomy.'_'.get_sub_field('category'))['alt'];?>">
                                    </picture>

                                    <div class="card-content">

                                        <a href="<?php echo get_term_link(get_sub_field('category'),$taxonomy); ?>" class="btn"><?php echo get_term(get_sub_field('category'),$taxonomy)->name;?></a>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                    <div class="category-slider-card">
                                        <div class="products-slider small">
                                                <?php
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,
                                                    'post__in' => get_sub_field('products'),

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
                                 <?php } ?>
                            <?php endwhile; ?>
                    <?php }else{ ?>
                        <?php

                        $termchildren = get_term_children( $active, $taxonomy );

                        $i=0;
                        foreach ($termchildren as $child) {
                            $i++;
                            $term = get_term_by( 'id', $child, $taxonomy );
                            if($i==3){
                                ?>
                                <div class="category-slider-card">
                                    <div class="products-slider small">
                                        <?php
                                        $args = array(
                                            'post_type'      => 'product',
                                            'posts_per_page' => 10,
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'product_cat',
                                                    'field'    => 'id',
                                                    'terms'    => $child
                                                )
                                            )

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
                            <?php
                            }
                            ?>
                            <div class="category-card">
                                <picture class="card-bg">
                                    <img src="<?php echo get_field('image_category',$taxonomy.'_'.$term->term_id)['url'];?>" alt="<?php echo get_sub_field('image_category',$taxonomy.'_'.$term->term_id)['alt'];?>">
                                </picture>

                                <div class="card-content">

                                    <a href="<?php echo get_term_link($term->term_id,$taxonomy); ?>" class="btn"><?php echo get_term($term->term_id,$taxonomy)->name;?></a>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <?php } ?>






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
<?php
get_footer( 'shop' );
