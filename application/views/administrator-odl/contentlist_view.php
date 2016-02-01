<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Content List</h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if ($this->session->flashdata('su_message')) {
                            ?>
                            <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                            <?php } ?><a href="<?php echo site_url(ADMIN_PATH . 'content/addAction'); ?>" class="btn btn-primary">New</a>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                   <!--<th>Writer</th>-->
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
                                            <td><?php echo $values -> content_title; ?></td>
                                            <td><?php echo word_limiter($values -> content_description, 25); ?></td>
                                            <td>
                                                <a href="<?php echo site_url(ADMIN_PATH . 'content/changeStatus/' . $values -> content_id . "/" . $values -> content_status); ?>">
                                                    <?php echo $values -> content_status; ?>
                                                </a>
                                            </td>
                                            <td class="action" style="width:100px">
                                                <?php
                                                if (in_array('content_update', $allowed)) {
                                                    ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'content/updateAction/' . $values -> content_id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                    <?php } if(in_array('content_delete', $allowed)){?>
                                                <a href="<?php echo site_url(ADMIN_PATH . 'content/deleteAction/' . $values -> content_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>
                                                    <?php }?>     
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
                </div><!--/span-->
            
            </div><!--/row-->
</div>