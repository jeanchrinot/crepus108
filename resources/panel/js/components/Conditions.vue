<template>
	<div>
		<div class="app-page-title">
			<div class="page-title-wrapper">
		        <div class="page-title-heading">
		            <div>{{ itemTitle }}</div>
		        </div>   
		    </div>
	    </div>            
	            
	    <div class="row">
	        <div class="col-12">
	            <div class="main-card mb-3 card">
                    <div class="card-header">{{ itemTitle }}
                    </div>
                    <div class="container mb-3 mt-3">
                        <div class="col-md-8">
                            <form class="" novalidate="" @submit.prevent="saveItem" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="title" class="">Titre</label>
                                        <input type="text" id="title" class="form-control" v-model="item.title" placeholder="Ex: Suivez-nous">
                                        <div class="error" v-if="submitTry && !$v.item.title.required">Ce champ est réquis.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="details" class="">Conditions</label>
                                    <ckeditor v-model="item.conditions" :config="editorConfig"></ckeditor>
                                    <div class="error" v-if="submitTry && !$v.item.conditions.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                            <b-alert v-model="showAlert" show variant="danger">{{ alertText }}</b-alert>
                            <button class="mt-2 btn btn-success">Sauvegarder</button>
                        </form>
                        </div>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
</template>

<script>

    import { EventBus } from '../bus.js';
    import { required, minLength} from 'vuelidate/lib/validators';

    import CKEditor from 'ckeditor4-vue';

    var moment = require('moment');

	export default{
		name:'Conditions',
        components: {
            ckeditor: CKEditor.component
        },
		data:()=>({
			itemName:'condition',
            itemTitle:'Conditions',
			itemModule:'Condition',
            itemPath:'condition',
			showItemDetails:false,
            showDeleteModal:false,
            showItemForm:false,
            showAlert:false,
            editorConfig: {
                // The configuration of the editor.
                font_names :
                'Poppins,sans-serif;'+
                'Arial/Arial, Helvetica, sans-serif;' +
                'Times New Roman/Times New Roman, Times, serif;' +
                'Verdana',
                width:'100%',
            },
            itemFormTitle:'',
            alertText:'',
            url_request:'',
            idToDelete:null,
            filter:{
                  status:'all',
                  keyword:'',
                  order:'desc'
                },
            url_request:'',
            addingItem:false,
            editingItem:true,
            submitTry:false
		}),
        beforeDestroy() {
            // Always destroy your editor instance when it's no longer needed
            this.editor.destroy()
        },
        created(){
            EventBus.$on(this.itemName+'-error',data=>{
                this.createErrorToast(data);
            })
            EventBus.$on(this.itemName+'-save-error',data=>{
                this.createErrorAlert(data);
            })

            this.$store.dispatch(this.itemModule+'/getItem');
        },
        computed:{
            item:{
                get(){
                    return this.$store.state.Condition.item;
                }
            }
        },
        validations:{
            item:{
                title:{required},
                conditions:{required}
            }
        },
		methods:{
            createErrorToast(data){
                let options = {
                    title:'Erreur',
                    message:data,
                    to:'4000',
                    type:'error'
                };

                this.$store.dispatch('toastr/createToast',options);
            },
            saveItem(){

                console.log('Tried to save item');

                this.submitTry = true;

                this.$v.$touch();

                if (this.$v.$invalid) {
                    // Form inputs invalid
                } else {

                    // Update or Add new item
                    if (this.addingItem===true) {
                        // Add new item
                        this.$store.dispatch(this.itemModule+'/addItem',this.item);
                        
                    }
                    else if (this.editingItem===true) {
                        // Update an item
                        this.$store.dispatch(this.itemModule+'/updateItem',this.item);
    
                    }
                }
            },
            cancelSaveItem(){
                this.submitTry = false;
                this.showItemForm = false;
            },
            onFileChange(e){
                if (this.addingItem || this.editingItem) {
                    console.log('file changed');
                    this.item.image = e.target.files[0];
                    let reader = new FileReader();

                    reader.onload = (e) => {
                      document.getElementById('item_form_image').setAttribute('src', e.target.result);
                    };
                    reader.readAsDataURL(this.item.image);
                }
            },
            formatDate(date){
              //let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
              // let theDate = new Date(date);
              // return theDate.toLocaleDateString("fr-FR"); 
              return moment(date).format('DD/MM/YYYY hh:mm');
            },
            updateStatus(id){
                let data = {
                    id:id,
                    status:this.itemStatus
                }

                this.$store.dispatch(this.itemModule+'/updateStatus',data);
            },
            createErrorAlert(error){
                const errors = Object.values(error); 
                    for (var i = errors.length - 1; i >= 0; i--) {
                      this.alertText = errors[i][0];
                      this.showAlert = true;
                    }
            }
		}
	}
</script>