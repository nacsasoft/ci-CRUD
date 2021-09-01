<?= $this->extend("app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                List Member
                <a href="<?= base_url('add-member') ?>" style="margin-top: -7px;" class="btn btn-info pull-right">Add Member</a>
            </div>
            <div class="panel-body">

                <?php
                    if(session()->has("success")){
                        ?>
                            <div class="alert alert-success">
                                <?= session("success") ?>
                            </div>
                        <?php
                    }
                ?>

                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($members as $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['mobile']; ?></td>
                                <td>
                                    <a href="<?= base_url('edit-member/' . $value['id']); ?>" class="btn btn-info">Edit</a>
                                    <a href="<?= base_url('delete-member/' . $value['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>