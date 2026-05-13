<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4"><?= lang('Auth.login') ?></h5>

            <?php if (session('error') !== null): ?>
                <div class="alert alert-danger" role="alert"><?= esc((string) session('error')) ?></div>
            <?php elseif (session('errors') !== null): ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))): ?>
                        <?php foreach (session('errors') as $error): ?>
                            <?= esc((string) $error) ?><br>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?= esc((string) session('errors')) ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingUsernameInput" name="username" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                    <label for="floatingUsernameInput"><?= lang('Auth.username') ?></label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPasswordInput" name="password" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <label for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
                </div>

                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?>checked<?php endif ?>>
                            <?= lang('Auth.rememberMe') ?>
                        </label>
                    </div>
                <?php endif ?>

                <div class="d-grid col-12 col-md-8 mx-auto mt-4">
                    <button type="submit" class="btn btn-primary"><?= lang('Auth.login') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>