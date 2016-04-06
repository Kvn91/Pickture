(function(){

	var container = document.documentElement,
		popup = document.querySelector( '.concours_popup' ),
		cover = document.querySelector( '.concours_cover' ),
		currentState = null;

	container.className = container.className.replace( /\s+$/gi, '' ) + ' concours_ready';

	// Deactivate on ESC
	function onDocumentKeyUp( event ) {
		if( event.keyCode === 27 ) {
			deactivate2();
		}
	}

	// Deactivate on click outside
	function onDocumentClick( event ) {
		if( event.target === cover ) {
			deactivate2();
		}
	}

	function activate2( state ) {
		document.addEventListener( 'keyup', onDocumentKeyUp, false );
		document.addEventListener( 'click', onDocumentClick, false );
		removeClass( popup, currentState );
		addClass( popup, 'no-transition' );
		addClass( popup, state );

		setTimeout( function() {
			removeClass( popup, 'no-transition' );
			addClass( container, 'concours_active' );
		}, 0 );

		currentState = state;
	}

	function deactivate2() {
		document.removeEventListener( 'keyup', onDocumentKeyUp, false );
		document.removeEventListener( 'click', onDocumentClick, false );

		removeClass( container, 'concours_active' );
	}

	function disableBlur() {
		addClass( document.documentElement, 'no-blur' );
	}

	function addClass( element, name ) {
		element.className = element.className.replace( /\s+$/gi, '' ) + ' ' + name;
	}

	function removeClass( element, name ) {
		element.className = element.className.replace( name, '' );
	}

	window.post = {
		activate2: activate2,
		deactivate2: deactivate2,
		disableBlur: disableBlur
	}

})();