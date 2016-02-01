<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title;?></h2>
                    </div>
                    <div class="box-content">
                                                <?php
                        if(validation_errors())
                        {
                            
                            ?>
                             <div class="message error"><?php echo validation_errors(); ?></div> 
                            <?php } ?>
                        <?php
                        if($error)
                        {
                            
                            ?>
                             <div class="message error">
                             <?php
                            foreach ($error as $value) {
                                echo $value;
                            }
                             ?>
                             </div> 
                            <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
                                echo form_open_multipart(ADMIN_PATH . 'album/update', $attributes);
                           ?>
                    <table class="form">
                        <tr>
                            <td class="col1">
                           
                                <?php $attributes = array('class' => 'left', );
                            echo form_label('Title', 'title', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                <?php
		                        $data = array(
		                            'name' => 'album_title',
		                            'id' => 'album_title',
		                            'value' => set_value('album_title')==""?$photoRecord->album_title:set_value('album_title'),
		                            'class' => 'medium'
		                                //'readonly' => 'readonly'
		                        );
		                        echo form_input($data);
		                        ?>
                            </td>
                        </tr>
                      <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
                                echo form_label('Description:', 'index', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                 
                                <?php $data = array('name' => 'album_descript', 'id' => 'album_descript', 'value' => set_value('album_descript')==""?$photoRecord->album_descript:set_value('album_descript'), 'class' => 'medium', 'rows' => '5', );
                                    echo form_textarea($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Status:</label>
                            </td>
                            <td>
                              <?php $extra = 'style="width:390px;" class="chzn-select medium select"';
                                $options = array('Active' => 'Active', 'Inactive' => 'Inactive', );
                                echo form_dropdown('album_status', $options, set_value('album_status')==""?$photoRecord->album_status:set_value('album_status'), $extra);
                                ?> 
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                            	<input type="hidden" name="album_id" value="<?php echo $photoRecord->album_id; ?>">
                               <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-navy', );

                                echo form_submit($data);
                                $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-grey', );
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