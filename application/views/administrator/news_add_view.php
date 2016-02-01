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
            if (validation_errors()) {
                ?>
                <div class="message error"><?php echo validation_errors(); ?></div> 
                <?php } ?>
                <div class="message error">
                             <?php
                             if(!empty($errors)){
                            foreach ($errors as $value) {
                                echo $value;
                            }}
                             ?>
                             </div> 
            <?php $attributes = array('class' => 'formular');
					echo form_open_multipart(ADMIN_PATH . 'news/add', $attributes);
            ?>
            <table class="form">
                <tr>
                    <td class="col1">
                        <?php $attributes = array('class' => 'left', );
						echo form_label('Title:', 'name', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php $data = array('name' => 'news_title', 'id' => 'news_title', 'value' => set_value('news_title'), 'class' => 'medium', );
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
                                        <option value="<?php echo $value -> id; ?>" <?php
							if (set_value("category") == $value->id) {
								echo 'selected="selected"';
							}
                            ?>><?php echo $value -> category_name; ?></option>
                                    <?php } ?>
                                 </select>
                            </td>
                        </tr>
                <tr>
                
                        <tr>
                            <td>
                                <label>
                                    Is Banner:</label>
                            </td>
                            <td>
                              <select name="banner" id="banner">
                                    <option value="">Select</option>
                                    <option value="Yes" <?php
										if (set_value("banner") == 'Yes') {
											echo 'selected="selected"';
										}
			                            ?>>Yes</option>
                                    <option value="No" <?php
							if (set_value("banner") == 'No') {
								echo 'selected="selected"';
							}
                            ?>>No</option>
                                 </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                           
                                <?php $attributes = array('class' => 'left', );
                            echo form_label('Feature Image:(405*315)', 'image', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                <?php $data = array('name' => 'path', 'id' => 'path', 'value' => '', 'class' => 'btn btn-primary', 'onchange' => 'readURL(this);',);
                                echo form_upload($data);
                            ?>(Max Filesize: 1Mb)<br/>
                            <img id="blah" style="display: none;" src="#" alt="" width="50%"/>
                            </td>
                        </tr>
                <tr>
                    <td>
                        <label>
                            Detail Description:</label>
                    </td>
                    <td>
                        <textarea class="ckeditor" id="detail_description"  style="width:100%"  name="news_details" ><?php echo set_value('news_details'); ?></textarea>
                    </td>
                </tr>

                <!-- <tr>
                    <td class="col1">
                        <?php $attributes = array('class' => 'input-xlarge datepicker hasDatepicker', );
						echo form_label('Date:', 'name', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php $data = array('name' => 'news_date', 'id' => 'news_date', 'value' => set_value('news_date'), 'class' => 'input-xlarge datepicker', );
						echo form_input($data);
                        ?>
                    </td>
                </tr> -->
                <tr>
                    <td class="col1">
                        <?php $attributes = array('class' => 'left', );
						echo form_label('Status:', 'name', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <select name="news_status" class="chzn-select medium select" style="width:390px;">

                            <option value="yes" <?php
							if (set_value("news_status") == 'yes') {
								echo 'selected="selected"';
							}
                            ?>>Yes</option>
                            <option value="no" <?php
							if (set_value("news_status") == 'no') {
								echo 'selected="selected"';
							}
                            ?>>No</option>


                        </select>
                    </td>
                </tr>






                <tr>
                    <td>
                        <label>
                            &nbsp;</label>
                    </td>
                    <td>
                        <?php
						$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary', );

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
    </div>

</div>

</div>