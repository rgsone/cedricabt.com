//require( './../css/app.scss' );

class App
{
	constructor( msg )
	{
		this.msg = msg;
	}

	logMsg()
	{
		console.log( this.msg );
	}
}

const app = new App( 'Gloups !' );
app.logMsg();

/* ########################################### */

// necessary for hot reloading
if ( module.hot )
	module.hot.accept();
