function changeVideo(target, formats) {
	var tab_formats = formats.split(',');
	var div = document.getElementById(target);
	var chaineHTML = "Format vidéo : <select name='format'> \
		<option value='tous'>Tout format</option>";
	for (var i in tab_formats) {
		chaineHTML = chaineHTML + "<option value='" + tab_formats[i] + "'>" + tab_formats[i] + "</option>";
	}
	chaineHTML = chaineHTML + "</select><br>Durée : <select name='duree'>\
	<option value='1'>Moins d'une heure</option>\
	<option value='2'>Entre une et deux heures</option>\
	<option value='3'>Plus de deux heures</option></select>";
	div.innerHTML = chaineHTML;
}

function changeTexte(target) {
	var div = document.getElementById(target);
	var chaineHTML = "Auteur : <input type='text' name='auteur'/>";
	div.innerHTML = chaineHTML;
}

function changeSonore(target, formats) {
	var tab_formats = formats.split(',');
	var div = document.getElementById(target);
	var chaineHTML = "Format audio : <select> \
		<option value='tous'>Tout format</option>";
	for (var i in tab_formats) {
		chaineHTML = chaineHTML + "<option value='" + tab_formats[i] + "'>" + tab_formats[i] + "</option>";
	}
	chaineHTML = chaineHTML + "</select><br>Durée : <select name='duree'>\
	<option value='1'>Moins de trois minutes</option>\
	<option value='2'>Entre trois et cinq minutes</option>\
	<option value='3'>Plus de cinq minutes</option></select>";
	div.innerHTML = chaineHTML;
}

function resetDiv(target) {
	var div = document.getElementById(target);
	var chaineHTML = "";
	div.innerHTML = chaineHTML;
}