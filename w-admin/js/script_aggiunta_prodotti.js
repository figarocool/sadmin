var num_prod_tmp = 0;
		
		function aggiungi_prodotto(){
			num_prod_tmp = num_prod_tmp + 1;
			var tabella = document.getElementById("lista_tutti_prodotti");
			var riga = document.createElement("tr");
			riga.paddingTop = "2px";
			var cella = document.createElement("td");
			//Creo la parte di L
			var txtL = document.createTextNode("L: ");
			var inputBoxL = document.createElement("input");
			inputBoxL.setAttribute("type", "text");
			inputBoxL.setAttribute("id", "l");
			inputBoxL.setAttribute("name", "prodottoNuovo["+num_prod_tmp+"][l]");
			inputBoxL.setAttribute("value", "");
			inputBoxL.setAttribute("size", "2");
			//Creo la parte di P
			var txtP = document.createTextNode(" P: ");
			var inputBoxP = document.createElement("input");
			inputBoxP.setAttribute("type", "text");
			inputBoxP.setAttribute("id", "p");
			inputBoxP.setAttribute("name", "prodottoNuovo["+num_prod_tmp+"][p]");
			inputBoxP.setAttribute("value", "");
			inputBoxP.setAttribute("size", "2");
			//Creo la parte di H
			var txtH = document.createTextNode(" H: ");
			var inputBoxH = document.createElement("input");
			inputBoxH.setAttribute("type", "text");
			inputBoxH.setAttribute("id", "h");
			inputBoxH.setAttribute("name", "prodottoNuovo["+num_prod_tmp+"][h]");
			inputBoxH.setAttribute("value", "");
			inputBoxH.setAttribute("size", "2");
			//Creo la parte di D
			var txtD = document.createTextNode(" D: ");
			var inputBoxD = document.createElement("input");
			inputBoxD.setAttribute("type", "text");
			inputBoxD.setAttribute("id", "d");
			inputBoxD.setAttribute("name", "prodottoNuovo["+num_prod_tmp+"][d]");
			inputBoxD.setAttribute("value", "");
			inputBoxD.setAttribute("size", "2");
			//Creo la parte per il nome
			var txtNome = document.createTextNode(" Nome: ");
			var inputBoxNome = document.createElement("input");
			inputBoxNome.setAttribute("type", "text");
			inputBoxNome.setAttribute("id", "nome_prodotto");
			inputBoxNome.setAttribute("name", "prodottoNuovo["+num_prod_tmp+"][nome_prod_tmp]");
			inputBoxNome.setAttribute("value", "");
			inputBoxNome.setAttribute("size", "53");
			//Appendo tutto
			cella.appendChild(txtL);
			cella.appendChild(inputBoxL);
			cella.appendChild(txtP);
			cella.appendChild(inputBoxP);
			cella.appendChild(txtH);
			cella.appendChild(inputBoxH);
			cella.appendChild(txtD);
			cella.appendChild(inputBoxD);
			cella.appendChild(txtNome);
			cella.appendChild(inputBoxNome);
			riga.appendChild(cella);
			tabella.appendChild(riga);
		}