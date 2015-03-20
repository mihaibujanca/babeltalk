<html>
    <head>
            
    </head>
    
    <body>
        <?php
            $Url = "http://itranslate4.eu/api/Translate?auth=785f2f42-eab1-461d-8a72-a1867112458a&src=de&trg=en&dat=Andreas+hat+seine+Aufgabe+erledigt.&dat=Er+kann+jetzt+nach+Hause+gehen.";
            $contents = url_get_contents($Url);
            echo $contents; 
            function url_get_contents ($Url) {
                if (!function_exists('curl_init')){ 
                    die('CURL is not installed!');
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $Url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                return $output;
            }       
            
            
        ?>
    </body>
</html>