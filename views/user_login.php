<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Created by PhpStorm.
 * User: alian
 * Date: 10/19/16
 * Time: 10:58 PM
 */

$wrapperExtraClass = $atts['wrapper-extra-class'];

?>

<div class="ad-user-login-wrapper <?php echo $wrapperExtraClass;?>">
	<?php
	$currentUser = wp_get_current_user();
	if ( !$currentUser->ID ) : ?>

		<form class="ad-user-login-form" method="POST">
			<?php AD_Users::generateNonceFieldFor('ad_users_login'); ?>
			<div class="ad-form-input-wrapper">
				<label for="log"><?php _e( "Username", AD_USER_FRONTEND_DOMAIN);?></label>
				<input name="log" type="text" required>
			</div>
			<div class="ad-form-input-wrapper">
				<label for="pwd"><?php _e( "Password", AD_USER_FRONTEND_DOMAIN);?></label>
				<input name="pwd" type="password" required>
			</div>

			<div class="ad-form-input-wrapper">
				<button type="submit"><?php _e( "Login", AD_USER_FRONTEND_DOMAIN);?></button>
			</div>
		</form>
		<div class="login-messages-wrapper">
			<div class="login-message login-error"></div>
			<div class="login-message login-success"></div>
		</div>

	<?php
	else :
		_e( "You are already logged", AD_USER_FRONTEND_DOMAIN);
	endif;
	?>

</div>




