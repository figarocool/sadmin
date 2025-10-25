//VARIABILI GLOABLI
var i=0;
var scrOfX=0;
var scrOfY=0;

//DIV DINAMICA CHE COMPRENDE LA RICERCA
function apricerca(){
	var t=setTimeout("apridiv()", 0);
}

function apridiv(){
	i=i+10;
	if(i<=200){
		document.getElementById('divricerca').style.height = i;
		apricerca();
	}else{
		i=0;
		document.getElementById('divricerca').style.border= "0";
		document.getElementById('cercaprev').style.display= "none";
	}
}
//FINE RICERCA

//RICERCA DELL'UTENTE
//oscuramento della pagina
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
	document.getElementById("oscura").style.height = myHeight+scrOfY+200;
}
 
 function cercautente(){
	oscura();
	document.getElementById("scrivipagina").innerHTML="<iframe name='iframe' id='iframe' style='display:visible;position:absolute; top: "+(scrOfY+50)+"; right: 200px;' src='listautenti.php' height='400px' width='500px' FRAMEBORDER='0' SCROLLING='no'>";		
	return false;
}

function aggiorna(){
	window.location="gestionepreventivo.php";
} 
//FINE RICERCA UTENTE

/*RICERCA LISTA PRODOTTI*/
function selezioneprodotti(marca){
	document.getElementById('ricavoprodotti').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -10px; margin-top: -12px;\" src='selezioneprodotti.php?marca="+marca+"' height='40px' width='240px' FRAMEBORDER='0' SCROLLING='no'>";
}
/*FINE RICERCA*/
