<?php
//FORMULAR ausgabe nach Bedingung formlesen
//TODO: Version 7
if (!isset($_POST["formok"]) or $_POST["formok"] == '0'){
    $lv_formok = '0';
}else{
    $lv_formok = '1';
    $GLOBALS['formok'] = '1';
}
//Prüfen ok Formular gesendet. Falls Ja get $_POST Parameter Else Show Formular
IF ($lv_formok == '0') {
//INITIAL WERTE
    $date = date('Y-m-d', strtotime(' +0 day'));
    $date2 = date('Y-m-d', strtotime(' -14 day'));
//Falls formular_value dann FORMULAR _*SOFORT*_ ANZEIGEN Hier ganz normal Navigieren
    echo "<div id=\"myModal\" class=\"modal\" >";

//********************************************************************************
//GET Garageame Bi Kunnr
//********************************************************************************
    $username = 'safepneu';       //evt. Anpassen
    $password = 'safepneu2015';   //evt. Anpassen
//	$server   = 'gwtest.esa.ch';  //evt. Anpassen
//	$TitleSystem = $server;
    $server = 'gw.esa.ch';  //evt. Anpassen
    $TitleSystem = '';

    $debitornr = $GLOBALS["gv_kunnr"];
    $service_url = 'https://' . $server . '/api/odata/esa/safepneu_srv/customerSet(kunnr=\'' . $debitornr . '\')?$format=json';
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);            // TRUE um den Transfer als String zurückzuliefern
    curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");  // Benutzername und Passwort im Format "[benutzername]:[passwort]"
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);        // Die zu nutzende HTTP-Authentisierungsmethode
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $curl_response = curl_exec($curl);
    curl_close($curl);
//die Curl Abfrage ist gemacht und ist in der Var. $curl_response
    //var_dump(json_decode($curl_response, true));
//Feststellen ob etwas enthalten ist: Fehler Auswertung
    $decoded = json_decode($curl_response);
    if (!empty($decoded->d->kunnr)) {
        $GLOBALS["gv_kunnr"] = $decoded->d->kunnr;
        $name1 = $decoded->d->name1;
        $ort = $decoded->d->ort01;
        $pstlz = $decoded->d->pstlz;
        $stras = $decoded->d->stras;
    } else {
        $GLOBALS["gv_kunnr"] = "0";
        $name1 = "Error";
    }
//********************************************************************************
    echo "
