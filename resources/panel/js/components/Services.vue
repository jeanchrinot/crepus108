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
                        <div class="btn-actions-pane-left" style="margin-left: 20px;">
                            <button class="mb-2 mr-2 btn btn-sm btn-primary" @click="newItem">Ajouter
                                        </button>
                        </div>
                        <div class="btn-actions-pane-right filter-form">
                            <div class="form-group form-group-sm" role="group">
                                <select class="form-control-sm form-control" @change="filterItems" v-model="filter.status">
                                    <option value="all">Tout</option>
                                    <option value="active">Actif</option>
                                    <option value="passive">Passif</option>
                                </select>
                                <input placeholder="Rechercher ici..." type="text" class="mb-2 form-control-sm form-control" @change="filterItems" v-model="filter.keyword">
                            </div>
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus" v-bind:class="[{'active':filter.order=='desc'}]" @click="sortItems('desc')">Plus récent</button>
                                <button class="btn btn-focus" v-bind:class="[{'active':filter.order=='asc'}]" @click="sortItems('asc')">Plus ancien</button>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nom</th>
                                <th>Sous-catégorie</th>
                                <th>Tarif</th>
                                <th>Durée</th>
                                <th class="text-center">Status</th>
                                <th class="">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in items" v-bind:key="item.id">
                                <td class="text-center text-muted">#{{ index + 1 }}</td>
                                <td>
                                    {{ item.name }}
                                </td>
                                <td>{{ getSubcategory(item.servicesubcategory_id) }}</td>
                                <td>{{ setPrice(item.price) }} </td>
                                <td>{{ setDuration(item.duration) }} </td>
                                <td class="text-center">
                                    <div class="badge" v-bind:class="'badge-'+getItemStatus(item.status,2)">{{ getItemStatus(item.status,1) }}</div>
                                </td>
                                <td class="">
                                    <div class="actions">
                                    	<div>
                                    		<i class="fa fa-eye actions__btn info-item" role="button" v-b-tooltip.hover.top="'Voir'" @click="getItem(item.id)"></i>
                                    	</div>
                                    	<div><i class="fa fa-pencil-square actions__btn success-item" role="button" v-b-tooltip.hover.top="'Modifier'" @click="editItem(item.id)"></i></div>
                                    	<div><i class="fa fa-trash actions__btn danger-item" v-b-tooltip.hover.top="'Supprimer'" @click="confirmDelete(item.id)"></i></div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot v-if="!pagination.total">
                                <tr>
                                    <td colspan="5"><p class="text-center">Aucun résultat.</p></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                    	<nav v-if="pagination.total" class="" aria-label="Pagination">
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous" @click="getItems(pagination.prev_page_url)"><span aria-hidden="true">«</span><span class="sr-only">Précedant</span></a></li>
                                <li v-for="link in pagination.links" class="page-item" v-bind:class="[{'active':link.active,'disabled':!link.url}]">
                                    <a href="javascript:void(0);" class="page-link" @click="getItems(link.url)">{{ link.label }}</a>
                                </li>
                                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]"><a href="javascript:void(0);" class="page-link" aria-label="Next" @click="getItems(pagination.next_page_url)"><span aria-hidden="true">»</span><span class="sr-only">Suivant</span></a></li>
                                <li>
                                    <a href="javascript:void(0);" class="disabled">
                                        <span>Affiché: {{ pagination.showing }} / {{ pagination.total }}</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
	        </div>
	    </div>
	    <b-modal id="itemForm" v-model="showItemForm" :title="itemFormTitle">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form class="" novalidate="" @submit.prevent="saveItem" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="name" class="">Nom</label>
                                    <input type="text" id="name" class="form-control" v-model="item.name">
                                    <div class="error" v-if="submitTry && !$v.item.name.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="subcategory" class="">Sous-catégorie</label>
                                    <select class="form-control" id="subcategory" v-model="item.servicesubcategory_id">
                                        <option value="">Choisir</option>
                                        <option v-for="cat in itemSubcats" :value="cat.id">{{ cat.name }}</option>
                                    </select>
                                    <div class="error" v-if="submitTry && !$v.item.servicesubcategory_id.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="price" class="">Prix (Ariary)</label>
                                    <input type="text" class="form-control" id="price" placeholder="ex: 15.000" v-model="item.price">
                                    <div class="error" v-if="submitTry && !$v.item.price.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="duration" class="">Durée (en minutes)</label>
                                    <input type="text" class="form-control" id="duration" placeholder="Ex: 45" v-model="item.duration">
                                    <div class="error" v-if="submitTry && !$v.item.duration.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="status" class="">Statut</label>
                                    <select class="form-control" id="status" v-model="item.status">
                                        <option value="1">Actif</option>
                                        <option value="0">Passif</option>
                                    </select>
                                    <div class="error" v-if="submitTry && !$v.item.status.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="availability" class="">Disponibilité</label>
                                    <select class="form-control" id="availability" v-model="item.availability">
                                        <option value="1" :selected="addingItem">Disponible</option>
                                        <option value="0">Indisponible</option>
                                    </select>
                                    <div class="error" v-if="submitTry && !$v.item.availability.required">Ce champ est réquis.</div>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="details" class="">Détails ou Déscription</label>
                            <textarea name="text" id="details" class="form-control" v-model="item.details"></textarea>
                        </div>
                        <div class="position-relative form-group">
                            <label for="image" class="">Image</label>
                            <input id="image" type="file" class="form-control" v-on:change="onFileChange">
                        </div>
                        <div class="position-relative form-group">
                            <img :src="item.image" id="item_form_image" class="item_image">
                        </div>
                        <b-alert v-model="showAlert" show variant="danger">{{ alertText }}</b-alert>
                        <button class="mt-2 btn btn-success">Sauvegarder</button>
                    </form>
                </div>
            </div>
            <template v-slot:modal-footer>
            <div class="w-100">
              <b-button
                variant="secondary"
                size="sm"
                class="float-right"
                @click="cancelSaveItem"
              >
                Annuler
              </b-button>
            </div>
          </template>
        </b-modal>
		<b-modal id="messageModal" v-model="showItemDetails" title="Détails du service">
	    <div class="main-card mb-3 card">
            <div class="card-body">
                <ul v-if="showItemDetails" class="list-group list-group-flush">
                    <li class="justify-content-between list-group-item"><b>Nom:</b> {{ item.name }}</li>
                    <li class="justify-content-between list-group-item"><b>Sous-catégorie:</b> {{ getSubcategory(item.servicesubcategory_id) }} </li>
                    <li class="justify-content-between list-group-item"><b>Tarif:</b> {{ setPrice(item.price) }}</li>
                    <li class="justify-content-between list-group-item"><b>Durée:</b> {{ setDuration(item.duration) }}</li>
                    <li class="justify-content-between list-group-item"><b>Statut:</b> 
                        <div class="badge" v-bind:class="'badge-'+getItemStatus(item.status,2)">{{ getItemStatus(item.status,1) }}</div>
                    </li>
                    <li class="justify-content-between list-group-item"><b>Disponibilité:</b> 
                        <div class="badge" v-bind:class="'badge-'+getAvailability(item.availability,2)">{{ getAvailability(item.status,1) }}</div>
                    </li>
                    <li class="justify-content-between list-group-item"><b>Détails:</b><br>
                    <p>{{ AvoidNullValue(item.details) }}</p>
                    </li>
                    <li class="justify-content-between list-group-item"><b>Image:</b><br>
                        <img :src="item.image" class="item_image">
                    </li>
                     <li class="justify-content-between list-group-item"><b>Créé le:</b> {{ formatDate(item.created_at) }} </li>
                </ul>
            </div>
        </div>
	    <template v-slot:modal-footer>
	        <div class="w-100">
	          <b-button
	            variant="primary"
	            size="sm"
	            class="float-right"
	            @click="showItemDetails=false"
	          >
	            Fermer
	          </b-button>
	        </div>
	      </template>
	  </b-modal>

      <b-modal id="deleteModal" v-model="showDeleteModal" title="Confirmer">
        <p class="mb-3">Voulez-vous vraiment supprimer ?</p>
        <template v-slot:modal-footer>
            <div class="w-100">
              <b-button
                variant="secondary"
                size="sm"
                class="float-right"
                @click="cancelDelete"
              >
                Fermer
              </b-button>
              <b-button
                variant="danger"
                size="sm"
                class="float-right"
                style="margin-right: 20px;"
                @click="deleteItem(idToDelete)"
              >
                Supprimer
              </b-button>
            </div>
          </template>
      </b-modal>
	</div>
