import reqwest from 'reqwest';
import _ from 'lodash';

var Api = function() {

	/**
	 * Key value for the API token in local storage
	 *
	 * @type {String}
	 */
	this.apiTokenName = 'freelance-api-token';

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

		// Stringify JSON if necessary
		if (_.isPlainObject(args.data)) {
			args.data = JSON.stringify(args.data);
		}

		var combinedArgs = Object.assign({}, this.defaults, baseArgs, args);

		if (this.token) {
			combinedArgs.headers['Authorization'] = 'Bearer ' + this.token;
		}

		return combinedArgs;
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
	 * Set token from local storage, if avaiable
	 *
	 * @return this
	 */
	this.setToken = function() {
		if (!localStorage.getItem(this.apiTokenName)) { return this; }

		this.token = localStorage.getItem(this.apiTokenName);

		return this;
	};

	/**
	 * Whether or not the API is currently authenticated for this user
	 *
	 * @return {Boolean} [description]
	 */
	this.isAuthed = function() {
		return this.token !== false;
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

		// TODO: Error handling here
		return this.post('tokens', args)
			.then(function(response) {
				// If response contains token, save to local storage
				if (response.authorized === true) {
					localStorage.setItem(this.apiTokenName, response.token);
					this.token = response.token;
				}
			}.bind(this));
	};

	/**
	 * Verify that the current token is valid
	 *
	 * @return {[type]} [description]
	 */
	this.verifyToken = function(callback) {
		return this.get('tokens/verify').always(function(response) {
			if (response.authorized === true) { return callback(true); }
			return callback(false);
		});
	};

	/**
	 * Destroy active token in the user's local storage
	 *
	 * @return {[type]} [description]
	 */
	this.destroyToken = function() {
		localStorage.removeItem(this.apiTokenName);
		this.token = false;
		return this;
	};

	// Look for local token on creation
	this.setToken();

	// Verify token is valid on startup - destroy if not valid
	if (this.token) {
		this.verifyToken(function(response) {
			if (response.authorized === false) this.destroyToken();
		}.bind(this));
	}

	console.log(this.token);

	return this;

};

module.exports = new Api();