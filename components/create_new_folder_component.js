Vue.component('create-new-folder-component', {

	template: "#create_new_folder_component_template",

	props: {
		api_url: {
			type:String,
			default: ""
		},
		
	},


	created() {

		event_bus.$on('show-create-new-folder-modal', ()=> {
			$(this.$refs.create_new_folder_modal).modal('show')
		})

	},

	methods: {


	},

	data: function () {
		return  {

			folder_name:"",
			created_folders:[],

		}
	}

})