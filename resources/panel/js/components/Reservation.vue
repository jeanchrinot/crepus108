<template>
	<div>
		<div class="app-page-title">
			<div class="page-title-wrapper">
		        <div class="page-title-heading">
		            <div>Réservations</div>
		        </div>   
		    </div>
	    </div>            
	            
	    <div class="row">
	        <div class="col-12">
	            <div class="main-card mb-3 card">
                    <div class="card-header">Réservations
                        <div class="btn-actions-pane-right filter-form">
                            <div class="form-group form-group-sm" role="group">
                                <select class="form-control-sm form-control" @change="filterItems" v-model="filter.status">
                                    <option value="all">Tout</option>
                                    <option value="pending">En attente</option>
                                    <option value="confirmed">Confirmé</option>
                                    <option value="done">Terminé</option>
                                    <option value="canceled">Annulé</option>
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
                                <th>Service</th>
                                <th>Téléphone</th>
                                <th>Date prévue</th>
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
                                <td>{{ getService(item.service) }}</td>
                                <td>{{ item.phone }}</td>
                                <td>{{ formatDate(item.reservation_date) }}</td>
                                <td class="text-center">
                                    <div class="badge" v-bind:class="'badge-'+getItemStatus(item.status,2)">{{ getItemStatus(item.status,1) }}</div>
                                </td>
                                <td class="">
                                    <div class="actions">
                                    	<div>
                                    		<i class="fa fa-eye actions__btn info-item" role="button"  data-toggle="modal" data-target="#itemModal" @click="getItem(item.id)"></i>
                                    	</div>
                                    	<div><i class="fa fa-pencil-square actions__btn success-item"></i></div>
                                    	<div><i class="fa fa-trash actions__btn danger-item" @click="confirmDelete(item.id)"></i></div>
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
	    
		<b-modal id="messageModal" v-model="showItemDetails" title="Détails de la réservation">
	    <div class="main-card mb-3 card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="justify-content-between list-group-item"><b>Nom:</b> {{ item.name }}</li>
                    <li class="justify-content-between list-group-item"><b>Adresse email:</b> {{ AvoidNullValue(item.email) }} </li>
                    <li class="justify-content-between list-group-item"><b>Téléphone:</b> {{ item.phone }}</li>
                    <li v-if="item.service" class="justify-content-between list-group-item"><b>Service:</b> {{ getService(item.service) }}</li>
                    <li class="justify-content-between list-group-item"><b>Date prévue:</b> {{ formatDate(item.reservation_date) }}</li>
                    <li class="justify-content-between list-group-item"><b>Note:</b><br>
                    <p>{{ AvoidNullValue(item.note) }}</p>
                    </li>
                     <li class="justify-content-between list-group-item"><b>Réçu le:</b> {{ formatDate(item.created_at) }} </li>
                </ul>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <span style="margin-right: 15px;">Mettre à jour le statut.</span>
                </div>
                <div class="form-group">
                      <div class="input-group mb-0">
                          <select class="form-control" v-model="itemStatus">
                            <option value="0">En attente</option>
                            <option value="1">Confirmé</option>
                            <option value="2">Terminé</option>
                            <option value="3">Annulé</option>
                          </select>
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" @click="updateStatus(item.id)">Mettre à jour</button>
                          </div>
                        </div>
                </div>
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
    var moment = require('moment');
	export default{
		name:'Reservations',
		data:()=>({
			itemName:'reservation',
			itemModule:'Reservation',
			showItemDetails:false,
            showDeleteModal:false,
            item:{},
            url_request:'',
            idToDelete:null,
            filter:{
                  status:'all',
                  keyword:'',
                  order:'desc'
                },
            url_request:'',
            itemStatus:''
		}),
        created(){
            EventBus.$on(this.itemName+'-error',data=>{
                this.createErrorToast(data);
            })

            this.$store.dispatch('Service/getItems','/api/panel/service/all');
            this.$store.dispatch(this.itemModule+'/getItems');
        },
        computed:{
            items:{
                get(){
                    return this.$store.state.Reservation.items;
                }
            },
            MetaAndLinks:{
                get(){
                    return this.$store.state.Reservation.pagination;
                }
            },
            pagination:{
                get(){
                    return this.paginator();
                }
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
                this.item = this.$store.getters[this.itemModule+'/getItemById'](id);
                this.itemStatus = this.item.status;
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
            cancelDelete(){
                this.showDeleteModal = false;
                this.idToDelete = null;
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
              var statusArr = [
              ['0','En attente','primary'],
              ['1','Confirmé','info'],
              ['2','Terminé','light'],
              ['3','Annulé','secondary'],
              ];
              
              return statusArr[status][index];
            },
            AvoidNullValue(item){
                return item ? item : '---';
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

                this.$store.dispatch('Reservation/updateStatus',data);
            },
            getService(id){
                let service = this.$store.getters['Service/getItemById'](id);
                return service.name;
            }
		}
	}
</script>