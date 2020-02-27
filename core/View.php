<?php

Class View
{
    private $page_title = "Titre de la page";
    private $page_keywords = "Mots clés de la page";
    private $page_description = "Description de la page";
    private $html_head_content = "";
    private $page_menu = "";
    private $page_content = "";
//    private $footer_template = "";
    private $footer_content = "";

    public $data = null;

    public function render()
    {
        global $oApp;

        // Demarre la bufferisation de sortie
        ob_start();
        echo('<!doctype html>'.PHP_EOL);
        echo('<html lang="fr" dir="ltr">'.PHP_EOL);
        printf( 
            $this->html_head_content,
            $this->page_keywords,
            $this->page_description,
            $this->page_title
        );
/*
        printf( $this->readTemplate("htmlhead.html"),
            $this->page_keywords,
            $this->page_description,
            $this->page_title
            );
*/            
        echo('<body>'.PHP_EOL);
        echo($this->page_menu);
        echo($this->page_content);
        echo($this->footer_content );
        DebugUtil::debugPanel($oApp);
        echo('</body>'.PHP_EOL);
        echo('</html>');
        // envoi le buffer sur la sortie puis libere le buffer
        ob_end_flush();
    }

    public function setData( $sKey, $value )
    {
        if ( is_string($sKey) && ! empty($sKey) ) {
            $this->data[$sKey] = $value;
        }
    }

    public function getData( $sKey )
    {
        if ( ! isset($sKey) ) {
            throw new \Exception("View: error getData(\"$sKey\") not exist", 1);
        }

        return($this->data[$sKey]);
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

    public function setHtmlHeadContent( $sHtmlHeadContent )
    {
        $this->html_head_content = $sHtmlHeadContent;
    }

    public function setPageMenu( $sPageMenu )
    {
        $this->page_menu = $sPageMenu;
    }

    public function setPageContent( $sPageContent )
    {
        $this->page_content = $sPageContent;
    }

    public function setFooterContent( $sFooterContent )
    {
        $this->footer_content = $sFooterContent;
    }

    protected function readTemplate( $sTemplateName )
    {
        global $oApp;

/*        
        if ( Validate::checkstring($sTemplateName) ) {
            throw new \Exception(__CLASS__.": Error template name '$sTemplateName' not valid", 1);
        }
*/
        $sTemplate = "";

        $sFile = $oApp->base_path . 'app/template/'.$sTemplateName;
        $sTemplate = $this->readTemplateFile($sFile);
        if ( $sTemplate === false ) {
            $sFile = $oApp->base_path . 'core/template/'.$sTemplateName;
            $sTemplate = $this->readTemplateFile($sFile);
            if ( $sTemplate === false ) {
                throw new \Exception("Template not found" . $sTemplateName, 1);
            }
        }

        return($sTemplate);
    }

    private function readTemplateFile($sFile)
    {
        $sTemplate = false;

        if (file_exists($sFile) && is_file($sFile)) {
            $sTemplate = file_get_contents($sFile);
            if ($sTemplate === false) {
                throw new \Exception("Unable to load template " . $sTemplateName, 1);
            } 
        }

        return($sTemplate);
    }

}
