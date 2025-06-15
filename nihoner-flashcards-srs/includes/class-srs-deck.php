<?php
class Nihoner_SRS_Deck {
    public function __construct() {
        add_action( 'init', array( $this, 'register_taxonomies' ) );
    }

    public function register_taxonomies() {
        register_taxonomy( 'srs_deck_category', 'srs_deck', array(
            'labels' => array(
                'name'          => __( 'Deck Categories', 'nihoner-srs' ),
                'singular_name' => __( 'Deck Category', 'nihoner-srs' ),
            ),
            'public'      => false,
            'show_ui'     => true,
            'hierarchical'=> true,
        ) );
    }
}
