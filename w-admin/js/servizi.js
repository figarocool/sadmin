function servizi(read){
	document.getElementById('a').style.visibility = 'hidden';
	document.getElementById('b').style.visibility = 'hidden';
	document.getElementById('c').style.visibility = 'hidden';
	document.getElementById('d').style.visibility = 'hidden';
	document.getElementById('1').style.visibility = 'hidden';
	document.getElementById('2').style.visibility = 'hidden';
	document.getElementById('3').style.visibility = 'hidden';
	document.getElementById('4').style.visibility = 'hidden';
	document.getElementById('1').style.color = '#000000';
	document.getElementById('2').style.color = '#000000';
	document.getElementById('3').style.color = '#000000';
	document.getElementById('4').style.color = '#000000';
	document.getElementById('desca').style.visibility = 'hidden';	
	document.getElementById('descb').style.visibility = 'hidden';	
	document.getElementById('descc').style.visibility = 'hidden';	
	document.getElementById('descd').style.visibility = 'hidden';
	document.getElementById('descrizione').style.visibility = 'visible';	
	switch(read) { 
		case "1": 
			document.getElementById('a').style.visibility = 'visible';
			document.getElementById('1').style.color = '#ff0000';
			document.getElementById('1').style.visibility = 'visible';
			document.getElementById('desca').style.visibility = 'visible';
		break; 

		case "2": 
			document.getElementById('b').style.visibility = 'visible';
			document.getElementById('2').style.color = '#ff0000';
			document.getElementById('2').style.visibility = 'visible';
			document.getElementById('descb').style.visibility = 'visible';
		break;  
	  
		case "3": 
			document.getElementById('c').style.visibility = 'visible';
			document.getElementById('3').style.color = '#ff0000';
			document.getElementById('3').style.visibility = 'visible';
			document.getElementById('descc').style.visibility = 'visible';
		break; 
		
		case "4": 
			document.getElementById('d').style.visibility = 'visible';
			document.getElementById('4').style.color = '#ff0000';
			document.getElementById('4').style.visibility = 'visible';
			document.getElementById('descd').style.visibility = 'visible';
		break; 

	}
}	

function attivascritte(){	
	document.getElementById('1').style.visibility = 'visible';
	document.getElementById('2').style.visibility = 'visible';
	document.getElementById('3').style.visibility = 'visible';
	document.getElementById('4').style.visibility = 'visible';
}