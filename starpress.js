$(document).ready(function() {

	// lorsque l'on clique sur a on r�cup�re la variable qui correspont � l'idd pour l'affecter aux diff�rentes classes 
	$("a").filter("[@class^=montre_]").click(function(event){
var monId=$(this).attr("class");
    var idd = monId.split('_');

	event.preventDefault();
	// on affecte la fonction "toogle" a l'objet de classe "cache"
		$("#cache_"+idd[1]).toggle("slow");
		// si le texte indiqu� est voir on le remplace par masqu�, on cache l'image 2 et l'on montre l'image 1
		if($("#toggletexte_"+idd[1]).html()==texte1) {
			$("#toggletexte_"+idd[1]).html(texte2);
			$("#img1_"+idd[1]).hide();
			$("#img2_"+idd[1]).show();
		} else {
			// sinon on �crit "voir" , on montre l'image 1 et l'on cache l'image 2 
			$("#toggletexte_"+idd[1]).html(texte1);
			$("#img1_"+idd[1]).show();
			$("#img2_"+idd[1]).hide();
		}
	});
});