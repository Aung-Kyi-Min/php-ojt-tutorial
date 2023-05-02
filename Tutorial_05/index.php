<?php
      use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
      require_once 'libs/vendor/box/spout/src/Spout/Autoloader/autoload.php';  
      function readTextFile()
{
    $file = "./files/sample.txt";
    $sampleFile = file_get_contents($file); 
    $lines = explode("\n", $sampleFile); 
    foreach ($lines as $newLine) {
        echo $newLine . '<br>';
    }
}

function readDocFile()
{
    $filename = './files/sample.doc';
    $openFile = fopen($filename, 'r'); 
    if (file_exists($filename)) {
        if (($fh = $openFile) !== false) {
            $headers = fread($fh, 0xA00);
            $n1 = (ord($headers[0x21C]) - 1);
            $n2 = ((ord($headers[0x21D]) - 8) * 256);
            $n3 = ((ord($headers[0x21E]) * 256) * 256);
            $n4 = (((ord($headers[0x21F]) * 256) * 256) * 256);
            $textLength = ($n1 + $n2 + $n3 + $n4);
            $extracted_plaintext = fread($fh, $textLength); 
            echo nl2br($extracted_plaintext); 
        }
    }
    fclose($openFile); 
}

function readCsvFile()
{
    $html = "<table class='table table-striped text-center'>";
    $csvFile = "./files/sample.csv";
    $file = fopen($csvFile, 'r'); 
    $data = fgetcsv($file);
    $html .= '<thead>';
    foreach ($data as $d) {
        $headers = preg_split('/\s+/', $d); 
        foreach ($headers as $header) {
            $html .= "<th>" . $header . "</th>";

        }
    }
    $html .= '</thead>';
    $html .= '<tbody>';
    while ($lines = fgetcsv($file)) {
        $html .= '<tr>';
        foreach ($lines as $line) {
            $cells = preg_split('/\s+/', $line);

            foreach ($cells as $cell) {
                $html .= "<td>" . $cell . "</td>"; 
            }
        }
        $html .= '</tr>';

    }
    $html .= '</tbody>';
    $html .= '</table>';
    fclose($file);
    echo $html; 
}
function readexcel(){    
        $path = 'files/sample.xlsx';
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($path);
        echo "<table class='table table-striped text-center'>";
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                echo "<tr>";
                foreach ($row->getCells() as $cell) {
                    echo "<td class='p-3'>";
                    echo $cell->getValue();
                    echo "</td>";
                }
                echo "</tr>";
            }
        }
        echo "</table>";
        $reader->close();
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read Files</title>
  <link rel="stylesheet" href="libs/bootstrap.min.css">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class=" mx-auto w-75">
    <div class="text-file">
      <h1>Text File</h1>
      <hr>
      <?php readTextFile();?>
    </div>
    <div class="doc-file">
      <h1 class="pt-5">Document File</h1>
      <hr>
      <?php readDocFile();?>
    </div>
    <div class="excel-file">
      <h1 class="pt-5">Excel File</h1>
      <hr>
      <?php 
        readexcel();
      ?>
    </div>
    <div class="csv-file">
      <h1 class="pt-5">Csv File</h1>
      <hr>
      <?php readCsvFile();?>
    </div>


  </div>
</body>

</html>


