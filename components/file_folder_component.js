Vue.component('file-folder-component', {
	
	template:"#file_folder_template",

	props:{
		api_url:"",
		files_and_folders_prop: null,
		is_list_view: true,
		current_directory: "",
		root_directory: "",
		directory_separator: "",
		can_write_files:false,
		
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
			selected_items:[],
		}
	},

	watch: {

		search_string: function(newValue, oldValue) {
			this.nameSearchChanged()
		},

		files_and_folders_prop_data: {
			
			handler(newValue) {
				Vue.set(this, "selected_items", [])
				for (item of newValue) {
					if (item.is_selected && !this.selected_items.includes(item.full_location)) {
						this.selected_items.push(item.full_location)
					}
				}
			},
			deep: true 
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

		showDeleteModal() {
			event_bus.$emit('show-delete-modal')
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
			if (is_directory) {
				event_bus.$emit('directory-changed-by-user', full_location)
			}

		},

		renameFile(item) {

			var new_name_with_location = ""
			if (item.is_directory) {
				new_name_with_location = item.location_without_item_name + item.name + this.directory_separator
			}
			else {
				new_name_with_location = item.location_without_item_name + item.name
			}
			
			const rename_object = {
				action: 'rename_item',
				new_name: new_name_with_location,
				old_name: item.full_location
			}

			this.$http.post(this.api_url, rename_object, {emulateJSON:true})
			.then(response=> {
				
				const server_response = response.body
				if (server_response.is_renamed) {
					item.is_editable = false
					item.full_location = new_name_with_location
				}

			})
		}

	},

	filters: {

		  user_friendly_date: function (timestamp) {
		  	return new Date(timestamp).toGMTString()
		  }
    }

})