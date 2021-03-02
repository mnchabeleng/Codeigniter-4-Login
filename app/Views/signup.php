<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1><?= $title ?></h1>
    <form method="POST">
        <?= view('messages') ?>
        <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
        <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" aria-describedby="first_name_response" value="<?= set_value('first_name') ?>">
            <div id="first_name_response" class="form-text">First name response.</div>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" aria-describedby="last_name_response" value="<?= set_value('last_name') ?>">
            <div id="last_name_response" class="form-text">Last name response.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="email_response" value="<?= set_value("email") ?>">
            <div id="email_response" class="form-text">Email response.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="password_response" value="<?= set_value('password') ?>">
            <div id="password_response" class="form-text">Password response.</div>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="confirm_password_response" value="<?= set_value('confirm_password') ?>">
            <div id="confirm_password_response" class="form-text">Confirm password response.</div>
        </div>
        <button type="submit" class="btn btn-primary">Signup</button>
    </form>
<?= $this->endSection() ?>
