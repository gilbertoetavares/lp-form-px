<?php
function motoristapx_send_to_hubspot( $post_data ) {
	$access_token = sanitize_text_field( wp_unslash( $_ENV['HUBSPOT_ACCESS_TOKEN'] ?? '' ) );
	$endpoint     = 'https://api.hubapi.com/crm/v3/objects/contacts';

	$name  = motoristapx_parse_fullname( $post_data['name'] );
	$phone = preg_replace( '/\D/', '', $post_data['phone'] );
	if ( $phone ) {
		$phone = '+55' . $phone;
	}
	$data = array(
		'properties' => array(
			'firstname'     => $name['firstname'],
			'lastname'      => $name['lastname'],
			'email'         => $post_data['email'],
			'phone'         => $phone,
			'company'       => $post_data['company'],
			'job_title'     => $post_data['job'],
			'trucks'        => $post_data['trucks'],
			'hs_state_code' => $post_data['state'],
			'state'         => motoristapx_state_from_code( $post_data['state'] ),
			'city'          => $post_data['city'],
		),
	);

	$response = wp_remote_post(
		$endpoint,
		array(
			'method'  => 'POST',
			'body'    => wp_json_encode( $data ),
			'headers' => array(
				'Content-Type'  => 'application/json',
				'Authorization' => 'Bearer ' . $access_token,
			),
			'timeout' => 10,
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response->get_error_message();
	}

	$http_code = wp_remote_retrieve_response_code( $response );
	return 201 === intval( $http_code ) ? true : wp_remote_retrieve_body( $response );
}
