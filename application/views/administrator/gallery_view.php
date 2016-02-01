<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title1; ?></h2>
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
                                if (!empty($photoRecord)) {
                                    echo form_open_multipart(ADMIN_PATH . 'gallery/update', $attributes);
                                } else {
                                    echo form_open_multipart(ADMIN_PATH . 'gallery/add', $attributes);
                                }
                           ?>
                    <table class="form">
                        <?php if(!empty($photoRecord)){?>
                        <input name="id" type="hidden" value="<?php echo $photoRecord->gallery_id?>"/>
                        <input name="old_image" type="hidden" value="<?php echo $photoRecord -> gallery_path; ?>"/>
                        <?php } ?>
                        <tr>
                            <td class="col1">
                            
                                <?php $attributes = array('class' => 'left', );
                                echo form_label('Image:(660*251)', 'image', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                <?php $data = array('name' => 'gallery_path', 'id' => 'gallery_path', 'class' => '', 'onchange' => 'readURL(this);');
                                echo form_upload($data);
                            ?> 
                            <br/><?php if(!empty($photoRecord)){ $path = '../../.'.GALLERY_IMAGE_PATH.str_replace(' ', '_', $albumname).'/';?><img id="blah" src="<?php echo $path . $photoRecord -> gallery_path; ?>" alt="" width="50%"/><?php }else{ ?><img id="blah" src="#" alt="" width="50%"/><?php } ?>
                            </td>
                        </tr>
                        <tr>
                    <td class="col1" >
                        <?php $attributes = array('class' => 'left', );
                        echo form_label('Image Title:', 'image_title', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        if (!empty($photoRecord))
                            $data = array('name' => 'gallery_title', 'id' => 'gallery_title', 'style' => 'height:20px;', 'value' => set_value('gallery_title') == "" ? $photoRecord -> gallery_title : set_value('gallery_title'), 'class' => 'medium', );
                        else
                            $data = array('name' => 'gallery_title', 'id' => 'gallery_title', 'value' => set_value('gallery_title'), 'class' => 'medium', 'style' => 'height:20px;');
                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                                <input type="hidden" name="album_id" value="<?php echo $albumid; ?>" />
                                
                               <?php
                                    if (!empty($photoRecord)) {
                                        $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );
                                    } else {
                                        $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary', );
                                    }
                                    echo form_submit($data);
                                    // $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-primary', );
                                    // echo form_reset($data);
                            ?>
                            </td>
                        </tr>
                        
                    </table>
                   <?php echo form_close(); ?>
                   </div>
                </div><!--/span-->

            </div><!--/row-->  
    </div>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                            <?php if (in_array('gallery_add', $allowed)) { ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'gallery/'.$albumid); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Gallery Image</th>
                                <th style="width: 20%;">GalleryTitle</th>
                                 <!--<th>Index</th>-->        
                                <th style="width: 20%;">Created Date</th>
                                <th style="width: 10%;">action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($photoList != 0 && count($photoList) > 0) {
                        $count = 1;
                        $path = base_url().GALLERY_IMAGE_PATH.str_replace(" ", "_", $albumname);
                        foreach ($photoList as $values) {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><img width="200" src="<?php echo $path . '/' . $values -> gallery_path; ?>"/></td>
                                <td><?php echo $values -> gallery_title; ?></td>
                                <!-- <td><?php //echo $values->slider_index;  ?></td>-->
                                <td><?php echo $values -> crtd_dt; ?></td>
                                <td class="action">
                                    <?php
                                    if (in_array('gallery_update', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'gallery/updateAction/' . $values -> gallery_id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('gallery_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'gallery/deleteAction/' . $values -> gallery_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
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
                      <a class="btn btn-primary" href="<?php echo site_url(ADMIN_PATH . 'album');?>">Back</a>      
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>