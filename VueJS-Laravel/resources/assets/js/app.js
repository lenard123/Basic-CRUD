require('./bootstrap');

window.Vue = require('vue');

let VueRouter = require('vue-router').default
let routes = require('./routes.js')

Vue.use(VueRouter)
let router = new VueRouter({
	routes
})

const app = new Vue({
	router,
    el: '#app'
});
