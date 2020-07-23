<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.04 - Consultas com query e exec");

require __DIR__ . "/../source/autoload.php";

use Source\Database\Connect;

/*
 * [ insert ] Cadastrar dados.
 * https://mariadb.com/kb/en/library/insert/
 *
 * [ PDO exec ] http://php.net/manual/pt_BR/pdo.exec.php
 * [ PDO query ]http://php.net/manual/pt_BR/pdo.query.php
 */
fullStackPHPClassSession("insert", __LINE__);

$insert = "
    INSERT INTO users (first_name, last_name, email, document)
    VALUES ('Pedro', 'Silva', 'pedro.credvip@mail.com', '126579845234');
";

try {
    $exec = Connect::getInstance()->exec($insert);
    var_dump(Connect::getInstance()->lastInsertId());
} catch (PDOException $exception) {
    var_dump($exception);
}

/*
 * [ select ] Ler/Consultar dados.
 * https://mariadb.com/kb/en/library/select/
 */
fullStackPHPClassSession("select", __LINE__);

try {
    $select = Connect::getInstance()->query("SELECT * FROM users LIMIT 2");
    var_dump(
        $select,
        $select->rowCount(),
        $select->fetchAll()
    );
} catch (PDOException $exception) {
    var_dump($exception);
}

/*
 * [ update ] Atualizar dados.
 * https://mariadb.com/kb/en/library/update/
 */
fullStackPHPClassSession("update", __LINE__);

try {
    $update = Connect::getInstance()->exec("
        UPDATE users SET first_name = 'Gerson', last_name = 'Guimaraes', email = 'gerson@credvip.com'
        WHERE id = '53';
        ");

    var_dump($update);
} catch (PDOException $exception) {
    var_dump($exception);
}

/*
 * [ delete ] Deletar dados.
 * https://mariadb.com/kb/en/library/delete/
 */
fullStackPHPClassSession("delete", __LINE__);

try {
    $delete = Connect::getInstance()->exec("DELETE FROM users WHERE id > 50;");
    var_dump($delete);
} catch (PDOException $exception) {
    var_dump($exception);
}