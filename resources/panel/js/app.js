import Vue from 'vue';

import store from './store';

import router from './router';

import { BootstrapVue } from 'bootstrap-vue';

import Vuelidate from 'vuelidate';

import VueToastr from 'vue-toastr';

require('./bootstrap');

// axios.defaults.headers.post['content-type'] = 'application/json'; // for POST requests
axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest'; // for POST requests

// axios.defaults.headers.put['content-type'] = 'application/json'; // for PUT requests
axios.defaults.headers.put['X-Requested-With'] = 'XMLHttpRequest'; // for PUT requests

import AppContainer from './components/AppContainer';
import TestContainer from './components/TestContainer';

Vue.component('login-form', require('./components/LoginForm.vue').default);
Vue.component("vue-toastr", VueToastr);

Vue.use(BootstrapVue);
Vue.use(Vuelidate);
Vue.use(VueToastr);

const app = new Vue({
   store,
   router,
   el: '#app',
   components:{
   	AppContainer,
   	TestContainer
   }
});
