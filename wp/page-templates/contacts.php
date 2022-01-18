<?php
/**
 * Template Name: Contacts
*/
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="page-first-screen-section">
            <div class="container">
                <div class="section-map">
                  <?php echo get_field('map');?>
                </div>

                <div class="section-header default-section-header">
                    <div class="section-caption">
                        <h1 class="sc-title"><?php echo get_field('title');?></h1>
                    </div>

                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </section>

        <section class="contacts-section">
            <div class="container">
                <div class="section-inner">
                    <div class="section-content">
                        <ul class="contacts-list">
                            <li>
                                <div class="item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/whatsapp.svg" alt="">
                                </div>
                                <div class="item-text">
                                    <a href="https://wa.me/<?php echo get_field('whatsapp','option');?>"><?php echo get_field('whatsapp','option');?></a>
                                </div>
                            </li>
                            <li>
                                <div class="item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/waze.svg" alt="">
                                </div>
                                <div class="item-text">
                                    <?php echo get_field('address','option');?>
                                </div>
                            </li>
                            <li>
                                <div class="item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/phone.svg" alt="">
                                </div>
                                <div class="item-text">
                                    <a href="tel:<?php echo get_field('phone','option');?>"><?php echo get_field('phone','option');?></a>
                                </div>
                            </li>
                            <li>
                                <div class="item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/email.svg" alt="">
                                </div>
                                <div class="item-text">
                                    <a href="mailto:<?php echo get_field('email','option');?>"><?php echo get_field('email','option');?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="section-form">
                        <h3 class="small-caption"><?php echo get_field('title_form');?></h3>
                        <div class="contacts-form form">
                           <?php echo do_shortcode('[contact-form-7 id="125" title="Contact"]');?>
                        </div>
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