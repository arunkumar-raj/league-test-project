<?php

/**
 *
 * @link              https://github.com/arunkumar-raj
 * @since             1.0.0
 * @package           Ltp
 *
 * @wordpress-plugin
 * Plugin Name:       League Test project
 * Plugin URI:        https://github.com/arunkumar-raj
 * Description:       Create a custom WordPress plugin that will make it possible to store football/sports teams categorized by the league they are from and list them with a custom-made Elementor widget.
 * Version:           1.0.0
 * Author:            Arunkumar
 * Author URI:        https://github.com/arunkumar-raj
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ltp
 * Domain Path:       /languages
 * 
 * Elementor tested up to: 3.11.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('LTP_VERSION', '1.0.0');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-ltp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ltp()
{

	$plugin = new Ltp();
	$plugin->run();
}
run_ltp();
