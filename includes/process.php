<?php

require_once __DIR__ . '/load.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/recaptcha.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/hubspot.php';

if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	$csrf_token = isset( $_POST['csrf_token'] ) ? sanitize_text_field( wp_unslash( $_POST['csrf_token'] ) ) : '';
	if ( ! motoristapx_validate_csrf_token( $csrf_token ) ) {
		die( 'Erro: Token CSRF inválido.' );
	}

	$secret             = $_ENV['GOOGLE_RECAPTCHA_SECRET_KEY'] ?? false;
	$recaptcha_response = '';
	if ( isset( $_POST['g-recaptcha-response'] ) ) {
		$recaptcha_response = sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) );
	}
	if ( $secret && ! motoristapx_validate_recaptcha( $recaptcha_response ) ) {
		die( 'Erro: Falha na validação do reCAPTCHA.' );
	}

	$result = motoristapx_send_to_hubspot( $_POST );

	if ( $result === true ) {
		header( 'Location: https://motoristapx.com.br/demonstracao-cadastrada/' );
		exit;
	} else {
		// TODO: Generic Notice frontend feedback.
		error_log( 'Error sending to HubSpot: ' . $result );
	}
}
