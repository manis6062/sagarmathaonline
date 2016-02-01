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
						if(validation_errors())
						{
							
							?>
							 <div class="message error"><?php echo validation_errors();  ?></div> 
							<?php
						}
					   ?>
                       <?php
						if($error)
						{
							
							?>
							 <div class="message error">
							 <?php 
							
							 foreach($error as $value)
							 {
								 echo $value;
							 }
							 ?>
							 </div> 
							<?php
						}
					   ?>
                		 <?php
						   $attributes = array('class' => 'formular');
						   echo form_open_multipart(ADMIN_PATH.'publication/add', $attributes);
						   ?>
                    <table class="form">
                    
                        
                        <tr>
                            <td class="col1">
                                <?php
									$attributes = array(
									'class' => 'left',
								);
								echo form_label('Title:', 'username', $attributes);
									?>
                            </td>
                            <td class="col2">
                                 <?php 
								$data = array(
								  'name'        => 'publication_title',
								  'id'          => 'quantity',
								  'value'       => set_value('publication_title'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Brief Description:</label>
                            </td>
                            <td>
                                 <textarea class="medium" id="description"  style="width:100%"  name="publication_brief" ><?php echo set_value('publication_brief');?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                   Detail Description:</label>
                            </td>
                            <td>
                                <textarea class="medium" id="detail_description"  style="width:100%"  name="publication_details" ><?php echo set_value('publication_details');?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                  Published Date:</label>
                            </td>
                            <td>
                                <?php 
								$data = array(
								  'name'        => 'publication_date',
								  'id'          => 'purchased_date',
								  'value'       => set_value('publication_date'),
								  'autocomplete' =>'off',
								  'class'        => 'input-xlarge datepicker',
								);
								echo form_input($data); 
								?>
                                 
                            </td>
                        </tr>
                        <tr>
                        	<td><label>Status</label></td>
                            <td>
                            <?php
								$extra='style="width:390px;" class="chzn-select medium select"';
								$options = array();
								
									$options['1']="Yes";
									$options['0']="No";
								
								echo form_dropdown('publication_status', $options, set_value('publication_status'),$extra);
								?> 
                            </td>
                        </tr>
                        <!--<tr>
                            <td>
                                <label>
                                    Writer:</label>
                            </td>
                            <td>
                              <?php
								/*$extra='style="width:390px;" class="chzn-select medium select"';
								$options = array();
								$options['']="Select";
								foreach($writer as $value)
								{
									$options[$value->writer_id]=$value->writer_name;
								}
								echo form_dropdown('writer_id', $options, set_value('writer_id'),$extra);*/
								?> 
                            </td>
                        </tr>-->
                        
                        <tr>
                            <td class="col1">
                           
                                <?php
									$attributes = array(
									'class' => 'left',
								);
								echo form_label('File:', 'name', $attributes);
									?>
                            </td>
                            <td class="col2">
                                <?php 
							$data = array(
							  'name'        => 'publication_file',
							  'id'          => 'gal_image',
							  'value'       => '',
							  'class'        => '',
							);
							echo form_upload($data); 
							?> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                               <?php 
							$data = array(
							  'name'        => 'submit',
							  'id'          => 'submit',
							  'value'       => 'Save',
							  'class'        => 'btn btn-primary',
							);
							
							echo form_submit($data);  
							?>
                            </td>
                        </tr>
                        
                    </table>
                   <?php
			   echo form_close();
			   ?> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->  
    </div>