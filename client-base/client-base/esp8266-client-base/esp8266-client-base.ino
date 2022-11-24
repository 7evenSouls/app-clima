#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include "esp8266_modes.hpp"
#include "esp8266_send.hpp"

// Nombre y clave de la red Wifi a la que va a conectarse
const char *ssid = "nombre-red";
const char *pass = "contraseña-red";

// Guardará el id de esp8266
String chipid = "";

// dominio al cual nos conectamos
String host = "dominio.com.ar";
// Puerto por el cual accederemos
int port = 80;
// url del archivo al cual enviaremos los datos
String url = "/esp8266/client-base/API/send.php";

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
    
    // lectura de sensores
    float sensorAnalogico = random(99);
    int sensorDigital = random(2);

    // Estado de actuadores
    int led = digitalRead(LED_BUILTIN);

    // Variables con valores a enviar por POST
    String data = "chipid=" + chipid + "&analogico=" + String(sensorAnalogico, 2) + "&digital=" + String(sensorDigital)+ "&led=" + String(led);
    
    // Envio los datos al host/url por el puerto especificado
    Serial.println(sendDataAPI(data, host, url, port));
 }
}
