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

const app = new Vue({
    el: '#app',
    components: { App }
});
