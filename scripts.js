const pxCities = {
	statesCodes: {
		AC: 12,
		AL: 27,
		AP: 16,
		AM: 13,
		BA: 29,
		CE: 23,
		DF: 53,
		ES: 32,
		GO: 52,
		MA: 21,
		MT: 51,
		MS: 50,
		MG: 31,
		PA: 15,
		PB: 25,
		PR: 41,
		PE: 26,
		PI: 22,
		RJ: 33,
		RN: 24,
		RS: 43,
		RO: 11,
		RR: 14,
		SC: 42,
		SP: 35,
		SE: 28,
		TO: 17,
	},
	stateSelect: document.querySelector( '#state' ),
	cityInput: document.querySelector( '#city' ),
	citySelect: null,

	init() {
		if ( this.stateSelect && this.cityInput ) {
			this.cityInput.disabled = true;
			this.replaceInputWithSelect();
			this.stateSelect.addEventListener( 'change', () => {
				this.loadCities( this.stateSelect.value );
			} );
		}
	},

	replaceInputWithSelect() {
		if ( ! this.citySelect ) {
			const select = document.createElement( 'select' );
			select.name = this.cityInput.name;
			select.id = this.cityInput.id;
			select.required = this.cityInput.required;
			select.disabled = true;

			this.cityInput.replaceWith( select );
			this.citySelect = select;
		}
	},

	loadCities( state ) {
		const stateCode = this.statesCodes[ state ];

		if ( ! stateCode ) {
			return;
		}

		this.replaceInputWithSelect();

		this.citySelect.innerHTML =
			'<option value="">Carregando cidades...</option>';
		this.citySelect.disabled = true;

		const url = `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${ stateCode }/municipios`;

		fetch( url )
			.then( ( response ) => response.json() )
			.then( ( data ) => {
				this.citySelect.innerHTML =
					'<option value="">Selecione a cidade</option>';
				data.forEach( ( city ) => {
					const option = document.createElement( 'option' );
					option.value = city.nome;
					option.textContent = city.nome;
					this.citySelect.appendChild( option );
				} );

				this.citySelect.disabled = false;
				this.citySelect.focus();
			} )
			.catch( () => {
				this.citySelect.innerHTML =
					'<option value="">Erro ao carregar</option>';
			} );
	},
};
const pxMask = {
	init() {
		const fields = document.querySelectorAll( '[data-mask]' );
		fields.forEach( ( field ) => {
			const mask = field.dataset.mask;
			this.mask( field, mask );
		} );
	},
	format( value, mask ) {
		let formated = value;
		switch ( mask ) {
			case 'phone-br':
				formated = this.formatPhoneBr( value );
				break;
		}
		return formated;
	},
	formatPhoneBr( value ) {
		value = value.replace( /^\+55/, '' ).replace( /\D/g, '' );
		if ( value.length > 11 ) {
			value = value.slice( 0, 11 );
		}

		let formatted = '';
		if ( value.length > 0 ) {
			formatted = '(' + value.substring( 0, 1 );
		}

		if ( value.length >= 2 ) {
			formatted += value.substring( 1, 2 ) + ')';
		}

		let isMobile = false;
		let slicePoint = 6;

		if ( value.length >= 3 ) {
			isMobile = 9 === parseInt( value[ 2 ] );
			slicePoint = isMobile || value.length > 10 ? 7 : 6;
			formatted += ' ' + value.substring( 2, slicePoint );
		}

		if ( value.length >= slicePoint ) {
			formatted += '-' + value.substring( slicePoint, value.length );
		}
		return formatted;
	},
	mask( selector, mask ) {
		let elements;
		if ( 'string' === typeof selector ) {
			elements = document.querySelectorAll( selector );
		} else {
			elements = [ selector ];
		}

		elements.forEach( ( el ) => {
			if ( 'phone-br' === mask ) {
				const phoneField = el;
				if ( phoneField ) {
					phoneField.addEventListener( 'input', ( e ) => {
						e.target.value = this.format( e.target.value, mask );
					} );

					phoneField.addEventListener( 'keydown', ( e ) => {
						if ( e.key === 'Backspace' ) {
							const selectionStart = phoneField.selectionStart;
							const selectionEnd = phoneField.selectionEnd;
							if ( selectionStart !== selectionEnd ) {
								phoneField.value = '';
								e.preventDefault();
								return;
							}
							phoneField.value = this.format(
								phoneField.value
									.replace( /\D/g, '' )
									.slice( 0, -1 ),
								mask
							);
							e.preventDefault();
						}
					} );
				}
			}
		} );
	},
};
document.addEventListener( 'DOMContentLoaded', () => pxCities.init() );
document.addEventListener( 'DOMContentLoaded', () => pxMask.init() );
