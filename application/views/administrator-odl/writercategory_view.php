<?php $allowed = $this -> Auth_master_model -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
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
                <?php
            }
            ?>
            <?php
            $attributes = array('class' => 'formular');
            if(!empty($photoRecord)){
                echo form_open(ADMIN_PATH . 'writercategory/update', $attributes);
            }else{
                echo form_open(ADMIN_PATH . 'writercategory/add', $attributes);
            }    
            ?>
            <table class="form">
                <tr>
                    <?php if(!empty($photoRecord)){?>
                        <input name="id" type="hidden" value="<?php echo $photoRecord->id?>"/>
                        <?php } ?>
                    <td class="col1" >
                        <?php
                        $attributes = array(
                            'class' => 'left',
                        );
                        echo form_label('Category Name:', 'name', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        if (!empty($photoRecord)){
                            $data = array(
                                'name' => 'writer_category',
                                'id' => 'writer_category',
                                'value' => set_value('writer_category')==""?$photoRecord->writer_category:set_value('writer_category'),
                                'class' => 'medium',
                            );
                        }                            
                        else{
                            $data = array(
                                'name' => 'writer_category',
                                'id' => 'writer_category',
                                'value' => set_value('writer_category'),
                                'class' => 'medium',
                            );
                        }    
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
                        <?php
                        if (!empty($photoRecord)){
                            $data = array(
                                'name' => 'submit',
                                'id' => 'submit',
                                'value' => 'Update',
                                'class' => 'btn btn-primary',
                            );
                        }else{
                            $data = array(
                                'name' => 'submit',
                                'id' => 'submit',
                                'value' => 'Save',
                                'class' => 'btn btn-primary',
                            );
                        }
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
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title;?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if($this->session->flashdata('su_message'))
                        {
                            
                            ?>
                             <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div> 
                            <?php
                        }
                       ?>
                       <?php if (in_array('writercategory_add', $allowed)) { ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'writercategory'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Category Name</th>
                            <th>action </th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                        if( $categoryList !=0 && count($categoryList) > 0)
                        {
                            $count=1;
                            foreach($categoryList as  $values)
                            {
                            ?>
                            <tr class="item">
                                <td><?php  echo $count;?></td>
                                <td><?php echo $values->writer_category; ?></td>                                
                               <td class="action" style="width:100px">
                               <?php
                                if(in_array('writercategory_update',$allowed))
                                {
                               ?>
                               <a href="<?php echo site_url(ADMIN_PATH.'writercategory/updateAction/'.$values->id); ?>"><img src="<?php echo base_url();?>/style/img/edit.png" alt="edit"></a> 
                               <?php
                                }
                               ?>
                               <?php
                               
                                    if(in_array('writercategory_delete',$allowed))
                                    {
                               ?>
                               <a href="<?php echo site_url(ADMIN_PATH.'writercategory/deleteAction/'.$values->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url();?>/style/img/delete.png" alt="delete"></a> 
                               <?php
                                    }
                               
                               ?>
                               
                               </td>
                            </tr>
                            <?php
                            $count++;
                            }
                        }
                        ?>
                     </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>