<?php
class Nihoner_SRS_REST {
    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    public function register_routes() {
        register_rest_route( 'srs/v1', '/decks', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'get_decks' ),
            'permission_callback' => array( $this, 'permissions' ),
        ) );

        register_rest_route( 'srs/v1', '/review', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'get_review_card' ),
            'permission_callback' => array( $this, 'permissions' ),
        ) );

        register_rest_route( 'srs/v1', '/answer', array(
            'methods'  => 'POST',
            'callback' => array( $this, 'post_answer' ),
            'permission_callback' => array( $this, 'permissions' ),
        ) );
    }

    public function permissions() {
        return current_user_can( 'read' );
    }

    public function get_decks( $request ) {
        $decks = get_posts( array( 'post_type' => 'srs_deck', 'numberposts' => -1 ) );
        $data  = array();
        foreach ( $decks as $deck ) {
            $data[] = array(
                'id'    => $deck->ID,
                'title' => $deck->post_title,
            );
        }
        return rest_ensure_response( $data );
    }

    public function get_review_card( $request ) {
        // Placeholder for fetching due card.
        return rest_ensure_response( array() );
    }

    public function post_answer( $request ) {
        // Placeholder for processing user answer.
        return rest_ensure_response( array() );
    }
}

