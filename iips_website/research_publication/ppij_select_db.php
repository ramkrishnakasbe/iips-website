 
<!-- <div class="padding">
  <div class="full col-sm-11" id="tab1">
 -->  <script type="text/javascript">
function iips(){
 $("#temp").html("iips davv");}
 </script>
      <center><h1>Your Inserted Data</h1></center>
      <table class ="table table-striped" id="table_div"  style="border-color:#337ab7;" align="center" border="1px" >
      <tr>
        <th>Session Year</th>
        <th>Serial No.</th>
        <th>Title</th>
        <th>Journal</th>
        <th>ISSN</th>
        <th>Peer Reviews</th>
        <th>Co-authors</th>
        <th>Main author</th>
        <th>Delete</th>
        <th>Update</th>
      </tr> 

     <?php
     mysql_connect('localhost','root','');
     mysql_select_db('pbas_db');

      $username= $_REQUEST['user'];
      $query= "SELECT * FROM teach_ppij WHERE User_Id = '$username' and data_set='valid' ";

      $run= mysql_query($query);
      if (!$run) { // add this check.
        die('Invalid query: ' . mysql_error());
      }

      while($row=mysql_fetch_array($run)) {
        
        $session= $row['session'];
        $user_id= $row['User_Id'];
        $ppij_id= $row['PPIJ_ID'];
        $TNO= $row['Teach_PPIJ_TNO'];
        $Journal= $row['Teach_PPIJ_Journal'];
        $ISBN= $row['Teach_PPIJ_ISBN'];
        $PR= $row['Teach_PPIJ_PR'];
        $NCA= $row['Teach_PPIJ_NCA'];
        $MA= $row['Teach_PPIJ_MA'];
      
    ?>

    <font size="5" color="red">
       <?php echo @$_GET['deleted']; ?> 
    </font>

    <tr align="center">
    <td><?php echo $session; ?></td>
    <td><?php echo $user_id; ?></td>
    <td><?php echo $TNO; ?></td>
    <td><?php echo $Journal; ?></td>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $PR; ?></td>
    <td><?php echo $NCA; ?></td>
    <td><?php echo $MA; ?></td>
    <!-- <td><a href='research_publication\delete.php?del_ppij_id=<?php //echo $ppij_id; ?> '>Delete</a></td>  -->

    <td><a href='research_publication/delete.php?de=<?php echo $ppij_id; ?>'>Delete</a></td>
    <td><button name="infoEdit" onClick="iips();">Update</a></button></td>
    
    </tr>
    <?php 
    }  //while end
    ?>
  </table>
<!-- 
  </div>
 </div> -->
 <script>
    $(document).ready(function() {
      $('#genInfo').validate();
    }); // end ready()
  </script>
  <!-- Knockout Script for  -->
  <script>
    var viewModel = {
      year: ko.observable(),
      reportEnabled : ko.observable(false),
      yearEnabled : ko.observable(true),
      isClicked : function(){
        self = this;
        self.yearEnabled(false);
        self.reportEnabled(true);
      },
      changeYear : function(){
        self = this;
        self.yearEnabled(true);
        self.reportEnabled(false);
      }
      
    }
    ko.applyBindings(viewModel);
  </script>

  <script><!--Ajax script for showing information on the basis of combobox value -->
    function showInfo(name)
    {
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
        {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {  
              document.getElementById("userInfo").innerHTML=xmlhttp.responseText; 
          }
        }
      xmlhttp.open("GET","updateInfoShow.php?name="+name,true);
      xmlhttp.send();
    }
  </script>
