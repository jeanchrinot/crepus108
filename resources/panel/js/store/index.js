import Vue from 'vue'
import Vuex from 'vuex'

import toastr from './modules/toastr'
import currentUser from './modules/currentUser'
import contactMessage from './modules/contactMessage'
import Reservation from './modules/Reservation'
import Service from './modules/Service'
import ServiceSubcategory from './modules/ServiceSubcategory'
import ServiceCategory from './modules/ServiceCategory'
import Slider from './modules/Slider'
import Testimonial from './modules/Testimonial'
import Brand from './modules/Brand'
import Contact from './modules/Contact'
import Social from './modules/Social'
import Condition from './modules/Condition'

Vue.use(Vuex);

export default new Vuex.Store({
	modules:{
		currentUser,
		toastr,
		contactMessage,
		Reservation,
		Service,
		ServiceSubcategory,
		ServiceCategory,
		Slider,
		Testimonial,
		Brand,
		Contact,
		Social,
		Condition
	}
})