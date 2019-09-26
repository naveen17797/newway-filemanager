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


		},

		showUploadModal() {
			
			event_bus.$emit('show-upload-modal')
		}

	},

	filters: {

		  user_friendly_memory_format_filter: function (num) {

		  	  if (typeof num !== 'number' || isNaN(num)) {
			    throw new TypeError('Expected a number');
			  }

			  var exponent;
			  var unit;
			  var neg = num < 0;
			  var units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

			  if (neg) {
			    num = -num;
			  }

			  if (num < 1) {
			    return (neg ? '-' : '') + num + ' B';
			  }

			  exponent = Math.min(Math.floor(Math.log(num) / Math.log(1000)), units.length - 1);
			  num = (num / Math.pow(1000, exponent)).toFixed(2) * 1;
			  unit = units[exponent];

			  return (neg ? '-' : '') + num + ' ' + unit;


		  },

		  user_friendly_date: function (timestamp) {
		  	return new Date(timestamp).toGMTString()
		  }
    }

})