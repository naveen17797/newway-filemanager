Vue.component('upload-component', {

	template: "#upload_component_template",

	props: {
		api_url: {
			type:String,
			default: ""
		},
		
		current_directory: {
			type:String,
			default: ""
		}
	},

	created() {

		event_bus.$on('show-upload-modal', ()=> {

			$('#upload_modal').modal('show')
		})

	},

	methods: {
		previewFiles(event) {
			let choosen_files = event.target.files
			for (file of choosen_files) {
				this.choosen_files.push(file)
			}
			this.resetFiles()
		},

	  	resetFiles() {
	    	const input = this.$refs.fileInput
	    	input.type = 'text'
	    	input.type = 'file'
	  	},

	  	submitFiles() {
	  		let formdata = new FormData();
	  		// converting to set in order to prevent duplicates
			let choosen_files = [...new Set(this.choosen_files)];	
		    for( var i = 0; i < choosen_files.length; i++ ){
		        let file = choosen_files[i];
		        formdata.append('file[' + i + ']', file);
		    }

		    formdata.append('action', 'upload_files')
		    formdata.append('directory', this.current_directory)
		    let config = {
		    	
		    	'Content-Type': 'multipart/form-data',
		    	
		    	progress(e) {
				    if (e.lengthComputable) {
				    	this.completed_progress = (e.loaded / e.total ) * 100
				    }
				}
		    }

		    this.$http.post(this.api_url, formdata, config)
		    .then(response=> {
		    	
		    	this.completed_progress = 100
		    	
		    	
		    	
		    	this.alert_message = choosen_files.length + " files uploaded successfully"
		    	let self = this
		    	event_bus.$emit('refresh-current-directory-data')
		    	setTimeout(function(){ 
		    		Vue.set(self, "alert_message", "")
		    		Vue.set(self, "choosen_files", [])
		    	}, 2000);

		    })

	  	},

	  	removeFile(index) {
	  		 this.$delete(this.choosen_files, index)
	  	}		

	},

	data: function () {
		return  {

			choosen_files: [],

			completed_progress: 0,

			alert_message: "",

		}
	}

})