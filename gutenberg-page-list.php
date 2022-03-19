<?php

/*
  Plugin Name: Gutenberg Page List
  Description: List of pages
  Version: 1.0
  Author: Tahir Asadli
  Author URI: https://tahir-asadov.github.io
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class GutenbergPageList
{

  public function __construct()
  {
    add_action('enqueue_block_editor_assets', [$this, 'register_assets']);
  }

  public function register_assets()
  {
    wp_enqueue_script('gutenberg-page-list', plugin_dir_url(__FILE__).'gutenberg-page-list.js', ['wp-blocks', 'wp-element']);
  }
}


$GutenbergPageList = new GutenbergPageList();
