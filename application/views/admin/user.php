<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">User</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <button style="margin-bottom: 20px;" data-toggle="modal" data-target="#add" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Add User</button>
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Level</th>
              <th>foto</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($detail as $users) :
              if ($users['is_active'] == 0) {
                $users['is_active'] = "Non Active";
              } elseif ($users['is_active'] == 1) {
                $users['is_active'] = "Active";
              }

              if ($users['role_id'] == 1) {
                $users['role_id'] = "Admin";
              } elseif ($users['role_id'] == 2) {
                $users['role_id'] = "Member";
              }
              ?>

              <tr>
                <td><?= $no++ ?></td>
                <td><?= $users['name'] ?></td>
                <td><?= $users['email'] ?></td>
                <td><?= $users['role_id'] ?></td>
                <td class="text-center"><img style="height: 60px;width:60px" src="<?= base_url('assets/img/' . $users['image']) ?>"></td>
                <td><?= $users['is_active'] ?></td>
                <td class="text-center">
                  <button data-toggle="modal" data-target="#edit<?= $users['id'] ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Edit</button> | <a href="<?= base_url() ?>User/delete/<?= $users['id'] ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="edit<?= $users['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form method="post" action="<?= base_url('/') ?>User/edit/<?= $users['id'] ?>">

                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="nama" value="<?= $users['name'] ?>" placeholder="Name" class="form-control">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $users['email'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">@example.com</span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Level</label>
                          <select class="form-control" name="level">
                            <?php
                            foreach ($role as $roles) :
                              $select =  $roles['role'] == $users['role_id'] ? "selected" : ""; ?>
                            <option value="<?= $roles['role'] ?>"><?= $roles['role'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="foto">foto</label><br>
                        <input name="foto" type="file" placeholder="foto" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="status">
                          <?php
                          if ($users['is_active'] == "Active") { ?>
                          <option selected value="1">Active</option>
                          <option value="0">Non Active</option>
                          <?php } elseif ($users['is_active'] == "Non Active") { ?>
                          <option value="1">Active</option>
                          <option selected value="0">Non Active</option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form>

                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="text" placeholder="Name" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <input type="email" class="form-control" placeholder="Email" name="email">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Level</label>
                  <select class="form-control" name="level">
                    <?php
                    foreach ($role as $roles) :
                      $select =  $roles['role'] == $users['role_id'] ? "selected" : ""; ?>
                    <option value="<?= $roles['id'] ?>"><?= $roles['id'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" placeholder="Name" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" placeholder="Name" class="form-control">
              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>