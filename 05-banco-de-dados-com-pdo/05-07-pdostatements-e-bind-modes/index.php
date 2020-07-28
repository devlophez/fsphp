<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.07 - PDOStatement e bind modes");

require __DIR__ . "/../source/autoload.php";

use Source\Database\Connect;

/**
 * [ prepare ] http://php.net/manual/pt_BR/pdo.prepare.php
 */
fullStackPHPClassSession("prepared statement", __LINE__);

$stmt = Connect::getInstance()->prepare("SELECT * FROM users LIMIT 1;");
$stmt->execute();

var_dump(
    $stmt,
    $stmt->rowCount(),
    $stmt->columnCount(),
    $stmt->fetch()
);

/*
 * [ bind value ] http://php.net/manual/pt_BR/pdostatement.bindvalue.php
 *
 */
fullStackPHPClassSession("stmt bind value", __LINE__);

//$stmt = Connect::getInstance()->prepare("SELECT * FROM users WHERE id = :id;");
//$stmt->bindValue(":id", 50, PDO::PARAM_INT);
//$stmt->execute();
//
//var_dump(
//    $stmt->fetch()
//);

//$stmt = Connect::getInstance()->prepare("
//    INSERT INTO users (first_name, last_name, email, document)
//    VALUES (?, ?, ?, ?);
//");
//
//$stmt->bindValue(1, "Pedro");
//$stmt->bindValue(2, "Silva");
//$stmt->bindValue(3, "pedro@credvip.com");
//$stmt->bindValue(4, "5487965");
//
//$stmt->execute();
//
//var_dump(
//    $stmt->rowCount(),
//    Connect::getInstance()->lastInsertId()
//);

$stmt = Connect::getInstance()->prepare("
    INSERT INTO users (first_name, last_name, email, document)
    VALUES (:first_name, :last_name, :email, :document);
");

$stmt->bindValue(":first_name", "Pedro", PDO::PARAM_STR);
$stmt->bindValue(":last_name", "Silva", PDO::PARAM_STR);
$stmt->bindValue(":email", "pedro@credvip.com", PDO::PARAM_STR);
$stmt->bindValue(":document", "5487965", PDO::PARAM_STR);

$stmt->execute();

var_dump(
    $stmt->rowCount(),
    Connect::getInstance()->lastInsertId()
);

/*
 * [ bind param ] http://php.net/manual/pt_BR/pdostatement.bindparam.php
 */
fullStackPHPClassSession("stmt bind param", __LINE__);

$stmt = Connect::getInstance()->prepare("
    INSERT INTO users (first_name, last_name)
    VALUES (:first_name, :last_name);
");

$first_name = "Airton";
$last_name = "Sousa";

$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);

$stmt->execute();

var_dump(
    $stmt->rowCount(),
    Connect::getInstance()->lastInsertId()
);

/*
 * [ execute ] http://php.net/manual/pt_BR/pdostatement.execute.php
 */
fullStackPHPClassSession("stmt execute array", __LINE__);

$stmt = Connect::getInstance()->prepare("
    INSERT INTO users (first_name, last_name)
    VALUES (:first_name, :last_name);
");

$user = [
    "first_name" => "Juan",
    "last_name" => "Carlos"
];

$stmt->execute($user);

var_dump(
    $stmt->rowCount(),
    Connect::getInstance()->lastInsertId()
);

/*
 * [ bind column ] http://php.net/manual/en/pdostatement.bindcolumn.php
 */
fullStackPHPClassSession("bind column", __LINE__);

$stmt = Connect::getInstance()->prepare("SELECT * FROM users LIMIT 3;");
$stmt->execute();

/**
 * o bindColumn captura o valor da coluna e atribui a variável
 */

$stmt->bindColumn("first_name", $name);
$stmt->bindColumn("email", $mail);

/**
 * maneira correta de mapear os dados que vieram do select
 */

while($user = $stmt->fetch()){
    var_dump($user);
    echo "<p class='trigger'>O e-mail de {$name} é {$mail}</p>";
}