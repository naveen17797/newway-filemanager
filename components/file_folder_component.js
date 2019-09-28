Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		files_and_folders_prop: null,
		is_list_view: true,
		current_directory: "",
		root_directory: "",
		directory_separator: "",
		
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

		getNavigatableDirectories() {
			const navigatableDirectories = []
			navigatableDirectories.push({
				name: "Root",
				location: this.root_directory
			})
			if (this.current_directory != undefined 
				&& this.current_directory != null 
				&& this.current_directory != "") {
				// then we are at root
				const current_directory = this.current_directory
				const nested_dirs = current_directory.replace(this.root_directory, "").split(this.directory_separator)
				var previous_directory_item = ""
				for (item of nested_dirs) {
					if (item != "") {
						previous_directory_item += item + this.directory_separator
						navigatableDirectories.push({
							name: item,
							location: this.root_directory + previous_directory_item
						})
					}
				}
			}
			return navigatableDirectories
		},

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
			console.log(full_location)
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