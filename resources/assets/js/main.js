// React components, react router, etc.
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, IndexRoute, Link, hashHistory } from 'react-router';

// App components
import Freelance from './freelance';
import Home from './components/home';
import Clients from './components/clients/clients';

render(
	<Router history={hashHistory}>
		<Route path="/" component={Freelance}>
			<IndexRoute component={Home} />
			<Route path="clients" component={Clients} />
		</Route>
	</Router>
, document.getElementById('freelance-app'));``