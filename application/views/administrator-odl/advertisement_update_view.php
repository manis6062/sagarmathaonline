<?php $CI = &get_instance();
$category = $CI -> News_category_model -> getAll();
?>
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
						   echo form_open_multipart(ADMIN_PATH.'advertisement/update/'.$offset, $attributes);
						   ?>
                    <table class="form">
                    	<tr>
		                    <td>
		                        <label>
		                            Size:</label>
		                    </td>
		                    <td><?php $options = array('' => 'Select', 'large' => 'Large', 'medium' => 'Medium', 'small' => 'Small', );
								echo form_dropdown('size', $options, set_value('size')==""?$photoRecord->size:set_value('size'));
		                        ?>
		                        (Image size: Large:1000*150, Medium:500*150, Small:200*100 (all in px))
		                    </td>
		                </tr> 
                        <tr>
                            <td class="col1">
                           <input type="hidden" name="old_image" value="<?php echo $photoRecord->path; ?>">
                           <input type="hidden" name="updt_cnt" value="<?php echo $photoRecord->updt_cnt; ?>">
                            <input type="hidden" name="slider_id" value="<?php echo $photoRecord->slider_id; ?>">
                                <?php
									$attributes = array(
									'class' => 'left',
								);
								echo form_label('Advertisement Image:', 'name', $attributes);
									?>
                            </td>
                            <td class="col2">
                                <?php 
							$data = array(
							  'name'        => 'path',
							  'id'          => 'path',
							  'value'       => '',
							  'class'        => '',
							  'onchange'     => 'readURL(this)',
							);
							echo form_upload($data); 
							?> (Max Filesize: 1Mb)<br/>
							<?php 
							     $path = ADVERTISEMENT_IMAGE_PATH;
							?>
                            <img id="blah" <?php if($photoRecord->path==''){ ?>style="display: none;"<?php }?> src="<?php echo '../../../.'.$path.$photoRecord->path;?>" alt="" width="50%"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Type:</label>
                            </td>
                            <td><?php $options = array('' => 'Select', 'slider' => 'Slider', 'non-slider' => 'Non-slider');
								echo form_dropdown('type', $options, set_value('type')==""?$photoRecord->type:set_value('type'));
		                        ?>
                            </td>
                        </tr>
                        <tr>
		                    <td class="col1" >
		                        <?php
		                        $attributes = array(
		                            'class' => 'left',
		                        );
		                        echo form_label('Link:', 'link', $attributes);
		                        ?>
		                    </td>
		                    <td class="col2">
		                        <?php
		                        $data = array(
		                            'name' => 'link',
		                            'id' => 'link',
		                            'value' => set_value('link')==""?$photoRecord->link:set_value('link'),
		                            'class' => 'medium',
		                        );
		                        echo form_input($data);
		                        ?>
		                        (Example: http://www.example.com)
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
							  'value'       => 'Update',
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