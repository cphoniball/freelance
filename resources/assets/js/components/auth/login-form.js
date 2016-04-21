import React from 'react';
import api from '../../api/api';
import { browserHistory } from 'react-router';

module.exports = React.createClass({

	getInitialState: function() {
		return {
			email: '',
			password: '',
			errors: []
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

		api.requestToken(this.state.email, this.state.password)
			.then(function(response) {
				// Log user in and redirect them to the dashboard
				browserHistory.push('/dashboard');
			}.bind(this))
			.fail(function(err, msg) {
				// Indicate failed email or password
				return this.setState({
					errors: ['Email or password incorrect.']
				});
			}.bind(this));
	},

	render: function() {
		return(
			<div className="login-form">
				{this.state.errors.map(function(error) {
					return <div className="alert alert-danger">{error}</div>;
				})}
				<form onSubmit={this.handleFormSubmit}>
					<div className="form-group">
						<input className="form-control" type="text" name="email" value={this.state.email} onChange={this.handleEmailChange} placeholder="Email address" />
					</div>

					<div className="form-group">
						<input className="form-control" type="password" name="password" value={this.state.password} onChange={this.handlePasswordChange} placeholder="Password" />
					</div>

					<div className="form-group">
						<input type="submit" className="btn btn-primary" value="Log In" />
					</div>
				</form>
			</div>
		);
	}

});