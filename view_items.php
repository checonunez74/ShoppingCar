<html>

<head>
        <title>Incredibly Simple Shopping</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="main.css">

</head>

<body>
    <div class="container">
            <div class="page-header">
                    <h1>Buy More!</h1>
            </div>
        <div>
        <!--on button click, POST back to self (controller) -->
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">    
            <div class="row col-md-8 col-md-offset-1">
                <!-- Make table extracting data from $items array -->
                <?php
                     
                    function build_table($items) {
                        //start table here with a variable that holds the table id
                        $html = '<table id = "myTABLE">';
                            // header row
                            $html .= '<tr>';
                                $ctr=10;
                                foreach ($items[0] as $key => $value) {
                                  
                                   //echo var_dump($key, $value);
                                   if($key!='id')
                                    {
                                        
                                       $html .= '<th id = D'.$ctr.'>' . htmlspecialchars($key) . '</a></th>';

                                    }
                                    else{
                                    $html .= '<th>' . htmlspecialchars("") . '</th>';
                                    }
                                     $ctr++;
                                }
                            $html .= '</tr>';
                            
                            //Extract price value from Items associative array by index.
                            //This for loop is only storing all values in price variable
                            for($i=0; $i < 3; $i++)
                                {  
                                    if( $i == 0){
                                        $price0 = array_values($items[$i])[2];
                                        //var_dump($price0);
                                    }
                                    if( $i == 1){
                                        $price1 = array_values($items[$i])[2];
                                        //var_dump($price1);
                                    }
                                     if( $i == 2){
                                        $price2 = array_values($items[$i])[2];
                                        //var_dump($price2);
                                    }
                                }
                            
                            // Start creating data rows
                                $ctr = 10;
                            foreach ($items as $key => $value) {
                                $html .= '<tr>';
                                
                                foreach ($value as $key => $value) {
                                   //echo (array_values($items[0])[2]);
                                   if($key == 'id'){
                                        if($value == 1000 ){
                                                $html .= '<td rowspan = "1"><input type="checkbox"  name="item_id[]" value ="'.$price0.'">';
                                                //echo '<br>'.$price0;
                                                //var_dump($price0);
                                          }
                                         if($value == 1001 ){
                                                $html .= '<td rowspan = "1"><input type="checkbox" name="item_id[]" value ="'.$price1.'">';
                                                 // echo '<br>'.$price1;
                                                 // var_dump($price1);
                                          }
                                        if($value == 1002 ){
                                                $html .= '<td rowspan = "1"><input type="checkbox" name="item_id[]" value ="'.$price2.'">';
                                                 // echo '<br>'.$price2;
                                                 // var_dump($price2);
                                          }
                                    }

                                    if($key!='img'){
                                        if($key!='id')
                                        {
                                            $html .= '<td>' . htmlspecialchars($value) . '</td>';
                                        }
                                    }
                                    else
                                        $html .= '<td><img src="' . htmlspecialchars($value) . '" class="img-responsive" id = IMG'.$ctr.' width="250" height="50" /></td>'; 
                                } 
                                $ctr++; 
                            }
                            $html .= '</tr>';
                            
                        // finish table and return it
                        $html .= '</table>';
                        return $html;
                    } 
                ?>
            </div>
            
                <!-- Script to SORT by NAME AND PRICE -->
                <script type="text/javascript">
                        $(document).ready(function(){
                              $('th').each(function(col) {
                                  $(this).hover(
                                    function() {
                                      $(this).addClass('focus');
                                    },
                                    function() {
                                      $(this).removeClass('focus');
                                    });
                            
                                  $(this).click(function() {
                                          if ($(this).is('.asc')) {
                                            $(this).removeClass('asc');
                                            $(this).addClass('desc selected');
                                            sortOrder = -1;
                                          } else {
                                            $(this).addClass('asc selected');
                                            $(this).removeClass('desc');
                                            sortOrder = 1;
                                          }
                                  $(this).siblings().removeClass('asc selected');
                                  $(this).siblings().removeClass('desc selected');
                                  var arrData = $('table').find('tbody >tr:has(td)').get();

                                  arrData.sort(function(a, b) {
                                    var val1 = $(a).children('td').eq(col).text().toUpperCase();
                                    var val2 = $(b).children('td').eq(col).text().toUpperCase();
                                    if ($.isNumeric(val1) && $.isNumeric(val2))
                                      return sortOrder == 1 ? val1 - val2 : val2 - val1;
                                    else
                                      return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                                  });
                                  $.each(arrData, function(index, row) {
                                    $('tbody').append(row);
                                  });
                              });
                          });
                        });
                </script>
                
                <!-- Function to increase image size -->
                <script type="text/javascript">
                        $(document).ready(function(){
                            $("#IMG10").on("click", function(){
                                $("#picModal0").modal("show");
                            });
                            $("#IMG11").on("click", function(){
                                $("#picModal1").modal("show");
                            })
                            $("#IMG12").on("click", function(){
                                $("#picModal2").modal("show");
                            })
                        });
                </script>
                 
                <!--  #Calling funtion to make table -->
                <? echo build_table($items); ?>
                
                 <!-- 
                    notice the button has a name attribute, so that you can tell they POSTed even if they didn't
                    select any checkboxes!
                -->
                <button class="btn btn-primary" style="margin:6" name="buy">Buy!</button>
                    <span>
                        <div>
                            <form>
                                <!-- I wanted to add these radio just to try them -->
                                <input  type="radio" name="ship" value="Pick-Up" checked> Pick Up<br>
                                <input type="radio" name="Ship" value="Ship"> Ship to Address  
                            </form>
                        </div>
                    </span>

                <?php
                    //Function to trigger modal when no items were selected.
                    function callmodal(){
                ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#myModal").modal('show');
                            });
                        </script>   
                <?php   
                }
                ?>

                <!-- Modal to alert the user no items were selected-->
                <div class="modal fade" id="myModal" role="dialog" name="modalBox">
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

                <!-- Modals to re-size picture when clicked 
                    Modal with FIRST BIG PICTURE-->
                <div class="modal fade" id="picModal0" role="dialog" name="modalBox">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">YOUR SELECTION:</h4>
                        </div>
                        <div class="modal-body">
                          <?php
                            $bigImage0 = array_values($items[0])[3];
                            
                            echo '<img src="'.htmlspecialchars($bigImage0).'" class="img-responsive" width="500" height="100" />';
                          ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal with SECOND BIG PICTURE -->
                <div class="modal fade" id="picModal1" role="dialog" name="modalBox">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">YOUR SELECTION:</h4>
                        </div>
                        <div class="modal-body">
                          <?php
                                $bigImage1 = array_values($items[1])[3];
                                //var_dump($bigImage1);
                       
                            echo '<img src="'.htmlspecialchars($bigImage1).'" class="img-responsive" width="500" height="100" />';
                          ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal with THIRD BIG PICTURE -->
                <div class="modal fade" id="picModal2" role="dialog" name="modalBox">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">YOUR SELECTION:</h4>
                        </div>
                        <div class="modal-body">
                          <?php
                                $bigImage2 = array_values($items[2])[3];
                                //var_dump($bigImage1);
                       
                            echo '<img src="'.htmlspecialchars($bigImage2).'" class="img-responsive" width="500" height="100" />';
                          ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                   
         </form>
    </div>
 </div>
   
</body>

</html>
