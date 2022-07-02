<?php
/*
* Plugin Name: Maxart CSV Product
* Description: Export product information WooCommerce.
* Requires at least: 5.9
* Requires PHP: 7.4.1
* Version: 1.0.0
* Author: MaxArt
* Author URI: https://maxart.ae
* License: GPL-2.0-or-later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: maxartcsv
* 
* @package Maxart-CSV-Product
*/
defined("ABSPATH") or die('');

class MaxartCsvProduct
{

    public function __construct()
    {
        add_filter('parse_request', array($this, 'maxart_handler_URI'));
        add_action('admin_menu', array($this, 'maxart_api_add_admin_page'));
        add_action('admin_enqueue_scripts', array($this, 'maxart_api_enqueue_admin_page_script'));
    }
    function activate()
    {
        flush_rewrite_rules();
    }
    function deactivate()
    {
        flush_rewrite_rules();
    }
    function uninstall()
    {
    }
    function maxart_api_add_admin_page()
    {
        add_menu_page(
            'MaxArt CSV Product',
            'MaxArt CSV Product',
            'manage_options',
            'maxart_api_settings',
            array($this, 'maxart_api_general_settings')
        );
    }
    function maxart_api_general_settings()
    {
        require_once __DIR__ . '/pages/index.php';
    }
    function maxart_api_enqueue_admin_page_script($hook)
    {

        if ('toplevel_page_maxart_api_settings' == $hook) {
            wp_enqueue_style('maxart-api-bootstrap-css', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css', array(), '5.1.0', 'all');
            wp_enqueue_script('index-maxart-js', plugin_dir_url(__FILE__) . 'assets/js/index.min.js', array(), '1.0.0', false);
        }
    }
    function maxart_handler_URI()
    {
        require_once __DIR__ . '/inc/MaxartCsvRoute.php';
        //add prefix uri
        $Route = new MaxartCsvRoute();
        $Route->post('/wp-admin/maxart-api/v1/product', 'MaxartCvsProduct@Index');
    }
    function get_image_from_post($ID)
    {
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'post_parent' => $ID,
        ));
        $url_Images = array();
        foreach ($attachments as $attachment) :
            $url_Images[] = wp_get_attachment_url($attachment->ID);
        endforeach;
        wp_reset_postdata();
        return join(',', $url_Images);
    }
}

if (class_exists('MaxartCsvProduct')) {
    $maxartClass = new MaxartCsvProduct();
    register_activation_hook(__FILE__, array($maxartClass, 'activate'));
    register_deactivation_hook(__FILE__, array($maxartClass, 'deactivate'));
}
