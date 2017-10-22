#include <ESP8266WiFi.h>
//#include <PubSubClient.h>

//HTTP headers
#include <ESP8266HTTPClient.h>

//JSON formatter header 
//https://bblanchon.github.io/ArduinoJson/
#include <ArduinoJson.h>
 
const char* ssid = "Private";
const char* password =  "vinkel1234";
 
WiFiClient espClient;
//PubSubClient client(espClient);

int pinOutD0 = D0;
int pinOutD1 = D1;
int pinOutD2 = D2;
int pinOutD3 = D3;
int pinOutD4 = D4;
int pinOutD5 = D5;
int pinOutD6 = D6;
int pinOutD7 = D7;

void setup() {
  
  pinMode(pinOutD0, OUTPUT);
  pinMode(pinOutD1, OUTPUT);
  pinMode(pinOutD2, OUTPUT);
  pinMode(pinOutD3, OUTPUT);
  pinMode(pinOutD4, OUTPUT);
  pinMode(pinOutD5, OUTPUT);
  pinMode(pinOutD6, OUTPUT);
  pinMode(pinOutD7, OUTPUT);

  digitalWrite(pinOutD0, LOW);
  digitalWrite(pinOutD1, LOW);
  digitalWrite(pinOutD2, LOW);
  digitalWrite(pinOutD3, LOW);
  digitalWrite(pinOutD4, LOW);
  digitalWrite(pinOutD5, LOW);
  digitalWrite(pinOutD6, LOW);
  digitalWrite(pinOutD7, LOW);

  Serial.begin(115200);
 
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Connecting to WiFi..");
  }
  Serial.println("Connected to the WiFi network");
}

void loop() {

  //Check WiFi connection status
  if(WiFi.status()== WL_CONNECTED){            

    // Memory pool for JSON object tree.
    //
    // Inside the brackets, 500 is the size of the pool in bytes.
    // If the JSON object is more complex, you need to increase that value.
    StaticJsonBuffer<500> jsonBuffer;

    // Create the root of the object tree.
    //
    // It's a reference to the JsonObject, the actual bytes are inside the
    // JsonBuffer with all the other nodes of the object tree.
    // Memory is freed when jsonBuffer goes out of scope.
    JsonObject& root = jsonBuffer.createObject();    

    // Add a nested object.
    JsonObject& payload = root.createNestedObject("payload");

    // TODO: Initialize values for valueInpA0FrmD#
    
    payload["vibrations"] = 1;

    //JSON output
    //{
    //  "payload": {
    //      "vibrations": ""
    //  }

    String data;

    //print JSON to data
    root.printTo(data);
    
    //Declare object of class HTTPClient
    HTTPClient http;

    //Specify request destination
    http.begin("https://mdm-hackathon.herokuapp.com/aide", "08 3b 71 72 02 43 6e ca ed 42 86 93 ba 7e df 81 c4 bc 62 30");

    //Specify content-type header
    http.addHeader("Content-Type", "application/json");

    //Send the request
    int httpCode = http.POST(data);
    
    //Get the response payload
    String response = http.getString();
    
    Serial.println();
    
    //Print HTTP return code
    Serial.print(httpCode);
    Serial.print(" ");
    
    //Print request response payload
    Serial.println(response);

    StaticJsonBuffer<500> jsonBufferRead;

    JsonObject& rootRead = jsonBufferRead.parseObject(response);

    if (!rootRead.success())
    {
      Serial.println("parseObject() failed");
    }
    
    int vibrations = (int)rootRead["payload"];

    Serial.println(vibrations);

    if ( vibrations >= 900 ) {
      digitalWrite(pinOutD1, HIGH);
    }
    delay(5000);
    digitalWrite(pinOutD1, LOW);

    //Close connection
    http.end();
 
 }else{
    //throw error in connection
    Serial.println("Error in WiFi connection");
 }
 
  delay(500); 

}
