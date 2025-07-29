<!DOCTYPE html>
<html>
<head>
    <title>簡易計算機</title>
</head>
<body>
    <h2>簡易計算機</h2>
        <form method="post">
            <input type="number" name="num1" required step="any">
            <select name="operator">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input type="number" name="num2" required step="any">
            <input type="submit" name="calculate" value="計算">
        </form>

    <?php

    if(isset($_POST['calculate'])){
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        $result = '';

        switch ($operator) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    if ($num2 == 0) {
                        $result = "錯誤：除數不能為 0";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                default:
                    $result = "無效的運算符";
        }

        echo "<h3>結果：$result</h3> ";
    }
    ?>

    <h2>🎓 成績計算</h2>
    <form method="post">
        <label>請輸入成績（用逗號分隔，如：80,70,90）：</label><br>
        <input type="text" name="scores" required>
        <input type="submit" name="check_score" value="計算成績">
    </form>

    <?php
    if (isset($_POST['check_score'])) {
        $input = $_POST['scores'];
        $score_array = array_filter(array_map('trim', explode(',', $input)), 'is_numeric');

        if (count($score_array) > 0) {
            $total = array_sum($score_array);
            $count = count($score_array);
            $average = $total / $count;
            $is_pass = $average >= 60 ? "及格 ✅" : "不及格 ❌";

            echo "<h3>平均分數：$average</h3>";
            echo "<h3>判斷結果：$is_pass</h3>";
        } else {
            echo "<p style='color:red'>請輸入正確的成績格式，例如：75,80,90</p>";
        }
    }
    ?>
    <h2>🧩 陣列操作練習</h2>
    <form method="post">
        <label>請輸入數字陣列（用逗號分隔，如：4,2,7,1,9）：</label><br>
        <input type="text" name="array_input" required>
        <input type="submit" name="array_ops" value="執行陣列操作">
    </form>

    <?php
    if (isset($_POST['array_ops'])) {
        $input = $_POST['array_input'];
        $array = array_filter(array_map('trim', explode(',', $input)), 'is_numeric');

        if (count($array) > 0) {
            echo "<h3>原始陣列：</h3>";
            echo implode(', ', $array);

            $sorted = $array;
            sort($sorted);

            $reversed = array_reverse($array);
            $sum = array_sum($array);
            $max = max($array);

            echo "<h3>排序（由小到大）：</h3>" . implode(', ', $sorted);
            echo "<h3>反轉陣列：</h3>" . implode(', ', $reversed);
            echo "<h3>總和：</h3>$sum";
            echo "<h3>最大值：</h3>$max";
        } else {
            echo "<p style='color:red'>請輸入有效的數字陣列</p>";
        }
    }
    ?>
</body>
</html>