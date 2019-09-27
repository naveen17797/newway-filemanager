Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		files_and_folders_prop: null,
		is_list_view: true,
		
	},

	created() {
		event_bus.$on('files-and-folders-prop_data-changed', (data)=> {
			Vue.set(this, "files_and_folders_prop_data", data)
		})
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

		getNameHtmlByHighlighting(name) {
			let search_string = this.search_string
			if (search_string != "") {
				return name.replace(search_string, "<b class='text-danger'>" + search_string + "</b>")
			}
			else {
				return name
			}
		},

		nameSearchChanged() {

			Vue.set(this, "files_and_folders_prop_data", [])
			for(item of this.files_and_folders_prop) {

				if (item.name.includes(this.search_string)) {
					this.files_and_folders_prop_data.push(item)
				}
			}


		},

		showUploadModal() {
			
			event_bus.$emit('show-upload-modal')
		},

		navigateToDirectory(full_location, is_directory) {

			if (is_directory) {
				event_bus.$emit('directory-changed-by-user', full_location)
			}
			else {
				console.log('not a directory')
			}
		}

	},

	filters: {

		  user_friendly_date: function (timestamp) {
		  	return new Date(timestamp).toGMTString()
		  }
    }

})