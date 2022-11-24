// Envia los datos al host/url por el puerto especificado, si responseTerminal esta a true muestra la página en la terminal
String sendDataAPI(String data, String host, String url, int port, bool responseTerminal = false){
  WiFiClient client;
  
  // Conecta al dominio por el puerto, si no funciono retorna error
  if(!client.connect(host, port)){
    return "[ERROR] Servidor no accesible.";
  }
    
  // La conexión se establecio
  

    // Parpadea el led avisando que enviará datos
    digitalWrite(LED_BUILTIN, LOW);
    delay(100);
    digitalWrite(LED_BUILTIN, HIGH);

    // Enviamos los datos a la página por POST con las cabeceras HTTP
    client.print("POST " + url + " HTTP/1.1\r\n" +
    "Host: " + host + "\r\n" +
    "Accept: /*\r\n" +
    "Content-Length: " + data.length() + "\r\n" +
    "Content-Type: application/x-www-form-urlencoded\r\n\r\n" +
    data);

    // guardamos el tiempo antes de entrar al while
    unsigned long timeIn = millis();
    
    // Mientras no haya datos que leer esperamos
    while(client.available() == 0){    
      // El tiempo de espera excedio los 5 segundos
      if(millis() - timeIn > 5000){
        client.stop(); // detenemos la conexión
        return "[ERROR] Se excedio el tiempo de envio.";
      }
    }

  // Para debug
  // ==========================
  if(responseTerminal){
    // Guardará la respuesta
    String response;
    // Mientras haya datos que leer
    while(client.available()){
      // Leemos los datos y luego los mostramos por la terminal
      response = client.readStringUntil('\r');
      Serial.println(response);
    }
  }
  

  client.stop();
  
  // Si llego aquí es porqué se envio correctamente
  return "[OK] Datos enviados.";
}
