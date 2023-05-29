//Poke API
function onResponce(response) {
	console.log('Json ricevuto correttamente');
	return response.json();
}

function change_img(event) {
	event.preventDefault();
	const cambia = event.currentTarget;
	if (cambia.classList.contains('selected')) {
		cambia.src = "vuoto.png";
		cambia.classList.remove('selected');
		//togli_preferiti(event);
	} else {
		cambia.src = "pieno.png";
		cambia.classList.add('selected');
		const fdata = new FormData();
		src_img = event.currentTarget.parentNode.parentNode.querySelector('img').src;
		fdata.append("src", src_img);
		form_data = { method: "POST", body: fdata };
		fetch("home2.php", form_data);
	}
}

function onJson(json) {
	console.log('ALL GOOD');
	const libreria = document.querySelector('#album-view');
	libreria.innerHTML = '';
	const risultato = json.data;
	console.log(json);
	let conta = 0;

	for (result of risultato) {
		if (conta <= 5) {
			const img = result.images.large;
			const price = result.cardmarket.prices.averageSellPrice;
			const sets = result.set.name;
			if (img === null)
				break;
			const album = document.createElement('div');
			album.classList.add('album');
			const inferiore = document.createElement('div');
			inferiore.classList.add('inf');
			const images = document.createElement('img');
			const preferiti = document.createElement('img');
			preferiti.classList.add('unselected');
			preferiti.src = 'vuoto.png';
			const prezzo = document.createElement('text');
			prezzo.classList.add('pos');
			const set = document.createElement('text');
			set.textContent = 'Set : ' + sets;
			prezzo.textContent = 'Average price : ' + price + '$';
			images.src = img;
			preferiti.addEventListener('click', change_img);

			album.appendChild(set);
			album.appendChild(images);
			inferiore.appendChild(preferiti);
			inferiore.appendChild(prezzo);
			album.appendChild(inferiore);
			libreria.appendChild(album);
			conta = conta + 1;
		}
		else break;

	}
}

function searchPkmn(event) {
	event.preventDefault();

	const pkmn = document.querySelector('#search').value;
	const elemento = encodeURIComponent(pkmn);

	const url = `https://api.pokemontcg.io/v2/cards?q=name:` + elemento;

	fetch(url).then(onResponce).then(onJson);
}

const form = document.querySelector('form');
form.addEventListener('submit', searchPkmn);