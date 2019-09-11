<div class="form-body without-side">
    <div class="website-logo">
        <a href="<?= base_url() ?>">
            <img class="" src="<?= base_url('assets/img/favicon.png') ?>" alt="" width="40">
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="<?= base_url('assets/vendor/io-form/') ?>images/graphic3.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3 class="mb-4">Login to account</h3>
                    <form method="post" action="<?= base_url('auth/login') ?>">
                        <input class="form-control" type="text" name="username" placeholder="Username" value="<?= set_value('username') ?>" required>
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn btn btn-primray w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

