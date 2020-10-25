import { EventBus } from '../../bus.js';

const state = {
	messages:[],
	pagination: {
		meta:null,
		links:null
	},
	markAsViewed:false

}

const getters = {
	getMessageById: (state) => (id) => {
    	return state.messages.find(todo => todo.id === id);
  	}
}

const actions = {
	getMessages({commit},api_url){
		api_url = api_url || '/api/panel/message';
		axios.get(api_url)
			.then(response=>{
				response = response.data;
				if (response.data) {
					commit('setMessages',response);
				}
				else{
					// 
				}
			})
			.catch(err=>{
				EventBus.$emit('message-error','Une erreur s\'est produite lors de la réception des messages.');
			})
	},
	deleteMessage({commit},id){
		axios.delete('/api/panel/message/'+id)
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
	markAsViewed({commit,state},id){

		commit('markAsViewed',id);
		
		if (state.markAsViewed===true){
			
			axios.put('/api/panel/message/viewed/'+id)
				.then(response=>{
					response = response.data;
					if (response.success) {
						// Message marked as viewed
						// Do nothing
					}
					else{
						
						console.log('Could not mark as viewed');
					}
				})
				.catch(err=>{
					console.log('Server error encountered');
				})
		}
	}
}

const mutations = {
	setMessages(state,data){
		state.messages = data.data;
		state.pagination.meta = data.meta;
		state.pagination.links = data.links;
	},
	removeById(state,id){
		state.messages = state.messages.filter(function(item)
		{
		    return item.id!==id
		});
		state.pagination.meta.total = state.pagination.meta.total - 1;
	},
	markAsViewed(state,id){
		
		state.messages.forEach((element, index) => {
		    if(element.id === id) {
		    	if (state.messages[index].viewed == 1) {
		    		// The element has already been marked as viewed
		    		state.markAsViewed = false;
		    	}
		    	else{
		    		// Mark the element as viewed
		    		state.messages[index].viewed = 1;
		    		state.markAsViewed = true;
		    	}
		    }
		});
	}
}

export default{
	namespaced:true,
	state,
	getters,
	actions,
	mutations
}