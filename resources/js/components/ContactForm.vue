<template>
	<div class="section-content bg-gray">
          <div class="contact-home-right p-a30">
          	<h5 class="text-uppercase font-26 p-b20 font-weight-400">Envoyez-nous un bonjour :)</h5>
          	<form @submit.prevent="sendMessage" class="cons-contact-form2" method="post" novalidate="">
            	<div class="form-group">
                    <div class="input-group" :class="{ 'form-group--error': $v.message.name.$error }">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input v-model.trim="$v.message.name.$model" name="name" type="text" required class="form-control" placeholder="Nom">
                    </div>
                    <div class="error" v-if="submitTry && !$v.message.name.required">Ce champ est réquis.</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input v-model="message.email" name="email" type="text" class="form-control" required placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-book"></i></span>
                        <input v-model.trim="message.phone" name="phone" type="text" class="form-control" required placeholder="Téléphone">
                    </div>
                    <div class="error" v-if="submitTry && !$v.message.phone.required">Ce champ est réquis.</div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input v-model.trim="message.subject" name="subject" type="text" required class="form-control" placeholder="Sujet">
                    </div>
                    <div class="error" v-if="submitTry && !$v.message.subject.required">Ce champ est réquis.</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon v-align-t"><i class="fa fa-pencil"></i></span>
                        <textarea v-model="message.message" name="message" class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                    <div class="error" v-if="submitTry && !$v.message.message.required">Ce champ est réquis.</div>
                    <div class="error" v-if="submitTry && !$v.message.message.minLength">Le message doit être au moins {{$v.message.message.$params.minLength.min}} caracteres.</div>
                </div>
                <button type="submit" class="site-button skew-icon-btn radius-sm">
                  <span class="font-weight-700 inline-block text-uppercase p-lr15">Envoyer</span> 
                </button>
            </form>
          </div> 

          <div id="Default-Modal" class="modal fade" role="dialog" style="display: none;">
	          <div class="modal-dialog" style="margin-top: 209.5px;">
	            <!-- MODAL CONTENT-->
	            <div class="modal-content">
	              <div class="modal-header bg-primary" v-bind:class="[{ 'modal-header--error':submitError }]">
	                <button type="button" class="close" data-dismiss="modal">×</button>
	                <h4 class="modal-title text-white">{{ responseTitle }}</h4>
	              </div>
	              <div class="modal-body" id="modal-body">
	                
	              </div>
	              <div class="modal-footer">
	                <button type="button" class="site-button " data-dismiss="modal">Close
	                 <i class="fa fa-angle-double-right"></i></button>
	              </div>
	            </div>
	          </div>
	        </div>                            
    </div>
</template>

<script>

	import { required, minLength} from 'vuelidate/lib/validators';

	export default{
		data(){
			return{
				message:{
					name:'',
					email:'',
					phone:'',
					subject:'',
					message:''
				},
				submitStatus:null,
				submitTry:false,
				responseTitle:'',
				responseMessage:'',
				submitError:false
			}
		},
		mounted(){
			console.log("Contact form component mounted");
		},
		validations:{
			message:{
				name:{
					required
				},
				phone:{
					required
				},
				subject:{
					required
				},
				message:{
					required,
					minLength: minLength(5)
				}
			}
		},
		methods:{
			sendMessage(e){

				 this.submitTry = true;
				 this.submitError = false;

				 this.$v.$touch();

			      if (this.$v.$invalid) {
			        this.submitStatus = 'ERROR'
			      } else {
			        // fields are valid
			        this.submitStatus = 'PENDING'

			        let data = this.message;

					axios.post('/api/contact',{
						body:data
					})
					.then(response=>{

						document.getElementById('modal-body').innerHTML = '';

						response = response.data;
						if (response.data) {
							this.submitError = false;
							// console.log(response.data);
							this.submitStatus = 'OK';
							this.submitTry = false;

							this.responseTitle = 'Succes';
							let successP = document.createElement('p');
								successP.classList.add('success');
							let successText = document.createTextNode("Votre message a bien été envoyé. Merci!");
							successP.appendChild(successText);
							document.getElementById('modal-body').appendChild(successP);
							$('#Default-Modal').modal('show');

							this.clearForm();
						}
						else{
							this.submitError = true;
							const errors = Object.values(response);
							console.log("Error");
							this.responseTitle = 'Erreur';
							let errList = document.createElement('ul');
							    errList.classList.add('error-list');
								errors.forEach(err=>{
									let errItem = document.createElement('li');
									errItem.classList.add('error-item');
									errItem.innerText = err;
									errList.appendChild(errItem);
								})

								document.getElementById('modal-body').appendChild(errList);
							
								$('#Default-Modal').modal('show');
						}
					})
					.catch(err=>{
						console.log(err);
						this.responseTitle = 'Erreur';
						this.submitError = true;
						let errorP = document.createElement('p');
							errorP.classList.add('error');
						let errorText = document.createTextNode("Une erreur est survenue. Veuillez réessayer plus tard.");
						errorP.appendChild(errorText);
						document.getElementById('modal-body').appendChild(errorP);
						$('#Default-Modal').modal('show');
					});
			      }

			      // console.log(this.submitStatus);
			},
			clearForm(){
				this.message.name = '';
				this.message.email = '';
				this.message.phone = '';
				this.message.subject = '';
				this.message.message = '';
			},
			test(){

				axios.get('/api/contact/test')
					.then(response=>{
						let res = response.data;
						console.log(res.data);
					})
					.catch(err=>{
						console.log(err);
					});
			}
		}
	}
</script>