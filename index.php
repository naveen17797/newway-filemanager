<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">


<div id="navbar_content">
	<title>{{ application_title }}</title>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light sticky-top">
	  <div class="container">
	    <a class="navbar-brand" href="#"><i class="fa fa-shield"></i> &nbsp;{{ application_title }}</a>
	  </div>
	</nav>
</div>

<?php 
	require_once 'components/login_component.html';
	require_once 'components/add_user_component.html';
	require_once 'components/registration_component.html';
?>


<div class="col-sm-12"  id="filemanager_area">
	<login-component v-if="is_logged_in == false && is_first_time_installation == false"></login-component>
	<add-user-component v-if="is_logged_in"></add-user-component>
	<registration-component v-if="is_first_time_installation" :api_url="api_url"></registration-component>
</div>

<script type="text/javascript">
	//load globals and enums
	const API_URL = "api/views.php";

	const ServerResponseCodes = {
		FirstTimeInstallation:10,
		LoggedIn:11,
		NotAuthenticated:12
	}

	const AccessLevels = {
			NoAccess: -1,
			ReadOnly: 0,
			ReadWrite: 1,
			ReadWriteDelete: 2,
			Admin: 3,
	}

	const ServerBinaryResponse =  {
		success:1,
		error:0
	}
</script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script>const event_bus = new Vue({})</script>
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="components/login_component.js"></script>
<script type="text/javascript" src="components/add_user_component.js"></script>
<script type="text/javascript" src="components/registration_component.js"></script>

<script>

	new Vue({
		el: "#filemanager_area",

		created() {
			this.getCurrentStateOnPageLoad()
			this.setUpRegistrationEventHander()
		},

		data: {
			is_logged_in: false,
			is_first_time_installation: false,
			api_url: API_URL
		},

		methods: 
		{
				setUpRegistrationEventHander() {
					event_bus.$on('registration', (server_response)=> {
						switch (server_response) {
							case ServerBinaryResponse.success:
								// registration success
								this.is_first_time_installation = false
								break;
							case ServerBinaryResponse.error:
								
								break;
							default:
								// statements_def
								break;
						}
					})
				},

				getCurrentStateOnPageLoad() {

					this.$http.post(API_URL, {"action":"get_current_status"}, {emulateJSON:true})
						.then(response=> {
							const server_response_code = response.body.return_code;
							switch (server_response_code) {
								case ServerResponseCodes.FirstTimeInstallation:
									this.is_first_time_installation = true
									break;
								case ServerResponseCodes.LoggedIn:
									this.is_logged_in = true
									break;
								case ServerResponseCodes.NotAuthenticated:
									this.is_logged_in = false
									break;
								default:
									break;					
							}
						})
				}
	

		}

	})
	new Vue({
		el: "#navbar_content",

		data: {
			application_title: "Newway File Manager"
		}

	})
</script>