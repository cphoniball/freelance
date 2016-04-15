var React 	= require('react'),
 		reqwest = require('reqwest');

module.exports = React.createClass({

	/**
	 * Dummy client data for init
	 *
	 * @return {[type]} [description]
	 */
	getInitialState: function() {
		return { clients: [] };
	},

	/**
	 * Get client data via ajax
	 *
	 * @return {[type]} [description]
	 */
	componentDidMount: function() {
		reqwest({
			url: '/api/v1/clients',
			method: 'get',
			success: function(response) {
				if (typeof response.data === 'undefined') return;

				this.setState({ clients: response.data });
			}.bind(this)
		});
	},

	/**
	 * Render an individual client row in the table
	 *
	 * @param  {[type]} client [description]
	 * @return {[type]}        [description]
	 */
	renderClientRow: function(client) {
		return(
			<tr className="client-row">
				<td>{client.name}</td>
				<td>{client.contact_name}</td>
				<td>{client.address}</td>
				<td>{client.phone}</td>
				<td>{client.email}</td>
				<td></td>
			</tr>
		);
	},

	render: function() {
		return(
			<div>
				<table className="client-list table table-striped">
					<thead>
						<th>Name</th>
						<th>Contact Name</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Actions</th>
					</thead>
					<tbody>
						{this.state.clients.map(this.renderClientRow)}
					</tbody>
				</table>
			</div>
		);
	}

});