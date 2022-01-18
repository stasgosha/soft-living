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

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
global $wp_query;
$queried_object = get_queried_object();
$active = get_queried_object()->term_id;
$parrent = get_queried_object()->parent;
$taxonomy = $queried_object->taxonomy;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>


    <main class="page-content">
    <?php if( have_rows('slider',$taxonomy.'_'.$active) ){ ?>
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
                                    <h3 class="card-caption main-font"><?php echo get_sub_field('title');?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </section>
        <?php } ?>
        <section class="sub-category-section">
            <div class="container">
                <div class="section-inner">
                    <div class="section-content">
                        <div  id="wrapload">
                            <div class="products-grid columns-2" id="load">
                            <?php
                            if ( woocommerce_product_loop() ) {


                                if ( wc_get_loop_prop( 'total' ) ) {
                                    $i=0;
                                    while ( have_posts() ) {
                                        $i++;
                                        the_post();
                                        if($i==5){
                                        ?>
                                        <div class="category-card wide with-text">
                                            <picture class="card-bg">
                                                <!-- <source srcset="" media="(max-width: 575px)" /> -->
                                                <img src="<?php echo get_field('catalog_banner','option')['url']?>" alt="<?php echo get_field('catalog_banner','option')['alt']?>">
                                            </picture>
                                            <div class="card-content">
                                                <h3 class="card-caption white"><?php echo get_field('banner_title','option');?></h3>
                                                <a href="<?php echo get_field('link_button','option');?>" class="btn btn-stroke"><?php echo get_field('text_button','option');?></a>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        wc_get_template_part( 'content', 'product' );
                                    }
                                }
                            } else {
                                do_action( 'woocommerce_no_products_found' );
                            }

                            ?>
                                <?php if ($wp_query->max_num_pages > 1) : ?>
                                    <div id="loadmore"
                                            data-current_page="<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>"
                                            data-posts_vars="<?php echo base64_encode(serialize($wp_query->query_vars)); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <script >
                            var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                        </script>
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="loader">
                            <path d="M16 .5c-.83 0-1.5.67-1.5 1.5v4a1.5 1.5 0 0 0 3 0V2c0-.83-.67-1.5-1.5-1.5Z"/>
                            <path d="M7.16 5.04 10 7.87a1.5 1.5 0 1 1-2.12 2.12L5.04 7.16a1.5 1.5 0 1 1 2.12-2.12Z"/>
                            <path d="M7.5 16c0-.83-.67-1.5-1.5-1.5H2a1.5 1.5 0 0 0 0 3h4c.83 0 1.5-.67 1.5-1.5Z"/>
                            <path d="m7.87 22.01-2.83 2.83a1.5 1.5 0 1 0 2.12 2.12L10 24.13a1.5 1.5 0 1 0-2.12-2.12Z"/>
                            <path d="M16 24.5c-.83 0-1.5.67-1.5 1.5v4a1.5 1.5 0 0 0 3 0v-4c0-.83-.67-1.5-1.5-1.5Z"/>
                            <path d="M24.13 22.01a1.5 1.5 0 1 0-2.12 2.12l2.83 2.83a1.5 1.5 0 0 0 2.12 0 1.5 1.5 0 0 0 0-2.12L24.13 22Z"/>
                            <path d="M30 14.5h-4a1.5 1.5 0 0 0 0 3h4a1.5 1.5 0 0 0 0-3Z"/>
                            <path d="M23.07 10.43c.39 0 .77-.15 1.06-.44l2.83-2.83a1.5 1.5 0 1 0-2.12-2.12L22 7.87a1.5 1.5 0 0 0 1.06 2.56Z"/>
                        </svg>
                    </div>
                    <div class="section-sidebar">
                        <div class="filters-component">
                            <input type="hidden" id="reset" value="<?php echo get_term_link($active,$taxonomy);?>">
                            <?php
                            if(get_field('filters',$taxonomy.'_'.$active)){
                                $filters=$taxonomy.'_'.$active;
                            }else{
                                $filters=$taxonomy.'_'.$parrent;
                            }

                            if( have_rows('filters',$filters) ): ?>
                                <?php
                                $i=0;
                                while( have_rows('filters',$filters) ): the_row(); ?>
                                <fieldset class="cmp-group">
                                    <h3 class="group-caption"><?php echo get_sub_field('title_filter');?></h3>

                                    <div class="group-list">
                                    <?php
                                    $args = [
                                        'taxonomy' => [get_sub_field('filter')],
                                    ];
                                    $terms = get_terms( $args );

                                    foreach( $terms as $term ){
                                        $product_cat_=array();
                                        $product_cat=$_GET[get_sub_field('filter').'_'];
                                        $product_cat_ = explode(',', $product_cat);
                                        ?>
                                        <div class="item">
                                            <label class="checkbox">
                                                <input type="checkbox" class="visually-hidden"  <?php if(in_array( $term->term_id,$product_cat_)
                                                    or $term->term_id==$active ){ echo 'checked'; } ?>
                                                       name="<?php echo get_sub_field('filter');?>_"  value="<?php echo $term->term_id; ?>">
                                                <span class="fake-label"><?php echo $term->name; ?></span>
                                            </label>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    </div>
                                </fieldset>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>



<?php


get_footer( 'shop' );
