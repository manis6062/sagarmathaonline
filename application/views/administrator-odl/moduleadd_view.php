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
            echo form_open(ADMIN_PATH . 'module/add', $attributes);
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
                            'value' => set_value('module_name'),
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
                            'value' => set_value('module_controller'),
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