window.onload = setVariableGlobal;
labMatEingeben       = 'Bitte Matnummer eingeben';

    function get_material_info(lv_matnr) {
        //TODO GET SPRACHE UND AUSGABE NACH SPRACHE
        //alert(lv_matnr);
        document.getElementById("reifenmarke").value = "";
        document.getElementById("dimension").value = "";
        document.getElementById("profil").value = "";
        document.getElementById("artikelnummer").value = "";

        if (lv_matnr === "") {
            document.getElementById("artikelnummer").innerHTML = labMatEingeben;
            return;
        }
        if (window.XMLHttpRequest) {
            // AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera
            xmlhttp = new XMLHttpRequest();
        } else {
            // AJAX mit IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var response = xmlhttp.responseText;
                var json = JSON.parse(response);
                // eine Antwort ist gekommen, Fage ist sie richtig?
                if (typeof (json.error) === "undefined") {
                    //Dimension muss erstellt werden
                    var lv_dimension = json.d.breite;
                    lv_dimension += '/';
                    lv_dimension += json.d.serie;
                    lv_dimension += ' ';
                    lv_dimension += json.d.radial;
                    lv_dimension += ' ';
                    lv_dimension += json.d.zoll;
                    //Abfüllen der gefundenen Werte ins Formular...
                    document.getElementById("reifenmarke").value = json.d.hersteller;
                    document.getElementById("dimension").value = lv_dimension;
                    document.getElementById("profil").value = json.d.profil;
                    document.getElementById("artikelnummer").value = lv_matnr;

                    //KontrollMat = lv_matnr;

                } else {
                    // Material wurde nicht gefunden in SAP -> json.error Elemen ist vorhanden.
                    document.getElementById("artikelnummer").value = "Artikelnummer "+lv_matnr+" ist nicht Vorhanden ";
                    document.getElementById("reifenmarke").value = "";
                    document.getElementById("dimension").value = "";
                    document.getElementById("profil").value = "";
                }
            }
            //alert("NUMMER NICHT VORHANDEN");

        };
        //TODO TEST löschen
        // Material wird auf dem GW oder GWTEST abgefragt via PHP für die sicherheit.
        //Failed to load resource: the server responded with a status of 404 (Not Found)
        //xmlhttp.open("GET", "/include/getmatinfo.php?matnr=" + lv_matnr, true);
        //Failed to load resource: the server responded with a status of 404 (Not Found)
        //xmlhttp.open("GET", "getmatinfo.php?matnr=" + lv_matnr, true);
        //Failed to load resource: the server responded with a status of 404 (Not Found)
        //xmlhttp.open("GET", "../getmatinfo.php?matnr=" + lv_matnr, true);
        //Failed to load resource: the server responded with a status of 404 (Not Found)
        //xmlhttp.open("GET", "../include/getmatinfo.php?matnr=" + lv_matnr, true);
        xmlhttp.open("GET", "./include/getmatinfo.php?matnr=" + lv_matnr, true);
        xmlhttp.send();

    }
