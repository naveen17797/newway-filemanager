Vue.component('add-user-component', {

	template: "#add_user_component_template",

	props: {
		api_url : {
			type: String,
			default: ""
		},

		files_and_folders_prop: {
			type:Array,
			default:[]
		},

		directory_separator: "",
	},

	created() {
		this.getAllUsers();

	},

	data: function () {
		return  {
			email: "",
			password:"",
			access_level:"",
			all_users: [],
			allowed_directories:[],
			current_allowed_directory:"",
		}
	},

	methods: {

		addToAllowedDirectoryList() {
			const directory = this.$refs.allowed_directory.value
			if (!this.allowed_directories.includes(directory) && directory != "") {
				this.allowed_directories.push(directory)
				this.$refs.allowed_directory.value = ""
			}
		},

		removeFromAllowedFolderList(path) {

			const index = this.allowed_directories.indexOf(path)
			if (index != -1) {
				this.$delete(this.allowed_directories, index)
			}

		},


		shortenTextOfPath(text) {
			const paths = text.split(this.directory_separator)
			var current_path_name = paths[paths.length - 2]
			return current_path_name
		},

		addNewUser() {

			const registration_object = {
				action: "add_new_user",
				email: this.email,
				password: this.password,
				access_level: this.access_level,
				allowed_directories: this.allowed_directories,
			}

			this.$http.post(this.api_url, registration_object, {emulateJSON:true})
			.then(response=> {
				const result = response.body
				// resetting ui after user creation
				this.getAllUsers()
				this.email = ""
				this.password = ""
				this.access_level =""
				Vue.set(this, "allowed_directories", [])
			
			})

		},

		getAllUsers() {
			this.$http.post(this.api_url, {action: "get_users"}, {emulateJSON: true})
			.then(response=> {
				Vue.set(this, "all_users", response.body)
			})
		},

		deleteUser(email) {
			this.$http.post(this.api_url, 
				{action:"delete_user", email:email}, {emulateJSON:true})
			.then(response=> {
				this.getAllUsers()
			})
		}
	},

})