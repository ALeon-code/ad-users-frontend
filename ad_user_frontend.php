<?php
/*
Plugin Name: AllDev Users Frontend Interface
Plugin URI: https://wordpress.alldev.co/plugins/alldev-users-frontend-interface
Description: Provides simple front end interface for WP Users. Provide shortcode for registration and login
Version: 0.1
Author: AllDev
Author URI: https://www.alldev.co
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'AD_USER_FRONTEND_DOMAIN', 'ad_user_frontend');

include_once "classes/AD_ShortCode.php";

/*
 * TODO.
 * 1. Generate the code for the plugin
 * 2. Make sure to disable or instruct to disable regular wp user registration
 */

class AD_Users
{
	public static $VERSION      = 0.1;
	public static $FILE         = __FILE__;
	public static $DIR_JS       = "/js";
	public static $DIR_VIEWS    = __DIR__;

	private $AD_ShortCode;

	function __construct()
	{
		$this->AD_ShortCode	= new AD_ShortCode();



/**
		wp_nonce_field( $pollAjaxEndpoint, "submit-$pollAjaxEndpoint" );

		wp_verify_nonce( $_REQUEST["submit-tutorEval"], 'tutorEval' );
/**/

	}



	public static function checkNonceFor($nonceName)
	{
		return wp_verify_nonce  ( $_REQUEST[ "nonce_$nonceName" ],  $nonceName );
	}

	public static function generateNonceFieldFor($nonceName)
	{
		wp_nonce_field          ( $nonceName,                       "nonce_$nonceName" );
	}
}

$AD_Users = new AD_Users();