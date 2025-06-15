<?php
class Nihoner_SRS_Settings {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
    }

    public function add_menu() {
        add_options_page( 'SRS Settings', 'SRS Settings', 'manage_options', 'srs-settings', array( $this, 'render' ) );
    }

    public function render() {
        echo '<h1>' . esc_html__( 'SRS Settings', 'nihoner-srs' ) . '</h1>';
    }
}
