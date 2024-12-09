<?php

// if (isset($_GET['menu'], $_GET['eten'], $_GET['drinken'])) {
//     $Menu = $_GET['menu']; // Gebruik de juiste parameter
//     $Eten = $_GET['eten']; // Gebruik de juiste parameter
//     $Drinken = $_GET['drinken'];
// } else {
//     echo "De opgegeven $Menu is niet beschikbaar.";
//     echo "De opgegeven $Eten is niet beschikbaar.";
//     echo "De opgegeven $Drinken is niet beschikbaar.";
// }



$eten = [

    'Shoarma' => '6.95',
    'Appels' => '10.95',
    'Tabouleh' => '8.95',
    'Hamburger' => '5.50',
];

$drinken = [

    'Cola' => '2.00',
    'Aryan' => '2.30',
    'Fernandes' => '2.50',
    'Bier' => '5.50',
];

$toetjes = [

    'Taart' => '12.00',
    'Cake' => '10.00',
];


$menu = [

    'Eten' => $eten,
    'Drinken' => $drinken,
    'Toetjes' => $toetjes
];


function showMenuItems($array){
    $html = '<table>';

    foreach($array as $key =>$value) {
    
        $html .= "<tr><td>($key)</td><td>($value)</td></tr>";
    
    }
    
    $html .= '</table>';
    return $html;    
}


function showMenu()
{

    $html = '';
    global $menu;
    foreach ($menu as $key => $value) {
        $html .= "<h2>($key)</h2>";
        $html .= showMenuItems(array:$value);
         
    }
    return $html;
}



?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <title>Restaurantmenu</title>
    <style>
        td:first-child {
            width: 8em;
        }

        td:nth-child(2) {
            font-style: italic;
            text-align: right;
            width: 4em;
        }
    </style>
</head>

<body>
    <h1>Menu</h1>
    <table>
        <?php
        echo showMenu();

        ?>
        <table>
</body>

</html>