console.log("ready!");
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
import create from './pages/create';

/*------------------------------------*\
    $ ROUTER
\*------------------------------------*/
const routes = new Router({
  // Commun
  common,
  create
});
// Load Events
// eslint-disable-next-line rule
jQuery(document).ready(() => routes.loadEvents());