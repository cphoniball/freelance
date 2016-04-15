var React = require('react');

var ClientList = require('./client-list'),
		CreateClientButton = require('./create-client-button');

module.exports = React.createClass({

	render: function() {
		return(
			<div className="client-wrap col-xs-12">
				<header className="client-list-header">
					<h1>Clients</h1>
					<CreateClientButton />
				</header>
				<ClientList />
			</div>
		);
	}

});