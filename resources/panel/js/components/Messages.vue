<template>
	<div>
		<div class="app-page-title">
			<div class="page-title-wrapper">
		        <div class="page-title-heading">
		            <div>Messages</div>
		        </div>   
		    </div>
	    </div>            
	            
	    <div class="row">
	        <div class="col-12">
	            <div class="main-card mb-3 card">
                    <div class="card-header">Boîte de réception
                        
                        <div class="btn-actions-pane-right filter-form">
                            <div class="form-group form-group-sm" role="group">
                                <select class="form-control-sm form-control" @change="filterItems" v-model="filter.status">
                                    <option value="all">Tout</option>
                                    <option value="unviewed">Nouveau</option>
                                    <option value="viewed">Lu</option>
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
                                <th>Sujet</th>
                                <th>Téléphone</th>
                                <th class="text-center">Status</th>
                                <th class="">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(msg,index) in messages" v-bind:key="msg.id">
                                <td class="text-center text-muted">#{{ index + 1 }}</td>
                                <td>
                                    {{ msg.name }}
                                </td>
                                <td>{{ msg.subject }}</td>
                                <td>{{ msg.phone }}</td>
                                <td class="text-center">
                                    <div class="badge" v-bind:class="'badge-'+messageStatus(msg.viewed,2)">{{ messageStatus(msg.viewed,1) }}</div>
                                </td>
                                <td class="">
                                    <div class="actions">
                                    	<div>
                                    		<i class="fa fa-eye actions__btn info-item" role="button" @click="getMessage(msg.id)"></i>
                                    	</div>
                                    	<div><i class="fa fa-pencil-square actions__btn success-item"></i></div>
                                    	<div><i class="fa fa-trash actions__btn danger-item" @click="confirmDelete(msg.id)"></i></div>
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
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous" @click="getMessages(pagination.prev_page_url)"><span aria-hidden="true">«</span><span class="sr-only">Précedant</span></a></li>
                                <li v-for="link in pagination.links" class="page-item" v-bind:class="[{'active':link.active,'disabled':!link.url}]">
                                    <a href="javascript:void(0);" class="page-link" @click="getMessages(link.url)">{{ link.label }}</a>
                                </li>
                                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]"><a href="javascript:void(0);" class="page-link" aria-label="Next" @click="getMessages(pagination.next_page_url)"><span aria-hidden="true">»</span><span class="sr-only">Suivant</span></a></li>
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
	    
	 <b-modal id="messageModal" v-model="showMessageDetails" title="Détails du message">
	    <div class="main-card mb-3 card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="justify-content-between list-group-item"><b>Nom:</b> {{ message.name }}</li>
                    <li class="justify-content-between list-group-item"><b>Adresse email:</b> {{ AvoidNullValue(message.email) }} </li>
                    <li class="justify-content-between list-group-item"><b>Téléphone:</b> {{ message.phone }}</li>
                    <li class="justify-content-between list-group-item"><b>Sujet:</b> {{ message.subject }}</li>
                    <li class="justify-content-between list-group-item"><b>Message:</b><br>
                    <p>{{ message.message }}</p>
                    </li>
                     <li class="justify-content-between list-group-item"><b>Réçu le:</b> {{ formatDate(message.created_at) }} </li>
                </ul>
            </div>
        </div>
	    <template v-slot:modal-footer>
	        <div class="w-100">
	          <b-button
	            variant="primary"
	            size="sm"
	            class="float-right"
	            @click="showMessageDetails=false"
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
                @click="deleteMessage(idToDelete)"
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
		name:'Messages',
		data:()=>({
			showMessageDetails:false,
            showDeleteModal:false,
            message:{},
            url_request:'',
            status:['Nouveau','Lu'],
            idToDelete:null,
            filter:{
                  status:'all',
                  keyword:'',
                  order:'desc'
                },
            url_request:''
		}),
        created(){
            EventBus.$on('message-error',data=>{
                this.createErrorToast(data);
            })
            this.$store.dispatch('contactMessage/getMessages');
        },
        computed:{
            messages:{
                get(){
                    return this.$store.state.contactMessage.messages;
                }
            },
            MetaAndLinks:{
                get(){
                    return this.$store.state.contactMessage.pagination;
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
            getMessages(api_url){
               this.$store.dispatch('contactMessage/getMessages',api_url);
            },
            getMessage(id){
                this.message = this.$store.getters['contactMessage/getMessageById'](id);
                this.showMessageDetails = true;
                this.$store.dispatch('contactMessage/markAsViewed',id);
            },
            confirmDelete(id){
                this.idToDelete = id;
                this.showDeleteModal = true;
            },
            deleteMessage(id){
                this.$store.dispatch('contactMessage/deleteMessage',id);
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
                    showing:this.messages.length,
                    total: this.MetaAndLinks.meta.total
                };
                
                return pagination;
            },
            messageStatus(status,index){
              var statusArr = [
              ['0','Nouveau','info'],
              ['1','Lu','secondary']
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
              
              var api_url = "/api/panel/message?f=true";

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

              this.getMessages(api_url);
            },
            sortItems(order){
                this.filter.order = order;
                this.filterItems();
            }
		}
	}
</script>