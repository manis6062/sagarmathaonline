<?php
$allowed=$this->Auth_master_model->getAuth();
$ts=$this->uri->total_segments();
$offset=(is_numeric($this->uri->segment($ts)))?$this->uri->segment($ts):0;
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
						if($this->session->flashdata('su_message'))
						{
							
							?>
							 <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div> 
							<?php
						}
					   ?>
                        <?php
					   if(in_array('publication_add',$allowed))
					   {
					   ?>
						<a href="<?php echo site_url(ADMIN_PATH.'publication/addAction');?>" class="btn btn-primary">New</a>
						<?php
					   }
						?>
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						<tr>
							 <th>&nbsp;</th>
                            <th>Title</th>
                            <!--<th>Image</th>-->
                             <th>Published Date</th>
                            <th>Order</th>
                            <!--<th>Writer</th>-->
                            <th>Status</th>
                            <th>action </th>
						</tr>
					</thead>
					<tbody>
						 <?php
						if( $usersTypes !=0 && count($usersTypes) > 0)
						{
							$count=1;
							foreach($usersTypes as  $values)
							{
							?>
							<tr class="item">
								<td><?php  echo $count;?></td>
								<td><?php echo $values->publication_title; ?></td>
                                <!--<td><img src="<?php //echo base_url()."uploads/publication/".$values->publication_file; ?>" width="70" /></td>-->
								 <td><?php echo $values->publication_date; ?></td>
								<td style="margin-right:5px"><?php echo $values->publication_order; ?>-<a href="<?php echo site_url(ADMIN_PATH."publication/updateOrder/$values->publication_id/$values->publication_order/1/$offset") ?>"><img src="<?php echo base_url();?>/style/img/arrow-desc.png" /></a><a href="<?php echo site_url(ADMIN_PATH."publication/updateOrder/$values->publication_id/$values->publication_order/2/$offset") ?>"><img src="<?php echo base_url();?>/style/img/arrow-asc.png" /></a></td>
								<!--<td><?php //echo $values->writer_name; ?></td>-->
								<td><?php
								if(in_array('user_update',$allowed))
								{
							   ?>
								<a href="<?php echo site_url(ADMIN_PATH.'publication/changeStatus/'.$values->publication_id."/".$values->publication_status."/".$offset); ?>"><?php echo $values->publication_status; ?></a>
								<?php
								}
							   ?></td>
                                
								
							   <td class="action" style="width:100px">
							   <?php
								if(in_array('user_update',$allowed))
								{
							   ?>
							   <a href="<?php echo site_url(ADMIN_PATH.'publication/updateAction/'.$values->publication_id."/".$offset); ?>"><img src="<?php echo base_url();?>/style/img/edit.png" alt="edit"></a> 
							   <?php
								}
							   ?>
							   <?php
							   
									if(in_array('user_update',$allowed))
									{
							   ?>
							   <a href="<?php echo site_url(ADMIN_PATH.'publication/deleteAction/'.$values->publication_id."/".$offset); ?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url();?>/style/img/delete.png" alt="delete"></a> 
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
                </div><!--/span-->
            
            </div><!--/row-->
</div>