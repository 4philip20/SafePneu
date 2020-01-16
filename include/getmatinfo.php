<?php
// ******************************************************************************************************
// Autor: Peter Thiel
// Datum: 02.06.2016
// Beschreibung:
// Dem Script muss die Materalnummer als Parameter mitgegeben werden.
// Es wird eine Verbindung zum GW resp. GWTEST erstellt und [pneuSet] für die Pneu Information abgefrag
// und mit echo zurückgegeben.
// Wichtig:
// Benutzerdaten und service_url bitte Anpassen
// Anpassungen:
// 02.06.16 PTH erstellt
// ******************************************************************************************************
  $str_matnr = $_GET['matnr'];


  $username = 'safepneu';       //evt. Anpassen
  $password = 'safepneu2015';   //evt. Anpassen
//  $server   = 'gwtest.esa.ch';  //evt. Anpassen
// ********************************************
  $server   = 'gw.esa.ch';  //evt. Anpassen

  $service_url = 'https://' . $server . '/api/odata/esa/safepneu_srv/pneuSet(materialNr=\'' . $str_matnr . '\',sprache=\'de\')?$format=json';
  //$service_url = 'https://' . $server . '/api/odata/esa/safepneu_srv/pneuSet(materialNr=\'' . $str_matnr . '\',sprache=\' '.$lv_sprache.'  \')?$format=json';
  $curl = curl_init($service_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);            // TRUE um den Transfer als String zurückzuliefern
  curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");  // Benutzername und Passwort im Format "[benutzername]:[passwort]"
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);        // Die zu nutzende HTTP-Authentisierungsmethode
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $curl_response = curl_exec($curl);
  curl_close($curl);
  echo $curl_response;
 ?>