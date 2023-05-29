function onjson(json){
	if(json.exists){
			console.log('Fetch error');
	}
	else console.log(json);
	location.reload();
}

function onResponse(response){
	if(response.ok){
			console.log('Message received successfully');
			return response.json();
	}else{
			console.log('Error on message received');
	}
}

function invia_testo(event){

	const msg = document.querySelector('#message');
	fetch('messages.php?msg='+encodeURIComponent(msg.value)).then(onResponse).then(onjson);
	console.log(msg.value);
	event.preventDefault();
}

const send = document.querySelector('button');
send.addEventListener('click',invia_testo);