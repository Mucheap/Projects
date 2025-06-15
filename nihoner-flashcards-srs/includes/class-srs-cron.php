<?php
class Nihoner_SRS_Cron {
    const HOOK = 'srs_daily_notify';

    public function __construct() {
        add_action( self::HOOK, array( $this, 'daily_notify' ) );
    }

    public static function activate() {
        if ( ! wp_next_scheduled( self::HOOK ) ) {
            wp_schedule_event( strtotime( '08:00:00' ), 'daily', self::HOOK );
        }
    }

    public static function deactivate() {
        wp_clear_scheduled_hook( self::HOOK );
    }

    public function daily_notify() {
        // Placeholder for email notifications.
    }
}
