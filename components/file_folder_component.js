Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		files_and_folders_prop: null,
		is_list_view: true,
		search_string: "",
	},

	data: {
		files_and_folders_prop_data: this.files_and_folders_prop
	},


	
	methods: {

		filterFilesAndReturnResult() {
			console.log(this.files_and_folders_prop_data)
			return this.files_and_folders_prop;
		},

		nameSearchChanged() {

		}

	}

})