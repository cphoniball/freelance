var React = require('react'),
		FullScreenOverlay = require('../layout/full-screen-overlay'),
		clientController = require('./client-controller');

module.exports = React.createClass({

	handleCloseOverlayClick: function(event) {
		clientController.fire('close-overlay');
	},

	render: function() {
		return(
			<FullScreenOverlay active={this.props.active} handleCloseOverlayClick={this.handleCloseOverlayClick}>
				<form className="create-client-form" action="/client/create" method="post">

					<input type="hidden" name="user_id" value="" />

					<div className="form-group">
						<label for="name">Name</label>
						<input type="text" className="form-control" name="name" placeholder="Client's name" required />
					</div>

					<div className="form-group">
						<label for="name">Contact Name</label>
						<input type="text" className="form-control" name="contact_name" placeholder="Client contact name" />
					</div>

					<div className="form-group">
						<label for="name">Description</label>
						<textarea name="description" placeholder="Describe this client" className="form-control"></textarea>
					</div>

					<div className="form-group">
						<label for="address">Address</label>
						<textarea name="address" placeholder="Client's complete address" className="form-control"></textarea>
					</div>

					<div className="form-group">
						<label for="phone">Phone</label>
						<input type="tel" name="phone" className="form-control" />
					</div>

					<div className="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" className="form-control" />
					</div>

					<div className="form-group">
						<button type="submit" className="btn btn-success">Create Client</button>
					</div>
				</form>
			</FullScreenOverlay>
		);
	}

});