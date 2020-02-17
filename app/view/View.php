<?php

Class View
{
    private $page_title = "Titre de la page";
    private $page_keywords = "Mots clés de la page";
    private $page_description = "Description de la page";
    private $page_menu = "";
    private $page_content = "";
    private $footer_template = "";

    public function render()
    {
        // Demarre la bufferisation de sortie
        ob_start();
        echo('<!doctype html>'.PHP_EOL);
        echo('<html lang="fr" dir="ltr">'.PHP_EOL);
        printf( $this->readTemplate("htmlhead.html"),
            $this->page_keywords,
            $this->page_description,
            $this->page_title
            );
        echo('<body>'.PHP_EOL);
        echo($this->page_menu);
        echo($this->page_content);
        echo($this->readTemplate( $this->footer_template ));
        $this->debugPanel();
        echo('</body>'.PHP_EOL);
        echo('</html>');
        // envoi le buffer sur la sortie puis libere le buffer
        ob_end_flush();
    }

    public function setPageTitle( $sPageTitle )
    {
        $this->page_title = $sPageTitle;
    }

    public function setPageKeywords( $sPageKeywords )
    {
        $this->page_keywords = $sPageKeywords;
    }

    public function setPageDescription( $sPageDescription )
    {
        $this->page_description = $sPageDescription;
    }

    public function setPageMenu( $sPageMenu )
    {
        $this->page_menu = $sPageMenu;
    }

    public function setPageContent( $sPageContent )
    {
        $this->page_content = $sPageContent;
    }

    public function setFooterTemplate( $sFooterTemplate )
    {
        $this->footer_template = $sFooterTemplate;
    }

    protected function readTemplate( $sTemplateName )
    {
        $sTemplate = "";
        if (!empty($sTemplateName)) {
            $sFile = '../template/'.$sTemplateName;
            if (file_exists($sFile) && is_file($sFile)) {
                $sTemplate = file_get_contents($sFile);
                if ($sTemplate === false) {
                    throw new \Exception("Unable to load template " . $sTemplateName, 1);
                }
            } else {
                throw new \Exception("Template not found" . $sTemplateName, 1);
            }
        }

        return($sTemplate);
    }

    private function debugPanel()
    {
        global $oApp;

        echo "<hr/>\n";

        echo "<h5>APP</h5>";
        var_dump($oApp);

        echo "<h5>SERVER</h5>";
        foreach ($_SERVER as $sKey => $sValue) {
            if (! in_array($sKey, [
                'HTTP_USER_AGENT',
                'HTTP_ACCEPT',
                'HTTP_ACCEPT_LANGUAGE',
                'HTTP_ACCEPT_ENCODING',
                'HTTP_CONNECTION',
                'HTTP_UPGRADE_INSECURE_REQUESTS',
                'HTTP_CACHE_CONTROL',
                'PATH',
                'SystemRoot',
                'WINDIR',
                'COMSPEC',
                'PATHEXT',
                'SERVER_SOFTWARE',
                'SERVER_SIGNATURE',
                'SERVER_ADDR',
                'SERVER_PORT',
                'REMOTE_ADDR',
                'REMOTE_PORT',
                'REQUEST_SCHEME',
                'SERVER_ADMIN',
                'GATEWAY_INTERFACE',
                'SERVER_PROTOCOL',
                'REQUEST_TIME_FLOAT',
                'REQUEST_TIME'
                ]) ) {

                echo "$sKey:$sValue<br/>";
            }
        }

        echo "<h5>GET</h5>";
        print_r($_GET);

        echo "<h5>POST</h5>";
        print_r($_POST);

        echo "<h5>COOKIE</h5>";
        print_r($_COOKIE);

        echo "<h5>SESSION</h5>";
        if(isset($_SESSION)){
            print_r($_SESSION);
        }
    }

}
