Vue.component('login-component', {

	template: "#login_component_template",

	data: function () {
		return  {
			email: "",
			password:""
		}
	},

	props: {
		api_url:""
	},

	methods: {
		loginUser() {

			const login_object = {
				"action":"login_user",
				"email":this.email,
				"password":this.password,
			}

			this.$http.post(this.api_url, login_object, {emulateJSON:true})
				.then(response=> {
					const server_response = response.body
					event_bus.$emit('login', server_response)
				})

		}

	}

})