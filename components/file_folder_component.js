Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		files_and_folders_prop: null,
		is_list_view: true,
		search_string: "",
	},

	data: function() {
		return {
			files_and_folders_prop_data: this.files_and_folders_prop
		}
	},

	created() {
		Vue.set(this, "files_and_folders_prop_data", this.files_and_folders_prop)
		console.log(this.files_and_folders_prop_data)
		console.log('updated')
	},

	
	methods: {

		nameSearchChanged() {

		}

	}

})