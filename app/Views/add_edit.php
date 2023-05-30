<?= $this->extend('layouts/default') ?>  <!-- Used the layout/default.php custom layout -->
<?= $this->section('content') ?>         <!-- Actual content starts -->
<?php helper('form');?>                  <!-- Used Form helper -->

  <!-- Form start -->
    <form method="post" id="add_user" name="add_user" action="<?= isset($user['firstname']) ? site_url('/update') : site_url('/submit-form') ?>">
      <?php if(isset($user['user_id'])): ?>
        <input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id']; ?>">
      <?php endif ?>
      <div class="col-md-6">
      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname" class="firstname form-control" value="<?= isset($user['firstname']) ? $user['firstname'] : ''; ?>"/>
        <div class="err-fname err-msg"></div>      <!-- Error div to display client side validation message -->
      </div>

      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lastname" class="lastname form-control" value="<?= isset($user['lastname']) ? $user['lastname'] : ''; ?>"/>
        <div class="err-lname err-msg"></div>
      </div>
      
      <div class="form-group">
        <label>Email ID</label>
        <input type="text" name="email" class="email form-control" value="<?= isset($user['email_id']) ? $user['email_id'] : ''; ?>"/>
        <div class="err-email err-msg"></div>
      </div>

      <div class="form-group">
        <label>Mobile No.</label>
        <input type="text" name="mobile" class="mobile form-control" value="<?= isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?>"/>
        <div class="err-mobile err-msg"></div>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="password form-control" value="<?= isset($user['password']) ? $user['password'] : ''; ?>"/>
        <div class="err-password err-msg"></div>
      </div>

      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="confirm_password form-control" value="<?= isset($user['password']) ? $user['password'] : ''; ?>"/>
        <div class="err-confirm_password err-msg"></div>
      </div>

      <div class="form-group">
        <label>Status</label>
        <br/>
        <div class="form-check">
          <?= form_radio('status', '1', isset($user['status']) && $user['status'] == '1' ? true : false, ['class' => 'form-check-input', 'id' => 'radio_active']); ?> 
            <label class="form-check-label" for="radio_active">
              Active
            </label>
        </div>
        <div class="form-check">
          <?= form_radio('status', '0', isset($user['status']) && $user['status'] == '0' ? true : false, ['class' => 'form-check-input', 'id' => 'radio_inactive']); ?> 
          <label class="form-check-label" for="radio_inactive">
            Inactive
          </label>
        </div>
        <div class="err-status err-msg"></div>
      </div>

      <!-- Action buttons start -->
      <br>
      <div class="form-group">
        <button class="btn btn-primary" id="submit_user">Submit</button>
        <a href="/" class="btn btn-secondary">Cancel</a>
      </div>
      <!-- Action buttons end -->

      </div>
    </form>
<!-- Form end -->
<script src="<?php echo base_url('/javascript/user_management.js'); ?>"></script>   <!-- Loaded custom js file -->
<?= $this->endSection() ?>