<?php 

class WP_Mail_Override
{

    /**
     * Hook everything up
     *
     * @return void
     */
    public static function init()
    {
        add_filter('wp_mail', array('WP_Mail_Override', 'capture'));
    }

    /**
     * Capture the email and create a new job
     *
     * @param  array $args
     * @return array
     */
    public static function capture($args)
    {
        // add the job to the queue
        wp_queue(new WP_Mail_Job($args));

        // return an array with empty properties to prevent it from sending
        return array( 'to' => '', 'message' => '', 'subject' => '' );
    }
}

// initialize module
WP_Mail_Override::init();
