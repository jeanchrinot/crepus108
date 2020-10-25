import toastr from 'toastr'


const state = {};
const getters = {};
const actions = {
	createToast({}, options){

				toastr.options = {
				  "closeButton": true,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": true,
				  "positionClass": "toast-top-full-width",
				  "preventDuplicates": true,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": options.to,
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				}

				toastr[options.type](options.message,options.title);

				
			}
};
const mutations = {};

export default {
	namespaced:true,
	state,
	getters,
	actions,
	mutations
}