</template>

<script>

    import { EventBus } from '../bus.js';
    import { required, minLength} from 'vuelidate/lib/validators';

    var moment = require('moment');

	export default{
		name:'Services',
		data:()=>({
			itemName:'service',
			itemModule:'Service',
            itemTitle:'Services',
			showItemDetails:false,
            showDeleteModal:false,
            showItemForm:false,
            showAlert:false,
            item:{
                id:'',
                name:'',
                servicesubcategory_id:'',
                price:'',
                duration:'',
                status:1,
                availability:1,
                details:'',
                image:''
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
            editingItem:false,
            submitTry:false
		}),
        created(){
            EventBus.$on(this.itemName+'-error',data=>{
                this.createErrorToast(data);
            })
            EventBus.$on(this.itemName+'-save-error',data=>{
                this.createErrorAlert(data);
            })
            EventBus.$on(this.itemName+'-save-success',data=>{
                this.resetItem();
                this.showAlert = false;
                this.submitTry = false;
                this.addingItem = false;
                this.showItemForm = false;
            })

            this.$store.dispatch('ServiceSubcategory/getItems','/api/panel/service/subcategory/all');
            this.$store.dispatch(this.itemModule+'/getItems');
        },
        computed:{
            items:{
                get(){
                    return this.$store.state.Service.items;
                }
            },
            MetaAndLinks:{
                get(){
                    return this.$store.state.Service.pagination;
                }
            },
            pagination:{
                get(){
                    return this.paginator();
                }
            },
            itemSubcats:{
                get(){
                    return this.$store.state.ServiceSubcategory.items;
                }
            }
        },
        validations:{
            item:{
                name:{required},
                servicesubcategory_id:{required},
                price:{required},
                duration:{required},
                status:{required},
                availability:{required}
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
            getItems(api_url){
               this.$store.dispatch(this.itemModule+'/getItems',api_url);
            },
            getItem(id){
                this.resetItem();
                this.item = this.$store.getters[this.itemModule+'/getItemById'](id);
                console.log(this.item.image);
                this.showItemDetails = true;

            },
            confirmDelete(id){
                this.idToDelete = id;
                this.showDeleteModal = true;
            },
            deleteItem(id){
                this.$store.dispatch(this.itemModule+'/deleteItem',id);
                this.showDeleteModal = false;
                this.idToDelete = null;
            },
            newItem(){
                this.resetItem();
                this.addingItem = true;
                this.editingItem = false;
                this.showItemForm = true;
            },
            editItem(id){
                this.editingItem = true;
                this.addingItem = false;
                this.item = this.$store.getters[this.itemModule+'/getItemById'](id);
                this.showItemForm = true;
                
            },
            saveItem(){

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
            cancelDelete(){
                this.showDeleteModal = false;
                this.idToDelete = null;
            },
            cancelSaveItem(){
                this.submitTry = false;
                this.showItemForm = false;
            },
            paginator() {
                
                let meta = this.MetaAndLinks.meta;
                let links = this.MetaAndLinks.meta.links;

                    // Remove the Previous and Next url in the links 
                    links = links.filter(function(item)
                    {
                        return item.label!='Previous' && item.label!='Next'
                    });

                    // Modify link urls to include url_request
                    links.forEach((element, index) => {

                        element.url = element.url + this.url_request;

                    });

                let pagination = {
                    links:links,
                    current_page: this.MetaAndLinks.meta.current_page,
                    last_page: this.MetaAndLinks.meta.last_page,
                    next_page_url: (this.MetaAndLinks.links.next) ? this.MetaAndLinks.links.next + this.url_request : this.MetaAndLinks.links.next,
                    prev_page_url: (this.MetaAndLinks.links.prev) ? this.MetaAndLinks.links.prev + this.url_request : this.MetaAndLinks.links.prev,
                    showing:this.items.length,
                    total: this.MetaAndLinks.meta.total
                };
                
                return pagination;
            },
            getItemStatus(status,index){
              let data = {
                status:status,
                index:index
              }
              status = this.$store.getters[this.itemModule+'/getItemStatus'](data);
              return status;
            },
            AvoidNullValue(item){
                return item ? item : '---';
            },
            resetItem(){
                this.item = {
                    id:'',
                    name:'',
                    servicesubcategory_id:'',
                    price:'',
                    duration:'',
                    status:1,
                    availability:1,
                    details:'',
                    image:''
                }
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
            filterItems(){
              
              var api_url = "/api/panel/"+this.itemName+"?f=true";

              this.url_request = '';

              if (this.filter.status!="all"){
                api_url += "&status="+this.filter.status;
                this.url_request += "&status="+this.filter.status;
              }

              if ((this.filter.keyword).length) {
                api_url += "&search="+this.filter.keyword;
                this.url_request += "&search="+this.filter.keyword; 
              }

              if (this.filter.order){
                api_url += "&order="+this.filter.order;
                this.url_request += "&order="+this.filter.order;
              }

              this.getItems(api_url);
            },
            sortItems(order){
                this.filter.order = order;
                this.filterItems();
            },
            updateStatus(id){
                let data = {
                    id:id,
                    status:this.itemStatus
                }

                this.$store.dispatch(this.itemModule+'/updateStatus',data);
            },
            getSubcategory(id){
                let service = this.$store.getters['ServiceSubcategory/getItemById'](id);
                return service.name;
            },
            setPrice(price){
                return price+' Ariary';
            },
            setDuration(duration){
                return duration+' minutes';
            },
            getAvailability(status,index){
                let avArr = [
                    ['0','Indisponible','secondary'],
                    ['1','Disponible','success']
                ];

                return avArr[status][index];
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