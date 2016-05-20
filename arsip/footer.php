<?php
require_once "php/cek_sesi.php";
?>
&nbsp
<div class="footer">&nbsp &copy 2015 Supported By <b>@mastoppink</b> for <b>DJP</b></div>
</div>
<div id="modal">
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            <h4 class="modal-title" id="myModalLabel"></h4>
          
          </div>
          <div class="modal-body" id="myModalBody">
            ...
          </div>
          <div class="modal-footer" id="myModalFooter">
            
          </div>
        </div>
      </div>
    </div>
 </div>
 <script type="text/javascript">
 function tampilkanModal(label,body,footer){
 	$('#myModalLabel').html(label);
	$('#myModalBody').html(body);
	$('#myModalFooter').html(footer);
	$('#myModal').modal();
 }
 </script>
</body>
</html>