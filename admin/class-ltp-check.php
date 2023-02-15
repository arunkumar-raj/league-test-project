<?php

/**
 * The file that defines the core elementor widget class
 *
 * A class definition that elementor compatibility used across both the
 * public-facing side of the site and the admin area.
 * @link       https://github.com/arunkumar-raj
 * @since      1.0.0
 *
 * @package    Ltp
 * @subpackage Ltp/admin
 */

/**
 * The core elementor widget class.
 *
 * This is used to define elementor widgets
 * 
 * @package    Ltp
 * @subpackage Ltp/admin
 * @author     Arunkumar <arunkumar.ram87@gmail.com>
 */

class Ltp_Check
{

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     * @var string Minimum Elementor version required to run the addon.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.7.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the addon.
     */
    const MINIMUM_PHP_VERSION = '7.3';

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     * @var \Ltp\Ltp_Check The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     * @return \Ltp\Ltp_Check An instance of the class.
     */

    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Perform some compatibility checks to make sure basic requirements are meet.
     * If all compatibility checks pass, initialize the functionality.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {

        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return false;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'ltp'),
            '<strong>' . esc_html__('League Test Project', 'ltp') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ltp') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'ltp'),
            '<strong>' . esc_html__('League Test Project', 'ltp') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ltp') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'ltp'),
            '<strong>' . esc_html__('League Test Project', 'ltp') . '</strong>',
            '<strong>' . esc_html__('PHP', 'ltp') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Initialize
     *
     * Load the addons functionality only after Elementor is initialized.
     *
     * Fired by `elementor/init` action hook.
     *
     * @since 1.0.0
     * @access public
     */
    public function init()
    {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    /**
     * Register Widgets
     *
     * Load widgets files and register new Elementor widgets.
     *
     * Fired by `elementor/widgets/register` action hook.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets($widgets_manager)
    {

        require_once(plugin_dir_path(dirname(__FILE__)) . '/includes/widgets/class-ltp-teams.php');
        $widgets_manager->register(new Ltp_Teams());
    }
}
