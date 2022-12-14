  #include "DHT.h"

#define DHTPIN 25
#define DHTTYPE DHT22
DHT dht(DHTPIN, DHTTYPE);

int buttonPin = 14;
int ledPin = 2;
int buttonState = 0;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  pinMode(buttonPin, INPUT_PULLUP);
  pinMode(ledPin, OUTPUT);
  dht.begin();
}
void loop() {
  // put your main code here, to run repeatedly:
  buttonState = digitalRead(buttonPin);
  delay(500); //Met en pause le programme pendant la valeur de 500 en ms
  Serial.print(buttonState);

float hum = dht.readHumidity();
float temp = dht.readTemperature();
Serial.print(F(" Humidity: "));
Serial.print(hum);
Serial.print(F("%  Temperature: "));
Serial.print(temp);
Serial.print(F("°C \n"));

}
