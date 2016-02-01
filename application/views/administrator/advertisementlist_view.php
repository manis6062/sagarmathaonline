<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
	<!-- content starts -->
	<div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Advertisement List</h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                            <?php
                            if (in_array('advertisement_add', $allowed)) {
                                ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'advertisement/addAction'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 35%;">Image</th>
                                <th style="width: 15%;">Size</th>
                                <th style="width: 15%;">Type</th>
                                <th style="width: 15%;">Link</th>        
                                <th style="width: 10%;">Created Date</th>
                                <th style="width: 5%;">Action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($photoList != 0 && count($photoList) > 0) {
                        $count = 1;
                        foreach ($photoList as $values) {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><img src="<?php echo base_url() . "uploads/advertisement/" . $values -> path; ?>" width="150" /></td>
                                <td><?php echo $values->size;  ?></td>
                                <td><?php echo $values->type;  ?></td>
                                <td><?php echo $values->link;  ?></td>
                                <td><?php echo $values -> crtd_dt; ?></td>

                                <td class="action">
                                    <?php
                                    if (in_array('advertisement_update', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'advertisement/updateAction/' . $values -> slider_id . "/" . $offset); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('advertisement_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'advertisement/deleteAction/' . $values -> slider_id . "/" . $offset); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                        <?php } ?>

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