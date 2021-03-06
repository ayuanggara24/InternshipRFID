#include <SPI.h> // Memanggil Library SPI 
#include <MFRC522.h> // Memanggil Library MFRC522
#include <Ethernet.h>
#include <Wire.h>
#include <Keypad.h>
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

#define RST_PIN 5
#define SS_PIN 8
#define E_MOBILE_330 3819
long otp;
String id;
int check = 0;

MFRC522 mfrc522(SS_PIN, RST_PIN);

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; // set mac address
IPAddress server(192, 168, 1, 102); // IP server
IPAddress ip(192, 168, 1, 16); // IP Ethernet arduino
byte gateway[] = {192, 168, 1, 1};
IPAddress subnet(255, 255, 255, 0);
EthernetClient client;

int addr = 0;
int nama_objek;
String id_temp;
boolean match = false;
boolean programMode = false;
byte storedCard[4];
byte readCard[4];
byte masterCard[4] = {0x33, 0x47, 0x39, 0x2}; // UID kartu yang diijinkan masuk : EC9FE97

const byte ROWS = 4;
const byte COLS = 3;

char hexaKeys[ROWS][COLS] = {
  {'1', '2', '3'},
  {'4', '5', '6'},
  {'7', '8', '9'},
  {'*', '0', '#'}
};

byte rowPins[ROWS] = {0, 9, 7, 6};
byte colPins[COLS] = {4, 3, 2};

Keypad customKeypad = Keypad(makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS);

String key1;
String key2;
String key3;
String key4;
String fullkey;
int cursorkey = 0;
int loopagain = 0;


int indexstatus;
int indexnama;
int indexendnama;
String nama;
String inout;

void setup() {
  pinMode(A0, OUTPUT);
  lcd.begin();
  lcd.backlight();
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();
  Ethernet.begin(mac, ip, gateway, subnet);
  delay(100);
  randomSeed(42);
  lcd.setCursor(0, 0);
  lcd.print("RFID SIAP");
  delay(1000);
  lcd.clear();
}

void loop ()
{
  check = 0;
  if (loopagain == 0) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tempelkan kartu");
    lcd.setCursor(0, 1);
    lcd.print("RFID...");
    loopagain = 1;
  }

  int successRead;
  successRead = getID();
  if (client.available()) {
    // char c = client.read();
    // Serial.print(c);
    String databack = client.readString(); // Membaca serial ESP8266
    Serial.println(databack);
    client.stop();
    indexstatus = databack.indexOf("ck=");
    //indexnama = databack.indexOf("nama=");
    // indexendnama = databack.indexOf("end");
    inout = databack.substring(indexstatus + 3, indexstatus + 5);
    //nama = databack.substring(indexnama + 5, indexendnama);
    Serial.print("statusinouuuuut=");
    Serial.println(inout);
    //    Serial.print("Namaaaaaaaaaaaaa=");
    //    Serial.println(nama);
    if (inout.equals("TP")) {
      id = "";
      loopagain = 0;
    }
    if (inout.equals("no")) {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Tidak terdaftar");
      delay(1000);
      lcd.clear();
      id = "";
      loopagain = 0;
    }
    if (inout.equals("ye")) {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Terima kasih");
      lcd.setCursor(0, 1);
      lcd.print(nama);
      delay(3000);
      lcd.clear();
      id = "";
      loopagain = 0;
    }
    if (inout.equals("fa")) {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Kode OTP salah");
      delay(1000);
      lcd.clear();
      id = "";
      loopagain = 0;
    }

    if (inout.equals("in")) {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Terima kasih");
      lcd.setCursor(0, 1);
      lcd.print(nama);
      delay(3000);
      lcd.clear();
      id = "";
      loopagain = 0;
    }
    if (inout.equals("ot")) {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Kode OTP=");
      while (1) {
        char customKey = customKeypad.getKey();
        if (customKey) {
          analogWrite(A0, 255);
          delay(100);
          analogWrite(A0, 0);
          delay(100);
          Serial.println(customKey);
          if (customKey == '#') {
            Ethernet.begin(mac, ip, gateway, subnet);
            delay(100);
            Serial.print("Full key=");
            Serial.println(fullkey);
            cursorkey = 0;
            check = 1;
            cekData();
            //kirimData();
            id = "";
            goto endstartloop;
          }
          if (cursorkey == 0) {
            key1 = customKey;
            fullkey = key1;
            lcd.setCursor(0, 1);
            lcd.print(fullkey);
            cursorkey++;
            goto endkey;
          }
          if (cursorkey == 1) {
            if (customKey == '*') {
              fullkey = "";
              lcd.clear();
              lcd.setCursor(0, 0);
              lcd.print("Kode OTP=");
              lcd.setCursor(0, 1);
              lcd.print(fullkey);
              cursorkey--;
              goto endkey;
            }
            key2 = customKey;
            fullkey = key1 + key2;
            lcd.setCursor(0, 1);
            lcd.print(fullkey);
            cursorkey++;
            goto endkey;
          }
          if (cursorkey == 2) {
            if (customKey == '*') {
              fullkey = key1;
              lcd.clear();
              lcd.setCursor(0, 0);
              lcd.print("Kode OTP=");
              lcd.setCursor(0, 1);
              lcd.print(fullkey);
              cursorkey--;
              goto endkey;
            }
            key3 = customKey;
            fullkey = key1 + key2 + key3;
            lcd.setCursor(0, 1);
            lcd.print(fullkey);
            cursorkey++;
            goto endkey;
          }
          if (cursorkey == 3) {
            if (customKey == '*') {
              fullkey = key1 + key2;
              lcd.clear();
              lcd.setCursor(0, 0);
              lcd.print("Kode OTP=");
              lcd.setCursor(0, 1);
              lcd.print(fullkey);
              cursorkey--;
              goto endkey;
            }
            key4 = customKey;
            fullkey = key1 + key2 + key3 + key4;
            lcd.setCursor(0, 1);
            lcd.print(fullkey);
            cursorkey++;
            goto endkey;
          }
          if (cursorkey == 4) {
            if (customKey == '*') {
              fullkey = key1 + key2 + key3;
              lcd.clear();
              lcd.setCursor(0, 0);
              lcd.print("Kode OTP=");
              lcd.setCursor(0, 1);
              lcd.print(fullkey);
              cursorkey--;
              goto endkey;
            }
          }
        }
endkey:
        delay(1);
      }
    }
  }
  // if the server's disconnected, stop the client:
  if (!client.connected()) {
    Serial.println();
    Serial.println("Tidak ada kartu yang terdeteksi.");
    client.stop();
  }
