<?php
$file_path = __DIR__ . "/questions.txt";
$message_status = "";

// Обработка отправки формы (Запись в файл)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_question"])) {
    $user_name = trim(strip_tags($_POST["user_name"]));
    $user_question = trim(strip_tags($_POST["user_question"]));

    if (!empty($user_name) && !empty($user_question)) {
        $date = date("d.m.Y H:i");
        $log_line = $date . "|||" . $user_name . "|||" . $user_question . "\n";

        $fp = fopen($file_path, "a");
        if ($fp) {
            if (flock($fp, LOCK_EX)) {
                fwrite($fp, $log_line);
                flock($fp, LOCK_UN);
                $message_status = "<p class='status-text'><b>Успех:</b> Ваш вопрос успешно отправлен и сохранен!</p>";
            } else {
                $message_status = "<p class='status-text'><b>Ошибка:</b> Не удалось заблокировать файл. Попробуйте позже.</p>";
            }
            fclose($fp);
        } else {
            $message_status = "<p class='status-text'><b>Ошибка:</b> Не удалось открыть файл для записи.</p>";
        }
    } else {
        $message_status = "<p class='status-text'><b>Внимание:</b> Пожалуйста, заполните все поля формы.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вопрос-Ответ</title>
    <style>
        body {
            color: #000;
            line-height: 1.5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 30px 0 15px;
        }
        
        .status-text {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 12px;
        }
        .form-group label {
            font-size: 14px;
            margin-bottom: 4px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            font-family: inherit;
            font-size: 14px;
            border: 1px solid #000;
            outline: none;
        }

        .btn {
            background: #000;
            color: #fff;
            padding: 8px 16px;
            border: 1px solid #000;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .faq-item {
            border-bottom: 1px solid #000;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .faq-meta {
            font-size: 12px;
            margin-bottom: 6px;
        }

        .faq-text {
            font-size: 14px;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Вопрос-ответ</h1>
    
    <?php echo $message_status; ?>

    <form action="lb5.php" method="POST">
        <div class="form-group">
            <label for="user_name">Ваше имя:</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required>
        </div>
        <div class="form-group">
            <label for="user_question">Ваш вопрос:</label>
            <textarea class="form-control" id="user_question" name="user_question" rows="3" required></textarea>
        </div>
        <button type="submit" name="submit_question" class="btn">Отправить вопрос</button>
    </form>

    <h3>Список обращений</h3>
    
    <?php
    if (file_exists($file_path) && filesize($file_path) > 0) {
        $fp = fopen($file_path, "r");
        if ($fp) {
            if (flock($fp, LOCK_SH)) {
                while (!feof($fp)) {
                    $line = fgets($fp);
                    if ($line) {
                        $data = explode("|||", trim($line));
                        if (count($data) == 3) {
                            $date = htmlspecialchars($data[0]);
                            $name = htmlspecialchars($data[1]);
                            $question = htmlspecialchars($data[2]);
                            
                            echo '
                            <div class="faq-item">
                                <div class="faq-meta">
                                    <b>Имя:</b> ' . $name . ' | <b>Дата:</b> ' . $date . '
                                </div>
                                <p class="faq-text"><b>Вопрос:</b> ' . $question . '</p>
                                <p class="faq-text"><b>Ответ:</b> Спасибо за обращение!</p>
                            </div>';
                        }
                    }
                }
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
    } else {
        echo '<p class="status-text">Вопросов пока нет.</p>';
    }
    ?>
</div>

</body>
</html>