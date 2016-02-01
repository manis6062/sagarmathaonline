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
                            if (in_array('user_add', $allowed)) {
                                ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'banner/addAction'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 30%;">Image</th>
                                <th style="width: 25%;">Description</th>
                                <th style="width: 15%;">Link</th>        
                                <th style="width: 10%;">Publish</th>
                                <th style="width: 5%;">action</th>
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
                                <td><img src="<?php echo base_url() . "uploads/banner/" . $values -> path; ?>" width="150" /></td>
                                <td><?php echo $values->description;  ?></td>
                                <td><?php echo $values->link;  ?></td>
                                <td><a href="<?php echo site_url(ADMIN_PATH . 'banner/changeStatus/' . $values -> slider_id . "/" . $values->publish. "/" . $offset); ?>"><?php echo $values -> publish; ?></a></td>
                                <td class="action">
                                    <?php
                                    if (in_array('banner_update', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'banner/updateAction/' . $values -> slider_id . "/" . $offset); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('banner_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'banner/deleteAction/' . $values -> slider_id . "/" . $offset); ?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
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