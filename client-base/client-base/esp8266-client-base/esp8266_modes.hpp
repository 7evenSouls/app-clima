void wifiAP(){
  
}

String wifiSTA(const char *ssid, const char *pass){
  // Inicializa el pin de Led status 
  pinMode(LED_BUILTIN, OUTPUT);
  
  // Obtiene el id del esp8266
  String id = String(ESP.getChipId());
  Serial.println("[" + id + "] ChipId.");
  
  // Muestra el SSID
  Serial.print("[");
  Serial.print( ssid );
  Serial.println("] SSID de la red.");
  
  // Conexión a la red WIFI
  WiFi.begin(ssid, pass);
  Serial.print("[WIFI] Conectando");

  // guardamos el tiempo antes de entrar al while
  unsigned long timeIn = millis();
  
  // Mientras no se haga efectiva la conexión
  while(WiFi.status() != WL_CONNECTED){
    // espera y muestra en la terminal un puntito
    delay(100);
    Serial.print(".");
    
    // Hacemos que el led parpadee para avisarnos que esta conectando
    digitalWrite(LED_BUILTIN, !digitalRead(LED_BUILTIN));

    // Si pasan más de 10 segundos de que no conecto, hay un problema en el ssid o pass
    if(millis() - timeIn > 10000 ){
      break;
    }
  }

  // Se establecio la conexión
  if(WiFi.status() == WL_CONNECTED){
    Serial.println("\r\n[OK] Conexión wifi.");
    Serial.print("[");
    Serial.print(WiFi.localIP());
    Serial.println("] IP optenida por DHCP.");

    // Apaga el led cuando se establecio la conexión
    digitalWrite(LED_BUILTIN, HIGH);
    
  // no se establecio la conexión
  }else{
    Serial.println("[ERROR] Conexión wifi.");

    // Si fallo queda el led encendido
    digitalWrite(LED_BUILTIN, LOW);
    
    WiFi.disconnect();
  }

  return id;
}
