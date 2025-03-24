<?php
function motoristapx_parse_fullname( $name ) {
	$name  = trim( preg_replace( '/\s+/', ' ', $name ) );
	$parts = explode( ' ', $name );
	return array(
		'firstname' => $parts[0] ?? '',
		'lastname'  => count( $parts ) > 1 ? implode( ' ', array_slice( $parts, 1 ) ) : '',
	);
}

function motoristapx_state_from_code( string $code ): ?string {
	$states = array(
		'AC' => 'Acre',
		'AL' => 'Alagoas',
		'AP' => 'Amapá',
		'AM' => 'Amazonas',
		'BA' => 'Bahia',
		'CE' => 'Ceará',
		'DF' => 'Distrito Federal',
		'ES' => 'Espírito Santo',
		'GO' => 'Goiás',
		'MA' => 'Maranhão',
		'MT' => 'Mato Grosso',
		'MS' => 'Mato Grosso do Sul',
		'MG' => 'Minas Gerais',
		'PA' => 'Pará',
		'PB' => 'Paraíba',
		'PR' => 'Paraná',
		'PE' => 'Pernambuco',
		'PI' => 'Piauí',
		'RJ' => 'Rio de Janeiro',
		'RN' => 'Rio Grande do Norte',
		'RS' => 'Rio Grande do Sul',
		'RO' => 'Rondônia',
		'RR' => 'Roraima',
		'SC' => 'Santa Catarina',
		'SP' => 'São Paulo',
		'SE' => 'Sergipe',
		'TO' => 'Tocantins',
	);
	return $states[ strtoupper( $code ) ] ?? null;
}
