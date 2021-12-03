require('bootstrap');

window.axios = require('axios');
import './libs/trix.js';

import Vue from 'vue'

Vue.component('task-page', require('./components/Task.vue').default);
Vue.component('category-page', require('./components/Category').default)
Vue.component('subscription-page', require('./components/Subscription').default)
Vue.component('dashboard-page', require('./components/Dashboard').default)
Vue.component('feed-page', require('./components/Feed').default)
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
});

document.addEventListener("trix-file-accept", function(event) {
    event.preventDefault();
});