endstartloop:
  delay(1);
}

int getID()
{
  String temp_id;
  if ( ! mfrc522.PICC_IsNewCardPresent())
  {
    return 0;
  }
  if ( ! mfrc522.PICC_ReadCardSerial())
  {
    return 0;
  }
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    readCard[i] = mfrc522.uid.uidByte[i];
    temp_id = String(readCard[i], HEX);
    id += temp_id;
  }
  analogWrite(A0, 255);
  delay(100);
  analogWrite(A0, 0);
  delay(100);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("RFID Terdeteksi");
  lcd.setCursor(0, 1);
  id.toUpperCase();
  lcd.print(id);
  id.toLowerCase();
  delay(1000);
  lcd.clear();
  Serial.print(id);
  Serial.println("");
  mfrc522.PICC_HaltA();
  mfrc522.PCD_StopCrypto1();
  kirimData();
  return 1;
}

void kirimData() {
  otp = random(1000, 9999);
  Serial.print("OTP = ");
  Serial.println(otp);
  // if you get a connection, report back via serial:
  if (client.connect(server, 80)) {
    client.print( "GET /rfid_otp/insert.php?"); // php??
    client.print("id=");
    client.print(id);
    client.print("&&");
    client.print("otp=");
    client.print(otp);
    client.print("&&");
    client.print("check=");
    client.print(check);
    client.println( " HTTP/1.1");
    client.println( "Host: 192.168.1.102" );//ur web server
    //client.println( "Content-Type: application/x-www-form-urlencoded" );
    client.println( "Connection: close" );
    client.println();
    // client.stop();
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Mohon tunggu...");
    Serial.println("Data berhasil");
  }
  else {
    Serial.println("gagal");
    id = "";
    delay(100);
  }
}

void cekData() {
  // if you get a connection, report back via serial:
  if (client.connect(server, 80)) {
    client.print( "GET /rfid_otp/insert.php?"); // php??
    client.print("id=");
    client.print(id);
    client.print("&&");
    client.print("otp=");
    client.print(fullkey);
    client.print("&&");
    client.print("check=");
    client.print(check);

    Serial.print("id=");
    Serial.print(id);
    Serial.print("&&");
    Serial.print("otp=");
    Serial.print(fullkey);
    Serial.print("&&");
    Serial.print("check=");
    Serial.print(check);

    client.println( " HTTP/1.1");
    client.println( "Host: 192.168.1.102" );//ur web server
    //client.println( "Content-Type: application/x-www-form-urlencoded" );
    client.println( "Connection: close" );
    client.println();
    // client.stop();
    Serial.println("Data berhasil");
  }
  else {
    Serial.println("gagal");
    id = "";
    delay(100);
  }
}



