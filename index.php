<?php

require_once "./vendor/autoload.php";

header('Content-Type: text/html');

echo '<!DOCTYPE>
      <html>  
      <head>

      </head>

      <body>
        <div>
';


use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

$writer = new PngWriter();

// Create QR code
$qrCode = QrCode::create('tel:' . $_GET['input'])
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
    ->setSize(300)
    ->setMargin(10)
    ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));

$result = $writer->write($qrCode);

// Save it to a file
$result->saveToFile(__DIR__ . '/src/qrcode.png');

echo '<img src="./src/qrcode.png" />

      <form name="form" action="" method="get">
                <input type="text" name="input" id="input" />
                <button type="submit">submit</button>
            </form>
        </div>
      </body>

      </html>
';


