<?php

class Router
{
    public $route = [];
    public $request_path = '';
    public $request_arg = [];

    public $controller_name = '';
    public $controller_action = '';


    /* décompose l'URL REQUEST_URI 
    http://username:password@hostname:9090/path?arg1=value1&arg=value2#anchor
    path -> request_path = path
    arg1=value1&arg=value2 -> request_arg=['arg1'=>'value1', 'arg2'=>'value2']
    */
    public function parseRequestURI($sRequestURI) 
    {

        $aFragment = parse_url($sRequestURI);
        $this->request_path = $aFragment['path']??'/';
        if (isset($aFragment['query'])) {
            $this->request_arg = $this->parseQuery($aFragment['query']) ?? [];
        }

    }

    // Decomposition de arguments de la requete
    // forme = arg1=value1&arg=value2
    private function parseQuery($sQuery)
    {
        $aReturn = array();

        // Decoupe chaque argument de la requete
        $aParam = explode('&', $sQuery);
        foreach ($aParam as $sParam) {
            // Decoupe le nom de l'argument et sa valeur
            $aVal = explode('=', $sParam);
            $aReturn[$aVal[0]]=$aVal[1];            
        }
        return($aReturn);
    }

    public function addRoute($sRequestPath, $sController, $sAction)
    {
        if (
            is_string($sRequestPath) &&
            ! empty($sRequestPath) &&
            is_string($sController) &&
            ! empty($sController) &&
            is_string($sAction) &&
            ! empty($sAction) 
        ) {
            $this->route[$sRequestPath] = [
                'controller_name' => $sController, 
                'controller_action' => $sAction
                ];
        }
    }

    public function matchRoute()
    {
        
        if (array_key_exists($this->request_path, $this->route)) {
            $this->setController(
                $this->route[$this->request_path]['controller_name'],
                $this->route[$this->request_path]['controller_action']
            );
        } else {
            $this->setController(
                $this->route['default']['controller_name'],
                $this->route['default']['controller_action']
            );
        }
    
    }

    private function setController( $sControllerName, $sControllerAction )
    {
        // Enregistre les propriétés du controller et de l'ction
        $this->controller_name   = $sControllerName;
        $this->controller_action = $sControllerAction;

    }

}