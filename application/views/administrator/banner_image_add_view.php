<?php $CI = &get_instance();
$category = $CI -> News_category_model -> getAll();
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i>Add New Banner</h2>
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
								echo form_open_multipart(ADMIN_PATH . 'banner/add', $attributes);
                           ?>
                    <table class="form">
                        <tr>
                            <td class="col1">
                           
                                <?php $attributes = array('class' => 'left', );
							echo form_label('Banner Image:(600*500)', 'name', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                <?php $data = array('name' => 'path', 'id' => 'path', 'value' => '', 'class' => '', 'onchange' => 'readURL(this);', );
								echo form_upload($data);
                            ?>(Max Filesize: 1Mb)<br/>
                            <img id="blah" style="display: none;" src="#" alt="" width="50%"/>
                            </td>
                        </tr>
                        <tr>
		                    <td>
		                        <label>
		                            Description:</label>
		                    </td>
		                    <td>
		                        <textarea class="ckeditor" id="description"  style="width:100%"  name="description" ></textarea>
		                    </td>
		                </tr>
                        <tr>
		                    <td class="col1" >
		                        <?php $attributes = array('class' => 'left', );
								echo form_label('Link:', 'link', $attributes);
		                        ?>
		                    </td>
		                    <td class="col2">
		                        <?php $data = array('name' => 'link', 'id' => 'link', 'value' => set_value('link'), 'class' => 'medium', );
								echo form_input($data);
		                        ?>
		                        (Example: http://www.example.com)
		                    </td>
		                </tr>   
		                <tr>
		                    <td>
		                        <label>
		                            Publish:</label>
		                    </td>
		                    <td><?php $options = array('yes' => 'yes', 'no' => 'no', );
								echo form_dropdown('publish', $options, set_value('publish'));
		                        ?>
		                    </td>
		                </tr>                     
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
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
                </div><!--/span-->
            </div><!--/row-->  
    </div>