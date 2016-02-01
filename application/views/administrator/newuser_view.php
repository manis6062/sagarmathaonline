<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
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
						   $attributes = array('class' => 'formular', 'id' => 'form');
						   echo form_open(ADMIN_PATH.'userlist/add', $attributes);
						   ?>
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <?php
									$attributes = array(
									'class' => 'left',
								);
								echo form_label('Name:', 'username', $attributes);
									?>
                            </td>
                            <td class="col2">
                                 <?php 
								$data = array(
								  'name'        => 'user_name',
								  'id'          => 'user_name',
								  'value'       => set_value('user_name'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Login Name:</label>
                            </td>
                            <td>
                                <?php 
								$data = array(
								  'name'        => 'login_name',
								  'id'          => 'login_name',
								  'value'       => set_value('login_name'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                   Password:</label>
                            </td>
                            <td>
                                <?php 
								$data = array(
								  'name'        => 'login_pwd',
								  'id'          => 'login_pwd',
								  'value'       => '',
								  'autocomplete' =>'off',
								  'class'        => 'medium',
								);
								echo form_password($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Confirm Password:</label>
                            </td>
                            <td>
                                <?php 
								$data = array(
								  'name'        => 'passconf',
								  'id'          => 'passconf',
								  'value'       => '',
								  'autocomplete' =>'off',
								  'class'        => 'medium',
								);
								echo form_password($data); 
								?>
                                 <input type="hidden" name="user_type" value="admin" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Status:</label>
                            </td>
                            <td>
                              <?php
								$extra='style="width:390px;" class="chzn-select medium select"';
								$options = array(
								  'yes'  => 'Yes',
								  'no'    => 'No',
								);
								echo form_dropdown('status', $options, set_value('status'),$extra);
								?> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Type:</label>
                            </td>
                            <td>
                              <?php
                                $extra='style="width:390px;" class="chzn-select medium select"';
                                $options = array(
                                  'super-admin'  => 'Super Admin',
                                  'admin'    => 'Admin',
                                  'user'    => 'User',
                                );
                                echo form_dropdown('user_type', $options, set_value('user_type'),$extra);
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
								  'name'        => 'phone',
								  'id'          => 'phone',
								  'value'       => set_value('phone'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
							?>
                            </td>
                        </tr>
                       
                        <tr>
                            <td>
                                <label>
                                    Mobile:</label>
                            </td>
                            <td>
                              <?php 
								$data = array(
								  'name'        => 'cell',
								  'id'          => 'cell',
								  'value'       => set_value('cell'),
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
								  'name'        => 'address',
								  'id'          => 'address',
								  'value'       => set_value('address'),
								  'class'        => 'medium',
								  'rows'		=>'5',
								);
								echo form_textarea($data); 
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                   Email: </label>
                            </td>
                            <td>
                              <?php 
								$data = array(
								  'name'        => 'email',
								  'id'          => 'email',
								  'value'       => set_value('email'),
								  'class'        => 'medium',
								);
								echo form_input($data); 
							?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php
                                $attributes = array(
                                    'class' => 'left',
                                );
                                echo form_label('Grant Access:', 'access', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php foreach($mas_auth as $value){?>
                                    <div style="float: left; width: 17%; margin-right: 20px;">
                                        <input type="checkbox" id="checkbox" name="auth_id[]" value="<?php echo $value->auth_id;?>"><?php echo $value->auth_label;?>
                                    </div>
                                <?php }?>   
                            </td>
                        </tr>
                        <!--<tr>
                            <td>
                                <label>
                                  Authorized Modules: </label>
                            </td>
                            <td>
                             <select name="auth_id[]"  class="chzn-select medium select"  style="width:390px;" multiple>
							  <?php
                              
                              //foreach($mas_auth as $mauth)
                              //{
                                  ?>
                                  <option value="<?php //echo $mauth->auth_id; ?>" <?php //echo set_select('auth_id[]', $mauth->auth_id) ?>><?php //echo $mauth->auth_name; ?></option>
                                  <?php
                              //}
                              ?>
                              </select>
                            </td>
                        </tr>-->
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
							$data = array(
							  'name'        => 'reset',
							  'id'          => 'reset',
							  'value'       => 'Clear',
							  'class'        => 'btn btn-primary',
							);
							echo form_reset($data); 
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