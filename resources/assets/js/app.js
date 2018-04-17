/*------------------------------------*\
    $ LIBRAIRIES
\*------------------------------------*/
import 'jquery';
import './lib/unelib';

/*------------------------------------*\
    $ LIBRAIRIES
\*------------------------------------*/
import Router from './util/Router';
import common from './common';
// PAGES
import items from './pages/items';
import create from './pages/create';

/*------------------------------------*\
    $ ROUTER
\*------------------------------------*/
const routes = new Router({
  // Commun
  common,
  // PAGES
  items,
  create
});
// Load Events
// eslint-disable-next-line rule
jQuery(document).ready(() => routes.loadEvents(console.log("ready!")));