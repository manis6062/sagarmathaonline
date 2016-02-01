<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title;?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                            <?php
                            if (in_array('module_add', $allowed)) {
                                ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'module/addAction'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 65%;">Module</th>
                                <th style="width: 10%;">Controller</th>
                                <th style="width: 5%;">action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($moduleList != 0 && count($moduleList) > 0) {
                        $count = 1;
                        foreach ($moduleList as $values) {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $values->module_name;?></td>
                                <td><?php echo $values -> module_controller; ?></td>
                                <td class="action">
                                    <?php
                                    if (in_array('module_update', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'module/updateAction/' . $values -> id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('module_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'module/delete/' . $values -> id); ?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
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