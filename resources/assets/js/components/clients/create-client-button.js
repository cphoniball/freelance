var React = require('react'),
		CreateClientForm = require('./create-client-form'),
		clientController = require('./client-controller');

module.exports = React.createClass({

	getInitialState: function() {
		return { active: false };
	},

	componentWillMount: function() {
		this.handleOverlayClose();
	},

	/**
	 * Handle a click on the create client button
	 *
	 * @return {[type]} [description]
	 */
	handleCreateClientClick: function(event) {
	 	return this.setState({ active: true });
	},

	/**
	 * Listen for the overlay close event
	 *
	 * @return {[type]} [description]
	 */
	handleOverlayClose: function() {
		clientController.on('close-overlay', (event) => {
			console.log(event);
			this.setState({ active: false });
		});
	},

  render: function() {
      return(
      	<div>
		    	<button className="btn btn-primary create-client-button" onClick={this.handleCreateClientClick}>Create new client</button>
		    	<CreateClientForm active={this.state.active} />
      	</div>
      );
  }

});