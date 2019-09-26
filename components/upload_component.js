Vue.component('upload-component', {

	template: "#upload_component_template",


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
	  	}		

	},

	data: function () {
		return  {

			choosen_files: [],

		}
	}

})