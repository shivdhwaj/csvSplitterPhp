<?php
    //add the ui thing to select the file and then split it and zip finally and give it back
    $inputFile = 'input.csv';
    $outputFile = 'output';
    $splitSize = 2;
    if (($in = fopen($inputFile, 'r'))) {
        $header = fgetcsv($in);
        $rowCount = 0;
        $fileCount = 0;
        while (($data = fgetcsv($in))) {
            if (($rowCount % $splitSize) == 0) {
                if ($rowCount > 0) {
                    fclose($out);
                }
                $filename = $outputFile . ++$fileCount . '.csv';
                $out = fopen($filename, 'w');
                chmod($filename, 755);
                fputcsv($out, $header);
            }
            fputcsv($out, $data);
            $rowCount++;
        }
        fclose($out);
    }
?>
