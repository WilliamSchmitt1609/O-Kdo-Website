import { createStore, compose, applyMiddleware } from 'redux';

import reducer from 'src/reducers';
import middleware from 'src/middlewares/okdoApi';

const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

// building an enhancer using dev tools and middleware
const enhancers = composeEnhancers(
  applyMiddleware(middleware),
);

const store = createStore(reducer, enhancers);

export default store;
