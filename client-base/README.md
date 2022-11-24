# client-base

Envio de datos desde el ESP8266 a una API que los almacena en una DB, también tiene una web que muestra un listado de los datos cargados en la DB. 

- API: Contiene los archivos que se utilizan para agregar y leer registros de la base de datos.

-- credenciales.php: Datos para la conexión a la base de datos.

-- database.php: Objeto DataBase, con el nos conectamos a la base de datos.

-- esp8266.sql: Sentencias SQL para crear la base de datos y tablas.

-- get.php: Recibe por metodo GET "limit" y retorna la cantidad de registros especificada en limit.

-- send.php: Recibe por metodo POST "chipid/analogico/digital/led", es accedido por el ESP8266.

- esp8266-client-base: Sketch Arduino para el ESP8266, conecta a la red wifi y envia el estado de 2 sensores virtuales y 1 led a la API (send.php).

-- esp8266-client-base.ino: Código principal, utiliza las funciones de las librerias para conectarse a una red wifi y enviar los datos a una API cada 10 segundos.

-- esp8266_modes.hpp: Contiene la función que activa el modo STA del ESP8266 de forma sencilla.

-- esp8266_send.hpp: Contiene la función que permite enviar información a la API de forma sencilla, también tiene modo debug.

- index.php: Página que accede a la base de datos y nos muestra de forma animada los últimos 7 registros, se agrega un nuevo dato cada 10 segundos.

Autor
=====
- Matias Baez
- @matt_profe
- mbcorp.matias@gmail.com
- https://mattprofe.com.ar