<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>jamesclonk.ch &raquo; <?php echo($title); ?></title>
        <link rel="stylesheet" href="<?php echo(base_url() . "themes/$theme/style.css"); ?>" type="text/css" />
        <link rel="shortcut icon" href="<?php echo(base_url()); ?>favicon.ico" />
    </head>

<?php

$quotes = array(
    'valar morghulis',
    'valar dohaeris',
    'winter is coming',
    'the laughing man',
    "I thought what I'd do was I'd pretend I was one of those deaf-mutes",
    'the cosmos is all that is or ever was or ever will be',
    'imagination will often carry us to worlds that never were, but without it we go nowhere',
    'if you wish to make an apple pie from scratch, you must first invent the universe',
    'matter is composed mainly of nothing',
    'all mass is interaction',
    "..and you will find someday that, after all, it isn't as horrible as it looks",
    "ask me when it's all over..",
    'the universe seems neither benign nor hostile, merely indifferent',
    'haste makes waste',
    'take it with a grain of salt',
    'sell a man a fish, he eats for a day, teach a man how to fish, he eats for the rest of his life',
    'a journey of a thousand miles starts with a single step',
    'holy cow!',
    'cogito ergo sum',
    'great spirits have always encountered violent opposition from mediocre minds',
    "damned if you do, damned if you don't",
    "ask me no questions, I'll tell you no lies",
    'holy heart failure, batman!'
);
$quote = $quotes[array_rand($quotes)];

function menuEntry($current_page, $view, $title) {
    if($current_page==$view) { echo('<li class="selected">'); }
    else { echo('<li>');  }
    echo(anchor($view, $title));
    echo('</li>');
}

?>

    <body>
        <div id="wrap">
            <div class="headerlogo">
                <img src="<?php echo(base_url()); ?>images/jamesclonk_coa.png" alt="jamesclonk.ch"/>
            </div>
            <div class="header">
                <h1><a href="<?php echo(base_url()); ?>">jamesclonk.ch</a></h1>
                <h2 class="quote"><?php echo($quote); ?></h2>
            </div>
            <div id="nav">
                <ul>
                    <?php
                    menuEntry($current_page, 'news','News');
                    menuEntry($current_page, 'movies','MovieDB');
                    menuEntry($current_page, 'games','GameDB');
                    menuEntry($current_page, 'filmchen','Meine Filmchen');
                    menuEntry($current_page, 'goty','GOTY');
                    menuEntry($current_page, 'quake','Quake3 CPMA');
                    menuEntry($current_page, 'go','Go');
                    menuEntry($current_page, 'gallery2','Gallery');
                    ?>
                </ul>
            </div>
            <div class="page">
                <div class="content">