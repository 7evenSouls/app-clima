loadEstaciones().then(estaciones => {
	if (estaciones.errno == 200) {
		estaciones.data.forEach(estacion => {
			createEstacion(estacion);
		});
	}
	else {
		listado.innerHTML = '<h3>Sin estaciones</h3>';
	}
});


async function loadEstaciones() {
	const response = await fetch('api2/Station/GetStationList');
	const data = await response.json();
	
	return data;
}


function createEstacion(data) {
	const tpl = tpl__estacion.content;
	const clon = tpl.cloneNode(true);
	clon.querySelector('.card__title').textContent = data.apodo;
	clon.querySelector('.card__location').textContent = data.ubicacion;
	clon.querySelector('.card__views').textContent = data.visitas;
	clon.querySelector('.card').href = 'panel.html?chipid=' + data.chipId;
	listado.appendChild(clon);
}