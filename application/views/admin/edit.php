<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Nama Lengkap" name="full_name" id="full_name" value="<?= $user['full_name']; ?>">
</div>
<div class="form-group">
    <select class="form-control bg-light" name="role_id" id="role_id">
        <?php if ( $user['role_id'] == 1 ) : ?>
        <option value="1">Admin</option>
        <option value="2">Uploader</option>
        <option value="3">Guest</option>
        <?php elseif ( $user['role_id'] == 2 ) : ?>
        <option value="2">Uploader</option>
        <option value="1">Admin</option>
        <option value="3">Guest</option>
        <?php else: ?>
        <option value="3">Guest</option>
        <option value="1">Admin</option>
        <option value="2">Uploader</option>
        <?php endif; ?>
    </select>
</div>
<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Unit Kerja" name="unit_kerja" id="unit_kerja" value="<?= $user['unit_kerja']; ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Nip" name="nip" id="nip" value="<?= $user['nip']; ?>">
</div>
<div class="form-group">
<<<<<<< HEAD
    <input type="email" class="form-control bg-light" placeholder="Email" name="email" id="email" value="<?= $user['email']; ?>">
=======
    <input type="text" class="form-control bg-light" placeholder="Email" name="email" id="email" value="<?= $user['email']; ?>">
>>>>>>> e4faebe5c8aebea9ad0508669df967f84bb1fb30
</div>
<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Extention" name="extention" id="extention" value="<?= $user['extention']; ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Domain" name="domain" id="domain" value="<?= $user['domain']; ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Username" name="username" id="username" value="<?= $user['username']; ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control bg-light" placeholder="Password"  name="password" id="password">
</div>

<input type="hidden" name="id" value="<?= $user['id']; ?>">