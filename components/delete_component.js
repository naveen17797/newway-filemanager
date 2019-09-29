Vue.component('delete-component', {

	template: "#delete_component_template",

	props: {
		api_url: {
			type:String,
			default: ""
		},
		
		choosen_files: {
			type:Array,
			default: []
		},

	},


	created() {

		event_bus.$on('show-delete-modal', ()=> {
			// before showing the model, 
			// clear the stats about the recently deleted files
			Vue.set(this, "deleted_files", [])
			$('#delete_modal').modal('show')
		})

	},

	methods: {

		confirmDeleteFiles() {

			const delete_object = {
				action: 'delete_items',
				file_list: this.choosen_files
			}

			// reset deleted files
			Vue.set(this, "deleted_files", [])

			this.$http.post(this.api_url, delete_object, {emulateJSON:true})
			.then(response=> {
				const deleted_files_statistics = response.body
				Vue.set(this, "deleted_files", deleted_files_statistics);
				event_bus.$emit('refresh-current-directory-data');
			})

		}

	},

	data: function () {
		return  {

			deleted_files:[],

		}
	}

})