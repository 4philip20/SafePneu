<?php
//TODO machen mit value
//INITIAL WERTE
$date = date('Y-m-d', strtotime(' +0 day'));
$date2 = date('Y-m-d', strtotime(' -14 day'));


//********************************************************************************
//GET Garageame By Kunnr
//********************************************************************************
$username = 'safepneu';       //evt. Anpassen
$password = 'safepneu2015';   //evt. Anpassen
//	$server   = 'gwtest.esa.ch';  //evt. Anpassen
//	$TitleSystem = $server;
//  ************************************
$server   = 'gw.esa.ch';  //evt. Anpassen
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
} else {
    $GLOBALS["gv_kunnr"] = "0";
    $name1 = "Error";
}
//****************************************************************************************************************************
//TODO:Daten lesen
//****************************************************************************************************************************

//Falls formular_value dann FORMULAR _*SOFORT*_ ANZEIGEN
    echo "<div id=\"myModal\" class=\"modal\" style=\"display: block;\">";

echo"
<h1>FORM LESEN = 1 VALUE</h1>
        <!-- Modal content -->
        <div class=\"modal-content\">
            <!-- Modal content close-->
            <span class=\"close\">&times;</span>
            <!-- in Modal content Formular-->
                <form action=\"senden.html\" id=\"person\">
                <!-- Überschirft -->
                <h3>". $GLOBALS["formsafepeuh1"]."</h3>
                <!-- some text -->
                <p>". $GLOBALS["lorem"]."</p>
                <br>
                <!-- div für linke und rechte formular spalte unterscheiden -->
                <div class=\"float-verkaufer\">
                    <!-- Überschirft -->
                    <h3>". $GLOBALS["reifenverkäufer"]."</h3>
                    <label class=\"label\" type=\"text\" name=\"kunnr\">". $GLOBALS["kundennummer"]."</label>
                    <br>
                    <input class=\"input\" id=\"grau\" type=\"text\" name=\"kunnr\" maxlength=\"30\" placeholder=\"123456\" value=\"". $GLOBALS["gv_kunnr"]."\" disabled>
                    <br>
                    <label class=\"label\" type=\"text\" name=\"kunnr\">". $GLOBALS["garage"]."</label>
                    <br>
                    <input class=\"input\" id=\"grau\" type=\"text\" name=\"name1\" maxlength=\"30\" placeholder=\"". $GLOBALS["garageplaceholder"]."\" value=\"$name1\" disabled>
                    <br>
                    <br>
                    <!--</div>-->
                    <!--<div class=\"float-kaufer\">-->
                    <h3>". $GLOBALS["reifenkäufer"]."</h3>
                    <label class=\"label\">". $GLOBALS["anrede"]."*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <label class=\"label\">". $GLOBALS["vorname"]."*</label>
                    <br>
                    <select class=\"selectoption\" id=\"abstand\" name=\"anrede\" size=\"1\"\">
                    <option value=\"herr\">". $GLOBALS["herr"]."</option>
                    <option value=\"frau\">". $GLOBALS["frau"]."</option>
                    </select>
                    <input class=\"input-vorname\" type=\"text\" name=\"vorname\" minlength=\"3\" maxlength=\"30\" placeholder=\"". $GLOBALS["vorname"]."\" id=\"vorname\"\" required>
                    <br>
                    <label class=\"label\" name=\"nachname\">". $GLOBALS["nachname"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"nachname\" maxlength=\"30\" minlength=\"3\" placeholder=\"". $GLOBALS["nachname"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["strudhausnr"]."*</label>
                    <br>
                    <input class=\"input-strasse\" type=\"text\" name=\"strasse\" minlength=\"3\" maxlength=\"30\" placeholder=\"Musterstrasse 12\" required>
                    <!--<input class=\"input-number\" type=\"text\" name=\"strassenr\" minlength=\"1\" maxlength=\"30\" placeholder=\"12\" required>-->
                    <br>
                    <label class=\"label\" >". $GLOBALS["pstlz"]."*</label>
                    <br>
                    <input class=\"input\" type=\"number\" name=\"pstlz\" minlength=\"3\" maxlength=\"5\" placeholder=\"3400\" required>
                    <br>
                    <label class=\"label\" >". $GLOBALS["stadt"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"stadt\" minlength=\"3\" maxlength=\"30\" placeholder=\"Stadt\" required>
                    <br>
                    <label class=\"label\" >". $GLOBALS["land"]."*</label>
                    <br>
                    <select class=\"selectoption-full\" id=\"abstand\" name=\"land\" size=\"1\">
                        <option value=\"d\">". $GLOBALS["sprache1"]."</option>
                        <option value=\"f\">". $GLOBALS["sprache2"]."</option>
                        <option value=\"i\">". $GLOBALS["sprache3"]."</option>
                        <option value=\"ö\">". $GLOBALS["sprache4"]."</option>
                    </select>
                    <br>
                    
                    <!--<label class=\"label\">". $GLOBALS["vorwahl"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>-->
                    <label class=\"label\">". $GLOBALS["telenr"]."</label>
                    <br>
                    <!--<select class=\"selectoption\" id=\"abstand\" name=\"televorwahl\" size=\"1\">
                        <option value=\"herr\">+41</option>
                        <option value=\"frau\">079</option>
                    </select>-->
                    <input class=\"input-tele\" type=\"tel\" name=\"telenr\" minlength=\"5\" maxlength=\"30\" placeholder=\"". $GLOBALS["telenrplaceholder"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["email"]."*</label>
                    <br>
                    <input class=\"input\" type=\"email\" name=\"email\" maxlength=\"40\" placeholder=\"". $GLOBALS["emailplaceholder"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["sprache"]."*</label>
                    <br>
                    <select class=\"selectoption-full\" id=\"abstand\" name=\"spras\" size=\"1\">
                        <option value=\"d\">". $GLOBALS["sprache1"]."</option>
                        <option value=\"f\">". $GLOBALS["sprache2"]."</option>
                        <option value=\"i\">". $GLOBALS["sprache3"]."</option>
                        <option value=\"ö\">". $GLOBALS["sprache4"]."</option>
                    </select>
                </div>
                <!-- Ab Hier float right -->
                <div class=\"float-sonstige\">
                    <h3>". $GLOBALS["fahrzeug"]."</h3>
                    <label class=\"label\">". $GLOBALS["marke"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"marke\" minlength=\"3\" maxlength=\"40\" placeholder=\"". $GLOBALS["markeplaceholder"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["modell"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"modell\" minlength=\"3\" maxlength=\"40\" placeholder=\"". $GLOBALS["modellplaceholder"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["erstinverkehr"]."*</label>
                    <br>
                    <input class=\"input\" id=\"white\" type=\"date\" name=\"erstinverkehrsetzung\" placeholder=\"". $GLOBALS["erstinverkehr"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["kennzeichen"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"kontrollschild\" maxlength=\"40\" minlength=\"3\" placeholder=\"". $GLOBALS["kennzeichen"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["kilometerstand"]."*</label>
                    <br>
                    <input class=\"input\" type=\"number\" name=\"kilometerstand\" maxlength=\"10000000\" minlength=\"1\" placeholder=\"". $GLOBALS["kilometerstand"]."\" required>
                    <br>
                    <br>
                    <h3>". $GLOBALS["reifen"]."</h3>
                    <label class=\"label\">". $GLOBALS["artikelnr"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"artikelnr\" maxlength=\"40\" minlength=\"3\" placeholder=\"". $GLOBALS["artikelnr"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["reifenmarke"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"pneumarke\" maxlength=\"40\" minlength=\"3\" placeholder=\"". $GLOBALS["reifenmarke"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["profil"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"profil\" maxlength=\"40\" minlength=\"3\" placeholder=\"". $GLOBALS["profil"]."\" required>
                    <br>
                    <label class=\"label\" type=\"text\">". $GLOBALS["dimension"]."*</label>
                    <br>
                    <input class=\"input\" type=\"text\" name=\"dimension\" maxlength=\"40\" minlength=\"3\" placeholder=\"". $GLOBALS["dimension"]."\" required>
                    <br>
                    <label class=\"label\">". $GLOBALS["anzahl"]."* &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</label>
                    <label class=\"label\">". $GLOBALS["vkdatum"]."* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <label class=\"label\">". $GLOBALS["vkpreis"]."*</label>
                    <br>
                    <input class=\"input-number\" type=\"number\" name=\"anzpneu\" maxlength=\"10000\" minlength=\"1\" placeholder=\"Anzahl Pneu\" required>
                    <!-- erkaufsdatum darf nicht unter -->
                    <input class=\"input-vkdatum\" id=\"whitee\" type=\"date\" name=\"verkaufsdatum\" id=\"vkdatum\" min=\"$date2\"  max=\"$date\" required>
                    <input class=\"input-vkpreis\" type=\"text\" name=\"verkaufspreis\" placeholder=\"CHF 00.00\" minlength=\"1\" required>
                    <!-- Error message -->
                    <br>
                    <label class=\"errormsg\">". $GLOBALS["14tage"]."</label>
                    <br>
                    <br>
                    <!--
                    <div class=\"printdelete\">
                    <input class=\"radiobutton-button\" type=\"radio\" name=\"radiobutton\" value=\"0\" required/>
                    <div class=\"radiobutton-div\">
                        <label class=\"radiobutton-text\" type=\"text\">
                            ". $GLOBALS["agb"]."
                            </label>
                    </div>
                    
                    <br>
                    <p class=\"label\" type=\"text\">". $GLOBALS["last"]."</p>
                    <br>

                    <input type=\"submit\" id=\"button\"/>-->
                </div>
                </div>
            </form>
                    </div>

    </div>

</div>
";
?>

