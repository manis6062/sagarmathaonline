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
                            if (in_array('album_add', $allowed)) {
                                ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'album/addAction'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 55%;">Title</th>
                                 <!--<th>Index</th>-->        
                                <th style="width: 20%;">Created Date</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 10%;">action</th>
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
                                <td><?php echo $values->album_title;?></td>
                                <!-- <td><?php //echo $values->slider_index;  ?></td>-->
                                <td><?php echo $values -> album_date; ?></td>

                                <td>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'album/changeStatus/' . $values ->album_id . "/" . $values -> album_status . "/" . $offset); ?>"><?php echo $values -> album_status; ?></a>                                    
                                </td>
                                <td class="action">
                                    <?php
                                    if (in_array('album_update', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'album/updateAction/' . $values -> album_id . "/" . $offset); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('album_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'album/deleteAction/' . $values -> album_id . "/" . $offset); ?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('gallery_view', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'gallery/' . $values -> album_id); ?>" class="icon-picture"></a> 
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