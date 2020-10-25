<template>
	<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <app-header></app-header>     
        <div class="app-main">
                <app-sidebar></app-sidebar>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                       <router-view></router-view>
                       <toast></toast>
                    </div>
                    <app-footer></app-footer> 
                </div>
        </div>
    </div>
</template>
<script>
    import AppHeader from './partials/AppHeader';
    import AppSidebar from './partials/AppSidebar';
    import AppFooter from './partials/AppFooter';
    import Toast from './utils/Toast';
    
	export default{
        name:'AppContainer',
		data:()=>({

        }),
		created(){
			axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('user_token');
			this.$store.dispatch('currentUser/getUser');
		},
        mounted(){
            this.$toastr.defaultPosition = "toast-top-right";
        },
        components:{
            AppHeader,
            AppSidebar,
            AppFooter,
            Toast
        }
	}
</script>