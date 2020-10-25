import { EventBus } from '../../bus.js';
const itemName = 'réservation';
const state = {
	items:[],
	pagination: {
		meta:null,
		links:null
	},
	services:[]

}

const getters = {
	getItemById: (state) => (id) => {
    	return state.items.find(todo => todo.id === id);
  	}
}

const actions = {
	getItems({commit},api_url){
		api_url = api_url || '/api/panel/reservation';
		axios.get(api_url)
			.then(response=>{
				response = response.data;
				if (response.data) {
					commit('setItems',response);
				}
				else{
					EventBus.$emit('reservation-error','Une erreur s\'est produite lors de la réception des '+itemName+'s.');
				}
			})
			.catch(err=>{
				EventBus.$emit('reservation-error','Une erreur s\'est produite lors de la réception des '+itemName+'s.');
			})
	},
	getServices({commit},api_url){
		api_url = api_url || '/api/panel/service';
		axios.get(api_url)
			.then(response=>{
				response = response.data;
				if (response.data) {
					commit('setServices',response);
				}
				else{
					EventBus.$emit('service-error','Une erreur s\'est produite lors de la réception des services.');
				}
			})
			.catch(err=>{
				EventBus.$emit('service-error','Une erreur s\'est produite lors de la réception des services.');
			})
	},
	deleteItem({commit},id){
		axios.delete('/api/panel/reservation/'+id)
			.then(response=>{
				response = response.data;
				if (response.success){
					commit('removeById',id);
					EventBus.$emit('delete-success','');
				}
				else{
					EventBus.$emit('delete-error','');
				}
				
			})
			.catch(err=>{
				EventBus.$emit('delete-error','');
			})
	},
	updateStatus({commit,state},data){
			
			axios.put('/api/panel/reservation/status/'+data.id+'/'+data.status)
				.then(response=>{
					response = response.data;
					if (response.success) {
						// Reservation status updated
						commit('updateStatus',data);
						EventBus.$emit('update-success','');
					}
					else{
						
						EventBus.$emit('update-error','');

					}
				})
				.catch(err=>{
					EventBus.$emit('update-error','');
				})
	}
}

const mutations = {
	setItems(state,data){
		state.items = data.data;
		state.pagination.meta = data.meta;
		state.pagination.links = data.links;
	},
	removeById(state,id){
		state.items = state.items.filter(function(item)
		{
		    return item.id!==id
		});
		state.pagination.meta.total = state.pagination.meta.total - 1;
	},
	updateStatus(state,data){
		
		state.items.forEach((element, index) => {
		    if(element.id === data.id) {
		    	element.status = data.status;
		    }
		});
	},
	setServices(state,data){
		state.services = data.data;
	}
}

export default{
	namespaced:true,
	state,
	getters,
	actions,
	mutations
}