<?php

$db = new PDO('mysql:dbname=lab3;host=127.0.0.1:3307', 'root', 'root');
$db->exec("SET NAMES UTF8");

if (count($_POST) > 0) {
    $name = trim($_POST['name']);
    $text = trim($_POST['text']);

    //$name = htmlspecialchars($name);
    //$text = htmlspecialchars($text);

    if ($name != '' && $text != '') {
        $query = $db->prepare("INSERT INTO comments SET name='$name', text='$text'");

        //$query = $db->prepare("INSERT INTO comments SET name=:name, text=:text");
       // $params = ['name' =>$name, 'text' => $text];

        $query->execute();

        header("Location:index.php");
        exit();
    }
}
        $query = $db->prepare("SELECT * FROM comments ORDER BY data DESC");
        //$query = $db->prepare("SELECT * FROM comments where is_moderate='1' ORDER BY data DESC");

$query->execute();
$comments = $query->fetchAll();
?>

<form method="post">
    Numele<br>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>
    Comentariu<br>
    <textarea name="text"><?php echo $text; ?></textarea><br>
    <input type="submit" value="Trimite">
</form>

<div class="comments">
    <? foreach ($comments as $one): ?>
        <div class="item">
            <span><?= $one['data'] ?></span>
            <strong><?= $one['name'] ?></strong>
            <div><?= $one['text'] ?></div>
        </div>
        <hr>
    <? endforeach; ?>
</div>

