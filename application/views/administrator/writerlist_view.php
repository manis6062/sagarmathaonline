<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
                		<?php
						if($this->session->flashdata('su_message'))
						{
							
							?>
							 <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div> 
							<?php } ?>
                       <?php
					   if(in_array('writer_add',$allowed))
					   {
					   ?><a href="<?php echo site_url(ADMIN_PATH . 'writer/addAction'); ?>" class="btn btn-primary">New</a>
						<?php } ?>
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						<tr>
							<th>&nbsp;</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>                            
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Order</th>
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
								<td><?php echo $count; ?></td>
								<td><img src="<?php echo base_url() . TEAM_PATH . $values -> writer_image; ?>" width="70" /></td>
                                <td><?php echo $values -> writer_name; ?></td>                                
                                <td><?php echo $values -> category; ?></td>
								<td><?php echo $values -> writer_email; ?></td>
								<td><?php echo $values -> writer_phone; ?></td>
								<td><?php echo $values -> writer_address; ?></td>                               
								<td><?php echo $values->order; ?>
								    -<a href="<?php echo site_url(ADMIN_PATH."writer/updateOrder/$values->writer_id/$values->order/1/$values->writer_category") ?>">
								        <img src="<?php echo base_url();?>/style/img/arrow-desc.png" />
								     </a>
								     <a href="<?php echo site_url(ADMIN_PATH."writer/updateOrder/$values->writer_id/$values->order/2/$values->writer_category") ?>">
								         <img src="<?php echo base_url();?>/style/img/arrow-asc.png" />
								     </a>
								</td>
                                <td class="action" style="width:100px">
							   <?php
								if(in_array('writer_update',$allowed))
								{
							   ?>
							   <a href="<?php echo site_url(ADMIN_PATH . 'writer/updateAction/' . $values -> writer_id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
							   <?php } ?>
							   <?php
							   
									if(in_array('writer_delete',$allowed))
									{
							   ?>
							   <a href="<?php echo site_url(ADMIN_PATH . 'writer/deleteAction/' . $values -> writer_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
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