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


		}

	},

	filters: {

		  user_friendly_memory_format_filter: function (bytes) {
		  	console.log(bytes)
		  	// 20
		  	let memory_units = ['YB','ZB','PB','TB','GB','MB','KB', 'B']


		  	// 3000
		  	// 
		  	for (let power = memory_units.length; power >= 1; power--) {
		  			

		  			let byte_limit = Math.pow(1024, power)
		  			let byte_unit = memory_units[power]

		  			if (bytes > byte_limit) {
		  				let size = bytes / (1024 * power)
		  				return size + byte_unit
		  			}	
		  	}
		  	return bytes + " B"

		  }
    }

})