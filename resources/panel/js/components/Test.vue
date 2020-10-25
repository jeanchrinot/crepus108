<template>
	<div>
		<form @submit.prevent="login">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" v-model="user.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" v-model="user.password" class="form-control" id="exampleInputPassword1">
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
	export default{
		data:()=>({
			user:{
				email:'',
				password:''
			}
		}),
		methods:{
			login(){
				this.$store.dispatch('currentUser/loginUser',this.user)
			}
		}
	}
</script>