<?php
function computePolkadotScore($ascii) {
    $lines = explode("\n", $ascii);

    $lipsStart = null;
    $lipsEnd = null;

    
    foreach ($lines as $line) {
        if (strpos($line, '(') !== false && strpos($line, ')') !== false) {
            
            if (substr_count($line, '(') == 1 && substr_count($line, ')') == 1) {
                $lipsStart = strpos($line, '(');
                $lipsEnd = strrpos($line, ')');
                break;
            }
        }
    }

    
    $pupilChars = 0;
    foreach ($lines as $line) {
        if (preg_match('/O\s+O/', $line)) {
            $pupilChars = 2;
            break;
        }
    }

    
    $inside = 0;
    $outside = 0;

    foreach ($lines as $lineIndex => $line) {
        for ($i = 0; $i < strlen($line); $i++) {
            if ($line[$i] === 'O') {


                if ($lineIndex < count($lines) / 2) continue;

                if ($lipsStart !== null && $i >= $lipsStart && $i <= $lipsEnd) {
                    $inside++;
                } else {
                    $outside++;
                }
            }
        }
    }


    return $outside + ($inside * $pupilChars);
}

$ascii = <<<TEXT
              ,   ,-',
        ,', ,'  ','  ,'   ÅÑGË£ÏÇÄ †(–)Ë ßRÄ†
      '-',  '      ,'
          ' -,    ',
              ' -, ',                                         , - - -,
             ('''''' ®'''''''')                        ,,,,,    ,-' -,''''''''',
              ` ~„''`„~ '                          ',  ,', -' , -,'' ''''''''',
                  "„  " - „                   „ - ",®,-'     `~~' '''''''
                 „"         " „         „ - "      ,',,,',
               „-" " " " " " " ~~~~~~" - „       ,'
            „" –,'' ~ ,       • ; •          "      "„
            """";      ' - , ,  ; , , , - '' ' ' -,_ ', ',
           , -' ' ',           ,'    ,'             ',~', ',
         ,'         ' - , ,()' /\    ',          (),'¯ ,'   `¸`;
         ',                            ` ` ` ` ` `      ,-,,,-'
           '-,                                  ,¬  ,-'
              ' -, ~            ~~~~~~' ' ` ,-'
                  `~-,,,,,,,      ,,,,,,,,,,-~'
      ('('('(,,,              ;    ;                •Å(V)åö•
       '-, '-,'''      ,-';`,`'ˆˆˆˆˆ ,' ;' ' -,           •97•
         ;¯ ;      ;  ;  ', ; ; ,'  ;  ‚¸  ' -,        •••
         ;   ;     ;       '''''''''''    ``'-,',  ,'
         ;   ;, -¬;    O   O      O   '-',,,,,,,,,,,,
         ;        ;  O   O     O O    O  ,'     O     ,'
          ' - - ' `;    O        O  O    O   O    ,'
               ,-'   O    O    O  O      O    O   ,'
            ,-' O O  O   O        O        O ,'
         ,-'   O      O   O   O     O  O     ,'
      ,-'  O    O    O  O   O   O O O   O,-'-,
       ``¬ -,,,,,,,-¬~,~~~~~~~~~--',)  (' -,
                    ',   (',                     ' -,    '-,
                     ',)  (',                        `-,)  ' -,
                      ',    ',                           `-,  ,',-----,
                       ',)   ;                              `\,- ---'
                   ¸,,,,'‡  (;
                  (¸,,,,,';_'\ ßy §(V)òó†(–)775 ™
TEXT;

$result = computePolkadotScore($ascii);

echo "Polkadot Score: " . $result;
?>