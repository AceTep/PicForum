document.addEventListener("DOMContentLoaded",function(){
	var trenutno = location.href.split("/").pop();
	if(trenutno == "")
	{
		trenutno = "index.html";
	}
	var stavke = document.querySelectorAll("#navigacija ul li a");
	for(var i=0; i<stavke.length; i++)
	{
		if(stavke[i].href.split("/").pop() == trenutno)
		{
			stavke[i].setAttribute("id","lokacija");
		}
	}
});
