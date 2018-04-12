$(document).ready(function(){
	function parselang(){
		var str = location.search;
		var s = str.indexOf("lang=");
		if(s == -1)
			return 1;
		var r = str.substr(s + 5, 2);
		if(r === "en")
			return 1;
		else if(r ==="fa")
			return 2;
		else return 1;
	}
	function setlang(){
		$(".cnt").addClass("hide");
		$(".cnt").eq(parselang() - 1).removeClass("hide");
	}
	setlang();
});