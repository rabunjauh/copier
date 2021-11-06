<div class="container box">	
	<div class="row">
		<div class="col-lg-6">
			<h1>Printer Registration Data</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">			
			<a href="<?php echo base_url() . 'c_user/add_user' ?>" class="btn btn-primary my-1">Register User</a>
		</div>
		<div class="col-lg-6">			
            <?=form_open(base_url() . 'c_employee_details/search'); ?>
            <div class="form-inline">
                <div class="form-group">
                    <select name="selSearch" id="selSearch" class="form-control">
                        <option value="0">Search By</option>
                        <option value="employeename">Name</option>
                        <option value="idemployee">Employee ID</option>
                        <option value="other_password">Other Printer Password</option>
                        <option value="sharp_password">Sharp Printer Password</option>
                        <option value="deptdesc">Department</option>
                        <option value="positiondesc">Position</option>
                        <option value="email">Email</option>
                    </select>						
                    <input type="text" class="form-control" name="txtSearch" id="txtSearch" placeholder="Search">
                    <select name="selDepartment" id="selDepartment" class="form-control">
                    </select>	
                    <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>Search</button>
                </div>
            </div>
            <?=form_close(); ?> 
		</div>
	</div>	
	<br>
	<div class="row">
		<div class="col-lg-12">
            <table class="table table-bordered">
                <tr>
                    <td>No</td>
                    <td>Employee ID</td>
                    <td>Sharp Password</td>
                    <td>Other Password</td>
                    <td>Name</td>
                    <td>Department</td>
                    <td>Job Title</td>
                    <td>Email</td>
                    <td colspan="4">Action</td>
                </tr>
		
                <?php
                    if ($copier_registrations) {
                        $no = 1;
                        foreach ($copier_registrations as $copier_registration): 
                            
                ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $copier_registration->fingerid; ?></td>
                                <td><?php echo $copier_registration->sharp_password; ?></td>
                                <td><?php echo $copier_registration->others_password; ?></td>
                                <td><?php echo $copier_registration->employeename; ?></td>
                                <td><?php echo $copier_registration->deptdesc; ?></td>
                                <td><?php echo $copier_registration->positiondesc; ?></td>
                                <td><?php echo $copier_registration->email; ?></td>
                                <td><a href="<?= base_url('c_employee_details/send_email_employee_details/' . $copier_registration->fingerid); ?>"><i class="fa fa-user fa-2x"></i></a></td>
                                <td><a href="<?= base_url('c_employee_details/send_email_sharp_details/' . $copier_registration->fingerid); ?>"><i class="fa fa-print fa-2x"></i></a></td>
                                <td><a href=""><i class="fa fa-edit fa-2x"></i></a></td>
                            </tr>
                            </form>
                <?php $no++; ?>
                <?php   
                            
                            
                            echo form_close();
                        endforeach;
                    } else {
                ?>
                        <tr><td colspan="8">No data to display</td></tr>
                <?php
                    }
                ?>
            </table>
            <?php echo $this->pagination->create_links(); ?>
	    </div>
	</div>	
    
   
</div>	

 <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    const selDepartment = document.getElementById('selDepartment');
    selDepartment.style.display = 'none'; 

    const selSearch = document.getElementById('selSearch');
    selSearch.addEventListener('change', function(e){
        const txtSearch = document.getElementById('txtSearch');
        if (this.value == 'deptdesc') {
            txtSearch.style.display = 'none';
            selDepartment.style.display = 'inline'; 
        } else {
            txtSearch.style.display = 'inline';
            selDepartment.style.display = 'none'; 
        }
        dependent('<?= base_url('c_employee_details/get_department') ?>', selDepartment);
    });
    function dependent(url, targetElement) {
        let xhttp = new XMLHttpRequest();
        xhttp.open('GET', url);
        xhttp.onreadystatechange = function (){
            if (this.readyState == 4 && this.status == 200) {
                let output = JSON.parse(this.responseText);
                targetElement.innerHTML = output;
                console.log(targetElement);
            }
        };
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send();
    }
</script>