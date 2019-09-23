Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		files_and_folders_prop: null
	},
	
	methods: {

		filterFilesAndReturnResult() {
			return this.files_and_folders_prop;
		}

	}

})