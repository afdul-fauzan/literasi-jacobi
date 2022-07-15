<!DOCTYPE html>
<html>
<head>
	<title>Iterasi Jacobi | Metode Numerik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css">
		body {
			margin: 0;
			background-color: #f3f3f3;
		}
        h4, label, h5, tr, td {
            color: white;
            font-weight: bold;
        }
        .btn-submit{
            color: #4A4C44;
            background: #FCBC41;            
            font-size: 18px;
            font-weight: bold;
        }
        .btn-submit:hover, .btn-submit:active{            
            background: #ffb54c;
            color: white;
        }
        .inputNumber input {
        	width: 100px !important;
        }			
        .inputNumber{
        	display: flex;
        	margin-right: 14px;
        }
        .row{
        	margin:0;        	
        }
        .persamaan{
        	margin-bottom: calc(1rem + 14px);
        }
        .form-group {
        	margin-bottom: 0;
        }        
        .inputNumber {
        	align-items: center;
        }
	</style>
</head>
<body>
	<?php 
		if(!empty($form_error)){
			echo "<script>alert('".$form_error."')</script>";
		}
	?>	
        <div class="container" style="margin-top: 80px;margin-bottom:80px;border: 1px solid #9C9C9C;background-color: #184BC3;border-radius: 20px;">     
        <div style="padding: 20px;">
        	<div class="row">
        		<div class="col col-md-7">
        			<form id="formInput" method="POST" action="#" onsubmit="return submitData();">
        		<?php
        		for($i=1;$i<=3;$i++){ ?>
        			<div class="persamaan">
        		<div>
        		<h4>Persamaan <?=$i?></h4>
        	</div>
        	<div class="row">
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="a[]" required>			    
			  </div>
			  <div>
			  	<h5 style="color: white;">x</h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="b[]" required>			    
			  </div>
			  <div>
			  	<h5 style="color: white;">y</h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="c[]" required>			    
			  </div>
			  <div>
			  	<h5 style="color: white;">z</h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">        			
			  <div>
			  	<h5 style="color: white;"> = </h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="o[]" required>			    
			  </div>			  
        		</div>        					  
        	</div>
        	</div>
        		<?php }
        		?>  
        		<div class="persamaan">        		
        	<div class="row">
        		<div class="inputNumber" style="margin-top: 10px;margin-bottom: 5px;">
        			<div style="margin-right: 5px;">
			  	<h5 style="color: white;">Diulang :</h5>
			  </div>			  
        			<div class="form-group" style="margin-right: 15px;">			    
			    <input type="number" class="form-control" id="ulangan" name="ulangan">			    
			  </div>
			  <div class="form-group">			    
			    <h5 style="color: white;">Kali</h5>
			  </div>			  
        		</div>
        	</div>
        	</div>      		 
        	<div>
        		<div class="form-group">
      <input type="submit" class="btn btn-md btn-submit" value="Hitung">
	  <a href="index.php" class="btn btn-md btn-secondary"><b>Kembali</b></a>
  </div>
        	</div>
        	</form>	
        		</div>
        		<div id="div_hasil" class="col col-md-5" style="border-left: 2px solid white;display: none;">
        			<div style="margin-bottom: 28px;">
        		<h4>Hasil</h4>
        	</div>
        	<div id="hasil" style="margin-bottom: 14px;"></div>
        	<div style="margin-bottom: 20px;">
        		<h5>Setelah dilakukan pengulangan sebanyak <span id="total_ulangan"></span> kali menggunakan metode JACOBI, maka didapatkan hasil sebagai berikut :</h5>
        	</div>
        	<div id="list_iterasi" class="table-responsive" style="margin-bottom: 14px;"></div>
        	<div>
        		<h5>x : <span id="hasil_x"></span></h5>
        		<h5>y : <span id="hasil_y"></span></h5>
        		<h5>z : <span id="hasil_z"></span></h5>
        	</div>
        		</div>
        	</div>
        </div>                       	
	</div>	
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var formUp = document.getElementById('formInput');	
	function submitData(){  			
  	$.ajax({                
                type: 'POST',
                url: "hitung.php",
                data: new FormData(formUp),
                contentType: false,
                cache: false,
                processData:false,
                dataType:'json',                
 
                success: function(json){        
                	$('#total_ulangan').text($('#ulangan').val());        	
                    $('#formInput').trigger("reset");
                    $('#div_hasil').show();
                    $('#hasil').html(json.data);     
                    $('#list_iterasi').html(json.list_iterasi);
                    $('#hasil_x').text(json.x);        	               
                    $('#hasil_y').text(json.y);        	               
                    $('#hasil_z').text(json.z);        	               
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                }
            });                

            return false;
  }
</script>
</html>