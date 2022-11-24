const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const chipid = urlParams.get('chipid');

document.addEventListener('DOMContentLoaded', () => {

    hideAllPropertiesExcept(temp_container);
    addVisit();
    getStation().then(data => {
        if (data.errno == 200) {
            data = data.data;
            document.querySelector("title").textContent = data.apodo;
            title.textContent = data.apodo;
            station_location.querySelector('span').textContent = data.ubicacion;
        }
    });
    
    getStationData(1).then(data => {
        if (data.errno == 200) {
            showStationData(data.data[0]);
        }
    });
    setInterval(() => {
        getStationData(1).then(data => {
            if (data.errno == 200) {
                showStationData(data.data[0]);
            }
        });
    }, 60000, 1);

});






btn_temp.onclick = () => {
    hideAllPropertiesExcept(temp_container);
}
btn_fire.onclick = () => {
    hideAllPropertiesExcept(fire_container);
}
btn_hum.onclick = () => {
    hideAllPropertiesExcept(hum_container);
}
btn_press.onclick = () => {
    hideAllPropertiesExcept(press_container);
}
btn_wind.onclick = () => {
    hideAllPropertiesExcept(wind_container);
}



function hideAllPropertiesExcept(ex) {
    temp_container.style.display = "none";
    fire_container.style.display = "none";
    hum_container.style.display = "none";
    press_container.style.display = "none";
    wind_container.style.display = "none";

    ex.style = "";
}


async function addVisit() {
   /*  const res = await fetch("https://mattprofe.com.ar/proyectos/app-estacion/datos.php?chipid=" + chipid + "&mode=visit-station");
    const data = await res.json(); */
    const data = 0;

    return data;
}


async function getStation() {
    const res = await fetch(`api2/Station/GetStation/${chipid}`);
    const data = await res.json();

    return data;
}

async function getStationData(amount) {
    const res = await fetch(`api2/Station/GetStationData/${chipid}/${amount}`);
    const data = await res.json();

    return data;
}


function showStationData(data) {
    datetime.textContent = data.fecha;
    let decChar = ',';
    if ((data.temperatura + '').includes('.')) {
        decChar = '.';
    }

    const temperatura = (data.temperatura + '').split(decChar);
    temp.textContent = temperatura[0];
    temp_dec.textContent = '.' + temperatura[1];
    btemp.textContent = temperatura[0] + 'ºC';
    max_temp.textContent = data.tempmax + 'ºC';
    min_temp.textContent = data.tempmin + 'ºC';

    const sensacion = (data.sensacion + '').split(decChar);
    sens.textContent = sensacion[0];
    sens_dec.textContent = '.' + sensacion[1];
    max_sens.textContent = data.sensamax + 'ºC';
    min_sens.textContent = data.sensamin + 'ºC';


    ffmc.textContent = data.ffmc;
    dmc.textContent = data.dmc;
    dc.textContent = data.dc;
    isi.textContent = data.isi;
    bui.textContent = data.bui;
    fwi.textContent = data.fwi;


    const humedad = (data.humedad + '').split(decChar);
    hum.textContent = humedad[0];
    hum_dec.textContent = '.' + humedad[1];
    bhum.textContent = humedad[0] + '%';


    const presion = (data.presion + '').split(decChar);
    press.textContent = presion[0];
    press_dec.textContent = '.' + presion[1];
    bpress.textContent = presion[0] + 'hPa';


    const viento = (data.viento + '').split(decChar);
    wind.textContent = viento[0];
    wind_dec.textContent = '.' + viento[1];
    bwind.textContent = viento[0] + 'Km/H';
    max_wind.textContent = data.vientomax + 'Km/H';

    dir.textContent = data.dviento;
    bdir.textContent = data.dviento;
}