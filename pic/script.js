/*
	© 2016 Hadi Safari
	
	http://hadisafari.ir
	info[at]hadisafari.ir
*/
$(document).ready(function(){
	if(!piclist.length)
		location.href = ".";
	for(var i = 0, j = 0, h = [0, 0, 0, 0]; i < piclist.length; i++){
		var node = "<div class=\"box\"><img src=" + piclist[i] + ">";
		if(typeof(det) !== "undefined" && det[piclist[i].substr(piclist[i].lastIndexOf("/") + 1)])
			node += "<div class=\"det\">" + det[piclist[i].substr(piclist[i].lastIndexOf("/") + 1)] + "</div>";
		node += "</div>";
		$(".col").eq(j % 3).append(node);
		var ht = $(".col").eq(j % 3).children(".box").last().children("img").height()
		h[j % 3] += ht;
		h[3] += ht;
		if(h[j % 3] > h[3] / 3)
			j++;
	}
	address = address.replace(/\//g, "*");
	$("#sidemenu a[href*=\"" + address + "\"]").parentsUntil("#sidemenu").addClass("show");
	$("#sidemenu a[href*=\"" + address + "\"]").parent().addClass("active");
	$(".box").click(function(){
		$("#msgbox img").attr("src", $(this).children("img").attr("src").replace(/thumb\//g, ""));
		$("#msgdet").text($(this).children(".det").text());
		$("#msgbox").width($("#msgbox img").width());
		$("#msgbox").css("margin-top", ($(window).height() - $("#msgbox").height()) / 2);
		$("#msgback").addClass("show");
	});
	setInterval(function(){
			$("#msgbox").width($("#msgbox img").width());
			$("#msgbox").css("margin-top", ($(window).height() - $("#msgbox").height()) / 2);
		}, 100);
	$("#msgback").click(function(){
		$(this).removeClass("show");
	});
	$("#msgbox").click(function(event){
		event.stopPropagation();
	});
	$("ul#sidemenu li ul").parent().children("a").each(function(){
		$(this).attr("href", "javascript: void();");
	});
	$("ul#sidemenu li ul").parent().children("a").click(function(event){
		event.preventDefault();
		$(this).parent().children().toggleClass("show");
	});
	$("#menutoggle").click(function(event){
		event.preventDefault();
		$(this).toggleClass("active");
		$("#sidebar").toggleClass("show");
	});
});