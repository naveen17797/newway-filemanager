var clickedItems = 0;
var items = new Array();

$("#rename_modal").iziModal({
	 title: 'Rename',
    subtitle: 'Rename the file/folder',
    headerColor: '#185cb5'
});

$("#delete_modal").iziModal({
	 title: 'Delete',
    subtitle: 'Delete these files/folders',
    headerColor: '#FF0000'
});

$('#create_folder_modal').iziModal({
	 title: 'Create',
    subtitle: 'Create new Folder',
    headerColor: '#185cb5'

});

$('#add_users_modal').iziModal({
	 title: 'Add users',
    subtitle: 'Add users to your file manager',
    headerColor: '#185cb5',
   	width: '1000'

});

$('tr').click(function () {
	if ($(this).hasClass('heading')) {

	}
	else {
		if($(this).hasClass('highlighted')) {
			$(this).css("background-color", "#fff");
			$(this).css("color", "black");
			$(this).removeClass("highlighted");
			clickedItems = clickedItems - 1;
			var fullname = $(this).closest('tr').children('td:first').attr("id");
			items.splice(items.indexOf(fullname), 1);
			updateClickedItems(clickedItems);
		}
		else {
			$(this).css("background-color", "#0080FF");
			$(this).css("color", "white");
			$(this).addClass("highlighted");
			clickedItems = clickedItems + 1;
			updateClickedItems(clickedItems);
			var fullname = $(this).closest('tr').children('td:first').attr("id");
			items.push(fullname);
		}
	}

});

$('#rename_button').click(function () {
	if (clickedItems == 0 || clickedItems > 1) {
		alert("More Items Cant be Renamed, choose a single file/folder");
	}
	else {
		$('#rename_oldname').text(items[0]);
		$("#rename_modal").iziModal('open');

	}
});

$('#delete_button').click(function () {
	if (clickedItems != 0) {
		$('#deletable_files').html("These Files/Folders Will be Deleted Permanently <br/><br/>" + makeArrayToList(items));
		$('#delete_modal').iziModal("open");
	}
});

$('#submit_delete').click(function () {
	var i = 0;
	if(clickedItems != 0){
		while (i < items.length) {
			$.post("ajax_file_functions.php", {delete_filename:rootDir+items[i]}, function(result){
				$('#delete_modal').iziModal("close");
				iziToast.success({
			    	title: 'Done',
			    	message: "Deleted all the chosen files"
				});
				window.location = "index.php?directory=" + rootDir;
	    	});
	    	i = i + 1;
		}
	}
});

$('#submit_rename').click(function () {
	var oldname = items[0];
		var newname = $('#rename_newname').val();
		 $.post("ajax_file_functions.php", {rename_oldname:rootDir+oldname, rename_newname:rootDir+newname}, function(result){
		 	if (result == "1") {
		 		iziToast.success({
			    	title: 'Done',
			    	message: "Renamed from " + oldname + " to " + newname
				});
				$("#rename_modal").iziModal('close');
				window.location = "index.php?directory=" + rootDir;
		 	}
		 	else {

		 		iziToast.Error({
			    	title: 'Error',
			    	message: "Renamed from " + oldname + " to " + newname
				});
		 		$("#rename_modal").iziModal('close');
		 		window.location = "index.php?directory=" + rootDir;
		 	}

    	});
});

$('#create_folder').click(function () {
	$('#create_folder_modal').iziModal("open");
});

$('#submit_new_folder').click(function () {
	var folder_name = $('#new_folder_name').val();
	folder_name  = rootDir + folder_name;
	 $.post("ajax_file_functions.php", {new_folder_name:folder_name}, function(result){
		 	if (result == "1") {
		 		iziToast.success({
			    	title: 'Done',
			    	message: "Folder Created"
				});
				$("#create_folder_modal").iziModal('close');
				window.location = "index.php?directory=" + rootDir;
		 	}
		 	else {

		 		$("#create_folder_modal").iziModal('close');
		 		window.location = "index.php?directory=" + rootDir;
		 	}

    	});

});

$('#submit_add_user').click(function () {
	var email = $('#add_user_email').val();
	var password = $('#add_user_password').val();
	var access_level = $('#add_user_access_level option:selected').val();


	 $.post("ajax_file_functions.php", {add_user_email:email, add_user_password:password, add_user_access_level:access_level}, function(result){
		if (result == "1") {
				iziToast.success({
			    	title: 'Done',
			    	message: "The user " + email + " has been added"
				});
				refreshCurrentUsers();
		}
		else {
			iziToast.success({
			    	title: 'Error',
			    	message: result
			});
		}

    });

});

$('#add_users').click(function () {
	$('#add_users_modal').iziModal("open");
});

$(document).on("click", ".delete_user", function () {
	var user_email = $(this).attr('id');
	 $.post("ajax_file_functions.php", {user_email: user_email}, function(result){
		if (result == "1") {
				iziToast.success({
			    	title: 'Done',
			    	message: "The user " + user_email + " has been removed"
				});
				refreshCurrentUsers();
		}
		else {
			iziToast.success({
			    	title: 'Error',
			    	message: result
			});
		}

    });

});

function updateClickedItems(clickedItems) {
	if (clickedItems > 0) {
		$('#delete_button').removeAttr("disabled");
		$('#item_selected_notification').html("<i class='fa fa-check'></i> " + clickedItems + " items selected");
		$('#item_selected_notification').css("display", "block");
		if (clickedItems == 1) {
			$('#rename_button').removeAttr("disabled");
		}
		else {
			$('#rename_button').attr("disabled", "true");
		}

	}
	else if (clickedItems == 0) {
		$('#item_selected_notification').css("display", "none");
		$('#rename_button').attr("disabled", "true");
		$('#delete_button').attr("disabled", "true");

	}
	else {

		$('#rename_button').removeAttr("disabled");
	}

}

function makeArrayToList(itemsi) {
	var i = 0;
	var returnText="<table class='table table-condensed text-center'>";
	while (i < itemsi.length) {
		returnText = returnText +  "<tr class='danger'><td>" + items[i]  + "</td></tr>";
		i = i + 1;
	}
	returnText = returnText +  "</table>";
	return returnText;
}

function refreshCurrentUsers() {
	$.post("ajax_file_functions.php", {get_users_list: "fetch"}, function(result){
		$('#existing_users').html(result);

    });

}

refreshCurrentUsers();
