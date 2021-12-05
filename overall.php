<style>
table,tr,td
{
    border: 1px solid black;
    
}

.centre{
 margin-left: auto;
margin-right:auto; 
margin-bottom : 100 px;1

}

</style>



<?php 
$server = "localhost";

$username = "root";

$password = "";

$database ="Wildlife";

$insert = false;
 $con = mysqli_connect($server, $username, $password,$database);
     

 
    if (isset($_GET['fund'])) {
      
        $name = $_GET['name'];
        $state = $_GET['state'];
        $amount=$_GET['donation'];
        $mail=$_GET['Mail'];
        $contact=$_GET['Contact_no'];
    
        $sql = "INSERT INTO `Wildlife`.`funds` (`Name`, `State`, `Amount`, `Contact_no`, `Mail`) VALUES('$name','$state', '$amount','$contact','$mail');";
    
            if($con->query($sql) == true){
            echo "Successfully inserted";
           $insert = true;}
         
    }
    elseif (isset($_GET['submit1'])) {
       $animal_name = $_GET['search1'];
      $sql ="select distinct wildlife_info.wildlife_sanctuary ,national_park_info.`national park name`, state.S_name, species_info1.species_Name , status.status
      from wildlife_info inner join  state on wildlife_info.state_code= state.S_code 
      inner join national_park_info on  national_park_info.`state id` =state.S_code
      inner join  species_info1 on  wildlife_info.species_code=species_info1.species_code 
      inner join status on wildlife_info.species_code=status.ID
      where species_Name = '".$animal_name."' ; ";
       $result =$con->query($sql);
       
       if($result->num_rows > 0){
        echo "<table class='centre'>";
        echo"<tr>";
        echo"<th>National Park Name</th>";
        echo"<th>Wildlife Sanctuary Name</th>";
        echo"<th>State Name</th>";
        echo"<th>Species Name</th>";
        echo"<th>Status</th>";
     echo"</tr>";
     
           while($row = $result-> fetch_assoc()){
               echo "<tr><td>" . $row["national park name"] . "</td><td>" . $row["wildlife_sanctuary"].  "</td><td>"  . $row["S_name"] . "</td><td>". $row["species_Name"]."</td><td>". $row["status"]."</td></tr> <br>" ;
          
           }

       }
      
    }
     

    elseif (isset($_GET['submit2'])) {
        $wildlife_name = $_GET['search2'];
        $sql ="SELECT distinct species_Name ,S_name as STATE, FOOD , status.status
        from wildlife_info inner join  state on wildlife_info.state_code= state.S_code 
        inner join  species_info1 on  wildlife_info.species_code=species_info1.species_code 
        inner join status on wildlife_info.species_code=status.ID
        where wildlife_info.wildlife_sanctuary= '".$wildlife_name."' 
        ORDER BY state.S_Name ASC;";
         $result =$con->query($sql);
        //  echo"$wildlife_name";
         if($result->num_rows > 0){
          echo "<table class='centre'>";
          echo"<tr>";
          echo"<th>Species Name</th>";
          echo"<th>State Name</th>";
          echo"<th>Food</th>";
          echo"<th>Status</th>";
       echo"</tr>";
       
             while($row = $result-> fetch_assoc()){
                 echo "<tr><td>" . $row["species_Name"] . "</td><td>" . $row["STATE"].  "</td><td>"  .$row["FOOD"] ."</td><td>"  .  $row["status"] ."</td></tr> <br>" ;
            
             }
  
         }
    }
    elseif (isset($_GET['submit3'])) {
        $national_name = $_GET['search3'];
        $sql ="SELECT distinct species_Name ,S_name as STATE , FOOD , status.status
        from national_park_info inner join  state on national_park_info.`state id`= state.S_code 
        inner join  species_info1 on  national_park_info.`sp_code`=species_info1.species_code
        inner join status on national_park_info.sp_code=status.ID 
        where national_park_info.`national park name`= '".$national_name."'  ; ";
         $result =$con->query($sql);
         
         if($result->num_rows > 0){
          echo "<table class='centre'>";
          echo"<tr>";
          echo"<th>Species Name</th>";
          echo"<th>State</th>";
          echo"<th>Food</th>";
          echo"<th>Status</th>";
       echo"</tr>";
       
             while($row = $result-> fetch_assoc()){
                echo "<tr><td>" . $row["species_Name"] . "</td><td>" . $row["STATE"].  "</td><td>"  .$row["FOOD"] ."</td><td>"  .  $row["status"] ."</td></tr> <br>" ;
            
             } 
    }
}
elseif(isset($_GET['login'])){
    $sql ="Select * from Funds";
   $result =$con->query($sql);
   
   if($result->num_rows > 0){
    echo "<table class='centre'>";
    echo"<tr>";
    echo"<th>Name</th>";
    echo"<th>State</th>";
    echo"<th>Donation</th>";
    echo"<th>E-Mail</th>";
    echo"<th>Contact</th>";
 echo"</tr>";

 $paisa=0;
 
       while($row = $result-> fetch_assoc()){
           echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["State"].  "</td><td>"  . $row["Amount"] . "</td><td>". $row["Mail"]."</td><td>". $row["Contact_no"]."</td></tr> <br>" ;
           $paisa+=$row['Amount'];
       } 

       echo"TOTOAL FUNDING COLLECTED = ";
       echo $paisa;
}

}
    else{
        echo "No";
        $con->close();
     }



     ?> 
   <!-- </table>' -->

