<?php
class Nihoner_SRS_CPT {
    public function __construct() {
        add_action( 'init', array( $this, 'register_cpts' ) );
    }

    public function register_cpts() {
        register_post_type( 'srs_flashcard', array(
            'labels' => array(
                'name'          => __( 'Flashcards', 'nihoner-srs' ),
                'singular_name' => __( 'Flashcard', 'nihoner-srs' ),
            ),
            'public'      => false,
            'show_ui'     => true,
            'supports'    => array( 'title', 'editor' ),
        ) );

        register_post_type( 'srs_deck', array(
            'labels' => array(
                'name'          => __( 'Decks', 'nihoner-srs' ),
                'singular_name' => __( 'Deck', 'nihoner-srs' ),
            ),
            'public'      => false,
            'show_ui'     => true,
            'supports'    => array( 'title' ),
        ) );
    }
}
