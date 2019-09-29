Vue.component('delete-component', {

	template: "#delete_component_template",

	props: {
		api_url: {
			type:String,
			default: ""
		},
		
		choosen_files: {
			type:Array,
			default: []
		},

	},

	created() {

		event_bus.$on('show-delete-modal', ()=> {

			$('#delete_modal').modal('show')
			console.log('modal shown')
		})

	},

	methods: {
	

	},

	data: function () {
		return  {

			completed_progress: 0,

			alert_message: "",

		}
	}

})