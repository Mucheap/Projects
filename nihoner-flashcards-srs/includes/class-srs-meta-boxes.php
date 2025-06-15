<?php
class Nihoner_SRS_Meta_Boxes {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta' ) );
    }

    public function add_boxes() {
        add_meta_box( 'srs_flashcard_meta', __( 'Flashcard SRS Data', 'nihoner-srs' ), array( $this, 'render_box' ), 'srs_flashcard', 'normal', 'default' );
    }

    public function render_box( $post ) {
        $next_review = get_post_meta( $post->ID, '_srs_next_review', true );
        echo '<p>' . esc_html__( 'Next review:', 'nihoner-srs' ) . ' ' . esc_html( $next_review ) . '</p>';
    }

    public function save_meta( $post_id ) {
        // Placeholder for saving meta fields.
    }
}
