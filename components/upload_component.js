Vue.component('upload-component', {

	template: "#upload_component_template",


	created() {

		event_bus.$on('show-upload-modal', ()=> {

			$('#upload_modal').modal('show')
		})

	},

	data: function () {
		return  {
			
		}
	}

})