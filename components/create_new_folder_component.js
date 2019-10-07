Vue.component('create-new-folder-component', {

	template: "#create_new_folder_component_template",

	props: {
		api_url: {
			type:String,
			default: ""
		},
		current_directory: "",
		directory_separator: "",
		
	},


	created() {

		event_bus.$on('show-create-new-folder-modal', ()=> {
			$(this.$refs.create_new_folder_modal).modal('show')
		})

	},

	methods: {

		createNewFolder() {
			const create_new_folder_object = {
				action: "create_new_folder",
				directory: this.current_directory  + this.folder_name + this.directory_separator
			}
			console.log(create_new_folder_object)
			this.$http.post(this.api_url, create_new_folder_object, {emulateJSON:true})
			.then(response=> {
				const created_folder_statistics = response.body
				Vue.set(this, "created_folders", [created_folder_statistics])
				event_bus.$emit('refresh-current-directory-data');
			})
		},
	},

	data: function () {
		return  {

			folder_name:"",
			created_folders:[],

		}
	}

})