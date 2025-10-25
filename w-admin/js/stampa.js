function Stampa() {
     //Nasconde le celle indesiderate
        indietro.style.display = "None";
     //Lancia la funzione di stampa
        window.print();
     //Ripristina l'impostazione iniziale delle celle indesiderate
        indietro.style.display = "";
}

