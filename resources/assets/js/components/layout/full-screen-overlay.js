var React = require('react');

module.exports = React.createClass({

	render: function() {
		var activeClass = this.props.active ? 'active' : 'hidden';

		return(
			<div className={'full-screen-overlay ' + activeClass}>
				<button className="btn btn-danger close-overlay-button" onClick={this.props.handleCloseOverlayClick}>x close</button>
				{this.props.children}
			</div>
		);
	}

});