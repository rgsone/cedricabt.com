import jump from 'jump.js';

class App
{
	init()
	{
		/*## handle backToTop link ##*/

		const backToTopLink = document.querySelector( '[data-backtotop]' );
		const topAnchor = document.querySelector( '#top' );

		if ( null !== backToTopLink && null !== topAnchor) {
			backToTopLink.addEventListener( 'click', ( e ) => {
				e.preventDefault();
				jump( topAnchor, { duration: 800, offset: 0 });
			});
		}
	}
}

/* ########################################### */

const app = new App();
app.init();

/* ########################################### */

// necessary for hot reloading
if ( module.hot ) {
	module.hot.accept();
}
