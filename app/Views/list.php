<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
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
<a href="/create" class="btn btn-primary">Add New User</a>
<!-- <br/>To do:<br/>
7. Smart admin theme<br/>
1. Server side validations<br/>
2. Exception handling<br/>
3. Image <br/>
4. Coding standards<br/>
5. Comments<br/>
6. Documentation<br/>
8. Push to git -->


<table class="user-list">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email ID</th>
      <th scope="col">Mobile No.</th>
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
            <a href="<?= base_url('edit/'.$user['user_id']);?>" class="btn btn-info btn-sm">Edit</a>
            <a href="#" class="delete_user btn btn-danger btn-sm" id="<?= $user['user_id']; ?>" >Delete</a>
          </td>
        </tr>
      <?php endforeach ?>
    <?php endif ?>
  </tbody>
</table>
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<script src="<?php echo base_url('/javascript/user_management.js'); ?>"></script>
<?= $this->endSection() ?>