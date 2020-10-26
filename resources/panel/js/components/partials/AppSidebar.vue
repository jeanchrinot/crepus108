<template>
	<div class="app-sidebar sidebar-shadow">
	    <div class="app-header__logo">
	        <div class="logo-src"></div>
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
	    </div>    <div class="scrollbar-sidebar">
	        <div class="app-sidebar__inner">
	            <ul class="vertical-nav-menu">
	                <li class="app-sidebar__heading">Dashboards</li>
	                <li>
	                    <!-- <a href="index.html" class="mm-active">
	                        
	                    </a> -->
	                    <router-link :to="{name:'stats'}">
	                    	<i class="metismenu-icon pe-7s-graph3"></i>
	                        Statistiques
	                    </router-link>
	                </li>
	                <li>
	                    <router-link :to="{ name: 'msg'}">
	                    	<i class="metismenu-icon pe-7s-mail"></i>
	                        Messages
	                    </router-link>
	                </li>
	                <li>
	                    <!-- <a href="index.html">
	                        <i class="metismenu-icon pe-7s-note"></i>
	                        Réservations
	                    </a> -->
	                    <router-link :to="{ name: 'reservation'}">
	                    	<i class="metismenu-icon pe-7s-note"></i>
	                        Réservations
	                    </router-link>
	                </li>
	                <li class="app-sidebar__heading">Contenus</li>
	                <li>
	                    <a href="#">
	                        <i class="metismenu-icon pe-7s-portfolio"></i>
	                        Services
	                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
	                    </a>
	                    <ul>
	                        <li>
	                            <router-link :to="{name:'servicecats'}">
			                    	<i class="metismenu-icon"></i>
			                        Catégories
			                    </router-link>
	                        </li>
	                        <li>
	                            <router-link :to="{name:'servicesubcats'}">
			                    	<i class="metismenu-icon"></i>
			                        Sous-catégories
			                    </router-link>
	                        </li>
	                        <li>
	                            <router-link :to="{name:'services'}">
			                    	<i class="metismenu-icon"></i>
			                        Liste des services
			                    </router-link>
	                        </li>
	                    </ul>
	                </li>
	                <!-- <li>
	                    <a href="#">
	                        <i class="metismenu-icon pe-7s-photo"></i>
	                        Galerie Photos
	                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
	                    </a>
	                    <ul>
	                        <li>
	                            <a href="components-tabs.html">
	                                <i class="metismenu-icon">
	                                </i>Catégories
	                            </a>
	                        </li>
	                        <li>
	                            <a href="components-accordions.html">
	                                <i class="metismenu-icon">
	                                </i>Liste
	                            </a>
	                        </li>
	                    </ul>
	                </li>
	                <li>
	                    <a href="#">
	                        <i class="metismenu-icon pe-7s-video"></i>
	                        Galerie Vidéos
	                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
	                    </a>
	                    <ul>
	                        <li>
	                            <a href="components-tabs.html">
	                                <i class="metismenu-icon">
	                                </i>Catégories
	                            </a>
	                        </li>
	                        <li>
	                            <a href="components-accordions.html">
	                                <i class="metismenu-icon">
	                                </i>Liste
	                            </a>
	                        </li>
	                    </ul>
	                </li> -->
	                <li class="app-sidebar__heading">Composants</li>
	                <li>
	                    <router-link :to="{name:'sliders'}">
			                    	<i class="metismenu-icon pe-7s-next"></i>
			                        Sliders
			            </router-link>
	                </li>
	                <li>
	                    <router-link :to="{name:'testimonials'}">
			                    	<i class="metismenu-icon pe-7s-comment"></i>
			                        Témoignages
			            </router-link>
	                </li>
	                <li>
	                    <router-link :to="{name:'brands'}">
			                    	<i class="metismenu-icon pe-7s-flag"></i>
			                        Marques
			            </router-link>
	                </li>
	                <li class="app-sidebar__heading">Pages</li>
	                <li>
	                    <router-link :to="{name:'contacts'}">
			                    	<i class="metismenu-icon pe-7s-map"></i>
			                        Contacts
			            </router-link>
	                </li>
	                <li>
	                    <router-link :to="{name:'socials'}">
			                    	<i class="metismenu-icon pe-7s-share"></i>
			                        Médias Sociaux
			            </router-link>
	                </li>
	                <li>
	                    <a href="#">
	                        <i class="metismenu-icon pe-7s-config"></i>
	                        Paramètres
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>  
</template>

<script>
	export default{
		name:'AppSidebar'
	}
</script>