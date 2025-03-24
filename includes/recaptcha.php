<?php

function motoristapx_validate_recaptcha( $response ) {
	$secret = $_ENV['GOOGLE_RECAPTCHA_SECRET_KEY'] ?? false;

	if ( ! $secret || empty( $response ) ) {
		return false;
	}

	$verify        = file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response" );
	$response_keys = json_decode( $verify, true );

	return isset( $response_keys['success'] ) && $response_keys['success'] && $response_keys['score'] >= 0.5;
}

function renderRecaptcha() {
	$recaptcha = $_ENV['GOOGLE_RECAPTCHA_SITE_KEY'] ?? false;
	if ( $recaptcha ) :
		?>

	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $recaptcha; ?>"></script>
	<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

	<script>
	grecaptcha.ready(function() {
		grecaptcha.execute('<?php echo $recaptcha; ?>', { action: 'submit' }).then(function(token) {
			document.getElementById('g-recaptcha-response').value = token;
		});
	});
	</script>

		<?php
	endif;
}
