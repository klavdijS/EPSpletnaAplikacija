<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1>Edit users</h1> 

            <table class="table table-striped">

                <thead>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    <?php foreach($users as $user) : ?>
                        <?php if (($this->ion_auth->is_admin() OR $user['group_id'] == 3) && $this->ion_auth->user()->row()->id != $user["id"]): ?>
                            <tr>
                                <td><?= $user["first_name"] ?></td>
                                <td><?= $user["last_name"] ?></td>
                                <td><?= $user["username"] ?></td>
                                <td><?= $user["email"] ?></td>
                                <td><a href="<?= base_url(); ?>auth/edit_user/<?= $user["user_id"]; ?>" class="btn btn-info" role="button">Edit user</a></td>
                                <td>
                                    <?php if ($user["active"]): ?>
                                        <a href="<?= base_url(); ?>auth/deactivate/<?= $user["user_id"]; ?>" class="btn btn-danger" role="button">Deactivate user</a>
                                    <?php else: ?>
                                        <a href="<?= base_url(); ?>auth/activate/<?= $user["user_id"]; ?>" class="btn btn-info" role="button">Activate user</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>

    </div>

</div>
<!-- /.container -->