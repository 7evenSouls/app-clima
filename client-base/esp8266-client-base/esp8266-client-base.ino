#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include "esp8266_modes.hpp"
#include "esp8266_send.hpp"
#include <DHT.h>
#define DHT_TYPE DHT11
#define DHT_PIN 14
DHT dht(DHT_PIN, DHT_TYPE);

// Nombre y clave de la red Wifi a la que va a conectarse
const char *ssid = "MattProfe";
const char *pass = "buenosdias2022";

// Guardará el id de esp8266
String chipid = "481184";

// dominio al cual nos conectamos
String host = "mattprofe.com.ar";
// Puerto por el cual accederemos
int port = 80;
// url del archivo al cual enviaremos los datos
String url = "/10047/client-base/API/send.php";

// Almacena el milisegundo cuando se realizo el envio de datos
unsigned long pastMillis = 0;

// Sección de configuración e inicialización del esp8266
// ============================
void setup(){
 
  // Demora para estabilización
  delay(1000);
  
  // Inicializa la comunicación serial
  Serial.begin(115200);
  Serial.println("\r\n[OK] Comunicación Serial.");

  // optiene el id del ESP8266 y lo conecta a la red wifi
  chipid = wifiSTA(ssid, pass);
  
}

// Bucle infinito
// ============================
void loop(){

  // Si pasaron 10 segundos 
  if(millis() - pastMillis >= 10000){
    // lo presente al pasado
    pastMillis = millis();

    // Variables con valores a enviar por POST
    float temp = dht.readTemperature();
    float hume = dht.readHumidity();

    String data = "chipid=" + chipid + "&temperatura=" + String(temp, 2) + "&humedad=" + String(hume, 2);
    
    // Envio los datos al host/url por el puerto especificado
    Serial.println(sendDataAPI(data, host, url, port));
 }
}
