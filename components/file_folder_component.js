Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		files_and_folders_prop: null,
		is_list_view: true,
		
	},

	data: function() {
		return {
			files_and_folders_prop_data: this.files_and_folders_prop,
			search_string: "",
		}
	},

	watch: {

		search_string: function(newValue, oldValue) {
			this.nameSearchChanged()
		}

	},
	
	methods: {

		nameSearchChanged() {

			Vue.set(this, "files_and_folders_prop_data", [])
			for(item of this.files_and_folders_prop) {

				if (item.name.includes(this.search_string)) {
					this.files_and_folders_prop_data.push(item)
				}
			}


		}

	}

})