<?php
/**
 * Plugin Name: Nihoner SRS Flashcards
 * Description: Spaced repetition flashcards for learning Japanese using the SM-2 algorithm.
 * Version: 0.1.0
 * Author: Codex
 * Text Domain: nihoner-srs
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define plugin constants.
 */
define( 'NIHONER_SRS_PATH', plugin_dir_path( __FILE__ ) );
define( 'NIHONER_SRS_URL', plugin_dir_url( __FILE__ ) );

define( 'NIHONER_SRS_VERSION', '0.1.0' );

// Include required classes.
require_once NIHONER_SRS_PATH . 'includes/class-srs-cpt.php';
require_once NIHONER_SRS_PATH . 'includes/class-srs-deck.php';
require_once NIHONER_SRS_PATH . 'includes/class-srs-meta-boxes.php';
require_once NIHONER_SRS_PATH . 'includes/class-srs-rest.php';
require_once NIHONER_SRS_PATH . 'includes/class-srs-cron.php';
require_once NIHONER_SRS_PATH . 'includes/class-srs-settings.php';
require_once NIHONER_SRS_PATH . 'includes/class-srs-scheduler.php';

/**
 * Initialize plugin components.
 */
add_action( 'plugins_loaded', function() {
    new Nihoner_SRS_CPT();
    new Nihoner_SRS_Deck();
    new Nihoner_SRS_Meta_Boxes();
    new Nihoner_SRS_REST();
    new Nihoner_SRS_Cron();
    new Nihoner_SRS_Settings();
    new Nihoner_SRS_Scheduler();
} );

// Activation and deactivation hooks.
register_activation_hook( __FILE__, array( 'Nihoner_SRS_Cron', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Nihoner_SRS_Cron', 'deactivate' ) );
