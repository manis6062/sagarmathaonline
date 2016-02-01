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
                        <h2><i class="icon-user"></i> Menu List</h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                        <?php } 
                        if (in_array('menu_add', $allowed)) {
                                ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'menu/addAction'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>                                
                        <table class="table table-striped table-bordered bootstrap-datatable datatable"  id="example-advanced">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($menuList != 0 && count($menuList) > 0) {
                                    $count = 1;
                                    foreach ($menuList as $values) {
                                        ?>
                                        <tr class="item" data-tt-id='<?php echo $count;?>'>
                                            <td><?php echo $values->menu_name; ?></td>
                                            <td><?php echo $values->menu_type; ?></td>
                                            <td><?php echo $values->crtd_dt; ?></td>   
                                            <td><?php echo $values->menu_order; ?>-<a href="<?php echo site_url(ADMIN_PATH."menu/updateOrder/$values->id/$values->menu_order/1") ?>"><img src="<?php echo base_url();?>/style/img/arrow-desc.png" /></a><a href="<?php echo site_url(ADMIN_PATH."menu/updateOrder/$values->id/$values->menu_order/2") ?>"><img src="<?php echo base_url();?>/style/img/arrow-asc.png" /></a></td>
                                            <td>
                                                <a href="<?php echo site_url(ADMIN_PATH . 'menu/changeStatus/' . $values->id . "/" . $values->status); ?>">
                                                    <?php echo $values->status; ?>
                                                </a>
                                            </td>
                                            <td class="action">
                                                <?php if(in_array('menu_update', $allowed)){?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'menu/updateAction/' . $values->id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                <?php }?>
                                                <?php if(in_array('menu_delete', $allowed)){?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'menu/deleteMenu/' . $values->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php 
                                            $submenu = $CI->Menu_model->getsubmenu($values->id);  
                                            if(!empty($submenu)){
                                                $i=1;
                                                foreach($submenu as $value){?>
                                                    <tr class="item" data-tt-id='<?php echo $count."-".$i;?>' data-tt-parent-id='<?php echo $count;?>'>
                                                        <td><?php echo $value->menu_name; ?></td>
                                                        <td><?php echo $value->menu_type; ?></td>
                                                        <td><?php echo $value->crtd_dt; ?></td>   
                                                        <td><?php echo $value->menu_order; ?>-<a href="<?php echo site_url(ADMIN_PATH."menu/updateOrder/$value->id/$value->menu_order/1") ?>"><img src="<?php echo base_url();?>/style/img/arrow-desc.png" /></a><a href="<?php echo site_url(ADMIN_PATH."menu/updateOrder/$value->id/$value->menu_order/2") ?>"><img src="<?php echo base_url();?>/style/img/arrow-asc.png" /></a></td>
                                                        <td>
                                                            <a href="<?php echo site_url(ADMIN_PATH . 'menu/changeStatus/' . $value->id . "/" . $value->status); ?>">
                                                                <?php echo $value->status; ?>
                                                            </a>
                                                        </td>
                                                        <td class="action">
                                                            <?php if(in_array('menu_update', $allowed)){?>
                                                                <a href="<?php echo site_url(ADMIN_PATH . 'menu/updateAction/' . $value->id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                            <?php }?>
                                                            <?php if(in_array('menu_delete', $allowed)){?>
                                                                <a href="<?php echo site_url(ADMIN_PATH . 'menu/deleteMenu/' . $value->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                                            <?php }?>
                                                        </td>
                                                    </tr><?php 
                                                    $i++;
                                                }
                                            }
                                        ?>
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