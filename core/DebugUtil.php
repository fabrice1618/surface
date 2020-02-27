<?php 

class DebugUtil
{

    public static function callStack($aStacktrace) 
    {
        $sReturn = str_repeat("=", 50) ."\n";

//        $i = 1;
        foreach($aStacktrace as $key => $aNode) {
            $sReturn .= "$key. ".basename($aNode['file']) .":" .$aNode['function'] ."(" .$aNode['line'].")\n";
  //          $i++;
        }

        return($sReturn);
    } 

    public static function debugPanel( $oApp )
    {
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