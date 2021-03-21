<?php
// (A) CONNECT TO DATABASE
// ! CHANGE SETTINGS TO YOUR OWN !
$dbhost = 'localhost';
$dbname = 'emirtest';
$dbchar = 'utf8';
$dbuser = 'root';
$dbpass = 'password1234';
try {
  $pdo = new PDO(
    "mysql:host=$dbhost;dbname=$dbname;charset=$dbchar",
    $dbuser, $dbpass, 
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (Exception $ex) {
  die($ex->getMessage());
}

switch ($_POST['req']) {
  // (B) SHOW COMMENTS
  case "show";
    // (B1) GET ALL COMMENTS
    try {
      $stmt = $pdo->prepare("SELECT `name`, `timestamp`, `message`, `mail`
      FROM `comments` 
      WHERE `post_id`=? AND `approved`=1 
      ORDER BY `timestamp` ASC");
      $stmt->execute([$_POST['pid']]);
    } catch (Exception $ex) {
      die($ex->getMessage());
    }

    // (B2) LOOP & GENERATE HTML
    while ($r = $stmt->fetch(PDO::FETCH_NAMED)) { ?>
    <div class="crow">
      <div class="chead">
        <div class="cname"><?=$r['name']?></div>
        <div class="mail"><?=$r['mail']?></div>
        <div class="ctime">[<?=$r['timestamp']?>]</div>
      </div>
      <div class="cmsg"><?=$r['message']?></div>
    </div>
    <?php }
    break;
 
  // (C) ADD COMMENT
  case "add":
    // (C1) CHECKS
    if (!isset($_POST['pid']) || !isset($_POST['name']) || !isset($_POST['msg'])) {
      die("Please provide the Post ID, name, and message");
    }

    // (C2) INSERT
    try {
      $stmt = $pdo->prepare("INSERT INTO `comments` (`post_id`, `name`, `message`, `mail`) VALUES (?,?,?,?)");
      $stmt->execute([$_POST['pid'], htmlentities($_POST['name']), htmlentities($_POST['msg']), htmlentities($_POST['mail'])]);
    } catch (Exception $ex) {
      die($ex->getMessage());
    }
    echo "OK";
    break;
}

// (D) CLOSE DATABASE CONNECTION
$stmt = null;
$pdo = null;
