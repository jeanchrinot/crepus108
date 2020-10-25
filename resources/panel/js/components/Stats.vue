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
	        <div class="col-md-6 col-xl-4">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Commandes</div>
	                            <div class="widget-subheading">Nombre total de commandes</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-success">1896</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6 col-xl-4">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Soldes</div>
	                            <!-- <div class="widget-subheading">Montant de produits vendus</div> -->
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-warning">Ar 200.000</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6 col-xl-4">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Clients</div>
	                            <div class="widget-subheading">Clients inscrits</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-danger">45</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6 col-xl-4">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Réservations</div>
	                            <div class="widget-subheading">Nombre total de réservations</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-danger">82</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6 col-xl-4">
	            <div class="card mb-3 widget-content">
	                <div class="widget-content-outer">
	                    <div class="widget-content-wrapper">
	                        <div class="widget-content-left">
	                            <div class="widget-heading">Séances</div>
	                            <div class="widget-subheading">Réservations éffectuées</div>
	                        </div>
	                        <div class="widget-content-right">
	                            <div class="widget-numbers text-danger">90%</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
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
	    </div>
	</div>
</template>

<script>
	export default{
		name:'Stats'
	}
</script>