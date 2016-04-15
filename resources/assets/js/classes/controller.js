var EventEmitter = require('eventemitter3');

class Controller {

	/**
	 * Set up this class
	 *
	 * @return {[type]} [description]
	 */
	constructor() {
		this.ee = new EventEmitter();
	}

	/**
	 * Fire the specified event
	 *
	 * @param  {[type]} eventName [description]
	 * @return {[type]}           [description]
	 */
	fire() {
		var args = Array.prototype.slice.call(arguments),
				eventName = args.shift();

		return this.ee.emit(eventName, args);
	}

	/**
	 * Register a callback that will fire on the specified event
	 *
	 * @param  {[type]}   eventName [description]
	 * @param  {Function} callback  [description]
	 * @return {[type]}             [description]
	 */
	on(eventName, callback)	{
		return this.ee.on(eventName, callback);
	}

}

module.exports = Controller;