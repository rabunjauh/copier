<div class="container box">
    <div class="row">
        <div class="col-lg-6">
            <h2>Register Password</h2>
        </div>
    </div>
    <?php 
        echo validation_errors(); 
        echo form_open(base_url('c_employee_details/register_password/'));    
    ?>

    <div class="row">
        <div class="col-lg-6">
            <?php 
                $sharp_password_integer = intval($last_row->sharp_password) + 1;
                $sharp_password_data = array(
                    'type' => 'text',
                    'name' => 'txt_sharp_password',
                    'id' => 'txt_sharp_password',
                    'class' => 'form-control',
                    'value' => $sharp_password_integer,
                    'disabled' => 'disabled'
                );
                
                $other_password_integer_to_string = intval($sharp_password_integer,1);
                $other_password_data = array(
                    'type' => 'text',
                    'name' => 'txt_others_password',
                    'id' => 'txt_others_password',
                    'class' => 'form-control',
                    'value' => substr($other_password_integer_to_string,1),
                    'disabled' => 'disabled'
                );
                
                $employee_id_data = array(
                    'type' => 'text',
                    'name' => 'txt_employee_id',
                    'id' => 'txt_employee_id',
                    'class' => 'form-control',
                    'placeholder' => 'Employee ID',
                    'disabled' => 'disabled'
                );

                $employee_name_data = array(
                    'type' => 'text',
                    'name' => 'txt_employee_name',
                    'id' => 'txt_employee_name',
                    'class' => 'form-control',
                    'placeholder' => 'Employee Name',
                    'disabled' => 'disabled'
                );

                $employee_department_data = array(
                    'type' => 'text',
                    'name' => 'txt_employee_department',
                    'id' => 'txt_employee_department',
                    'class' => 'form-control',
                    'placeholder' => 'Department',
                    'disabled' => 'disabled'
                );
                
                $employee_position_data = array(
                    'type' => 'text',
                    'name' => 'txt_employee_position',
                    'id' => 'txt_employee_position',
                    'class' => 'form-control',
                    'placeholder' => 'Job Title',
                    'disabled' => 'disabled'
                );
                
                $employee_email_data = array(
                    'type' => 'text',
                    'name' => 'txt_employee_email',
                    'id' => 'txt_employee_email',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'disabled' => 'disabled'
                );
               
                $submit_data = array(
                    'type' => 'submit',
                    'name' => 'submit',
                    'class'=> 'btn btn-primary',
                    'value' => 'Register Employee Detail'
                );
            ?>
                <div class="form-input">
            <?php
                echo form_label('Sharp Password: ', $sharp_password_data['name']);
                echo form_input($sharp_password_data);
            ?>
                </div>    
                
                <div class="form-group">
            <?php
                echo form_label('Other Password: ', $other_password_data['name']);
                echo form_input($other_password_data);
            ?>
                </div>    
                
        </div>

        <div class="col-lg-6">
            <?php echo form_label('Employee ID: ', $employee_id_data['name']); ?>
                <div class="input-group">
            <?php
                
                echo form_input($employee_id_data);
            ?>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="btnSearchEmployee"  data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i></button>
                    </span>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Name: ', $employee_name_data['name']);
                echo form_input($employee_name_data);
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Department: ', $employee_department_data['name']);
                echo form_input($employee_department_data);
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Position: ', $employee_position_data['name']);
                echo form_input($employee_position_data);
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Email: ', $employee_email_data['name']);
                echo form_input($employee_email_data);
            ?>
                </div>  
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php
                    echo form_input($submit_data);
                ?>  
            </div> 
        </div>      
    </div>
        <?php
            echo form_close();
        ?>
</div>

<!-- Employee Data Modal -->
<div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Employee Data</h4>
            </div>

            <div class="modal-body">
                
            <?php
                $search_by = array(
                    '0' => 'Search By',
                    'fingerid' => 'Employee ID',
                    'employeename' => 'Name',
                    'deptdesc' => 'Department',
                    'positiondesc' => 'Position',
                    'email' => 'Email'
                );    
                
                $search_text = array(
                    'type' => 'text',
                    'id' => 'txt_search',
                    'name' => 'txt_search',
                    'class' => 'form-control',
                    'placeholder' => 'Search...'
                );    
            ?>
            
                <div class="form-group">    
            <?php
                echo form_label('Search Employee: ', 'sel_search_by');
                echo form_dropdown('sel_search_by', $search_by, '0', 'class="form-control" id="sel_search_by"'); 
            ?>
                <div>
                
                <div class="form-group">    
            <?php
                echo form_input($search_text); 
            ?>
                <div>
            </div>
            <br>

            <table class="table table-bordered">
                <thead> 
                    <tr>
                        <td>Employee ID</td>
                        <td>Name</td>
                        <td>Department</td>
                        <td>Job Title</td>
                        <td>Email</td>
                    </tr>
                </thead>
                <tbody id="tBody">
                    <tr>
                        <td colspan="5">No data to display</td>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                        <td>Employee ID</td>
                        <td>Name</td>
                        <td>Department</td>
                        <td>Job Title</td>
                        <td>Email</td>
                    </tr>
                </tfoot>
            </table>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const btnSearchEmployee = document.getElementById('btnSearchEmployee');
    btnSearchEmployee.addEventListener('click', function() {
        const tbody = document.getElementById('tBody');
        let xhttp = new XMLHttpRequest();
        xhttp.open('GET', '<?= base_url('c_employee/get_employee_data'); ?>');
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // const data = JSON.parse(this.response);
                // const results = data.results;
                // const links = data.links;
                console.log(this.response);
            }
        }
        xhttp.setRequestHeader('Content-Type',  'application/x-www-form-urlencoded');
        xhttp.send();
    });
</script>

