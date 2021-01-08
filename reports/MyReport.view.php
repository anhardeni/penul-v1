<?php
use \koolreport\widgets\koolphp\Table;
?>
<html>
<head>
    <title>My Report dsab</title>
</head>
<body>
    <h1>It works ayoooo 2020</h1>
    <?php
    Table::create([
        "dataSource"=>$this->dataStore("dsab_list")
    ]);
    ?>
</body>
</html>

