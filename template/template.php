<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=$title?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/template/css/style.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <?//View::get_Style()?>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">
    <?//View::get_Header()?>
    <div class="content">
        <div class="heading">
            <h1><?//View::get_Page()?><?=$title?></h1>
        </div>

        <?//View::get_Sidebar()?>
        <section>
            <?=$content?>
        </section>
    </div>
</div>
<?//View::get_Footer()?>


</body>
</html>
