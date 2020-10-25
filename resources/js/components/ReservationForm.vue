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
            <!-- <div class="col-sm-9">
                <input v-model="reservation.reservation_date" name="reservation_date" class="form-control" type="datetime-local">
                <div class="error" v-if="submitTry && !$v.reservation.reservation_date.required">Ce champ est réquis.</div>
            </div> -->
            <div class="col-sm-9 col-md-3">
            	<datepicker :language="fr" :disabled-dates="rsDisabledDates" :format="'yyyy MM dd'" v-model="reservation.rs_date" name="rs_date" input-class="'form-control'" @closed="filterTimes"></datepicker>
            	<div class="error" v-if="submitTry && !$v.reservation.rs_date.required">Ce champ est réquis.</div>
            </div>
            <div class="col-sm-9 col-md-3">
            	<vue-timepicker :minute-interval="0" :minute-range="[0]" :hour-range="hour_range" v-model="reservation.rs_time" hide-disabled-hours></vue-timepicker>
            	<div class="error" v-if="submitTry && !$v.reservation.rs_time.required">Ce champ est réquis.</div>
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

	import Datepicker from 'vuejs-datepicker';
	import { fr } from 'vuejs-datepicker/dist/locale';

	import VueTimepicker from 'vue2-timepicker';

	export default{
		components: {
		    Datepicker,
		    VueTimepicker
		},
		props:['services'],
		data(){
			return{
				fr: fr,
				reservation:{
					name:'',
					email:'',
					phone:'',
					service:'',
					rs_date:'',
					rs_time:'',
					note:''
				},
				reservations:[],
				hour_range:[9,10,11,13,14,15,16],
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
			
		},
		created(){
			EventBus.$on('service-select', data => {
                  this.selectService(data);
                });
			this.getReservations();
			this.parseServiceObjects();
			this.selectService();
			// EventBus.$emit('form-ready','Ready');
		},
		computed:{
			rsDisabledDates:function () {
				return this.setDisabledDates();
			}
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
				rs_time:{
					required
				},
				rs_date:{
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

			       	const rs_date = this.getRSDate();

			        let data = this.reservation;
			        	data.rs_date = rs_date;
			        	

			        // console.log('value in data='+data.rs_date);

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
				this.reservation.rs_date ='';
				this.reservation.rs_time = '',
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
			setDisabledDates(){

					let busyDays = [];
					let temp,date;
					let disabledDates;
					let validHours = [9,10,11,13,14,15,16];

					this.reservations.forEach((element, index) => {

							if (!this.checkDateAvailable(element.rs_date)) {
								date = new Date(element.rs_date);
								// temp = parseInt(temp[0]);
								busyDays.push(date);
							}
							
					});

					disabledDates = {
		    				to: new Date(),
		    				days: [0],
		    				dates: busyDays
						}

					return disabledDates;

			
					// set Today
					// let today = new Date();
					// const tomorrow = new Date(today)
					// tomorrow.setDate(tomorrow.getDate() + 1)
					// const date = (tomorrow.getMonth()+1)+'-'+tomorrow.getDate()+'-'+tomorrow.getFullYear();
					// this.reservation.rs_date = date;
			},
			getRSDate(){
				// Need to change date format to YYYY-MM-DD
			        let dateStr = this.reservation.rs_date+'';

			        let myDate = new Date(dateStr);
			            myDate = myDate.toLocaleString('fr-FR');
						myDate = myDate.split(' ');
						myDate = myDate[0];
						myDate = myDate.split('/');
						myDate = myDate[2]+'-'+myDate[1]+'-'+myDate[0];
			      	
			      	// this.reservation.rs_date = myDate;

			      	return myDate;
			},
			serviceExist(id){
				return this.all_services.some(el=> {
			    return el.id === id;
			  }); 
			},
			getReservations(){
				axios.get('/api/contact/reservation')
					.then(response=>{
						response = response.data;

						if (response.data) {
							// Success
							this.reservations = response.data;
							
						}
						else{
							console.log(response);
							// Could not get data
						}

					})
			},
			filterTimes(){
				let selectedDate = this.getRSDate();
				let validHours = [9,10,11,13,14,15,16];
				let takenHours = [];
				let temp;

					this.reservations.forEach((element, index) => {
						if (element.rs_date==selectedDate) {
							temp = element.rs_time;
							temp = temp.split(':');
							temp = parseInt(temp[0]);
							takenHours.push(temp);
						}
					});

				this.hour_range = validHours.filter(function(item)
				{
				    return !(takenHours.includes(item))
				});
			},
			checkDateAvailable(date){
	
				let count = 0;

					this.reservations.forEach((element, index) => {
						if (element.rs_date==date) {
							count++;
						}
					});

					if (count>=7) {
						return false;
					}

					return true;

			},
			test(){
				
				console.log('value after selected='+this.reservation.rs_date);
			}
		}
	}
</script>