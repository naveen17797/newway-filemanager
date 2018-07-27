var clickedItems = 0;
var items = new Array();
$("#rename_modal").iziModal({
	 title: 'Rename',
    subtitle: 'Rename the file/folder',
    headerColor: '#185cb5'
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

function updateClickedItems(clickedItems) {
	if (clickedItems > 0) {
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
		
	}
	else {
		
		$('#rename_button').removeAttr("disabled");
	}

}
