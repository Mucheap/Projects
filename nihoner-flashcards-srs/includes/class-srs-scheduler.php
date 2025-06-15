<?php
class Nihoner_SRS_Scheduler {
    public function __construct() {}

    public function schedule( $card_id, $quality ) {
        $easiness   = (float) get_post_meta( $card_id, '_srs_easiness', true );
        $interval    = (int) get_post_meta( $card_id, '_srs_interval', true );
        $repetitions = (int) get_post_meta( $card_id, '_srs_repetitions', true );

        if ( ! $easiness ) {
            $easiness = 2.5;
            $interval = 1;
            $repetitions = 0;
        }

        if ( $quality < 3 ) {
            $repetitions = 0;
            $interval    = 1;
        } else {
            $repetitions++;
            if ( $repetitions === 1 ) {
                $interval = 1;
            } elseif ( $repetitions === 2 ) {
                $interval = 6;
            } else {
                $interval = round( $interval * $easiness );
            }
        }

        $easiness = max( 1.3, $easiness + 0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02) );
        $next     = strtotime( '+' . $interval . ' days' );

        update_post_meta( $card_id, '_srs_easiness', $easiness );
        update_post_meta( $card_id, '_srs_interval', $interval );
        update_post_meta( $card_id, '_srs_repetitions', $repetitions );
        update_post_meta( $card_id, '_srs_next_review', date( 'Y-m-d H:i:s', $next ) );
        update_post_meta( $card_id, '_srs_last_quality', $quality );
    }
}
