<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title;?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
                                echo form_open_multipart(ADMIN_PATH . 'social/update', $attributes);
                           ?>
                    <table class="form">
                        <?php $path = base_url().'uploads/social/'; foreach($socialList as $value){?>
                            <tr>
                                <td class="col1">
                                    <img src="<?php echo $path.$value->social_icon;?>" width="32" data-rel="tooltip" title="<?php echo $value->social_title;?>"/>&nbsp;&nbsp;&nbsp;
                                </td>
                                <td class="col2">
                                    <?php
                                    $data = array(
                                        'name' => 'social_link['.$value->id.']',
                                        'id' => 'social_link',
                                        'value' => set_value('social_link')==""?$value->social_link:set_value('social_link'),
                                        'class' => 'medium'
                                            //'readonly' => 'readonly'
                                    );
                                    echo form_input($data);
                                    ?>
                                    <input type="hidden" name="id" value="<?php echo $value->id;?>"/>
                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                                <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );

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