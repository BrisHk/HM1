function onResponce(response) {
  return response.json();
}

function onJson(json) {
  console.log(json);
}

function elimina(event) {
  const id_fig = event.currentTarget.parentNode.querySelector('img').id;
  fetch('fav.php?id_carta=' + id_fig);
  fetch('fav.php?stampa_fav=ciao').then(onResponce).then(onJson);
  console.log(id_fig);
}

function onJson(json) {
  console.log(json);
  const libreria = document.querySelector('#album-view');
  libreria.innerHTML = '';
  console.log(json);

  if (json) {
    for (let i = 0; i < json.length; i++) {
      const album = document.createElement('div');
      album.classList.add('album');
      const inferiore = document.createElement('div');
      inferiore.classList.add('inf');
      const images = document.createElement('img');
      images.src = json[i].src;
      const pref = document.createElement('img');
      const id_carta = json[i].id;
      pref.setAttribute("id", id_carta);
      pref.src = 'pieno.png';

      //album.appendChild(set);
      album.appendChild(images);
      inferiore.appendChild(pref);
      album.appendChild(inferiore);
      libreria.appendChild(album);

      pref.addEventListener('click', elimina);
    }
  } else console.log('errore nella ricezione del json');
}

fetch('fav.php?stampa_fav=ciao').then(onResponce).then(onJson);