$(document).ready(function(){

	$('.accesiut').click(showAccesIUT);
	$('.hotels').click(showHotels);
	$('.restauration').click(showResto);
	$('.transports').click(showTransports);
	$('.tourisme').click(showTourisme);
	$('.acceswifi').click(showAccesWifi);
	$('.chartes').click(showChartes);

});

function showAccesIUT(){
		console.log("Acces IUT")
		$('.conteneur-informationspratiques-div').hide();
		$('#accesiut').fadeIn(200);
}

function showHotels(){
		console.log("Hotels")
		$('.conteneur-informationspratiques-div').hide();
		$('#hotels').fadeIn(200);
}

function showResto(){
		$('.conteneur-informationspratiques-div').hide();
		$('#restauration').fadeIn(200);
}

function showTransports(){
		$('.conteneur-informationspratiques-div').hide();
		$('#transports').fadeIn(200);
}

function showTourisme(){
		$('.conteneur-informationspratiques-div').hide();
		$('#tourisme').fadeIn(200);
}

function showAccesWifi(){
		$('.conteneur-informationspratiques-div').hide();
		$('#acceswifi').fadeIn(200);
}

function showChartes(){
		$('.conteneur-informationspratiques-div').hide();
		$('#chartes').fadeIn(200);
}