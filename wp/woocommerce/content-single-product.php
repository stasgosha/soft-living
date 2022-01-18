<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */


if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$id=get_the_ID();
?>


<main class="page-content">
    <section class="page-first-screen-section sm-hidden">
        <div class="container">
            <?php
            do_action( 'woocommerce_before_single_product' );
            do_action( 'woocommerce_before_main_content' );
            ?>
            <div class="section-header default-section-header">
                <div class="section-caption">
                    <h1 class="sc-title"><?php the_title();?></h1>
                </div>
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>
        </div>
    </section>

    <section class="single-product-section">
        <div class="container">
            <div class="section-inner">
                <div class="section-slider">
                    <div class="product-sliders-wrapper small-buttons">
                        <div class="product-actions">
                          <!--  <button class="card-btn add-to-cart" aria-label="Add to cart">
                                <svg class="btn-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#bag"></use>
                                </svg>
                            </button>
                            -->
                            <button class="card-btn add-to-favourites js-add-compare <?php if(in_array($id,$_SESSION['compare'])){ echo 'active';}?>"
                              data-id="<?php echo $id; ?>" aria-label="Add to favourites">
                                <svg class="btn-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#heart"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="big-slider">
                            <?php $slider=get_field('gallery');
                            if($slider){
                                foreach ($slider as  $value){?>
                                    <div class="slide">
                                        <div class="slide-image">
                                            <img src="<?php print_R($value['sizes']['productgal']);?>" alt="<?php print_R($value['alt']);?>">
                                        </div>
                                    </div>
                                <?php } } ?>
                        </div>
                        <div class="previews-slider">
                            <?php $slider=get_field('gallery');
                            if($slider){
                                foreach ($slider as  $value){?>
                                    <div class="slide">
                                        <div class="slide-image">
                                            <img src="<?php print_R($value['sizes']['productgalmin']);?>" alt="<?php print_R($value['alt']);?>">
                                        </div>
                                    </div>
                                <?php } } ?>
                        </div>
                    </div>

                    <div class="sm-visible-flex">
                        <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                    </div>
                </div>
                <div class="section-content">
                    <h1 class="product-name sm-visible"><?php the_title(); ?></h1>

                    <p class="product-price"><?php _e( 'מחיר', 'softliving' );?> <?php echo $product->get_price_html(); ?></p>
                    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
                    <p class="product-sku">
                        <span class="sku_wrapper"><?php _e( 'קוד מוצר:', 'softliving' );?> <span class="sku">
                        <?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
                    </p>
                    <?php endif; ?>

                    <?php
                        $attributes = $product->get_attributes();

                        foreach($attributes as $attr=>$attr_deets){

                            $attribute_label = wc_attribute_label($attr);

                            if ( isset( $attributes[ $attr ] ) || isset( $attributes[ 'pa_' . $attr ] ) ) {

                                $attribute = isset( $attributes[ $attr ] ) ? $attributes[ $attr ] : $attributes[ 'pa_' . $attr ];
                                if($attr!='pa_number-of-units') {
                                    if ($attribute['is_taxonomy']) {

                                        $formatted_attributes[$attribute_label] = implode(', ', wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names')));

                                    } else {

                                        $formatted_attributes[$attribute_label] = $attribute['value'];
                                    }
                                }

                            }
                        }
                    ?>
                    <ul class="product-info-list">
                        <?php
                            foreach($formatted_attributes as $key=> $value){
                                ?>
                                   <li><?php echo $key; ?>: <strong><?php echo $value; ?></strong></li>
                                <?php
                            }
                        ?>
                    </ul>
                    <?php woocommerce_template_single_add_to_cart();  ?>
                    <button class="btn wish-btn js-add-compare <?php if(in_array($id,$_SESSION['compare'])){ echo 'active';}?>"
                            data-id="<?php echo $id; ?>"><?php _e( 'wishlist', 'softliving' );?></button>

<!--                    <div class="select-count-block">-->
<!--                        <button class="block-btn minus">-</button>-->
<!--                        <input class="block-field" type="tel" value="1">-->
<!--                        <button class="block-btn plus">+</button>-->
<!--                    </div>-->
                </div>
            </div>

            <div class="section-accordions">
                <div class="accordion">
                    <div class="ac-header">
                        <h3 class="ac-caption"><?php echo get_field('title_params','option');?></h3>
                        <button class="ac-opener"></button>
                    </div>
                    <div class="ac-content">
                        <ul class="params-list">
                            <?php
                            $params=get_the_terms( get_the_ID(), 'params' );
                            ?>
                            <?php foreach($params as $value){ ?>
                                <li>
                                    <div class="item-icon">
                                        <img src="<?php echo get_field('icon','params_'.$value->term_id)['url']; ?>" alt="">
                                    </div>
                                    <div class="item-text"><?php echo $value->name;?></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="accordion">
                    <div class="ac-header">
                        <h3 class="ac-caption"> <?php echo get_field('title_sescription','option');?></h3>
                        <button class="ac-opener"></button>
                    </div>
                    <div class="ac-content">
                        <?php the_content(); ?>
                        <ul class="params-list">
                            <?php if( have_rows('links','option') ): ?>
                                <?php
                                $i=0;
                                while( have_rows('links','option') ): the_row(); ?>
                                    <li>
                                        <div class="item-icon">
                                            <img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>">
                                        </div>
                                        <div class="item-text">
                                            <a href="<?php echo get_sub_field('link');?>"><?php echo get_sub_field('text');?></a>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="accordion">
                    <div class="ac-header">
                        <h3 class="ac-caption"><?php echo get_field('return_title','option');?></h3>
                        <button class="ac-opener"></button>
                    </div>
                    <div class="ac-content">
                        <p><?php echo get_field('return_text','option');?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-products-section big-bottom-padding">
        <div class="container">
            <div class="section-caption">
                <h2 class="sc-title"><?php echo get_field('title_products','option');?></h2>
            </div>

            <div class="products-slider">
                <?php
                $products=get_field('products');
                if(!$products) {
                    $products = get_field('products', 'option');
                }
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 10,
                    'post__in' => $products,

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
</main>


<?php do_action( 'woocommerce_after_single_product' ); ?>
