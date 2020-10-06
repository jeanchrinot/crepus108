<template>
	<div class="newsletter-bx">
        <form @submit.prevent="saveEmail" role="search" method="post" novalidate="">
            <div class="input-group">
                <input v-model="newsletter.email" name="news-letter" class="form-control" placeholder="Votre addresse email" type="email">
                <span class="input-group-btn">
                    <button type="submit" class="site-button"><i class="fa fa-paper-plane-o"></i></button>
                </span>
            </div>
            <div class="error" v-if="submitTry && !$v.newsletter.email.required">Votre adresse email est réquise.</div>
            <div class="message" v-if="showMessage" v-bind:class="messageType">{{ messageText }}</div>
         </form>
    </div>
</template>
<script>
	import {required} from 'vuelidate/lib/validators'
	export default{
		data(){
			return{
				newsletter:{
					email:''
				},
				submitTry:false,
				showMessage: false,
				messageText: '',
				messageType: ''
			}
		},
		mounted(){
			console.log('Newsletter form component mounted');
		},
		validations:{
			newsletter:{
				email:{
					required
				}
			}
		},
		methods:{
			saveEmail(){
				this.submitTry = true;
				this.$v.$touch();
				if (this.$v.$invalid) {
					// Invalid input
					// Do nothing // Errors will be output by validators
				}
				else{
					// Valid input , proceed to saving email

					let data = this.newsletter;
					axios.post('/api/contact/newsletter',{
						body:data
					})
						.then(response=>{
							response = response.data;
							if (response.data) {
								// Success 
								this.submitTry = false;
								this.messageType = 'success';
								this.messageText = 'Vous vous êtes abonné avec succes!';
								this.showMessage = true;
								this.clearForm();
							}
							else{
								this.messageType = 'error';
								this.messageText = 'Erreur, veuillez entrer une adresse email valide.';
								this.showMessage = true;
							}
						})
						.catch(err=>{
							console.log(err);
							this.messageType = 'error';
							this.messageText = 'Désolé! Une erreur est survenue. Veuillez réessayer plus tard.';
							this.showMessage = true;
						});
						// Dismiss message after 10 seconds
						setTimeout(()=>{
							this.showMessage = false;
						},10000);
				}
				
			},
			clearForm(){
				this.newsletter.email = '';
			}
		}
	}
</script>