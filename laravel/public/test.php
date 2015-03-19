<?php

  $translation = file_get_contents("http://itranslate4.eu/api/Translate?auth=df287e5e-6b1f-4319-90c7-9bc3ba3e45c4&src=de&trg=en&dat=Andreas+hat+seine+Aufgabe+erledigt.&dat=Er+kann+jetzt+nach+Hause+gehen.");

  $array = json_decode($json, true);
   
  echo $array;


?>
