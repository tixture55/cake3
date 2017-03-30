<?php
//test.ctp
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    </title>
    <?= $this->Html->meta('icon') ?>
 
    <?= $this->Html->css('test.css') ?>
 
    <?= $this->Html->script('test.js') ?>
 
</head>
<body>
  <?= $this->fetch('content') ?>
 
</body>
</html>
