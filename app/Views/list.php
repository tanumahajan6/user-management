<?= $this->extend('layouts/default') ?>         <!-- Used default layout -->
<!-- Content start -->
<?= $this->section('content') ?>

<!-- Display flash message if present in the session -->
<?php if((session()->getFlashdata ('success_msg') !== NULL)): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> <?= session()->getFlashdata ('success_msg'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif ?>
<?php if((session()->getFlashdata ('error_msg') !== NULL)): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> <?= session()->getFlashdata ('error_msg'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif ?>

<a href="/create" class="btn btn-primary add-btn"><i class="fa fa-plus" aria-hidden="true"></i>
 Add New User</a>


<!-- Datatable to display the list of users start -->
<table class="user-list">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email ID</th>
      <th scope="col">Mobile No.</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($data) && !empty($data)): ?>
      <?php foreach ($data as $user): ?>
        <tr>
          <td scope="row"><?= $user['user_id'] ?></td>
          <td><?= $user['firstname'] ?></td>
          <td><?= $user['lastname'] ?></td>
          <td><?= $user['email_id'] ?></td>
          <td><?= $user['mobile_no'] ?></td>
          <td>
            <button type="button" class="btn btn-outline-info btn-sm change-status" data-status="<?= $user['status'] ?>" id="<?= $user['user_id']?>" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to change the status."><?= ($user['status'] == '1') ? 'Active' : 'Inactive'; ?></button>
          </td>
          <td>
            <a href="<?= base_url('edit/'.$user['user_id']);?>" class="btn btn-info btn-sm">Edit</a>
            <a href="#" class="delete_user btn btn-secondary btn-sm" id="<?= $user['user_id']; ?>" >Delete</a>
          </td>
        </tr>
      <?php endforeach ?>
    <?php endif ?>
  </tbody>
</table>
<!-- Datatable to display the list of users end -->

<!-- Basic JS & CSS files imported -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Sweetalert used for confirmation popup -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- Custom JS file imported -->
<script src="<?php echo base_url('/javascript/user_management.js'); ?>"></script>
<?= $this->endSection() ?>
<!-- Content end -->