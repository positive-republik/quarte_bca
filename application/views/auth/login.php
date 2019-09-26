<div class="form-body without-side">
    <div class="website-logo">
        <center>
            <img class="" src="<?= base_url('assets/img/logo.png') ?>" alt="" style="width:300px !important; margin-left:-70% !important; margin-bottom:-50%;">
        </center>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <!-- <img src="<?= base_url('assets/vendor/io-form/') ?>images/graphic3.svg" alt=""> -->
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3 class="mb-5 text-center text-white">Login Panel</h3>
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

