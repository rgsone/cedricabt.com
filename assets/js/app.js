import jump from 'jump.js';

class App
{
	constructor()
	{
		/*
		this.scrollReveal = new ScrollReveal({
			viewFactor: .2,
			duration: 800,
			origin: 'bottom',
			distance: '40px',
			scale: 1
		});
		*/
	}

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

		/*
		//console.log( this.scrollReveal );

		if ( this.scrollReveal.isSupported() )
			document.documentElement.classList.add( 'sr' );

		this.scrollReveal.reveal( '.LogoBig', {
			delay: 20,
			duration: 500,
			distance: '20px'
		});

		this.scrollReveal.reveal( '.HomeTagline', {
			delay: 100,
			duration: 500,
			distance: '20px'
		});

		this.scrollReveal.reveal( '.HomeNav', {
			delay: 200,
			duration: 500,
			distance: '20px'
		});

		this.scrollReveal.reveal( '.ProjectListItem', {
			delay: 300,
			duration: 500,
			distance: '20px'
		});

		this.projectImages = document.querySelectorAll( '.ProjectImg' );

		for ( var i = 0; i < this.projectImages.length; ++i ) {
			this.projectImages[i].addEventListener( 'load', ( e ) => {
				e.target.classList.add( 'scrollRevealElem' );
				if ( key <= 0 )
					this.scrollReveal.reveal( '.scrollRevealElem', {
						delay: 100
					});
				else
					this.scrollReveal.sync();
			});
		}

		/*
		 function setReveal() {
		 sr.reveal('.imgtest', {
		 origin: 'bottom',
		 distance: '50px',
		 duration: 800,
		 delay: 50,
		 scale: 1,
		 reset: false
		 //container: '.Project-projectImg',
		 });
		 }

		 var imgAll = document.querySelectorAll( '.img' );
		 imgAll.forEach( function( value, key ) {
		 //console.log( value + ' ' + key + "/" + this );
		 value.addEventListener( "load", function( e ) {
		 //console.log( e.target );
		 e.target.classList.add( 'imgtest' );
		 if ( key <= 0 ) setReveal();
		 else sr.sync();
		 });
		 });
		 */
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
