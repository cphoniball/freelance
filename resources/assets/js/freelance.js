import React from 'react';
import { Link } from 'react-router';

import Sidebar from './components/layout/sidebar';

/**
 * Parent component for Freelance front end
 *
 * @type {[type]}
 */
module.exports = React.createClass({

	render: function() {
		return(
				<div className="freelance-container">
					<Sidebar />
					<div className="freelance-view-container">
						{this.props.children}
					</div>
				</div>
			);
	}
});