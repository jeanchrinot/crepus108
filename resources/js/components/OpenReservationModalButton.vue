<template>
	<button type="button" class="site-button " data-toggle="modal" data-target="#with-form" @click="emitEvent()">Réserver <i class="fa fa-angle-double-right"></i>
	</button>
</template>

<script>

	import { EventBus } from '../bus.js';

	export default{
		props:['itemId'],
		data(){
			return{

			}
		},
		created(){
			
		},
		methods:{
			emitEvent(){
				EventBus.$emit('service-select',this.itemId);
			}
		}
	}
</script>