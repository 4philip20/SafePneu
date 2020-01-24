<?php
//Require usw
require_once('include/get_language.php');
require_once('menu.php');


class index
{

    public $gt_sprache = "de";
    public $gt_allowed_langs = array ('de', 'fr', 'it');

    function __construct()
    {
        $this->gt_sprache = "de";
    }

    public function getParameter(){
        if (!isset($_GET["debitornr"])) {      // Wenn nicht vorhanden
            $GLOBALS['gv_kunnr'] ='0';
            $GLOBALS['gv_formular'] ='0';
        } else {
            $GLOBALS['gv_kunnr'] = $_GET["debitornr"];
            $GLOBALS['gv_formular'] ='1';
        }
    }

    public function setHtmlHeader()
    {
            $lv_result = "
            <!DOCTYPE html>
            <html lang='$this->gt_sprache'>
            <head>
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
              <!--  <link rel=\"stylesheet\" href=\"/assets/css/main.css\" type=\"text/css\"> -->
                <link rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">

<!-- TODO Übersetzung
<script type=\"text/javascript\">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'de'}, 'google_translate_element');
    }
</script>

<script type=\"text/javascript\" src=\"//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"></script>
-->
            </head>
            ";

        return $lv_result;
    }

    public function getSprache(){
        //Noch anschauen
        $this->gt_sprache = lang_getfrombrowser ($this->gt_allowed_langs, 'de', null, false);
        $GLOBALS['sprache'] = $this->gt_sprache;
    }

    public function setMenu(){
        $menu = new menu();
        $lv_result = $menu->setMenu();
        return $lv_result;
    }
}
//Objekt instanzieren
$HtmlSeite = new index();
//Hier läuft Programm ab
echo $HtmlSeite->setHtmlHeader();
$HtmlSeite->getParameter();
$HtmlSeite->getSprache();
echo $HtmlSeite->setMenu();


