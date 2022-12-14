#include <PubSubClient.h>
#include <WiFi.h>
#include "DHT.h"

#define DHTPIN 4
#define DHTTYPE DHT22 

//
// WARNING!!! PSRAM IC required for UXGA resolution and high JPEG quality
//            Ensure ESP32 Wrover Module or other board with PSRAM is selected
//            Partial images will be transmitted if image exceeds buffer size
//


const char* ssid = "SN2021";
const char* password = "modernraven922";
const char *mqtt_broker = "128.128.0.58";
const char *topic = "zoubidac";
const char *mqtt_username = "";
const char *mqtt_password = "";
const int mqtt_port = 2305;

WiFiClient espClient;
PubSubClient client(espClient);
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  Serial.setDebugOutput(true);
  Serial.println();
  dht.begin();

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("WiFi connected");
  client.setServer(mqtt_broker, mqtt_port);
  client.setCallback(callback);
   while (!client.connected()) {
      String client_id = "esp8266-client-";
      client_id += String(WiFi.macAddress());
      Serial.printf("The client %s connects to the public mqtt broker\n", client_id.c_str());
      if (client.connect(client_id.c_str(), mqtt_username, mqtt_password)) {
          Serial.println("Public emqx mqtt broker connected");
      } else {
          Serial.print("failed with state ");
          Serial.print(client.state());
          delay(2000);
      }
  }

  client.publish(topic, "hello world");
  Serial.println("Message Published");
  client.subscribe(topic);
}

void callback(char *topic, byte *payload, unsigned int length) {
  Serial.print("Message arrived in topic: ");
  Serial.println(topic);
  Serial.print("Message:");
  for (int i = 0; i < length; i++) {
      Serial.print((char) payload[i]);
  }
  Serial.println();
  Serial.println("-----------------------");
}

void loop() {
  // put your main code here, to run repeatedly:
  client.loop();
  delay(6000);

  float t = dht.readTemperature(); //Heat-Index
  float f = dht.readTemperature(true); //humidity

  float h = dht.readHumidity(); //
  float data = dht.readTemperature();
  String value = "1/1/"+String(data);
  const char *resultee = value.c_str();
  client.publish("temperature", resultee);


  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }

  float hif = dht.computeHeatIndex(f, h);
  float hic = dht.computeHeatIndex(t, h, false);

  Serial.print(F("Humidity: "));
  Serial.print(h);
  Serial.print(F("%  Temperature: "));
  Serial.print(t);
  Serial.print(F("째C "));
  Serial.print(f);
//  Serial.print(F("째F  Heat index: "));
//  Serial.print(hic);
//  Serial.print(F("째C "));
//  Serial.print(hif);
//  Serial.println(F("째F"));
  client.publish("test", "");
}
