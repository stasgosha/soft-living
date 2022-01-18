<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$id = $product->get_id();
?>
<div class="product-card">
    <div class="card-image">
        <?php
        $thumb_id = get_post_thumbnail_id($id);
        $thumb_url = wp_get_attachment_image_src($thumb_id,'product', true);
        $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
        ?>
        <img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $image_alt; ?>" >
    </div>
    <div class="card-content">
        <p class="card-name"><?php echo get_the_title($id); ?></p>
        <p class="card-price"><?php echo $product->get_price_html(); ?></p>
        <a href="<?php echo get_permalink($id);?>" class="card-link" aria-label="Go to product page"></a>
    </div>
    <div class="card-actions">

        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        <button class="card-btn add-to-favourites js-add-compare <?php if(in_array($id,$_SESSION['compare'])){ echo 'active';}?>"   data-id="<?php echo $id; ?>"  aria-label="Add to favourites">
            <svg class="btn-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#heart"></use>
            </svg>
        </button>
    </div>
</div>
