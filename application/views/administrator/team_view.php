<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
                         <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
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
                            <?php
                        if(validation_errors())
                        {
                            
                            ?>
                             <div class="message error"><?php echo validation_errors(); ?></div> 
                            <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
                                echo form_open_multipart(ADMIN_PATH . 'team/update', $attributes);
                           ?>
                    <table class="form">
                        <?php

                         if(!empty($team)){?>
                            <input name="id" id="id" type="hidden" value="<?php echo $team -> id; ?>"/>
                      
                       <td class="col1">
                            <p>Category Name </p></td>
                            <td class="col2">
                                <input name="category_name" type="text" id="category_name" value="<?php echo $team -> category_name; ?>">
                            </td>
                             <tr>
                        </tr>
                            
                            <td class="col1">
                            <p>Member Name</p></td>
                            <td class="col2">
                                <input name="name" type="text" id="name" value="<?php echo $team -> name; ?>">
                            </td>
                     
                        <?php } else{ ?>
                        
                      
                       <td class="col1">
                            <p>Title </p></td>
                            <td class="col2">
                                <input name="category_name" type="text" id="category_name" >
                            </td>
                             <tr>
                        </tr>
                            
                            <td class="col1">
                            <p>iFrame</p></td>
                            <td class="col2">
                                <input name="name" type="text" id="name" >
                            </td>
                        <tr>
                        <tr>
                             </tr>
                             
                              
                             
                             
                        <?php } ?>
                        
                       
            
                        
                            
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                               <?php
                            if (!empty($team)) {
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