// React components, react router, etc.
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, IndexRoute, Link, browserHistory } from 'react-router';

// App components
import Freelance from './freelance';
import Home from './components/home';
import Dashboard from './components/dashboard';
import Clients from './components/clients/clients';

import api from './api/api';

/**
 * Require authentication for routes
 *
 * @param  {[type]} nextState [description]
 * @param  {[type]} replace   [description]
 * @return {[type]}           [description]
 */
function requireAuth(nextState, replace) {
	if (!api.isAuthed()) {
		replace({
			pathname: '/',
			state: { nextPathName: nextState.location.pathname }
		});
	}
}

/**
 * Redirect to dashboards if the user tries to access home page while logged in
 *
 * @param  {[type]} nextState [description]
 * @param  {[type]} replace   [description]
 * @return {[type]}           [description]
 */
function redirectIfAuthed(nextState, replace) {
	if (api.isAuthed()) {
		replace({
			pathname: '/dashboard'
		});
	}
}

render(
	<Router history={browserHistory}>
		<Route path="/" component={Freelance}>
			<IndexRoute component={Home} onEnter={redirectIfAuthed} />
			<Route path="dashboard" component={Dashboard} onEnter={requireAuth} />
			<Route path="clients" component={Clients} onEnter={requireAuth} />
		</Route>
	</Router>
, document.getElementById('freelance-app'));