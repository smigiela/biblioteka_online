require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import Vue from "vue";
import App from './vue/app.vue';
import axios from "axios";
import VueAxios from "vue-axios";
import VModal from 'vue-js-modal';
Vue.use(VueAxios, axios);
Vue.use(VModal);

import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);

const app = new Vue({
    el: '#app',
    components: { App }
});
