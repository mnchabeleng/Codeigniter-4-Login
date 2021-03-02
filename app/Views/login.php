<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1><?= $title ?></h1>
    <form method="POST">
        <?= view('messages') ?>
        <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="email_response" value="<?= set_value('email') ?>">
            <div id="email_response" class="form-text">Email response.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="password_response">
            <div id="password_response" class="form-text">Password response.</div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
<?= $this->endSection() ?>
