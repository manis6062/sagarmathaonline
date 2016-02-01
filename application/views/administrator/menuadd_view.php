<?php 
$CI = & get_instance();
$content = $CI->Content_model->getAllActive();
$module = $CI->Module_model->getAll();
$parent_menu = $CI->Menu_model->getAll('Active');
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
            echo form_open(ADMIN_PATH . 'menu/add', $attributes);
            ?>
            <table class="form">
                <tr>
                    <td class="col1" >
                        <?php
                        $attributes = array(
                            'class' => 'left',
                        );
                        echo form_label('Title:', 'menu_title', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        $data = array(
                            'name' => 'menu_name',
                            'id' => 'menu_name',
                            'value' => set_value('menu_name'),
                            'class' => 'medium',
                        );
                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Menu Type:</label>
                    </td>
                    <td>
                        <?php
                        $options = array(
                            '' => 'Select',
                            'top-menu' => 'Top Menu',
                            'main-menu' => 'Main Menu',
                            'footer-menu' => 'Footer Menu',
                        );
                        echo form_dropdown('menu_type', $options, set_value('menu_type'));
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Content:</label>
                    </td>
                    <td>
                        <select name="content">
                            <option value="">Select</option>
                            <?php
                                foreach($content as $value){?>
                                <option value="<?php echo $value->content_id;?>"><?php echo $value->content_title;?></option>
                            <?php }?>
                         </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Menu Module:</label>
                    </td>
                    <td>
                        <select name="module">
                            <option value="">Select</option>
                            <?php
                                foreach($module as $value){?>
                                <option value="<?php echo $value->id;?>"><?php echo $value->module_name;?></option>
                            <?php }?>
                         </select>
                    </td>
                </tr>
                <!-- <tr>
                    <td>
                        <label>
                            Parent Menu:</label>
                    </td>
                    <td>
                        <select name="parent">
                            <option value="">Select</option>
                            <?php
                                foreach($parent_menu as $value){?>
                                <option value="<?php echo $value->id;?>"><?php echo $value->menu_name;?></option>
                            <?php }?>
                         </select>
                    </td>
                </tr> -->
                <tr>
                    <td>
                        <label>
                            Status:</label>
                    </td>
                    <td><?php 
                            $options = array(
                                '' => 'Select',
                                'Active' => 'Active',
                                'Inactive' => 'Inactive',
                            );
                            echo form_dropdown('status', $options, set_value('status'));
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
                        $data = array(
                            'name' => 'submit',
                            'id' => 'submit',
                            'value' => 'Save',
                            'class' => 'btn btn-primary',
                        );
                        echo form_submit($data);
                        $data = array(
                            'name' => 'reset',
                            'id' => 'reset',
                            'value' => 'Clear',
                            'class' => 'btn btn-primary',
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