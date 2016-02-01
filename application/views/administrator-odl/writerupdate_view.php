<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();
$category = $CI -> Writercategory_model -> getAll();
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
						   echo form_open_multipart(ADMIN_PATH.'writer/update/'.$offset, $attributes);
						   ?>
                    <table class="form">
                    <tr>
                            <td>
                                <label>
                                    Name:</label>
                            </td>
                            <td>
                              <?php 
								$data = array(
								  'name'        => 'writer_name',
								  'id'          => 'writer_name',
								  'value'       => set_value('writer_name')==""?$usersTypes->writer_name:set_value('writer_name'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Category:</label>
                            </td>
                            <td>
                              <select name="category" id="category">
                                    <option value="">Select</option>
                                    <?php
                                        foreach($category as $value){?>
                                        <option value="<?php echo $value -> id; ?>" <?php if($usersTypes->writer_category==$value->id){?> selected="selected"<?php }?>><?php echo $value -> writer_category; ?></option>
                                    <?php } ?>
                                 </select>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>
                                    Post:</label>
                            </td>
                            <td>
                              <?php 
								$data = array(
								  'name'        => 'writer_post',
								  'id'          => 'writer_post',
								  'value'       => set_value('writer_post')==""?$usersTypes->writer_post:set_value('writer_post'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Gender:</label>
                            </td>
                            <td><?php $options = array('' => 'Select', 'Male' => 'Male', 'Female' => 'Female', );
                                echo form_dropdown('gender', $options, set_value('gender')==""?$usersTypes->writer_gender:set_value('gender'), 'id="gender"');
                                ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>
                                    Education:</label>
                            </td>
                            <td>
                              <?php 
								$data = array(
								  'name'        => 'writer_education',
								  'id'          => 'writer_education',
								  'value'       => set_value('writer_education')==""?$usersTypes->writer_education:set_value('writer_education'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Address:</label>
                            </td>
                            <td>
                              <?php 
								$data = array(
								  'name'        => 'writer_address',
								  'id'          => 'writer_address',
								  'value'       => set_value('writer_address')==""?$usersTypes->writer_address:set_value('writer_address'),
								  'class'        => 'medium',
								  'rows'		=>'5',
								);
								echo form_textarea($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php
									$attributes = array(
									'class' => 'left',
								);
								echo form_label('Email:', 'username', $attributes);
									?>
                            </td>
                            <td class="col2">
                                 <?php 
								$data = array(
								  'name'        => 'writer_email',
								  'id'          => 'writer_email',
								  'value'       => set_value('writer_email')==""?$usersTypes->writer_email:set_value('writer_email'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Phone:</label>
                            </td>
                            <td>
                                <?php 
								$data = array(
								  'name'        => 'writer_phone',
								  'id'          => 'writer_phone',
								  'value'       => set_value('writer_phone')==""?$usersTypes->writer_phone:set_value('writer_phone'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                   Details:</label>
                            </td>
                            <td>
                              
                                <textarea class="medium" id="detail_description"  style="width:100%"  name="writer_details" ><?php if(set_value('writer_details')==""){ echo $usersTypes->writer_details;}else{ echo set_value('writer_details');}?></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="col1">
                           
                                <?php
									$attributes = array(
									'class' => 'left',
								);
								echo form_label('Image(100*100):', 'name', $attributes);
									?>
                            </td>
                            <td class="col2">
                                <?php 
							$data = array(
							  'name'        => 'writer_image',
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
                            <input type="hidden" name="writer_id" value="<?php echo $usersTypes->writer_id; ?>">
                            <input type="hidden" name="crtd_by" value="<?php echo $usersTypes->crtd_by; ?>">
                            <input type="hidden" name="updt_cnt" value="<?php echo $usersTypes->updt_cnt; ?>">
                             <input type="hidden" name="old_image" value="<?php echo $usersTypes->writer_image; ?>">
                               <?php 
							$data = array(
							  'name'        => 'submit',
							  'id'          => 'submit',
							  'value'       => 'Update',
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
            </div>
            
        </div>
    </div>