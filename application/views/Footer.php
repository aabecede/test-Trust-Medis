	

	<script>
		//pasien
		$("#frm-tambah-pasien").hide();
		$("#frm-tambah-rawat-jalan").hide();

		var table;

		$(document).ready(function() {

			if($('#frm-no-rm').val() == null){
				$("#btn-rawat-jalan").attr('disabled', 'disabled');
			}
		
			$(".btn-tambah-pasien").click(function() {
				$('#frm-tambah-pasien').toggle('slow');
			});

			$(".btn-tambah-rawat-jalan").click(function() {
				$('#frm-tambah-rawat-jalan').toggle('slow');
			});

			$("#btn-cari-norm").click(function() {
				var data = $('#search-norm').val();
				$.ajax({
					url: '<?php echo site_url('Pasien/get_pasien_by_no');?>',
					type: 'POST',
					data: {norm : data},
					success:function(data){
						$("#show-pasien").html(data);
						$("#btn-rawat-jalan").removeAttr('disabled');
					}
				})
				.fail(function() {
					alert('No RM TIDAK TERSEDIA');
					$("#btn-rawat-jalan").attr('disabled','disabled');
				});
				
			});


			 //datatables
	        table = $('#table').DataTable({ 

	            "processing": true, 
	            "serverSide": true, 
	            "order": [], 
	            
	            "ajax": {
	                "url": "<?php echo site_url('Pasien/get_data_pasien')?>",
	                "type": "POST"
	            },

	            
	            "columnDefs": [
	            { 
	                "targets": [ 0 ], 
	                "orderable": false, 
	            },
	            ],

	        });


	         table = $('#table-rawat').DataTable({ 

	            "processing": true, 
	            "serverSide": true, 
	            "order": [], 
	            
	            "ajax": {
	                "url": "<?php echo site_url('Rawatjalan/get_data_rawat')?>",
	                "type": "POST"
	            },

	            
	            "columnDefs": [
	            { 
	                "targets": [ 0 ], 
	                "orderable": false, 
	            },
	            ],

	        });


	        $("#modal").on('show.bs.modal', function(e){
            var rowid = $(e.relatedTarget).data('id');
            //get data
            $.ajax({
                type : "POST",
                url : "<?php echo site_url('Pasien/get_pasien_by');?>",
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);
                }
            })
        });

		});

	</script>	
</body>

</html>
