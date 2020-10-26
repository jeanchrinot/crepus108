<template>
	<div>
		<div class="app-page-title">
			<div class="page-title-wrapper">
		        <div class="page-title-heading">
		            <div>Statistiques</div>
		        </div>   
		    </div>
	    </div>            
	            
	    <div class="row">
	    	<div class="col-12">
	    		<h2 class="card-title">Messages</h2>
	    	</div>
	        <div class="col-md-6">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Total</div>
	                            <div class="widget-subheading">Messages</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-info">{{ messages.total }}</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Non lus</div>
	                            <div class="widget-subheading">Messages</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-warning">{{ messages.unviewed }}</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="col-12">
	    		<h2 class="card-title">Réservations</h2>
	    	</div>
	        <div class="col-md-6">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Total</div>
	                            <div class="widget-subheading">Réservations</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-info">{{ reservations.total }}</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">En attente</div>
	                            <div class="widget-subheading">Réservations</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-primary">{{ reservations.pending }}</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Terminé</div>
	                            <div class="widget-subheading">Réservations</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-success">{{ reservations.done }}</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Annulé</div>
	                            <div class="widget-subheading">Réservations</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-danger">{{ reservations.canceled }}</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- <div class="row">
	        <div class="col-md-12 col-lg-6">
	            <div class="mb-3 card">
	                <div class="card-header-tab card-header-tab-animation card-header">
	                    <div class="card-header-title">
	                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
	                        Sales Report
	                    </div>
	                    <ul class="nav">
	                        <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
	                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
	                    </ul>
	                </div>
	                <div class="card-body">
	                    <div class="tab-content">
	                        <div class="tab-pane fade show active" id="tabs-eg-77">
	                            <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
	                                <div class="widget-chat-wrapper-outer">
	                                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
	                                        <canvas id="canvas"></canvas>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div> -->
	</div>
</template>

<script>
	export default{
		name:'Stats',
		data:()=>({
			messages:{},
			reservations:{}
		}),
		created(){
			this.getStats();
		},
		methods:{
			getStats(){
				axios.get('/api/panel/stats')
					.then(response=>{
						response = response.data;
						if (response.data) {
							// Success
							this.messages = response.data.messages;
							this.reservations = response.data.reservations;
							console.log(response.data);
						}
						else{
							// Could not get stats
						}
					})
			}
		}
	}
</script>