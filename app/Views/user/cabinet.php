<?= $this->extend('common/main_layout') ?>

<?= $this->section('title') ?>
	Кабинет
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Добрый день, <?php echo $username?>!</h1>
	
    <a href="/user/logout" class="button">Выйти из системы</a>

<?= $this->endSection() ?>