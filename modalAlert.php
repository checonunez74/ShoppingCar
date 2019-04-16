<!DOCTYPE html>
<html>
<body>

<h1> In new file</h1>

        <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Watch it!</h4>
                        </div>
                        <div class="modal-body">
                          <p>You didn't select anything to buy!!!.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

<script>
    $(document).ready(function() {
              console.log('funcition working!!');
              $("#myModal").modal('show');
      
     });
</script>


</body>

</html>
   