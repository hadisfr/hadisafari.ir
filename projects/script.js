/*
	© 2016 Hadi Safari
	
	http://hadisafari.ir
	info[at]hadisafari.ir
*/
var tc = 0, ti = 10;
$(document).ready(function(){
	$("#lm").text(lastModified);
	(function loadpagedata(){
		for(i in projlist)
			$("#projlist").append("<tr>\
				<td class=\"timer md\">-rw-r--r--</td>\
				<td class=\"timer\">Hadi Safari" + projlist[i].others + "</td>\
				<td><a class=\"timer\" href=\"javascript: void();\" data-link=" + projlist[i].link + ">" + projlist[i].name + "</a></td>\
				<td class=\"timer\">" + projlist[i].date + "</td>\
				<td class=\"timer\">" + projlist[i].det + "</td>\
				</tr>");
		writeterminal();
	})();
	function writeterminal(){
		$(".timer").each(function(){
			var str = $(this).text();
			$(this).text("");
			for(i in str){
				(function (j, o){
					setTimeout(function(){
						o.text(o.text() + str[j]);
						o.removeClass("hide");
						$(".timer").removeClass("active");
						o.addClass("active");
					}, tc += ti);
				})(i, $(this));
			}
		});
		setTimeout(function(){
			$(".timer").removeClass("timer");
			$("#terminal .hide").removeClass("hide");
		}, tc);
		tc = 0;
	}
	$("#projlist tr a").click(function(event){
		if($(".timer").length)
			return false;
		event.preventDefault();
		$("#terminal p.terminal:last-child").text("cat " + $(this).text());
		$("#terminal p.terminal:last-child").addClass("timer");
		$.get($(this).data("link"), function(d){
			$("#terminal").append("<div class=\"hide\">" + d + "<div>");
		})
		.fail(function(dd){
			$("#terminal").append($("<p class=\"timer hide\">cat: No such file or directory</p>"));
		})
		.always(function(){
			$("#terminal").append($("<p class=\"terminal timer hide\">&nbsp;</p>"));
			writeterminal();
		});
	});
});
