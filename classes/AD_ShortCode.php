<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 *
 */
class AD_ShortCode
{
	private $endpointUsersLogin;

	function __construct()
	{
		add_shortcode("ad_users_login",     array( $this, 'ad_users_login') );
		add_shortcode("ad_users_register",  array( $this, 'ad_users_register') );
		add_shortcode("ad_users_list",      array( $this, 'ad_users_list_function') );

		$this->endpointUsersLogin = "ad_user_login";

		add_action( "wp_ajax_{$this->endpointUsersLogin}", array( $this, 'ad_users_login_ajax') );
		add_action( "wp_ajax_nopriv_{$this->endpointUsersLogin}", array( $this, 'ad_users_login_ajax') );
		function my_ajax() {
			die( "Hello World" );
		}
	}


	/**
	 * Handler of the shortcode ad_users_login.
	 *
	 * @param array $attsInput Options of the shortcode
	 * @param null  $content Return the HTML for the login process
	 *
	 * @return string
	 */
	public static function ad_users_login($attsInput, $content = null)
	{
		$atts = shortcode_atts( array(
			                        'wrapper-extra-class' => '',
			                        'ajax' => true,
			                        'redirect-to' => ''
		                        ), $attsInput, 'ad_users_login' );

		wp_enqueue_script('ad_user_login', plugin_dir_url( AD_Users::$FILE ) . 'js/user_login.js', array('jquery'), AD_Users::$VERSION, true);
		wp_localize_script('ad_user_login', 'AD', array(
			'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
			'enabledAjax'   => $atts['ajax'],
			'redirectTo'    => $atts['redirect-to'],
			'endPoint'      => 'ad_user_login'
		));

		$viewFile = AD_Users::$DIR_VIEWS . "/views/user_login.php";

		ob_start();
		include_once $viewFile;
		$html = ob_get_contents();
		ob_clean();

		return $html;
	}

	/**
	 * Handler of the shortcode add=_users_list.
	 *
	 * @param array $attsInput Options of the shortcode
	 * @param null  $content Return the HTML for the register process
	 *
	 * @return string
	 */
	public static function ad_users_register($attsInput, $content = null)
	{
		$atts = shortcode_atts( array(

		                        ), $attsInput, 'ad_users_register' );


		ob_start();
		include_once "views/user_list.php";

		$html = ob_get_contents();
		ob_flush();
		return $html;
	}

	/**
	 * Handler of the shortcode ad_users_list.
	 *
	 * @param array $attsInput Options of the shortcode
	 * @param null  $content Return the HTML for the list of the users.
	 *
	 * @return string
	 */
	public static function ad_users_list_function($attsInput, $content = null)
	{
		$atts = shortcode_atts( array(

		                        ), $attsInput, 'ad_users_list' );


		ob_start();
		include_once "../views/user_list.php";

		$html = ob_get_contents();
		ob_flush();
		return $html;
	}



	// ==================================        AJAX ENDPOINTS      ======================== //
	public static function ad_users_login_ajax()
	{
		/**
		 * Verify nonce.
		 */

		if ( !AD_Users::checkNonceFor('ad_users_login') ) wp_die(-1);

		//here we need to login the supplied user.

		/**
		 * if empty the credentials on wp_signon will use the default WP login names attributes,
		 * those are the ones defines on the form for the login process.
		 */
		$user = wp_signon( array(), true );


		//TODO: implement a limit of tries/[minute/hour]
		if ( get_class($user) === "WP_Error" )
		{
			$response = array (
				"status" => 'error',
				"message" => __( "There was an error, please provide a valid username/password.", AD_USER_FRONTEND_DOMAIN )
			);
		}
		else
		{
			$response = array (
				"status" => 'success',
				"message" => __( "You have been logged!", AD_USER_FRONTEND_DOMAIN )
			);
		}
		echo json_encode( $response );

		wp_die();
	}




}