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
							 <div class="message error"><?php echo validation_errors(); ?></div> 
							<?php } ?>
                		 <?php $attributes = array('class' => 'formular');
                        echo form_open(ADMIN_PATH . 'userlist/updatePassword/' . $offset, $attributes);
						   ?>
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
                                echo form_label('Old Password:', 'old_password', $attributes);
									?>
                            </td>
                            <td class="col2">
                                 <?php $data = array('name' => 'old_password', 'id' => 'old_password', 'value' => '', 'class' => 'medium', );
                                echo form_password($data);
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                   New Password:</label>
                            </td>
                            <td>
                                <?php $data = array('name' => 'login_pwd', 'id' => 'login_pwd', 'value' => '', 'autocomplete' => 'off', 'class' => 'medium', );
                                echo form_password($data);
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                   Confirm Password: </label>
                            </td>
                            <td>
                               <?php $data = array('name' => 'passconf', 'id' => 'passconf', 'value' => '', 'autocomplete' => 'off', 'class' => 'medium', );
                                echo form_password($data);
							?>
                            </td>
                        </tr>
                       
                        
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                             <input type="hidden" name="user_id" value="<?php echo $values -> user_id; ?>">
                           <input type="hidden" name="old" value="<?php echo $values -> login_pwd; ?>">
                               <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary', );

                            echo form_submit($data);
                            $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-primary', );
                            echo form_reset($data);
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