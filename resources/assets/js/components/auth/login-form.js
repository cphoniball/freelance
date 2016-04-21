import React from 'react';
import api from '../../api/api';

module.exports = React.createClass({

	getInitialState: function() {
		return {
			email: '',
			password: ''
		};
	},

	handleEmailChange: function(event) {
		const email = event.target.value;

		this.setState({ email });
	},

	handlePasswordChange: function(event) {
		const password = event.target.value;

		this.setState({ password });
	},

	/**
	 * Request auth token
	 *
	 * @param  {[type]} event [description]
	 * @return {[type]}       [description]
	 */
	handleFormSubmit: function(event) {
		event.preventDefault();

		api.requestToken(this.state.email, this.state.password);
	},

	render: function() {
		return(
			<div className="login-form">
				<form onSubmit={this.handleFormSubmit}>
					<div className="form-group">
						<input className="form-control" type="text" name="email" value={this.state.email} onChange={this.handleEmailChange} placeholder="Email address" />
					</div>

					<div className="form-group">
						<input className="form-control" type="password" name="password" value={this.state.password} onChange={this.handlePasswordChange} placeholder="Password" />
					</div>

					<div className="form-group">
						<input type="submit" class="btn btn-primary" value="Log In" />
					</div>
				</form>
			</div>
		);
	}

});