<?php


class menu
{

    public function setMenu()
    {
        /*
        if ($lv_sprache == "fr") {
            //Französisch
            require_once("/safepneu/include/sprache/fr_langVariable.php");
        } elseif ($lv_sprache == "it") {
            //Italienisch
            require_once("/safepneu/include/sprache/it_langVariable.php");
        } else {
            //Deutsch
            require_once("/safepneu/include/sprache/de_langVariable.php");
        }
        */
        if (!isset($_GET["lang"])) {      // Wenn nicht vorhanden
            require_once("include/sprache/de_langVariable.php");
        } else if ($_GET["lang"] == "fr") {
            require_once("include/sprache/fr_langVariable.php");
        } else if ($_GET["lang"] == "it") {
            require_once("include/sprache/it_langVariable.php");
        } else {
            require_once("include/sprache/de_langVariable.php");
        }

        $lv_result = "
<body style='height: 1300px;
             width: 1630px;'>
             
<!-- TODO Übersetzung 
<div id=\"google_translate_element\"></div>
-->
        <img src=\"/safepneu/Bilder/icon.png\" class=\"logo\">
<h2>" . $GLOBALS["titel"] . "</h2>
<img src=\"/safepneu/Bilder/pfeil.png\" class=\"pfeil\">
<p class=\"back\">" . $GLOBALS["back2uebersicht"] . "</p>
<div class=\"tab\">";

/*
          $lv_result = $lv_result . "
    <button class=\"tablinks active\" onclick=\"openCity(event, 'abschliessen')\">" . $GLOBALS["garantieabschliessen"] . "</button>
    <button class=\"tablinks\" onclick=\"openCity(event, 'ueberischt')\">" . $GLOBALS["meinegarantien"] . "</button>";
*/

        //Prüfen für Ausagbe, nach POST ist else fall
        if (!isset( $_POST['formok'])){
            $lv_result = $lv_result . "
    <button class=\"tablinks active\" onclick=\"openCity(event, 'abschliessen')\">" . $GLOBALS["garantieabschliessen"] . "</button>
    <button class=\"tablinks\" onclick=\"openCity(event, 'ueberischt')\">" . $GLOBALS["meinegarantien"] . "</button>";
        }else{
            $lv_result = $lv_result . "
    <button class=\"tablinks\" onclick=\"openCity(event, 'abschliessen')\">" . $GLOBALS["garantieabschliessen"] . "</button>
    <button class=\"tablinks active\" onclick=\"openCity(event, 'ueberischt')\">" . $GLOBALS["meinegarantien"] . "</button>";
        }

        $lv_result = $lv_result . "
</div>
<div id=\"abschliessen\" class=\"tabcontent\" >
    <div class=\"bild\">
        <img src=\"/safepneu/Bilder/safepneu_logo.jpg\" id=\"bild\">
    </div>
    <div class=\"abschliessen-text\">
        <h3>" . $GLOBALS["titel"] . "</h3>
        <p>" . $GLOBALS["titel_beschreibung"] . "</p>
        <button id=\"myBtn\">" . $GLOBALS["garantieabschliessen"] . "</button>
    </div>
    ";
        //FORMULAR ausgabe nach Bedingung formlesen
        if (!isset($_GET["formlesen"]) or $_GET["formlesen"] == '0'){
            include 'include/formular_empty.php';       //Falls nichts gesetzt
        }else{
            include 'include/formular_value.php';
            $GLOBALS['gv_formular'] = '1';
        }

        $lv_result = $lv_result . "
                    </div>
    </div>
</div>
<div id=\"ueberischt\" class=\"tabcontent\" >
    <h3>" . $GLOBALS["uebersicht"] . "</h3>
</div>

<script type=\"text/javascript\" src=\"/safepneu/include/javascript.js\"></script>
<script type=\"text/javascript\" src=\"/safepneu/include/get_material_info.js\"></script>

        ";

        //TODO TEST
        if (!isset( $_POST['formok'])){
            $lv_result = $lv_result . "
    <script>        
        document.getElementById('abschliessen').style.display = 'block';
        document.getElementById('ueberischt').style.display = 'none';
    </script>
            ";
        }else {
            $lv_result = $lv_result . "
    <script>        
        document.getElementById('abschliessen').style.display = 'none';
        document.getElementById('ueberischt').style.display = 'block';
    </script>
    ";

        }

        return $lv_result;
    }

}
