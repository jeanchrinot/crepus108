<template>
	<div>
	<form @submit.prevent="sendReservation" id="demo-form" class="form-horizontal mb-lg" method="post" novalidate>
        <div class="form-group mt-lg">
            <label class="col-sm-3 control-label">Nom complet</label>
            <div class="col-sm-9">
                <input v-model="reservation.name" name="name" class="form-control" placeholder="Votre nom complet..." required type="text">
                <div class="error" v-if="submitTry && !$v.reservation.name.required">Ce champ est réquis.</div>
            </div>
            
        </div>
        <div class="form-group mt-lg">
            <label class="col-sm-3 control-label">Email (optionnel)</label>
            <div class="col-sm-9">
                <input v-model="reservation.email" name="email" class="form-control" placeholder="Votre adresse email..." required type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Téléphone</label>
            <div class="col-sm-9">
                <input v-model="reservation.phone" name="phone" class="form-control" placeholder="Votre Téléphone..." required type="text">
                <div class="error" v-if="submitTry && !$v.reservation.phone.required">Ce champ est réquis.</div>
            </div>
            
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Service</label>
            <div class="col-sm-9">
                <select v-model="reservation.service" name="service" class="form-control" required>
                  <option value="">Choisir un service</option>
                  <option v-for="service in services" v-bind:value="service.id">{{ service.name }}</option>
                </select>
                <div class="error" v-if="submitTry && !$v.reservation.service.required">Ce champ est réquis.</div>
            </div>
            
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date et heure</label>
            <div class="col-sm-9">
                <input v-model="reservation.reservation_date" name="reservation_date" class="form-control" type="datetime-local">
                <div class="error" v-if="submitTry && !$v.reservation.reservation_date.required">Ce champ est réquis.</div>
            </div>
            
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Note (optionnel)</label>
            <div class="col-sm-9">
            <textarea v-model="reservation.note" rows="5" class="form-control" placeholder="Taper ici si vous voulez laisser une note..." name="note"></textarea>
            <div class="error" v-if="submitTry && !$v.reservation.note.minLength">Ce champ est réquis.</div>
            </div>
       		
        </div>
        <div class="alert-box">
        	<div v-if="showAlert" class="alert" v-bind:class="[{'alert-danger':submitError,'alert-success':!submitError}]" role="alert">
        		{{ alertText }}
        	</div>
        </div>
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input v-model="condition" name="condition" id="condition" class="form-control" type="checkbox">
                <label for="condition">J'ai lu et compris les conditions d'utilisations.</label>
                <div class="error" v-if="submitTry && !$v.condition.required">Vous devez accepter les conditions d'utilisations.</div>
            </div>
            
        </div>
        <div class="form-group">
          <button type="button" class="site-button site-button-secondry  m-r15 cancel-btn" style="float: right;" data-dismiss="modal">Fermer
           <i class="fa fa-close"></i></button>

          <button type="submit" class="site-button " style="float: right;margin-right: 15px;">Sauvegarder
           <i class="fa fa fa-check"></i></button>
        </div>
    </form>
	</div>
</template>

<script>

	import { EventBus } from '../bus.js';

	import { required, minLength} from 'vuelidate/lib/validators';

	export default{
		props:['services'],
		data(){
			return{
				reservation:{
					name:'',
					email:'',
					phone:'',
					service:'',
					reservation_date:'',
					note:''
				},
				condition:[],
				submitStatus:null,
				submitTry:false,
				submitError:false,
				showAlert:false,
				alertText:'',
				all_services:[]
			}
		},
		mounted(){
			console.log("Reservation form component mounted");
		},
		created(){
			EventBus.$on('service-select', data => {
                  this.selectService(data);
                });
			this.parseServiceObjects();
			this.selectService();
			// EventBus.$emit('form-ready','Ready');
		},
		validations:{
			reservation:{
				name:{
					required
				},
				phone:{
					required
				},
				service:{
					required
				},
				reservation_date:{
					required
				},
				note:{
					minLength: minLength(5)
				}
			},
			condition:{
					required
				}
		},
		methods:{
			sendReservation(){

				 this.submitTry = true;

				 // console.log(this.condition);

				 this.$v.$touch();

			      if (this.$v.$invalid) {
			        this.submitStatus = 'ERROR'
			      } else {
			        // fields are valid
			        this.submitStatus = 'PENDING'

			        let data = this.reservation;

					axios.post('/api/contact/reservation',{
						body:data
					})
					.then(response=>{

						this.showAlert = false;

						response = response.data;
						if (response.data) {
							this.submitError = false;
							console.log(response.data);
							this.submitStatus = 'OK';
							this.submitTry = false;

							this.alertText = 'Votre réservation a bien été envoyée. Merci de votre confiance!';
							this.submitError = false;
							this.showAlert = true;

							this.clearForm();
						}
						else{
							this.submitError = true;
							const errors = Object.values(response);
							this.alertText = errors[0][0];
							this.showAlert = true;
						}
					})
					.catch(err=>{
						console.log(err);
						this.submitError = true;
						this.alertText = "Une erreur est survenue. Veuillez réessayer plus tard.";
						this.showAlert = true;
					});
			      }

			      // console.log(this.submitStatus);
			},
			clearForm(){
				this.reservation.name = '';
				this.reservation.email = '';
				this.reservation.phone = '';
				this.reservation.service = '';
				this.reservation.reservation_date ='';
				this.reservation.note = '';
				this.condition = false;
			},
			parseServiceObjects(){
				this.all_services = this.services
				// console.log(this.services);
			},
			selectService(id=null){
				if (id!=null) {
					this.reservation.service = id;
				}
				else{
					let url_string = window.location.href;
					let url = new URL(url_string);
					let id = url.searchParams.get("service");
					id = parseInt(id);
					if (this.serviceExist(id)){

						this.reservation.service = id;
					}
				}
			},
			serviceExist(id){
				return this.all_services.some(el=> {
			    return el.id === id;
			  }); 
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