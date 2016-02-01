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
                echo form_open(ADMIN_PATH . 'newscategory/update', $attributes);
            }else{
                echo form_open(ADMIN_PATH . 'newscategory/add', $attributes);
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
                                'name' => 'news_category',
                                'id' => 'news_category',
                                'value' => set_value('news_category')==""?$photoRecord->category_name:set_value('news_category'),
                                'class' => 'medium',
                            );
                        }                            
                        else{
                            $data = array(
                                'name' => 'news_category',
                                'id' => 'news_category',
                                'value' => set_value('news_category'),
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
                            Is Menu:</label>
                    </td>
                    <td><?php 
                            $options = array(
                                '' => 'Select',
                                'Yes' => 'Yes',
                                'No' => 'No',
                            );
							if (!empty($photoRecord)){
                            	echo form_dropdown('ismenu', $options, set_value('ismenu')==""?$photoRecord->is_menu:set_value('ismenu'));
							}else{
								echo form_dropdown('ismenu', $options, set_value('ismenu'));
							}	
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
                       <?php if (in_array('newscategory_add', $allowed)) { ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'newscategory'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Category Name</th>
                            <th>Ismenu</th>
                            <th>Order</th>
                            <th>action</th>
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
                                <td><?php echo $values->category_name; ?></td>   
                                <td><?php echo $values->is_menu;?></td>
                                <td><?php echo $values->order;?>
                                	-<a href="<?php echo site_url(ADMIN_PATH."newscategory/updateOrder/$values->id/$values->order/1") ?>">
                                		<img src="<?php echo base_url();?>/style/img/arrow-desc.png" />
                                	 </a>
                                	 <a href="<?php echo site_url(ADMIN_PATH."newscategory/updateOrder/$values->id/$values->order/2") ?>">
                                	 	<img src="<?php echo base_url();?>/style/img/arrow-asc.png" />
                                	 </a>                                	
                                </td>                             
                               <td class="action" style="width:100px">
                               <?php
                                if(in_array('newscategory_update',$allowed))
                                {
                               ?>
                               <a href="<?php echo site_url(ADMIN_PATH.'newscategory/updateAction/'.$values->id); ?>"><img src="<?php echo base_url();?>/style/img/edit.png" alt="edit"></a> 
                               <?php
                                }
                               ?>
                               <?php
                               
                                    if(in_array('newscategory_delete',$allowed))
                                    {
                               ?>
                               <a href="<?php echo site_url(ADMIN_PATH.'newscategory/deleteAction/'.$values->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url();?>/style/img/delete.png" alt="delete"></a> 
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