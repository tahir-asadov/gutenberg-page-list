<?php

/*
  Plugin Name: Gutenberg Page List
  Description: List of pages
  Version: 1.0
  Author: Tahir Asadli
  Author URI: https://tahir-asadov.github.io
  Text Domain: gutenberg-page-list
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class GutenbergPageList
{

  public function __construct()
  {
    add_action('init', [$this, 'register_assets']);
    add_action('init', [$this, 'register_settings_page']);
  }

  public function register_assets()
  {

    wp_register_style('gutenberg-page-list-css', plugin_dir_url(__FILE__).'build/index.css' );

    wp_register_script('gutenberg-page-list', plugin_dir_url(__FILE__).'build/index.js', ['wp-blocks', 'wp-element', 'wp-editor']);

    register_block_type('gutenberg-page-list/gutenberg-page-list', [
      'editor_script' => 'gutenberg-page-list',
      'editor_style' => 'gutenberg-page-list-css',
      'render_callback' => [$this, 'render']
    ]);

  }

  public function register_settings_page()
  {
    add_menu_page( __('Gutenberg Page List', 'gutenberg-page-list'), __('Page List', 'gutenberg-page-list'), 'manage_options', 'gutenberg-page-list', [$this, 'settings_page'], 'dashicons-editor-ul', 100 );

    register_setting( 'gutenberg_page_list_settings', 'gutenberg_page_list_included_pages' );
    register_setting( 'gutenberg_page_list_settings', 'gutenberg_page_list_excluded_pages' );
  }

  public function settings_page()
  {
    include plugin_dir_path(__FILE__) . 'views/settings.php';
  }

  public function render($attributes)
  {
    wp_enqueue_style('gutenberg-page-list-front-css', plugin_dir_url(__FILE__).'build/frontend.css' );
    
    ob_start(); ?>
      <div class="gutenberg-page-list-front">
        <?php wp_list_pages([
          'include' => get_option('gutenberg_page_list_included_pages'),
          'exclude' => get_option('gutenberg_page_list_excluded_pages'),
          'post_status' => 'publish'
        ]) ;?>
      </div>

    <?php return ob_get_clean();
  }
}


$GutenbergPageList = new GutenbergPageList();