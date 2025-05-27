
<div class="bultr-popup-container">
    <?php

    $columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
    $post_thumbnail_id = get_post_thumbnail_id($product->get_ID());
    $full_size_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
    $image_title = get_post_field('post_excerpt', $post_thumbnail_id);
    $placeholder = has_post_thumbnail($product->get_ID()) ? 'with-images' : 'without-images';
    $wrapper_classes = apply_filters(
        'woocommerce_single_product_image_gallery_classes',
        [
            'woocommerce-product-gallery',
            'woocommerce-product-gallery--' . $placeholder,
            'woocommerce-product-gallery--columns-' . absint($columns),
            'images',
        ]
    );

    ?>
    <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
        <figure class="woocommerce-product-gallery__wrapper">
            <?php
            $data_src = '';
            $data_large_image = '';
            $data_large_image_width = '';
            $data_large_image_height = '';

            if (is_array($full_size_image)) {
                $data_src = isset($full_size_image[0]) ? $full_size_image[0] : '';
                $data_large_image = isset($full_size_image[0]) ? $full_size_image[0] : '';
                $data_large_image_width = isset($full_size_image[1]) ? $full_size_image[1] : '';
                $data_large_image_height = isset($full_size_image[2]) ? $full_size_image[2] : '';
            }

            $attributes = [
                'title' => $image_title,
                'data-src' => $data_src,
                'data-large_image' => $data_large_image,
                'data-large_image_width' => $data_large_image_width,
                'data-large_image_height' => $data_large_image_height,
            ];

            if (has_post_thumbnail($product->get_ID())) {
                $html  = '<div data-thumb="' . get_the_post_thumbnail_url($product->get_ID(), 'shop_thumbnail') . '" class="woocommerce-product-gallery__image"><a href="' . esc_url($data_src) . '">';
                $html .= get_the_post_thumbnail($product->get_ID(), 'shop_single', $attributes);
                $html .= '</a></div>';
            } else {
                $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'woocommerce'));
                $html .= '</div>';
            }

            echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($product->get_ID()));

            do_action('woocommerce_product_thumbnails');
            ?>
        </figure>
    </div>
    <div class="bultr-popup-content">
        <h3 class="bultr-popup-title"><?php echo $product->get_name(); ?></h3>
        <div class="bultr-popup-sku"><?php echo $product->get_sku(); ?></div>
        <div class="bultr-popup-price"><?php echo $product->get_price_html(); ?></div>
        <div class="bultr-popup-rating"><?php echo $this->render_star_rating($product->get_average_rating($product->get_ID()), $index); ?></div>
        <div class="bultr-popup-desc"><?php echo $product->get_description(); ?></div>
        <div class="woocommerce bultr-popup-quantity">
            <?php
            do_action('woocommerce_' . $product->get_type() . '_add_to_cart');
            ?>
        </div>
        <div class="bultr-popup-meta">

            <div class="bultr-product_meta">

                <?php do_action('woocommerce_product_meta_start'); ?>

                <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>

                    <span class="bultr_sku_wrapper"><?php esc_html_e('SKU:', 'wpv-bu'); ?> <span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'wpv-bu'); ?></span></span>

                <?php endif; ?>

                <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="bultr_posted_in">' . _n('Category:', 'Categories:', count($product->get_category_ids()), 'wpv-bu') . ' ', '</span>'); ?>

                <?php echo wc_get_product_tag_list($product->get_id(), ', ', '<span class="bultr_tagged_as">' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'wpv-bu') . ' ', '</span>'); ?>

                <?php do_action('woocommerce_product_meta_end'); ?>

            </div>
        </div>
    </div>
</div>
