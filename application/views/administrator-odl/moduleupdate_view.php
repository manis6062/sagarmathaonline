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
            echo form_open(ADMIN_PATH . 'module/update', $attributes);
            ?>
            <table class="form">
                <tr>
                    <td class="col1">
                        <?php
                        $attributes = array(
                            'class' => 'left',
                        );
                        echo form_label('Module Name:', 'module_name', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        $data = array(
                            'name' => 'module_name',
                            'id' => 'module_name',
                            'value' => set_value('module_name')==""?$modules->module_name:set_value('module_name'),
                            'class' => 'medium'
                                //'readonly' => 'readonly'
                        );
                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <?php
                        $attributes = array(
                            'class' => 'left',
                        );
                        echo form_label('Module Controller:', 'module_controller', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        $data = array(
                            'name' => 'module_controller',
                            'id' => 'module_controller',
                            'value' => set_value('module_controller')==""?$modules->module_controller:set_value('module_name'),
                            'class' => 'medium'
                                //'readonly' => 'readonly'
                        );
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
                        <input type="hidden" name="id" value="<?php echo $modules->id;?>" />
                        <?php
                        $data = array(
                            'name' => 'submit',
                            'id' => 'submit',
                            'value' => 'Update',
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