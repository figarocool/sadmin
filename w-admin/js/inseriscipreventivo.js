var scrOfX=0;
var scrOfY=0;

function oscura() {
  //misura dello scroll
 // var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }

	
//misura della finestra	
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
	//Non-IE
	myWidth = window.innerWidth;
	myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
	//IE 6+ in 'standards compliant mode'
	myWidth = document.documentElement.clientWidth;
	myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
	//IE 4 compatible
	myWidth = document.body.clientWidth;
	myHeight = document.body.clientHeight;
  }
	document.getElementById("oscura").style.display = "block";
	document.getElementById("oscura").style.width = myWidth;         
	document.getElementById("oscura").style.height = myHeight+scrOfY;
}
 
 function caricapagina(){
	oscura();
	if (top.frames["scrivipagina"] == null) {
		document.body.innerHTML+="<div name='scrivipagina' id='scrivipagina'><iframe name='iframe' id='iframe' style='display:visible;position:absolute; top: "+(scrOfY+50)+"; right: 200px;' src='listaprodotti.php' height='500px' width='500px' FRAMEBORDER='0' SCROLLING='no'></div>";		
	} else {
		document.frames["scrivipagina"].style.display="";				 
	}	return false;
}

function aggiorna(){
	window.location="visualizzapreventivo.php";
}    