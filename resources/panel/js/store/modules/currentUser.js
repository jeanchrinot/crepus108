import { EventBus } from '../../bus.js';

const state = {
	user:{}
};

const getters = {};

const actions = {
	getUser({commit}){
		axios.get('/api/panel/user/current')
			.then(response=>{
				response = response.data;

				commit('setUser',response.data);
			})
			.catch(err=>{
				console.log(err);
			})
	},

	loginUser( {} , user){
		axios.post('/api/auth/login',{
			email:user.email,
			password:user.password
		})
		.then(response=>{
			response = response.data;

			if (response.access_token) {
				localStorage.setItem('user_token',response.access_token);
				window.location = '/panel/dashboard';
			}
			else{
				let data = 'Erreur: Veuillez vérifier votre identifiants.';
				EventBus.$emit('login-error',data);
			}
		})
		.catch(err=>{
			console.log(err);
			EventBus.$emit('login-error','Désolé! Une erreur est survenue. Veuillez réessayer plus tard.');
		})
	},

	logoutUser({commit}){
		axios.get('/api/auth/logout')
                .then(response=>{
                	console.log(response.data.success);

                    if (response.data.success) {
                        localStorage.removeItem('user_token');
                        let user = {};
                        commit('setUser',user);

                        window.location = '/panel/login';
                    }
                    else{

                        EventBus.$emit('logout-error','Erreur: un probleme est survenue.');
                    }
                    
                })
                .catch(err=>{
                    EventBus.$emit('logout-error','Erreur: un probleme est survenue.');
                    console.log(err);
                });
	}
};

const mutations = {
	setUser(state,data){
		state.user = data;
	}
};

export default {
	namespaced:true,
	state,
	getters,
	actions,
	mutations
}