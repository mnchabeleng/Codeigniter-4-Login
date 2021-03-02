<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1><?= $title ?><?= ( session()->get('user') ) ? ', ' . session()->get('user')['first_name'] : null ?></h1>
<?= $this->endSection() ?>
