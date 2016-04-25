var React 						= require('react'),
		reqwest 					= require('reqwest'),
		FullScreenOverlay = require('../layout/full-screen-overlay'),
		clientController 	= require('./client-controller');

import api from '../../api/api';

module.exports = React.createClass({

	defaultState: {
		name: '',
		description: '',
		contactName: '',
		address: '',
		phone: '',
		email: '',
		validationErrors: {},
		statusMessage: false
	},

	getInitialState: function() {
		return this.defaultState;
	},

	handleCloseOverlayClick: function(event) {
		clientController.fire('close-overlay');
	},

	/**
	 * Handle a generic input element value change
	 *
	 * @return {[type]} [description]
	 */
	handleInputChange: function(event) {
		var update = {};
		update[event.target.name] = event.target.value;

		this.setState(update);
	},

	handlePhoneChange: function(event) {
		var phone = event.target.value;

		// TODO: Custom validation here

		this.setState({ phone });
	},

	handleEmailChange: function(event) {
		var email = event.target.value;

		// TODO: Custom validation here

		this.setState({ email });
	},

	handleFormSubmit: function(event) {
		event.preventDefault();

		api.post('clients', {
			data: this.state,
			error: function (response, error) {
				var data = JSON.parse(response.response);

				if (data.result_code === 403) { // Validation error
					this.setState({ validationErrors: data.error.validation_error });

					console.log(data.error.validation_error);
				}
			}.bind(this),
			success: function(response) {
				if (typeof response.created !== 'undefined') {
					var newState = this.defaultState;
					newState.statusMessage = 'Client created!';

					this.setState(newState);
				}
			}.bind(this)
		});
	},

	render: function() {
		var statusMessage = this.state.statusMessage ? <div className="statusMessage alert alert-success">{this.state.statusMessage}</div> : <div></div>;

		return(
			<FullScreenOverlay active={this.props.active} handleCloseOverlayClick={this.handleCloseOverlayClick}>
				<form className="create-client-form" action="/client" method="post" onSubmit={this.handleFormSubmit}>

					<div className="errors">
						{Object.keys(this.state.validationErrors).map(function(key) {
							return <div className="alert alert-danger">{this.state.validationErrors[key].pop()}</div>
						}.bind(this))}
					</div>

					{statusMessage}

					<div className="form-group">
						<label for="name">Name</label>
						<input type="text" className="form-control" name="name" value={this.state.name} onChange={this.handleInputChange} placeholder="Client's name" required />
					</div>

					<div className="form-group">
						<label for="name">Contact Name</label>
						<input type="text" className="form-control" name="contactName" value={this.state.contactName} onChange={this.handleInputChange} placeholder="Client contact name" />
					</div>

					<div className="form-group">
						<label for="name">Description</label>
						<textarea name="description" placeholder="Describe this client" value={this.state.description} onChange={this.handleInputChange} className="form-control"></textarea>
					</div>

					<div className="form-group">
						<label for="address">Address</label>
						<textarea name="address" placeholder="Client's complete address" value={this.state.address} onChange={this.handleInputChange} className="form-control"></textarea>
					</div>

					<div className="form-group">
						<label for="phone">Phone</label>
						<input type="tel" name="phone" value={this.state.phone} onChange={this.handlePhoneChange} className="form-control" />
					</div>

					<div className="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" value={this.state.email} onChange={this.handleEmailChange} className="form-control" />
					</div>

					<div className="form-group">
						<button type="submit" className="btn btn-success">Create Client</button>
					</div>
				</form>
			</FullScreenOverlay>
		);
	}

});