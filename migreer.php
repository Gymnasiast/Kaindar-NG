<?php

$pdo = new PDO('mysql:host=localhost;dbname=kaindar;charset=utf8', 'root', 'yellowhat');

//$prep = $pdo->prepare('SELECT * FROM codes_oud');
//$prep->execute([]);
//
//foreach ($prep->fetchAll() as $code)
//{
//    $prep2 = $pdo->prepare('INSERT INTO codes VALUES(NULL, ?, ?, 0, 0, CURRENT_TIME, CURRENT_TIME)');
//    $prep2->execute([$code['code'], $code['omschrijving']]);
//}

//$prep = $pdo->prepare('SELECT * FROM rekeningen');
//$prep->execute([]);
//
//foreach ($prep->fetchAll() as $rekening)
//{
//    $prep2 = $pdo->prepare('INSERT INTO accounts VALUES(NULL, ?, ?, CURRENT_TIME, CURRENT_TIME)');
//    $prep2->execute($rekening['omschrijving'], [$rekening['afkorting']]);
//}

$prep = $pdo->prepare('SELECT * FROM mutaties2');
$prep->execute([]);

foreach ($prep->fetchAll() as $mutatie)
{
    $prep3 = $pdo->prepare('SELECT * FROM accounts WHERE abbreviation=?');
    $prep3->execute([$mutatie['rekening']]);
    if ($prep3->errorInfo()[0] != "00000")
    {
        echo $prep3->errorInfo()[1] .PHP_EOL;
        echo $prep3->errorInfo()[2] .PHP_EOL;
    }
    $account = $prep3->fetch();

    $prep3 = $pdo->prepare('SELECT * FROM codes WHERE abbreviation=?');
    $prep3->execute([$mutatie['code']]);
    if ($prep3->errorInfo()[0] != "00000")
    {
        echo $prep3->errorInfo()[1] .PHP_EOL;
        echo $prep3->errorInfo()[2] .PHP_EOL;
    }

    $code = $prep3->fetch();

    if (empty($code['id']))
    {
        $codeId = 0;
    }
    else
    {
        $codeId = $code['id'];
    }

    $prep2 = $pdo->prepare('INSERT INTO mutations VALUES(NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIME, CURRENT_TIME)');
    $prep2->execute([
        $account['id'],
        $codeId,
        $mutatie['datum'],
        $mutatie['commentaar'],
        //$mutatie['bij'] - $mutatie['af'],
		$mutatie['bedrag'],
        $mutatie['btw'],
    ]);

    if ($prep2->errorInfo()[0] != "00000")
    {
        echo $prep2->errorInfo()[1] .PHP_EOL;
        echo $prep2->errorInfo()[2] .PHP_EOL;
    }
}
