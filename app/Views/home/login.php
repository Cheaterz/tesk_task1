<?= $this->extend('common/main_layout') ?>

<?= $this->section('title') ?>
	Вход в систему
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Страница входа</h1>
    <?= $validation->listErrors() ?>

    <?php if(isset($creds_error)):?>
    	<p class="error">Неверные данные</p>
    <?php endif; ?>

    <?php if(isset($extra)):?>
    	<p class="error"><?php echo $extra; ?></p>
    <?php endif; ?>

    <?php echo form_open('home/login'); ?>

    <?php echo form_input('username', '', ['placeholder' => 'Имя пользователя']);?>
    <?php echo form_password('password', '', ['placeholder' => 'Пароль']);?>
    <?php echo form_submit('mysubmit', 'Войти');?>
    <?php echo form_close(); ?>
    
<?= $this->endSection() ?>