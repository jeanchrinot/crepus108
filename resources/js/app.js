require('./bootstrap');

window.Vue = require('vue');

import Vuelidate from 'vuelidate';
import 'vue2-timepicker/dist/VueTimepicker.css';

axios.defaults.headers.post['content-type'] = 'application/json'; // for POST requests
axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest'; // for POST requests

axios.defaults.headers.put['content-type'] = 'multipart/form-data'; // for PUT requests
axios.defaults.headers.put['X-Requested-With'] = 'XMLHttpRequest'; // for PUT requests

Vue.component('contact-form', require('./components/ContactForm.vue').default);
Vue.component('open-reservation-modal-button', require('./components/OpenReservationModalButton.vue').default);
Vue.component('reservation-form', require('./components/ReservationForm.vue').default);
Vue.component('newsletter-form',require('./components/NewsletterForm.vue').default);

Vue.use(Vuelidate);

const app = new Vue({
   el: '#app',
});
