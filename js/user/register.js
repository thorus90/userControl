$(document).ready(function(){
	$("body").on("click", ".select_lang",  function()
	{
		$("#language").val($(this).html());
		$("#language-real").val($(this).html());
	});
	if ( $('#messages').children().children('p').html() == "Benutzer wurde erstellt. Sie werden umgeleitet." )
	{
		setTimeout(
			function() {
				window.location.href = "cake/user/login";
			}, 3000 );
	}
});
