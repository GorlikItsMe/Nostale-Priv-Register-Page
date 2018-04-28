/*Chcek username
id=user pattern='.{6,30} required'

respone id=user-result

*/
$(document).ready(function() {
			$("#user").keyup(function (e) {
				$(this).val($(this).val().replace(/\s/g, ''));
				var username = $(this).val();
				if(username.length < 6){$("#user-result").html(''); $("#user-result").css('visibility', 'hidden'); return;}
				if(username.length >= 6){
					$("#user-result").css('visibility', 'visible');
					$("#user-result").html('<i class="fa-li fa fa-spinner fa-spin"></i>');
					$.post('check.php', {'user':username}, function(data) {
					  $("#user-result").html(data);
					});
				}
			});	
		});

$(document).ready(function() {
			$("#mail").keyup(function (e) {
				$(this).val($(this).val().replace(/\s/g, ''));
				var username = $(this).val();
				if(username.length < 6){$("#mail-result").html(''); $("#mail-result").css('visibility', 'hidden'); return;}
				if(username.length >= 6){
					$("#mail-result").css('visibility', 'visible');
					$("#mail-result").html('<i class="fa-li fa fa-spinner fa-spin"></i>');
					$.post('check.php', {'mail':username}, function(data) {
					  $("#mail-result").html(data);
					});
				}
			});	
		});