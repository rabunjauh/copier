<div class="container box">	
	<div class="row">
		<div class="col-lg-6">
			<h1>Printer Registration Data</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">			
			<a href="<?php echo base_url() . 'c_user/add_user' ?>" class="btn btn-primary my-1">Register User</a>
		</div>
	</div>	
	<br>
	<div class="row">
		<div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Employee ID</td>
                    <td>Other Printer Password</td>
                    <td>Sharp Printer Password</td>
                    <td>Name</td>
                    <td>Department</td>
                    <td>Job Title</td>
                    <td>Email</td>
                    <td colspan="2">Action</td>
                </tr>
                </thead>
                <tbody id="t_body_data">

                </tbody>
            </table>
	        <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination">
            
                </ul>
            </nav>
	    </div>
	</div>		
</div>	
<script>
    loadData('<?= base_url('c_user/load_registration_data'); ?>');
    function loadData(url) {
        const t_body_data = document.getElementById('t_body_data');
        const pagination = document.getElementById('pagination');

        let xhttp = new XMLHttpRequest();
        xhttp.open('GET', url);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const data = JSON.parse(this.response);
                const results = data.results;
                const links = data.links;
                results.forEach((result, index) => {
                    const tr = document.createElement('tr');
                    let no = index + 1;
                    const tdNo = document.createElement('td');
                    const tdNoText = document.createTextNode(no);
                    tdNo.appendChild(tdNoText);
                    tr.appendChild(tdNo);

                    Object.keys(result).forEach((key, index) => {
                        let td = document.createElement('td');
                        let tdText = document.createTextNode(result[key]);
                        td.appendChild(tdText);
                        tr.appendChild(td);
                    })

                    const tdActionEmployeeDetails = document.createElement('td');
                    // const empLink = document.createElement('a');
                    const buttonSendEmpDetail = document.createElement('button');
                    const empIcon = document.createElement('i');
                    empIcon.classList.add('glyphicon');
                    empIcon.classList.add('glyphicon-user');
                    // empLink.setAttribute('href', '<?= base_url(`c_user/`)?>');
                    // empLink.classList.add('btn');
                    // empLink.classList.add('btn-primary');
                    // empLink.appendChild(empIcon);
                    buttonSendEmpDetail.classList.add('btn');
                    buttonSendEmpDetail.classList.add('btn-primary');
                    buttonSendEmpDetail.setAttribute('id', 'btnSendEmployeeDetails');
                    buttonSendEmpDetail.appendChild(empIcon);
                    tdActionEmployeeDetails.appendChild(buttonSendEmpDetail);
                    tr.appendChild(tdActionEmployeeDetails);
                    
                    const tdActionPrinterDetails = document.createElement('td');
                    const printerLink = document.createElement('a');
                    const printerIcon = document.createElement('i');
                    printerIcon.classList.add('glyphicon');
                    printerIcon.classList.add('glyphicon-print');
                    printerLink.setAttribute('href', '#');
                    printerLink.classList.add('btn');
                    printerLink.classList.add('btn-warning');
                    printerLink.appendChild(printerIcon);
                    tdActionPrinterDetails.appendChild(printerLink);
                    tr.appendChild(tdActionPrinterDetails);

                    t_body_data.appendChild(tr);
                })

                // links.forEach(link => {
                //     console.log(link);
                //     if (link) {
                //         let li = document.createElement('li');
                //         pagination.appendChild(li);
                //     }
                // })
                 
                let linkOutput = '<li>';
                links.forEach(link => {
                    linkOutput += `<li>${link}</li>`;
                });
                $(pagination).append(linkOutput);
                paginationLink = pagination.querySelectorAll('li a');
                paginationLink.forEach(a => {
                    a.classList.add('pageButton');
                });
            
                const paginationButtons = document.querySelectorAll('.pageButton');
                paginationButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (!e.target.classList.contains('current')){
                            const url = e.target.href;
                            t_body_data.innerHTML = '';
                            pagination.innerHTML = '';
                            loadData(url);
                        }
                    }); 
                })
            }
        }
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send();
    }
</script>