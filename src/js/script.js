// import './_vue'
// import './_material-library'
require( 'slick-carousel' );
// require('jquery-colorbox')
require( 'venobox' );

$( '.slick' ).slick( {
	dots: true,
	infinite: true,
	speed: 800,
	slidesToShow: 6,
	slidesToScroll: 2,
	swipeToSlide: true,
	autoplay: true,

	responsive: [
		{
			breakpoint: 1648,
			settings: {
				slidesToShow: 6,
			},
		},
		{
			breakpoint: 1280,
			settings: {
				slidesToShow: 4,
			},
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 3,
				arrows: false,
			},
		},
		{
			breakpoint: 414,
			settings: {
				slidesToShow: 2,
				arrows: false,
			},
		},
	],
} );

$( '.slick-sample-single' ).slick( {
	dots: true,
	infinite: true,
	speed: 800,
	slidesToShow: 4,
	slidesToScroll: 4,
	// swipeToSlide: true,
	autoplay: true,

	responsive: [
		{
			breakpoint: 768,
			settings: {
				slidesToScroll: 3,
				slidesToShow: 3,
				arrows: false,
			},
		},
		{
			breakpoint: 414,
			settings: {
				slidesToScroll: 2,
				slidesToShow: 2,
				arrows: false,
			},
		},
	],
} );

$( function () {
	$( '.venobox' ).venobox( {
		infinigall: false,
		titleattr: 'data-title',
	} );
} );

// お問い合わせフォームの選択肢によって表示したり非表示したり
const $formAbout = $( '#form-about' );

if ( $formAbout.length ) {
	const $formHardware = $( '#form-hardware' );
	const $formSectionHardware = $( '#form-section-hardware' );

	const changeForm = function () {
		if ( $formAbout.val() === 'hardware' ) {
			$formSectionHardware.show();
		} else {
			$formSectionHardware.hide();
			$formHardware.val( '' );
		}
	};

	$( function () {
		changeForm();
	} );

	$formAbout.on( 'change', function () {
		changeForm();
	} );
}

// 埋め込みカレンダーの高さを自動調節
// eslint-disable-next-line @wordpress/no-global-event-listener
window.addEventListener( 'message', ( event ) => {
	if ( event.data.hasOwnProperty( 'height' ) ) {
		const iframe = document.querySelector( 'iframe.iframe' );
		iframe.style.height = `${ event.data.height }px`;
		iframe.style.border = 'none';
	}
} );
