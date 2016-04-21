import React from 'react';
import { Link } from 'react-router';

module.exports = React.createClass({

	links: [
		{ name: 'Dashboard', path: '/dashboard' },
		{ name: 'Clients', path: '/clients' }
	],

	render: function() {
		return(
			<div className="freelance-sidebar sidebar">
				<div className="freelance-sidebar-header">
					<h1 className="freelance-sidebar-logo">Freelance</h1>
				</div>
				<div className="freelance-sidebar-links">
					{this.links.map(function(link) {
						return <Link className="freelance-sidebar-link" activeClassName="active" to={link.path}>{link.name}</Link>;
					})}
				</div>
				<footer className="freelance-sidebar-footer">

				</footer>
			</div>
		);
	}

});