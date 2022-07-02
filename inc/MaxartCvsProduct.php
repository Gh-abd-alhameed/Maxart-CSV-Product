<?php
defined("ABSPATH") or die('');
require_once __DIR__ . '/MaxartCvsdownload.php';
class MaxartCvsProduct extends MaxartCvsdownload
{
    public function Index()
    {
        $namefile = "product";
        if (isset($_POST['namefile'])) :
            $namefile = !empty($_POST['namefile']) ? trim(wp_strip_all_tags($_POST['namefile']))  : "product";
        endif;
        $post_type = $_POST['posttype'] ? trim(wp_strip_all_tags($_POST['posttype'])) : 'product';
        $post_title_id = $_POST['title_id'] ? trim(wp_strip_all_tags($_POST['title_id'])) : "ID";

        $__title_name = $_POST['title_name'] ? trim(wp_strip_all_tags($_POST['title_name'])) : "Title";

        $__title_description = $_POST['title_description'] ? trim(wp_strip_all_tags($_POST['title_description'])) : "Description";

        $__title_image = $_POST['title_image'] ? trim(wp_strip_all_tags($_POST['title_image'])) : 'Image';
        $__title_sale_price_dates_from = "Sale Price Dates From";
        $___sale_price_dates_from = " ";
        if (isset($_POST['title_sale_price_dates_from'])) :
            $__title_sale_price_dates_from = !empty($_POST['title_sale_price_dates_from']) ? trim(wp_strip_all_tags($_POST['title_sale_price_dates_from'])) : 'Sale Price Dates From';
            $___sale_price_dates_from = $_POST['_sale_price_dates_from'] ? trim(wp_strip_all_tags($_POST['_sale_price_dates_from'])) : " ";
        endif;

        $__title_sale_price_dates_to = "sale price dates to";
        $___sale_price_dates_to = " ";
        if (isset($_POST['title_sale_price_dates_to'])) :
            $__title_sale_price_dates_to =  !empty($_POST['title_sale_price_dates_to']) ? trim(wp_strip_all_tags($_POST['title_sale_price_dates_to'])) : 'sale price dates to';
            $___sale_price_dates_to = $_POST['_sale_price_dates_to'] ? trim(wp_strip_all_tags($_POST['_sale_price_dates_to'])) : " ";
        endif;

        $__title_stock_status = "Stock Status";
        $___stock_status = " ";
        if (isset($_POST['title_stock_status'])) :
            $__title_stock_status = !empty($_POST['title_stock_status']) ? trim(wp_strip_all_tags($_POST['title_stock_status'])) : "Stock Status";
            $___stock_status = $_POST['_stock_status'] ? trim(wp_strip_all_tags($_POST['_stock_status'])) : " ";
        endif;
        $__title_sale_price = "Sale Price";
        $___sale_price = " ";
        if (isset($_POST['title_sale_price'])) :
            $__title_sale_price = !empty($_POST['title_sale_price']) ? trim(wp_strip_all_tags($_POST['title_sale_price'])) : "Sale Price";
            $___sale_price = $_POST['_sale_price'] ? trim(wp_strip_all_tags($_POST['_sale_price'])) : " ";
        endif;
        $__title_regular_price = "Regular Price";
        $___regular_price = " ";
        if (isset($_POST['title_regular_price'])) :
            $__title_regular_price = !empty($_POST['title_regular_price']) ? trim(wp_strip_all_tags($_POST['title_regular_price'])) : "Regular Price";
            $___regular_price = $_POST['_regular_price'] ? trim(wp_strip_all_tags($_POST['_regular_price'])) : " ";
        endif;
        $__title_sku = "SKU";
        $___sku = " ";
        if (isset($_POST['title_sku'])) :
            $__title_sku = !empty($_POST['title_sku']) ? trim(wp_strip_all_tags($_POST['title_sku'])) : "SKU";
            $___sku = $_POST['_sku'] ? trim(wp_strip_all_tags($_POST['_sku'])) : " ";
        endif;
        if (class_exists('woocommerce')) :
            global $post;
            $product_Query = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type'      => $post_type,
            ));
            $allDATA = array(array(
                $post_title_id,
                $__title_name,
                $__title_description,
                $__title_image,
                $__title_regular_price,
                $__title_sale_price,
                $__title_sale_price_dates_from,
                $__title_sale_price_dates_to,
                $__title_stock_status,
                $__title_sku
            ));
            if ($product_Query->have_posts()) :
                while ($product_Query->have_posts()) :
                    $product_Query->the_post();
                    array_push($allDATA, array(
                        $post->ID,
                        trim(wp_strip_all_tags($post->post_title)),
                        trim(wp_strip_all_tags($post->post_content)),
                        wp_get_attachment_url(get_post_thumbnail_id($post->ID)),
                        trim(wp_strip_all_tags(get_post_meta($post->ID, $___regular_price, true))),
                        trim(wp_strip_all_tags(get_post_meta($post->ID, $___sale_price, true))),
                        !empty(get_post_meta($post->ID, $___sale_price_dates_from, true)) ? date("Y-m-d H:i:s", get_post_meta($post->ID, $___sale_price_dates_from, true)) : "",
                        !empty(get_post_meta($post->ID, $___sale_price_dates_to, true)) ? date("Y-m-d H:i:s", get_post_meta($post->ID, $___sale_price_dates_to, true)) : "",
                        trim(wp_strip_all_tags(get_post_meta($post->ID, $___stock_status, true))),
                        trim(wp_strip_all_tags(get_post_meta($post->ID, $___sku, true))),
                    ));
                endwhile;
            endif;
            $this->array_to_csv_download($allDATA, $namefile . '.csv');
            wp_reset_postdata();
        endif;
    }
}
