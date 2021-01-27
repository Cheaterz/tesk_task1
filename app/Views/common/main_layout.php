<!doctype html>
<html>
<head>
    <title><?= $this->renderSection('title') ?></title>
    <?php echo link_tag('css/style.css');?>

</head>
<body>
    <?= $this->renderSection('content') ?>
</body>
</html>