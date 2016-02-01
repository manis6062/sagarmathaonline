<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Youtube Links List</h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                        <?php } 
                        ?>                                
                        <table class="table table-striped table-bordered bootstrap-datatable datatable"  id="example-advanced">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($themeoption) ){
                                    $count = 1;
                                    foreach ($themeoption as $values) { ?>
                                        <tr class="item" data-tt-id='<?php echo $count;?>'>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $values->title; ?></td>
                                            <td><?php echo $values->theme_video; ?></td> 
                                         
                                            <!-- <td>
                                                <a href="<?php echo site_url(ADMIN_PATH . 'menu/changeStatus/' . $values->id . "/" . $values->status); ?>">
                                                    <?php echo $values->status; ?>
                                                </a>
                                            </td> -->
                                            <td class="action">
                                                <?php if(in_array('theme_option_update', $allowed)){?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'theme_option/editPage/' . $values->id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                <?php }?>
                                                <?php if(in_array('theme_option_update', $allowed)){?> 
                                                  <a href="<?php echo site_url(ADMIN_PATH . 'theme_option/deletePage/' . $values->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');">
                                                      <img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>                                                 <?php }?>
                                            </td>
                                        </tr>
                                      
                         <?php  } }?>
                            </tbody>
                        </table>          
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>