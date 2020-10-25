import { EventBus } from '../../bus.js';
const itemDisplayName = 'condition';
const itemPath = 'condition';
const itemName = 'condition';
const state = {
	item:{},
	statusArr:[
	              ['0','Passif','secondary'],
	              ['1','Actif','success']
              ]

}

const getters = {
	getItemById: (state) => (id) => {
    	return state.items.find(item => item.id === parseInt(id));
  	},
  	getItemStatus:(state) => (data) =>{
  		return state.statusArr[data.status][data.index];
  	}
}

const actions = {
	getItem({commit},api_url){
		api_url = api_url || '/api/panel/'+itemPath;
		axios.get(api_url)
			.then(response=>{
				response = response.data;
				if (response.data) {
					commit('setItem',response);
				}
				else{
					EventBus.$emit('item-fetch-error','Une erreur s\'est produite lors de la réception des '+itemDisplayName+'s.');
				}
			})
			.catch(err=>{
				EventBus.$emit('item-fetch-error','Une erreur s\'est produite lors de la réception des '+itemDisplayName+'s.');
			})
	},
	deleteItem({commit},id){
		axios.delete('/api/panel/'+itemPath+'/'+id)
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
	addItem({commit},data){

		let formData = new FormData();
            
         _.each(data, (value, key) => {
	          formData.append(key, value)
	        })

		axios.post('/api/panel/'+itemPath,formData,{
			headers: {
              'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
            }
		})
		.then(response=>{
			response = response.data;
			console.log(response);
			if (response.data) {
				// Successfully added data
				// Add the newly created item to items
				commit('addItem',response.data);
				EventBus.$emit('item-save-success','');
				EventBus.$emit(itemName+'-save-success','');
			}
			else{
				// Errors
				EventBus.$emit(itemName+'-save-error',response);
			}
		})
		.catch(err=>{
			EventBus.$emit('item-save-error','');
		})
	},
	updateItem({commit,state},data){

		console.log(data.conditions);

		axios.post('/api/panel/'+itemPath+'/'+data.id,
			{
				_method:'put',
				title:data.title,
				conditions:data.conditions
			},
			{
			headers: {
              'Content-Type': "application/json"
            }
		})
		.then(response=>{
			response = response.data;
			if (response.data) {
				// Successfully updated item
				// Update the item in the state
				console.log('we cool');
				commit('updateItem',response.data);

				EventBus.$emit('item-save-success','');
				EventBus.$emit(itemName+'-save-success','');
			}
			else{
				console.log(response);
				// Errors
				EventBus.$emit(itemName+'-save-error',response);
			}
		})
		.catch(err=>{
			EventBus.$emit('item-save-error','');
		})
	},
	updateStatus({commit,state},data){
			
			axios.put('/api/panel/'+itemPath+'/status/'+data.id+'/'+data.status)
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
	setItem(state,data){
		state.item = data.data;
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
	addItem(state,data){
		state.items.unshift(data);
		state.items.pop();
	},
	updateItem(state,data){
		state.item = data;
	}
}

export default{
	namespaced:true,
	state,
	getters,
	actions,
	mutations
}