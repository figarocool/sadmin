	function oscura() {    
		if (navigator.appVersion.indexOf("MSIE")!=-1){         
			document.getElementById("oscura").style.width = screen.width;         
			document.getElementById("oscura").style.height = screen.height+100;    
		}    
		document.getElementById("oscura").style.display = "block";
	}
	function caricapagina(read){
		document.body.innerHTML+="<div name='scrivipagina' id='scrivipagina'><iframe name='iframe' id='iframe' style='display:visible;position:absolute; top: 200px; right: 200px;' src='newsletter.php?invio=1&news="+read+"' height='200px' width='470px' FRAMEBORDER='0' SCROLLING='no'></div>";		
		return false;
	}
	function aggiorna(){
		window.location="gestionenewsletter.php";
	}