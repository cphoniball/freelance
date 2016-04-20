import React from 'react';
import { Link } from 'react-router';

/**
 * Parent component for Freelance front end
 *
 * @type {[type]}
 */
module.exports = React.createClass({
	render: function() {
		return(
				<div className="freelance">
					<header className="freelance-header">
						<h1><Link to="/">Freelance</Link></h1>
						<nav>
							<ul>
								<li><Link to="/clients">Clients</Link></li>
							</ul>
						</nav>
					</header>
					<div className="freelance-body">
						{this.props.children}
					</div>
				</div>
			);
	}
});