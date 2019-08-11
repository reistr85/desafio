require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueRouter, VueAxios, axios)

let routes = [
    { path: '/', name: 'home', component: require('./components/HomeComponent.vue').default },
    { path: '/users', component: require('./components/UsersComponent.vue').default },
    { path: '/show/:id', name: 'show', component: require('./components/ShowComponent.vue').default },
    { path: '/edit/:id', name: 'edit', component: require('./components/EditComponent.vue').default },
    { path: '/create', name: 'create', component: require('./components/CreateComponent.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});
