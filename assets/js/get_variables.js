/* 
// FUNZIONE CHE PERMETTE IL GET DELLE VARIABILI
// By Matteo Bernardini
// Last update 06/08/11
*/

function GETvars(key) {
 key = key || null;

 var querystring=location.search.split("?")[1];
 var GET=new Array(); //definisce l'array
 if (querystring!=undefined) { //esegue il codice solo se sono stati passati effettivamente dei valori
  var parametri=querystring.split("&"); //separa le coppie "var=val"
  for (i=0; i < parametri.length; i++)
   {
    var parametro = parametri[i].split("="); //separa "var" da "val"
    GET[unescape(parametro[0])] = unescape(parametro[1]); //inserisce nell'array "val" con indice "var"
   }
 }
 if (key!=null) return GET[key];
 else return GET;
}