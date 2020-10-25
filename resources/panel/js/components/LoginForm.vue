<template>
	<div>
		<form @submit.prevent="login" novalidate="">
			  <div class="form-group">
			    <div v-if="errorExist" class="alert" v-bind:class="alertClass" role="alert">{{ alertText }}</div>
			  </div>
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" v-model.trim="user.email" class="form-control" id="email" aria-describedby="emailHelp">
			    <div class="error" v-if="submitTry && !$v.user.email.required">Ce champ est réquis.</div>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" v-model.trim="user.password" class="form-control" id="password">
			    <div class="error" v-if="submitTry && !$v.user.password.required">Ce champ est réquis.</div>
			  </div>
			  <div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">Remember me</label>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</template>
<script>
	import { EventBus } from '../bus.js';
	import { required, minLength} from 'vuelidate/lib/validators';
	export default{
		data:()=>({
			user:{
				email:'',
				password:''
			},
			errorExist:false,
			alertClass:'alert-danger',
			alertText:'',
			submitTry:false
		}),
		created(){
			EventBus.$on('login-error',data=>{
				this.showError(data);
			})
		},
		validations:{
			user:{
				email:{
					required
				},
				password:{
					required
				}
			}
		},
		methods:{
			login(){

				this.submitTry = true;

				this.$v.$touch();

			    if (this.$v.$invalid) {
			        // DO nothing 
			    }
			    else {
			    	this.$store.dispatch('currentUser/loginUser',this.user)
			    }
				
			},
			showError(err){
				this.alertText = err;
				this.errorExist = true;
			}
		}
	}
</script>