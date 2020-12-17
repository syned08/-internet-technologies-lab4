<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laba 4 DH.</title>
</head>
<body>
    <h1>Благодарим за голосование!</h1>
    <p>Каждый голос помогает улучшить точность статистических данных!</p>
    <p>На данный момент результаты голосования выглядят следующим образом:</p>
    <?php 
        $array = [];

        $fp = fopen("results.txt", "a+");
        if (!$fp) {
            echo "Невозможно открыть удаленный файл.\n";
            exit;
        }

        $nameOfLanguage = $_POST["language"];

        while (!feof($fp)) {
            $buffer = fgets($fp);
            if (strpos($buffer, $nameOfLanguage) !== false) {
                $rest = intval(substr($buffer, stripos($buffer, ":") + 2)) + 1;
                $buffer = substr($buffer, 0, stripos($buffer, ":") + 2) . $rest ." <br>\n";
            }
            array_push($array, $buffer);
        }
        file_put_contents('results.txt', null);
        fclose($fp);
        $fp = fopen("results.txt", "a");
        foreach($array as $key => $value){
            fwrite($fp, $value);
        }
        fclose($fp);

        $fp = fopen("results.txt", "r");
        echo fread($fp, filesize("results.txt"));
        fclose($fp);
    ?>
</body>
</html>