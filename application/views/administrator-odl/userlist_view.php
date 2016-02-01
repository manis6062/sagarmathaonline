<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> User List</h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if ($this->session->flashdata('su_message')) {
                            ?>
                            <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                            <?php
                        }
                        ?>
                        <?php
                        if (in_array('user_add', $allowed)) {
                            ?>
                            <a href="<?php echo site_url(ADMIN_PATH . 'userlist/addUser'); ?>" class="btn btn-primary">New</a>
                            <?php
                        }
                        ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Login Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Address</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($usersTypes != 0 && count($usersTypes) > 0) {
                                    $count = 1;
                                    foreach ($usersTypes as $values) {
                                        ?>
                                        <tr class="item">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $values->user_name; ?></td>
                                            <td><?php echo $values->login_name; ?></td>
                                            <td><?php echo $values->email; ?></td>
                                            <td><?php echo $values->user_type; ?></td>
                                            <td><?php echo $values->address; ?></td>
                                            <td><?php echo $values->crtd_dt; ?></td>
                                            <td>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'userlist/changeStatus/' . $values->user_id . "/" . $values->status . "/" . $offset); ?>"><?php echo $values->status; ?></a>
                                            </td>
                                            <td class="action" style="width:100px">
                                                <?php
                                                if (in_array('user_update', $allowed)) {
                                                    ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'userlist/updateuser/' . $values->user_id . "/" . $offset); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($this->session->userdata(ADMIN_AUTH_USERID) != $values->user_id) {
                                                    if (in_array('user_delete', $allowed)) {
                                                        ?>
                                                        <a href="<?php echo site_url(ADMIN_PATH . 'userlist/deleteUser/' . $values->user_id . "/" . $offset); ?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if (in_array('user_update', $allowed)) {
                                                    ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'userlist/changePassword/' . $values->user_id . "/" . $offset); ?>"><img src="<?php echo base_url(); ?>/style/img/password-icon.gif" alt="edit"></a> 
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
            </div>
        </div>
    </div>

</div>