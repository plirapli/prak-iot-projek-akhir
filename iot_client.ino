#include <SPI.h>
#include <MFRC522.h>

#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

const char* ssid = "Ruang Asisten";
const char* password = "tanyaadmin";

//pengenalan host
const char* host = "192.168.77.140"; //alamat IP web server

//variabel rfid
#define SDA_PIN 2 // D4
#define RST_PIN 0 // D3

#define BUZZ 4
#define LED_GREEN 16
#define LED_RED 5

MFRC522 mfrc522(SDA_PIN, RST_PIN);


void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);

  //Settik koneksi wifi
  WiFi.hostname("NodeMcu");
  WiFi.begin(ssid, password);

  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Dekatkan kartu RFID anda");
  Serial.println();

  pinMode(BUZZ, OUTPUT);
  pinMode(LED_GREEN, OUTPUT);
  pinMode(LED_RED, OUTPUT);
}

void loop() {
  digitalWrite(LED_RED, HIGH);
  digitalWrite(LED_GREEN, LOW);

  // put your main code here, to run repeatedly:
  if(! mfrc522.PICC_IsNewCardPresent())
    return ;

  if(! mfrc522.PICC_ReadCardSerial())
    return ;

  String IDTAG = "";
  for(byte i=0; i<mfrc522.uid.size; i++)
  {
    IDTAG += mfrc522.uid.uidByte[i];
  }

  //kirim nomor RFID ke data base
  WiFiClient client;
  const int httpPort = 80;

  if(!client.connect(host, httpPort))
  {
    Serial.println("Connection Failed");
    return;
  }

  String Link;
  HTTPClient http;
  Link = "http://192.168.77.140/prakiot/src/utils/kirim_kartu.php?card_no=" + IDTAG;
  http.begin(client, host, httpPort, Link);

  int httpCode = http.GET();
  String payload = http.getString();
  Serial.println(payload);
  
  digitalWrite(LED_RED, LOW);
  digitalWrite(LED_GREEN, HIGH);
  digitalWrite(BUZZ, HIGH);
  delay(75);
  digitalWrite(BUZZ, LOW);
  delay(75);
  digitalWrite(BUZZ, HIGH);
  delay(75);
  digitalWrite(BUZZ, LOW);
  http.end();

  delay(2000); 

  if(IDTAG != "")
    Serial.println(IDTAG);
  
}
