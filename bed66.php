<?php
/**
 * Bootstrap file to launch the plugin.
 *
 * @wordpress-plugin
 * Plugin Name: Bed66
 * Plugin URI:  https://bed66.com
 * Description: Plugin to easily embed hotel website booking engines
 * Version:     0.1.1.1
 * Author:      Hardeep Khehra
 * Author URI:  https://bed66.com/
 * License:     GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bed66
 * Domain Path: /languages
 */

namespace BedSixtySix\Blocks;

require_once 'inc/Enqueue.php';

// Exit if accessed directly.
defined('ABSPATH') || exit;

//Register Block Category
function bed66_blocks_categories( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'bed66',
                'title' => __( 'Booking Engines', 'bed66'),
                'icon'  => 'wordpress'
            ),
        )
    );
}
add_filter( 'block_categories', 'BedSixtySix\Blocks\bed66_blocks_categories', 10, 2 );

/**
 *  Enqueue JavaScript and CSS
 *  for block editor only.
 */
function enqueue_block_editor_assets() {

  $enqueue = new BedSixtySixEnqueue( 'bedSixtySix', 'dist', '0.1.0', 'plugin', __FILE__ );

  // Enqueue the bundled block JS file
  $enqueue->enqueue( 'app', 'main', [] );
  
}

add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_block_editor_assets');

function enqueue_frontend_assets() {
    $enqueue = new BedSixtySixEnqueue( 'bedSixtySix', 'dist', '0.1.0', 'plugin', __FILE__ );

    // Enqueue the bundled block JS file
    $enqueue->enqueue( 'app', 'index', [] );
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_frontend_assets');