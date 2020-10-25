import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Stats from './components/Stats';
import Messages from './components/Messages';
import Reservation from './components/Reservation';
import Services from './components/Services';
import ServiceSubcategories from './components/ServiceSubcategories';
import ServiceCategories from './components/ServiceCategories';
import Sliders from './components/Sliders';
import Testimonials from './components/Testimonials';
import Brands from './components/Brands';
import Contacts from './components/Contacts';
import Socials from './components/Socials';
import Conditions from './components/Conditions';

export default new VueRouter({
	routes:[
		{
			path:'/panel/dashboard',
			component:Stats
		},
		{
			path:'/panel/dashboard#stats',
			name:'stats',
			component:Stats
		},
		{
			path:'/panel/dashboard#msg',
			name:'msg',
			component:Messages
		},
		{
			path:'/panel/dashboard#reservation',
			name:'reservation',
			component:Reservation
		},
		{
			path:'/panel/services',
			component:Services
		},
		{
			path:'/panel/services#list',
			name:'services',
			component:Services
		},
		{
			path:'/panel/services#subcats',
			name:'servicesubcats',
			component:ServiceSubcategories
		},
		{
			path:'/panel/services#cats',
			name:'servicecats',
			component:ServiceCategories
		},
		{
			path:'/panel/sliders',
			name:'sliders',
			component:Sliders
		},
		{
			path:'/panel/testimonials',
			name:'testimonials',
			component:Testimonials
		},
		{
			path:'/panel/brands',
			name:'brands',
			component:Brands
		},
		{
			path:'/panel/contacts',
			name:'contacts',
			component:Contacts
		},
		{
			path:'/panel/socials',
			name:'socials',
			component:Socials
		},
		{
			path:'/panel/conditions',
			name:'conditions',
			component:Conditions
		}
	],
	mode: 'history'
})