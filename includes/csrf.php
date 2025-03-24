<?php
session_start();

if ( empty( $_SESSION['csrf_token'] ) ) {
	$_SESSION['csrf_token'] = bin2hex( random_bytes( 32 ) );
}

function getCsrfToken() {
	return $_SESSION['csrf_token'];
}

function motoristapx_validate_csrf_token( $token ) {
	return isset( $token ) && $token === $_SESSION['csrf_token'];
}

function renderCsrfField() {
	echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}
