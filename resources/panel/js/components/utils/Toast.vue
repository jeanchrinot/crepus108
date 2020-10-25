<template>
	<div>
		
	</div>
</template>
<script>
	import { EventBus } from '../../bus.js';
	export default{
		name:'Toast',
		created(){
			EventBus.$on('delete-error',data=>{
				data = data.length ? data : 'L\'élément n\'a pas pu être supprimé.';
				this.createErrorToast(data);
			})

			EventBus.$on('delete-success',data=>{
				data = data.length ? data : 'L\'élément a été supprimé.';
				this.createSuccessToast(data);
			})

			EventBus.$on('update-error',data=>{
				data = data.length ? data : 'Un probleme est survenu lors de la mise à jour de l\'élément.';
				this.createErrorToast(data);
			})

			EventBus.$on('update-success',data=>{
				data = data.length ? data : 'Mise à jour réussi!';
				this.createSuccessToast(data);
			})

			EventBus.$on('item-fetch-error',data=>{
				data = data.length ? data : 'Une erreur s\'est produite lors de la réception des articles.';
				this.createErrorToast(data);
			})

			EventBus.$on('item-save-error',data=>{
				data = data.length ? data : 'L\'article n\'a pas pu être sauvegardé.';
				this.createErrorToast(data);
			})

			EventBus.$on('item-save-success',data=>{
				data = data.length ? data : 'L\'article a été sauvegardé!';
				this.createSuccessToast(data);
			})
		},
		methods:{
			createErrorToast(data){
				
				let options = {
                    title:'Erreur',
                    message:data,
                    to:'5000',
                    type:'error'
                };
				this.$store.dispatch('toastr/createToast',options);
			},
			createSuccessToast(data){

				let options = {
                    title:'Succès',
                    message:data,
                    to:'5000',
                    type:'success'
                };
				this.$store.dispatch('toastr/createToast',options);
			},
			createInfoToast(data){

				let options = {
                    title:'Erreur',
                    message:data,
                    to:'5000',
                    type:'info'
                };
				this.$store.dispatch('toastr/createToast',options);
			}
		}
	}
</script>