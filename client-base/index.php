<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>esp8266-sensors</title>

	<style>

		#wrapper{
			width: 100vw;
			height: 100vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}

		#list{
			width: 500px;
		}

		.row{
			display: grid;
			grid-template-columns: 8em 6em 4em 2em 12em;		
		}

		.item{
			border: solid;
		}
	</style>
</head>
<body>

	<div id="wrapper">

		Estado de sensores
		<div id="list">
			
			<div class="row">
				<div class="item chipid">chipId</div>
				<div class="item analogico">analogico</div>
				<div class="item digital">digital</div>
				<div class="item led">led</div>
				<div class="item fechahora">fechaHora</div>
			</div>

			<template id="tpl-row">
				<div class="row">
					<div class="item chipid"></div>
					<div class="item analogico"></div>
					<div class="item digital"></div>
					<div class="item led"></div>
					<div class="item fechahora"></div>
				</div>
			</template>

		</div>
	</div>


	<script type="text/javascript">
		
		document.addEventListener("DOMContentLoaded", () => {

			loadData(7).then( data => {
				data.forEach(function(element, item){

					addRowList(element)
				})
			})


			let inter = setInterval(reloadItems, 10000)
		})

		function reloadItems(){
			
			loadData(1).then( data => {
				
				orderList()
				addRowList(data[0])
			})			
		}

		async function loadData(cant){
			const response = await fetch("./API/get.php?limit="+cant)
			const data = await response.json()

			return data
		}

		function addRowList(data){

			let tpl = document.querySelector("#tpl-row")
			let clon = tpl.content.cloneNode(true)

			clon.querySelector(".chipid").innerHTML = data.chipid
			clon.querySelector(".analogico").innerHTML = data.analogico
			clon.querySelector(".digital").innerHTML = data.digital
			clon.querySelector(".led").innerHTML = data.led
			clon.querySelector(".fechahora").innerHTML = data.fechaHora

			document.querySelector("#list").appendChild(clon)
		}

		function orderList(){
			let rows = document.querySelectorAll(".row")
			
			rows[1].remove();

		}

	</script>
	
</body>
</html>