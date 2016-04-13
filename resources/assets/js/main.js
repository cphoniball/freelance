var React 		= require('react'),
		ReactDOM 	= require('react-dom'),
		Controller = require('./classes/controller');

var CreateClientButton 	= require('./components/client/create-client-button');

ReactDOM.render(<CreateClientButton />, document.getElementById('create-client-button'));