
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('customers', require('./components/Customers.vue'));

const app = new Vue({
    el: '#app',
    data: () => ({
        drawer: null,
        items: [
            { icon: 'library_music', text: 'Ministério de Louvor' },
        ]
    }),
    props: {
        source: String
    }
});
