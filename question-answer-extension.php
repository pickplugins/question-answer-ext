<?php
/*
Plugin Name: QA Extension
Plugin URI: https://www.pickplugins.com/item/post-grid-create-awesome-grid-from-any-post-type-for-wordpress/
Description: Awesome post grid for query post from any post type and display on grid.
Version: 1.0.0
Author: PickPlugins
Author URI: https://www.pickplugins.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

if( !class_exists( 'QAEXT' )){
    class QAEXT{

        public function __construct(){

            define('qa_ext_plugin_url', plugins_url('/', __FILE__));
            define('qa_ext_plugin_dir', plugin_dir_path(__FILE__));
            define('qa_ext_plugin_basename', plugin_basename(__FILE__));
            define('qa_ext_plugin_name', 'QA Extension');
            define('qa_ext_version', '1.0.0');

            include('templates/qa-hook.php');


            add_action('wp_enqueue_scripts', array($this, '_scripts_front'));
            add_action('admin_enqueue_scripts', array($this, '_scripts_admin'));

            add_action('plugins_loaded', array($this, '_textdomain'));

            register_activation_hook(__FILE__, array($this, '_activation'));
            register_deactivation_hook(__FILE__, array($this, '_deactivation'));


        }


        public function _textdomain(){

            $locale = apply_filters('plugin_locale', get_locale(), 'qa-ext');
            load_textdomain('qa-ext', WP_LANG_DIR . '/qa-ext/qa-ext-' . $locale . '.mo');

            load_plugin_textdomain('qa-ext', false, plugin_basename(dirname(__FILE__)) . '/languages/');

        }

        public function _activation(){

            /*
             * Custom action hook for plugin activation.
             * Action hook: qa_ext_activation
             * */
            do_action('qa_ext_activation');

        }

        public function qa_ext_uninstall(){

            /*
             * Custom action hook for plugin uninstall/delete.
             * Action hook: qa_ext_uninstall
             * */
            do_action('qa_ext_uninstall');
        }

        public function _deactivation(){

            /*
             * Custom action hook for plugin deactivation.
             * Action hook: qa_ext_deactivation
             * */
            do_action('qa_ext_deactivation');
        }


        public function _scripts_front(){

            // wp_register_style('qa-ext', qa_ext_plugin_url.'assets/frontend/css/style.css');


//            wp_register_script('qa_ext_scripts', qa_ext_plugin_url. 'assets/frontend/js/scripts.js', array( 'jquery' ));
//            wp_enqueue_script('mixitup');


            /*
             * Custom action hook for scripts front.
             * Action hook: qa_ext_scripts_front
             * */
            do_action('qa_ext_scripts_front');
        }


        public function _scripts_admin(){

            //wp_register_style('post-grid-style', qa_ext_plugin_url.'assets/admin/css/style.css');
            //wp_enqueue_style('post-grid-style');

            /*
             * Custom action hook for scripts admin.
             * Action hook: qa_ext_scripts_admin
             * */
            do_action('qa_ext_scripts_admin');
        }


    }
}
new QAEXT();