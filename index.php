<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<?php 
	require_once 'components/login_component.html';
	require_once 'components/add_user_component.html';
	require_once 'components/registration_component.html';
	require_once 'components/alert_component.html';
	require_once 'components/file_folder_component.html';
	require_once 'components/upload_component.html';
?>
<style type="text/css">
	td.file_folder_item:hover {
		background-color: rgba(0,0,130, 0.2);
	}
	.bigger_icon {
		font-size: 70px;
	}

	.borderless td, .borderless th {
	    border: none;
	}

	.selected_option {
		background-color: rgba(0,0,130, 0.2);
	}
</style>


		<div  id="filemanager_area" class="">

			<title>{{ application_title }}</title>

			<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light sticky-top">
			  <div class="container">
			    <a class="navbar-brand" href="#"><i class="fa fa-shield"></i> &nbsp;{{ application_title }}</a>
			  </div>
			</nav>

			<alert-component :alert_title="alert_object.title" :alert_description="alert_object.description" :alert_type="alert_object.type"></alert-component>
			<login-component v-if="is_logged_in == false && is_first_time_installation == false" :api_url="api_url"></login-component>
			
			<registration-component v-if="is_first_time_installation" :api_url="api_url"></registration-component>
			<br/><br/>

			<div class="container-fluid" v-if="is_logged_in">
				<div class="row">
					<div class="col-sm-3">
						<table class="table borderless">
							<tr>
								<td @click="changeFileViewState()" style="cursor: pointer" :class="{selected_option:is_list_view}"><i class="fa fa-list-alt" ></i>&nbsp; List View</td>
								<td @click="changeFileViewState()" style="cursor: pointer" :class="{selected_option:(is_list_view == false)}"><i class="fa fa-square"></i>&nbsp; Grid View</td>
							</tr>
						</table>

						<add-user-component></add-user-component>
					</div>
					<div class="col-sm-9" v-if="is_file_folder_data_ready">
						<file-folder-component :files_and_folders_prop="files" :is_list_view="is_list_view"></file-folder-component>
						<upload-component></upload-component>
					</div>
				</div>
			</div>
			
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

	const AlertType = {
		Success:"alert-success",
		Failure:"alert-danger",
		Warning:"alert-warning"
	}

	const LoginError = {
		EmailIncorrect:13,
		PasswordIncorrect:14,
	}

</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script>const event_bus = new Vue({})</script>
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="components/login_component.js"></script>
<script type="text/javascript" src="components/add_user_component.js"></script>
<script type="text/javascript" src="components/registration_component.js"></script>
<script type="text/javascript" src="components/alert_component.js"></script>
<script type="text/javascript" src="components/file_folder_component.js"></script>
<script type="text/javascript" src="components/upload_component.js"></script>
<script>

	new Vue({
		el: "#filemanager_area",

		created() {
			this.getCurrentStateOnPageLoad()
			this.setUpRegistrationEventHander()
			this.setUpLoginEventHandler()
		},

		data: {
			is_list_view: false,
			is_logged_in: false,
			is_first_time_installation: false,
			api_url: API_URL,
			alert_object: {
				"title":"",
				"description":"",
				"type":AlertType.Success
			},
			application_title: "Newway File Manager",
			current_user:null,
			files:[],
			is_file_folder_data_ready: false,
		},

		watch: {

			is_logged_in: function(newValue, oldValue) {
				console.log("watcher activated")
				//console.log('old value is ' + oldValue)
				console.log('new value is '+ newValue)
				if (newValue) {
					// if logged in then get files
					this.getFilesAndFolders()
				}
			}

		},

		methods: 
		{


				setUpLoginEventHandler() {
					event_bus.$on('login', (server_response)=> {
						server_response = parseInt(server_response)
						switch (server_response) {
							case LoginError.EmailIncorrect:
								// registration success
								this.is_first_time_installation = false
								this.alert_object.title = "Failure"
								this.alert_object.description = "Entered email didnt match any registered users"
								this.alert_object.type = AlertType.Failure
								break;
							case LoginError.PasswordIncorrect:
								this.alert_object.title = "Failure"
								this.alert_object.description = "Entered password is wrong, recheck your password"
								this.alert_object.type = AlertType.Failure
								break;
							case ServerResponseCodes.LoggedIn:
								this.is_logged_in = true
								break;
							default:
								// statements_def
								break;
						}
					})
				},


				setUpRegistrationEventHander() {
					event_bus.$on('registration', (server_response)=> {
						server_response = parseInt(server_response)
						switch (server_response) {
							case ServerBinaryResponse.success:
								// registration success
								this.is_first_time_installation = false
								this.alert_object.title = "Success"
								this.alert_object.description = " You have been successfully registered, please login"
								this.alert_object.type = AlertType.Success
								break;
							case ServerBinaryResponse.error:
								this.alert_object.title = "Registration Failure"
								this.alert_object.description = "Please Check Your File Permissions"
								this.alert_object.type = AlertType.Failure
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
									console.log('logged in ')
									this.is_logged_in = true
									break;
								case ServerResponseCodes.NotAuthenticated:
									this.is_logged_in = false
									break;
								default:
									break;					
							}
						})
				},


				getFilesAndFolders() {
					const file_object = {
						"action":"get_files"
					}
					this.$http.post(API_URL, file_object, {emulateJSON:true}).then(response=> {
						const server_response = response.body;
						if (Array.isArray(server_response)) {
							Vue.set(this, "files", server_response)
							console.log(server_response)
							this.is_file_folder_data_ready = true
						}
						else {
							console.log('not array')
						}
					})

				},


				changeFileViewState() {
					this.is_list_view = !this.is_list_view;
					console.log(this.is_list_view)
				}
	

		}

	})
</script>