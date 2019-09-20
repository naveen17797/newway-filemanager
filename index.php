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
?>


<div class="col-sm-12 bg-dark color-light" style="height: 100%;" id="filemanager_area">
	<login-component></login-component>
	<add-user-component></add-user-component>
</div>

<script type="text/javascript" src="js/vue.js"></script>
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="components/login_component.js"></script>
<script type="text/javascript" src="components/add_user_component.js"></script>

<script>
	new Vue({
		el: "#filemanager_area",

	})
	new Vue({
		el: "#navbar_content",

		data: {
			application_title: "Newway File Manager"
		}
	})
</script>