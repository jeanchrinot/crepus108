<template>
	 <div class="app-header header-shadow">
	    <div class="app-header__logo">
	        <div class="logo-src">
	        	<a href="/" target="_blank"><span class="navbar-brand mb-0 h1">Crépus 108</span></a>
	        </div>
	        <div class="header__pane ml-auto">
	            <div>
	                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
	                    <span class="hamburger-box">
	                        <span class="hamburger-inner"></span>
	                    </span>
	                </button>
	            </div>
	        </div>
	    </div>
	    <div class="app-header__mobile-menu">
	        <div>
	            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
	                <span class="hamburger-box">
	                    <span class="hamburger-inner"></span>
	                </span>
	            </button>
	        </div>
	    </div>
	    <div class="app-header__menu">
	        <span>
	            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
	                <span class="btn-icon-wrapper">
	                    <i class="fa fa-ellipsis-v fa-w-6"></i>
	                </span>
	            </button>
	        </span>
	    </div>    <div class="app-header__content">
	        <div class="app-header-left">
	            <div class="search-wrapper">
	                <div class="input-holder">
	                    <input type="text" class="search-input" placeholder="Recherche...">
	                    <button class="search-icon"><span></span></button>
	                </div>
	                <button class="close"></button>
	            </div>
	            <!-- <ul class="header-menu nav">
	                <li class="nav-item">
	                    <a href="javascript:void(0);" class="nav-link">
	                        <i class="nav-link-icon fa fa-database"> </i>
	                        Statistics
	                    </a>
	                </li>
	                <li class="btn-group nav-item">
	                    <a href="javascript:void(0);" class="nav-link">
	                        <i class="nav-link-icon fa fa-edit"></i>
	                        Projects
	                    </a>
	                </li>
	                <li class="dropdown nav-item">
	                    <a href="javascript:void(0);" class="nav-link">
	                        <i class="nav-link-icon fa fa-cog"></i>
	                        Settings
	                    </a>
	                </li>
	            </ul>  -->       
	        </div>
	        <div class="app-header-right">
	            <div class="header-btn-lg pr-0">
	                <div class="widget-content p-0">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="btn-group">
	                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
	                                    <img width="42" class="rounded-circle" src="/panel-assets/assets/images/avatars/default.jpg" alt="">
	                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
	                                </a>
	                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
	                                    <button type="button" tabindex="0" class="dropdown-item">Profil</button>
	                                    <button type="button" tabindex="0" class="dropdown-item">Paramètres</button>
	                                    <!-- <h6 tabindex="-1" class="dropdown-header">Header</h6>
	                                    <button type="button" tabindex="0" class="dropdown-item">Actions</button> -->
	                                    <div tabindex="-1" class="dropdown-divider"></div>
	                                    <button id="logout" type="button" tabindex="0" class="dropdown-item" @click="logoutUser"><i class="pe-7s-power"></i> {{ ' ' }} Se déconnecter</button>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="widget-content-left  ml-3 header-user-info">
	                            <div class="widget-heading">
	                                {{ currentUser.name }}
	                            </div>
	                            <div class="widget-subheading">
	                               Administateur
	                            </div>
	                        </div>
	                        <!-- <div class="widget-content-right header-user-info ml-3">
	                            <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
	                                <i class="fa text-white fa-calendar pr-1 pl-1"></i>
	                            </button>
	                        </div> -->
	                    </div>
	                </div>
	            </div>        
	        </div>
	    </div>
	</div> 
</template>
<script>
	import { EventBus } from '../../bus.js';
	export default{
		name:'AppHeader',
		data:()=>({

		}),
		created(){
			EventBus.$on('logout-error',data=>{
				this.createErrorToast(data);
			})
		},
		computed:{
			currentUser:{
				get(){
					return this.$store.state.currentUser.user;
				}
			}
		},
		methods:{
			logoutUser(){
				this.$store.dispatch('currentUser/logoutUser');
			},
			createErrorToast(data){
				let options = {
					title:'Erreur',
					message:data,
					to:'4000',
					type:'error'
				};

				this.$store.dispatch('toastr/createToast',options);
			}
		}
	}
</script>