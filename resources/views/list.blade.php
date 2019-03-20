<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>WatchList</h1>
    <h2><?=$username ?></h2>
    <ul>
        <li><?= $list->title ?></li>
        <img src="<?= $list->poster_url ?>"/>
        <li><?= $list->id ?></li>

    </ul>
</body>
</html>