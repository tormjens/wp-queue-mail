<?php
/*
Plugin Name:   WP Queue Mail
Description:   Queue all emails for faster page loads and big wins
Plugin URI:    http://tormorten.no
Author:        Tor Morten Jensen
Author URI:    http://tormorten.no
Version:       1.0.0
License:       GPL2
Text Domain:   wpqueuemail
Domain Path:   lang
*/

/*

    Copyright (C) 2017  Tor Morten Jensen  tormorten@tormorten.no

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

final class WP_Queue_Mail
{

    /**
     * WP Queue Mail version.
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * The single instance of the class.
     *
     * @var WP_Queue_Mail
     * @since 1.0.0
     */
    protected static $_instance = null;


    /**
     * Main WP Queue Mail Instance.
     *
     * Ensures only one instance of WP Queue Mail is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WP_Queue_Mail()
     * @return WP_Queue_Mail
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * WP Queue Mail Constructor.
     */
    public function __construct()
    {
        // include the queue vendor
        include 'includes/vendor/queue/queue.php';

        // include the mail job
        include 'includes/jobs/class-wp-mail-job.php';

        // include the mail override
        include 'includes/class-wp-mail-override.php';
    }
}

/**
 * Fetches the single formie instance
 */
function WP_Queue_Mail()
{
    return WP_Queue_Mail::instance();
}

WP_Queue_Mail();