<h1>FORM LESEN = 0 EMPTY</h1>
        <!-- Modal content -->
        <div class=\"modal-content\">
            <!-- Modal content close-->
            <span class=\"close\">x</span>
            <!-- in Modal content Formular-->
                <form action=\"?kunnr=" . $GLOBALS["gv_kunnr"] . "\" method=\"post\" id=\"person\" enctype=\"application/x-www-form-urlencoded\">
                <!-- Überschirft -->
                <h3>" . $GLOBALS["formsafepeuh1"] . "</h3>
                <!-- some text -->
                <p>" . $GLOBALS["lorem"] . "</p>
                <br>
                <!-- div für linke und rechte formular spalte unterscheiden -->
                <div class=\"float-verkaufer\">
                    <!-- Überschirft -->
                    <h3>" . $GLOBALS["reifenverkäufer"] . "</h3>
                    <label class=\"label\" type=\"text\" name=\"kunnr\">" . $GLOBALS["kundennummer"] . "</label>
                    <br>
                    <input class=\"input\" id=\"grau\" type=\"text\" name=\"kunnr\" maxlength=\"30\" placeholder=\"123456\" value=\"" . $GLOBALS["gv_kunnr"] . "\" disabled>
                    <br>
                    <label class=\"label\" type=\"text\" name=\"kunnr\">" . $GLOBALS["garage"] . "</label>
                    <br>
                    <input class=\"input\" id=\"grau\" type=\"text\" name=\"name1\" maxlength=\"30\" placeholder=\"" . $GLOBALS["garageplaceholder"] . "\" value=\"$name1\" disabled>
                    <br>
                    <br>
                    <!--</div>-->
                    <!--<div class=\"float-kaufer\">-->
                    <h3>" . $GLOBALS["reifenkäufer"] . "</h3>
                    <label class=\"label\">" . $GLOBALS["anrede"] . "*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <label class=\"label\">" . $GLOBALS["vorname"] . "*</label>
                    <br>
                    <select class=\"selectoption\" id=\"abstand\" name=\"anrede\" size=\"1\"\">
                    <option value=\"herr\">" . $GLOBALS["herr"] . "</option>
                    <option value=\"frau\">" . $GLOBALS["frau"] . "</option>
                    </select>
                    <input class=\"input-vorname\" type=\"text\" name=\"vorname\" minlength=\"3\" maxlength=\"30\" placeholder=\"" . $GLOBALS["vorname"] . "\" id=\"vorname\"\" required>
                    <br>
                    <label class=\"label\" name=\"nachname\">" . $GLOBALS["nachname"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"nachname\" maxlength=\"30\" minlength=\"3\" placeholder=\"" . $GLOBALS["nachname"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["strudhausnr"] . "*</label>
                    <br>
                    <input class=\"input-strasse\" type=\"text\" name=\"strasse\" minlength=\"3\" maxlength=\"30\" placeholder=\"Musterstrasse 12\" value=\"$stras\" required>
                    <!--<input class=\"input-number\" type=\"text\" name=\"strassenr\" minlength=\"1\" maxlength=\"30\" placeholder=\"12\" required>-->
                    <br>
                    <label class=\"label\" >" . $GLOBALS["pstlz"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"number\" name=\"pstlz\" minlength=\"3\" maxlength=\"5\" placeholder=\"3400\" value=\"$pstlz\" required>
                    <br>
                    <label class=\"label\" >" . $GLOBALS["stadt"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"stadt\" minlength=\"3\" maxlength=\"30\" placeholder=\"Stadt\" value=\"$ort\" required>
                    <br>
                    <label class=\"label\" >" . $GLOBALS["land"] . "*</label>
                    <br>
                    <select class=\"selectoption-full\" id=\"abstand\" name=\"land\" size=\"1\">
                        <option value=\"s\">" . $GLOBALS["land5"] . "</option>
                        <option value=\"d\">" . $GLOBALS["land1"] . "</option>
                        <option value=\"f\">" . $GLOBALS["land2"] . "</option>
                        <option value=\"i\">" . $GLOBALS["land3"] . "</option>
                        <option value=\"ö\">" . $GLOBALS["land4"] . "</option>
                    </select>
                    <br>
                    
                    <!--<label class=\"label\">" . $GLOBALS["vorwahl"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>-->
                    <label class=\"label\">" . $GLOBALS["telenr"] . "</label>
                    <br>
                    <!--<select class=\"selectoption\" id=\"abstand\" name=\"televorwahl\" size=\"1\">
                        <option value=\"herr\">+41</option>
                        <option value=\"frau\">079</option>
                    </select>-->
                    <input class=\"input-tele\" type=\"tel\" name=\"telenr\" minlength=\"5\" maxlength=\"30\" placeholder=\"" . $GLOBALS["telenrplaceholder"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["email"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"email\" name=\"email\" maxlength=\"40\" placeholder=\"" . $GLOBALS["emailplaceholder"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["sprache"] . "*</label>
                    <br>
                    <select class=\"selectoption-full\" id=\"abstand\" name=\"spras\" size=\"1\">
                        <option value=\"d\">" . $GLOBALS["sprache1"] . "</option>
                        <option value=\"f\">" . $GLOBALS["sprache2"] . "</option>
                        <option value=\"i\">" . $GLOBALS["sprache3"] . "</option>
                    </select>
                </div>
                <!-- Ab Hier float right -->
                <div class=\"float-sonstige\">
                    <h3>" . $GLOBALS["fahrzeug"] . "</h3>
                    <label class=\"label\">" . $GLOBALS["marke"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"marke\" minlength=\"3\" maxlength=\"40\" placeholder=\"" . $GLOBALS["markeplaceholder"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["modell"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"modell\" minlength=\"3\" maxlength=\"40\" placeholder=\"" . $GLOBALS["modellplaceholder"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["erstinverkehr"] . "*</label>
                    <br>
                    <input class=\"input\" id=\"white\" type=\"date\" name=\"erstinverkehrsetzung\" placeholder=\"" . $GLOBALS["erstinverkehr"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["kennzeichen"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"kontrollschild\" maxlength=\"40\" minlength=\"3\"  placeholder=\"" . $GLOBALS["kennzeichen"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["kilometerstand"] . "*</label>
                    <br>
                    <input class=\"input\" type=\"number\" name=\"kilometerstand\" maxlength=\"10000000\" minlength=\"1\" min=\"0\" placeholder=\"" . $GLOBALS["kilometerstand"] . "\" required>
                    <br>
                    <br>
                    <h3>" . $GLOBALS["reifen"] . "</h3>
                    <label class=\"label\">" . $GLOBALS["artikelnr"] . "*</label>
                    <br>
                    <input class=\"input\" id=\"artikelnummer\" type=\"text\" name=\"artikelnr\" maxlength=\"10\" minlength=\"3\" placeholder=\"" . $GLOBALS["artikelnr"] . "\" onchange=\"get_material_info(this.value)\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["reifenmarke"] . "*</label>
                    <br>
                    <input class=\"input\" id=\"reifenmarke\" type=\"text\" name=\"pneumarke\" maxlength=\"40\" minlength=\"3\" placeholder=\"" . $GLOBALS["reifenmarke"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["profil"] . "*</label>
                    <br>
                    <input class=\"input\" id=\"profil\" type=\"text\" name=\"profil\" maxlength=\"40\" minlength=\"3\" placeholder=\"" . $GLOBALS["profil"] . "\" required>
                    <br>
                    <label class=\"label\" >" . $GLOBALS["dimension"] . "*</label>
                    <br>
                    <input class=\"input\" id=\"dimension\" type=\"text\" name=\"dimension\" maxlength=\"40\" minlength=\"3\" placeholder=\"" . $GLOBALS["dimension"] . "\" required>
                    <br>
                    <label class=\"label\">" . $GLOBALS["anzahl"] . "* &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</label>
                    <label class=\"label\">" . $GLOBALS["vkdatum"] . "* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <label class=\"label\">" . $GLOBALS["vkpreis"] . "*</label>
                    <br>
                    <input class=\"input-number\" type=\"number\" name=\"anzpneu\" maxlength=\"10000\" minlength=\"1\" min='1' max='100' placeholder=\"Anzahl Pneu\" value='4' required>
                    <!-- erkaufsdatum darf nicht unter -->
                    <input class=\"input-vkdatum\" id=\"whitee\" type=\"date\" name=\"verkaufsdatum\" id=\"vkdatum\" min=\"$date2\"  max=\"$date\" required>
                    <input class=\"input-vkpreis\" type=\"text\" name=\"verkaufspreis\" placeholder=\"CHF 00.00\" pattern=\"^\d+(\.|\,)\d{2}$\" title=\"Bitte Preis eingeben z.B 45.00\" required>
                    <!-- Error message -->
                    <br>
                    <label class=\"errormsg\">" . $GLOBALS["14tage"] . "</label>
                    <br>
                    <br>
                    <div class=\"printdelete\">
                    <input class=\"radiobutton-button\" type=\"radio\" name=\"radiobutton\" value=\"0\" required/>
                    <div class=\"radiobutton-div\">
                        <label class=\"radiobutton-text\" type=\"text\">
                            " . $GLOBALS["agb"] . "
                            </label>
                    </div>
                    <br>
                    <p class=\"label\" type=\"text\">" . $GLOBALS["last"] . "</p>
                    <br>
                    <input type='hidden' name='formok' id='formok' value='1'>

                    <input type=\"submit\" id=\"button\"/>
                </div>
                </div>
            </form>
                    </div>
    </div>
</div>
";
}else{
    //Fomular wurde erfolgreich gesendet.
    //Nun müssen Daten empfangen werden und in SAP gespeichert werden.
    //  Wichtig: Serveranbinndung muss eingestellt werden je nach dem...
    //  ----------------------------------------------------------------
    $username = 'safepneu';              //evt. Anpassen
    $password = 'safepneu2015';          //evt. Anpassen
//  TEST System...**************************************
//	$server   = 'gwtest.esa.ch';         //evt. Anpassen
//	$session  = 'SAP_SESSIONID_GWT_100'; //evt. Anpassen
//	$TitleSystem = $server;
//  PROD System...**************************************
    $server   = 'gw.esa.ch';             //evt. Anpassen
    $session  = 'SAP_SESSIONID_GWP_100'; //evt. Anpassen

    //POST Allgemeine Daten
    //$lv_kunnr = $_POST['kunnr'];
    $lv_kunnr =  $GLOBALS["gv_kunnr"];
    $lv_garage = $_POST['name1'];
    //Reifenkäufer Daten
    $lv_anrede = $_POST['anrede'];
    $lv_vorname = $_POST['vorname'];
    $lv_nachname = $_POST['nachname'];
    $lv_strHausnr = $_POST['strasse'];
    $lv_pstlz = $_POST['pstlz'];
    $lv_stadt = $_POST['stadt'];
    $lv_land = $_POST['land'];
    $lv_telenr = $_POST['telenr'];
    $lv_email = $_POST['email'];
    $lv_sprache = $_POST['spras'];
    //POST Fahrzeug Daten
    $lv_marke = $_POST['marke'];
    $lv_modell = $_POST['modell'];
    $lv_inverkehr = $_POST['erstinverkehrsetzung'];
    $lv_kennzeichen = $_POST['kontrollschild'];
    $lv_kilometerstand = $_POST['kilometerstand'];
    //POST reife Daten
    $lv_artikelnr = $_POST['artikelnr'];
    $lv_reifenmarke = $_POST['pneumarke'];
    $lv_profil = $_POST['profil'];
    $lv_dimension = $_POST['dimension'];
    $lv_anzahlPenu = $_POST['anzpneu'];
    $lv_vkdatum = $_POST['verkaufsdatum'];
    $lv_vkpreis = $_POST['verkaufspreis'];
    //leer
    $lv_dot              = " "; //$_POST["spform_dot"];

    // Format Umsetzungen...
    $lv_kaufdatum = date("Ymd", strtotime($lv_vkdatum));
    $lv_inverkehr = date("Ymd", strtotime($lv_inverkehr));

    // Format Json
    $endkunde = array(
        "anrede"               => $lv_anrede,
        "vorname"              => $lv_vorname,
        "nachname"             => $lv_nachname,
        "strasse"              => $lv_strHausnr,
        "plz"                  => $lv_pstlz,
        "ort"                  => $lv_stadt,
       // "land"                 => $lv_land,
        "telefon"              => $lv_telenr,
        "email"                => $lv_email,
        "spras"                => $lv_land
    );
    $fahrzeug = array(
        "marke"                => $lv_marke,
        "modell"               => $lv_modell,
        "erstinverkehrsetzung" => $lv_inverkehr,
        "kontrollschild"       => $lv_kennzeichen,
        "kilometerstand"       => $lv_kilometerstand
    );
    //Alle daten bei Safepneu_data
    $safepneu_data = array(
        "kunnr"                => $lv_kunnr,
        "materialNr"           => $lv_artikelnr,
        "kaufDatum"            => $lv_kaufdatum,
        "pneuDOT"              => $lv_dot,
        //"pneuProfil"           => $lv_profil,
        //"pneuMarke"            => $lv_reifenmarke,
        "pneuAnzahl"           => $lv_anzahlPenu,
        "pneuPreis"            => $lv_vkpreis,
        "endkunde"             => $endkunde,
        "fahrzeug"             => $fahrzeug
    );

    var_dump($safepneu_data);
    //TODO Speicher und verstehen
    //Speichern:
    //Dannach Handling bei erfolg -> mit javascipt überischt garantie öffnen.
    //******************************************************************************************************************

//  Header muss aufgebaut werden mit x-csrf-token: Fetch ...
//  Damit ein POST gestartet werden kann muss mit einem GET der SAP CSRF Token abgefragt werden, ist wir eine SessionId.
    //TODO Wieso kunnr???
    $service_url = 'https://' . $server . '/api/odata/esa/safepneu_srv/customerSet(kunnr=\'25860\')?$format=json';
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);            // TRUE um den Transfer als String zurückzuliefern
    curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");  // Benutzername und Passwort im Format "[benutzername]:[passwort]"
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);        // Die zu nutzende HTTP-Authentisierungsmethode
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);           // FALSE um die überprüfung des Peerzertifikats seitens cURL zu unterdrücken.
    curl_setopt($curl, CURLOPT_VERBOSE, TRUE);                   // TRUE um ausführliche Informationen auszugeben, entweder nach STDERR oder in die mittels der Option CURLOPT_STDERR gewählte Datei.
    curl_setopt($curl, CURLOPT_HEADER, TRUE);                    // Gibt den Header zurück...
    curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'X-CSRF-TOKEN: Fetch')); // Min. Header für x-csrf-token übergeben..-

// * Gibt bei Erfolg TRUE zurück. Im Fehlerfall wird FALSE zurückgegeben.
// * Ist jedoch die Option CURLOPT_RETURNTRANSFER gesetzt so wird das Ergebnis des cURL-Transfers zurückgegeben, im Falle eines Fehlers FALSE.
    $curl_response = curl_exec($curl);
    curl_close($curl);
    if ($curl_response === false) {
        $msg_error = 'Fehlermeldung Nr01: ' . curl_error($curl);
        die($msg_error);
    }

//  extract the CSRF Token from the Header..
//  Step 1 Header und Content trennen.
    list($headers, $content) = explode("\r\n\r\n", $curl_response, 2);
//  extract x-csrf token from Header
    $xcsrf_token = '';
    foreach (explode("\r\n",$headers) as $hdr){
        // printf('<p>Header: %s</p>', $hdr);
        $elements = explode(":", $hdr);
        if ($elements[0] == 'x-csrf-token'){
            $xcsrf_token = $elements[1];
        }
    }

    //  Cookies müssen enpackt werden ...
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $curl_response, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
        parse_str($item, $cookie);
        $cookies = array_merge($cookies, $cookie);
    }
    // echo "$xcsrf_token<hr>"	;

//  POST safepneu set ******************************************************************
    $safepneu_json = json_encode($safepneu_data);
    $service_url = 'https://' . $server . '/api/odata/esa/safepneu_srv/safepneuSet';
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Cache-Control: no-cache',
        'Host: '. $server,                // Systemabhängig
        'X-CSRF-TOKEN: ' . $xcsrf_token);
    // echo "$service_url<hr />";
    $ch = curl_init($service_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            // TRUE um den Transfer als String zurückzuliefern
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");  // Benutzername und Passwort im Format "[benutzername]:[passwort]"
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);        // Die zu nutzende HTTP-Authentisierungsmethode
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);           // FALSE um die überprüfung des Peerzertifikats seitens cURL zu unterdrücken.
    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);                   // TRUE um ausführliche Informationen auszugeben, entweder nach STDERR oder in die mittels der Option CURLOPT_STDERR gewählte Datei.
    curl_setopt($ch, CURLOPT_HEADER, TRUE);                    // Gibt den Header zurück...
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);            // Min. Header für x-csrf-token übergeben..-
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");           // Eine benutzerdefinierte Request-Methode, die anstelle von GET oder HEAD für den HTTP-Request benutzt werden soll. Dies ist nützlich bei DELETE oder anderen unüblichen Requests. Zulässige Werte sind GET, POST, CONNECT etc.
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $safepneu_json);      // inhalt für POST
    curl_setopt($ch, CURLOPT_COOKIE, "sap-usercontext=" . $cookies["sap-usercontext"]);
    curl_setopt($ch, CURLOPT_COOKIE, $session. "=" .      $cookies[$session]);            // Systemabhängig
    $sap_response = curl_exec($ch);
    curl_close($ch);
    if ($sap_response === false) {
        $msg_error = 'Fehlermeldung Nr02: ' . curl_error($ch);
        die($msg_error);
    }
//  Step 1 Header und Content trennen.
    list($response_header, $json_content) = explode("\r\n\r\n", $sap_response, 2);

    //  Rückgabe wird ausgewerte, damit der ganze Garantieschein angezeigt werden kann.
    $decoded_json_content = json_decode($json_content);

//  es werden nur die folgenden drei werte extrahiert, die ander müssen gleich wie der Input sein.
    $gueltigVon     = $decoded_json_content->d->kaufDatum;
    $gueltigBis     = $decoded_json_content->d->endDatum;
    $garantieNummer = $decoded_json_content->d->garantienr;

    //  Datumsformat für Output erstellen...
    $gueltigBis = date("d.m.Y", strtotime($gueltigBis));
    $gueltigVon = date("d.m.Y", strtotime($gueltigVon));
    $lv_inverkehrsetzung = date("d.m.Y", strtotime($lv_inverkehr));
    $lv_kaufdatum = date("d.m.Y", strtotime($lv_kaufdatum));
    //******************************************************************************************************************

}
?>

