function onjson(json){
	if(json.exists){
			console.log('Fetch error');
	}
	else console.log(json);
	location.reload();
}

function onResponse(response){
	if(response.ok){
			console.log('Post correctly published');
			return response.json();
	}else{
			console.log('Error posting response');
	}
}

function pub_post(event){

	const post = document.querySelector('.postusr');
	fetch('home2.php?post='+encodeURIComponent(post.value)).then(onResponse).then(onjson);
	console.log(post.value);
	event.preventDefault();
}

const pub = document.querySelector('button');
pub.addEventListener('click',pub_post);


function onjson_post(json){
	if(!json){
		console.log('Warning error posting');
	}else{
		console.log(json);
		const bigcontainer = document.querySelector('#main');
		bigcontainer.innerHTML = '';
		for(let i = 0 ; i < json.length ; i++){
			const user_txt = json[i].Username;
			const post_user = json[i].post;
			const time_post = json[i].post_time;

			const container = document.createElement('div');
			container.classList.add('cont_commento');
			const user = document.createElement('h3');
			user.classList.add('user');
			user.textContent ="User: "+ user_txt;

			const post_usr = document.createElement('h4');
			post_usr.classList.add('post_u');
			post_usr.textContent=post_user;

			const time = document.createElement('h3');
			time.textContent=time_post;


			container.appendChild(user);
			container.appendChild(post_usr);
			container.appendChild(time);
			bigcontainer.appendChild(container);
		}
	}
}

fetch('home2.php?stampa=ciao').then(onResponse).then(onjson_post);