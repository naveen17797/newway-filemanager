Vue.component('registration-component', {

	template: "#registration_component_template",

	data: function () {
		return  {
			email: "",
			password:"",
		}
	},

	props: {
		api_url: {
			type:String,
			default: ""
		}
	},

	methods: {
		registerNewUser() {

			const registration_object = {
				"action":"register_new_user",
				"email":this.email,
				"password":this.password,
				"access_level":AccessLevels.Admin
			}

			this.$http.post(this.api_url, registration_object, {emulateJSON:true})
				.then(response=> {
					console.log(response.body)
				})

		}
	}
})