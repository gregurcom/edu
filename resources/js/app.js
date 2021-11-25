require('bootstrap');

window.axios = require('axios');
import './libs/trix.js';

import Vue from 'vue'

Vue.component('task-page', require('./components/Task.vue').default);
Vue.component('category-page', require('./components/Category').default)

const app = new Vue({
    el: '#app',
});

document.addEventListener("trix-file-accept", function(event) {
    event.preventDefault();
});
