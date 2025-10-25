function sistemaprezzo(read,idtext){
	//Controllo se il prezzo è stato inserito con il punto
	if(read.search(",")==-1){
		idtext.value;
	}else{
		pos=read.indexOf(',');
		modifica=read.replace(read,read.substr(0,pos)+'.');
		idtext.value=modifica;
	}
}	