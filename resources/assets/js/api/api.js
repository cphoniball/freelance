import reqwest from 'reqwest';
import _ from 'lodash';

var Api = function() {

	/**
	 * JWT authorization token for the API
	 *
	 * @type {Boolean}
	 */
	this.token = false;

	/**
	 * Default request args
	 *
	 * @type {Object}
	 */
	this.defaults = {
		method: 'get',
		headers: {
			'Content-Type': 'application/json'
		},
		type: 'json'
	};

	/**
	 * String to prefix all requests with
	 *
	 * @type {String}
	 */
	this.prefix = 'api/v1/';

	/**
	 * Assemble default argument object for requests,
	 * including adding authentication and other params if appropriate
	 *
	 * @param  {[type]} method [description]
	 * @param  {[type]} url    [description]
	 * @param  {[type]} args   [description]
	 * @return {[type]}        [description]
	 */
	this.getRequestArgs = function(method, url, args) {
		if (typeof args === 'undefined') args = {};

		const baseArgs = { method: method, url: this.prefix + url };

		// Add JWT authentication if available
		if (this.token) {
			baseArgs.headers['Authorization'] = 'Bearer ' + this.token;
		}

		// Stringify JSON if necessary
		if (_.isPlainObject(args.data)) {
			args.data = JSON.stringify(args.data);
		}

		return Object.assign({}, this.defaults, baseArgs, args);
	};

	/**
	 * Generic get function
	 *
	 * @param  {[type]} url [description]
	 * @return {[type]}     [description]
	 */
	this.get = function(url, args) {
		args = this.getRequestArgs('get', url, args);

		return reqwest(args);
	};

	/**
	 * Generic post function
	 *
	 * @param  {[type]} url [description]
	 * @return {[type]}     [description]
	 */
	this.post = function(url, args) {
		args = this.getRequestArgs('post', url, args);

		return reqwest(args);
	};

	/**
	 * Generic put function
	 *
	 * @param  {[type]} url [description]
	 * @return {[type]}     [description]
	 */
	this.put = function(url, args) {
		args = this.getRequestArgs('put', url, args);

		return reqwest(args);
	};

	/**
	 * Generic delete function
	 *
	 * @param  {[type]} url [description]
	 * @return {[type]}     [description]
	 */
	this.delete = function(url, args) {
		args = this.getRequestArgs('delete', url, args);

		return reqwest(args);
	};

	/**
	 * Request a new token from the API
	 *
	 * @return {[type]} [description]
	 */
	this.requestToken = function(email, password) {
		const args = {
			data: {
				email: email,
				password: password
			}
		};

		return this.post('tokens', args)
			.then(function(response) {
				console.log(response);
			});
	};

	/**
	 * Destroy active token in the user's local storage
	 *
	 * @return {[type]} [description]
	 */
	this.destroyToken = function() {

	};

	return this;

};

module.exports = new Api();