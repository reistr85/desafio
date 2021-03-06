require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueTheMask from 'vue-the-mask';

Vue.use(VueRouter, VueAxios, axios, VueTheMask)
Vue.prototype.$BASE_URL = 'http://desafio.test/api/';
//Vue.prototype.$BASE_URL = 'https://aw-desafio.herokuapp.com/api/';

let routes = [
    { path: '/', name: 'home', component: require('./components/HomeComponent.vue').default },

    //USERS
    { path: '/users', component: require('./components/UsersComponent.vue').default },
    { path: '/show/:id', name: 'show', component: require('./components/ShowComponent.vue').default },
    { path: '/create', name: 'create', component: require('./components/CreateComponent.vue').default },
    { path: '/edit/:id', name: 'edit', component: require('./components/EditComponent.vue').default },
    { path: '/delete/:id', name: 'delete', component: require('./components/DeleteComponent.vue').default },

    //TODOS
    { path: '/todo', component: require('./components/TodoComponent.vue').default },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('nav-component', require('./components/NavComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
