    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"-->
    <!-- Our Custom CSS -->

</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="documentationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Results</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="documentationModalContent" style="padding: 0px">
	<iframe id="documentation-iframe" src="">
	</iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $("#run-example").click(function(){
    var url = $(this).prop("href"); 
    $.ajax({
        type: "GET",
        url: url,
        success: function(res) {
            
            // get the ajax response data
            // update modal content
            // show modal
            $('#documentationModalContent').html(res);
		//res = "<b>hello</b>goodbye";
            $('#documentationModal').modal('show');
            
        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
    return false;
});
</script>

</body>
</html>
