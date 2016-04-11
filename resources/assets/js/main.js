var React 		= require('react'),
		ReactDOM 	= require('react-dom');

var CreateClientButton 	= require('./components/client/create-client-button'),
		CreateClientForm 	 	= require('./components/client/create-client-form');

ReactDOM.render(<CreateClientButton />, document.getElementById('create-client-button'));
ReactDOM.render(<CreateClientForm />, document.getElementById('create-client-form'));