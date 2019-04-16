<?php
#1 include the data file to fake database data
require_once("data.php");


    // do stuff!
    $price = 0;
    $id = 0;
    $ctr = 0;


        #2 Check for a Post to the page (if an item was selected)
        #If statement with isset function to calculate prices and items
        if (isset($_POST['item_id']))
        {
            $selected = $_POST['item_id'];
           // var_dump($selected); //This is displayed in next page view_confirm.php

            #Check the checkboxes with isset to see the key
            #All items will comeback as an array item_id.
            if(isset($selected))
            {   
                //echo '<br>inside if#2 statement<br>';
                $NumItems = count($selected);
                echo '<h2>Shopping cart has ' .$NumItems. ' items<br>';


                for($i=0; $i < $NumItems; $i++)
                {
                    //I made the two echos for visualization purposesd but they
                    //are not needed any more, although they can come handy.
                    //echo '<br>You selected: '.array_values($selected)[$i];
                    $price += array_values($selected)[$i];
                   // echo '<h3>Your Total =$ '.$price.'<br>';
                }
                              
                #3 inlcude the view if the user check any of the boxes
                require_once('view_confirm.php');
                die();
            }
            else
            {
                echo "something is wrong with data!";

            }

        }
        #This if will trigger the modal alert when no items are selected
        if(isset($_POST['buy']))
          {
            require_once("view_items.php");
            //Function call for modal Alert!
            echo callmodal(); 

          }


        
    
 #3 include the view items page
 require_once("view_items.php");


?>
