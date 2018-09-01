window.Turbolinks = require('turbolinks');
Turbolinks.start();



import { Application } from "stimulus";
import { definitionsFromContext } from "stimulus/webpack-helpers";

window.$ = window.jQuery = require('jquery');
require('bootstrap');

const application = Application.start();
const context= require.context("./fields", true, /\.js$/);
application.load(definitionsFromContext(context));





