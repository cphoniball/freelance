import React from 'react';
import LoginForm from './auth/login-form';

module.exports = React.createClass({

	render: () => {
		return(
			<div className="freelance-home">
				<p>This is the home view</p>
				<LoginForm />
			</div>
		);
	}

});