
<?php
    require('auth.php');
    require('getid.php');
    require('orderidgen.php');
//        require('checkempty.php');
    if(isset($_POST['submit']))
    {
//        $arr=array('brand','model','material','color','fileupload');
//        chek($arr);
        $brandm = $_POST['brand']." model: ".$_POST['model'];  
        $details = "color : ".$_POST['color']." material : ".$_POST['material']." brand : ".$brandm;
        $order_id = generateon('Case',$db);
        $odate = date('Y-m-d H:i:s') ;
        $total= $_COOKIE["case_total"]; 

    if( isset($_FILES['fileupload']))
    {
    $target_dir = "orders/".$id."/";
    if(!is_dir($target_dir))
    {mkdir($target_dir);}
$target_file = $target_dir.basename($_FILES["fileupload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
     $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
  if($check !== false) 
  {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } 
  else 
  {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  if (file_exists($target_file)) 
  {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
  }
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) 
{
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) 
{
  echo " File not uploaded . Possible reasons could be that the file is not an image ";
  exit(1);
} 
else 
{
  if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) 
  {
    echo "<script>alert('The file ". htmlspecialchars( basename( $_FILES["fileupload"]["name"])). " has been uploaded.')</script>";
    $filename=htmlspecialchars( basename( $_FILES["fileupload"]["name"]));
  } 
  else 
  {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
else
{
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Image not provided </strong> The background color will be applied on the case .
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
$filename="<p> <font color=".$_POST['color'].">color</font> </p> ";
}
}
$queryo="   INSERT into orders values('$order_id',$id , '$ad', $total ,-1,'$details', 'Case' , '$odate');";
// print($queryo)
  $resulto=mysqli_query($db,$queryo);
    if(!$resulto)
    {
      print(" Error occured ! Order not placed");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PrintAnywhere</title>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/pay.css">
    </head>
    <body onload="username()">
        <section id="top">
            <b>PRINT ANYWHERE <sup>®</sup></b>
        </section>
       <div class="cupdetail">
            <center>
                <form id="slip">
                <h1><b>placement of the order</b></h1>
                <table>
                     <tr>
                        <td>cutomer name :</td>
                        <td id="username"></td>
                    </tr>
                    <tr>
                        <td>order object :</td>
                        <td id="object"></td>
                    </tr>
                    <tr>
                        <td>phone company :</td>
                        <td id="comp"></td>
                    </tr>
                    <tr>
                        <td>model :</td>
                        <td id="model"></td>
                    </tr>
                    <tr>
                        
                        <td>type of case :</td>
                        <td id="cover"></td>
                    </tr>
                    <tr>
                        <td>background color :</td>
                        <td id="bg" style="text-transform: none"></td>
                    </tr>
                     <tr>
                        <td>total amount :</td>
                        <td id="total"></td>
                    </tr>
                    <tr>
                        <td>order number :</td>
                        <td id="orderno"><?php echo"$order_id" ?></td> <!-- order number let it be combination username and something -->
                    </tr>
                     <tr>
                        <td>image file :</td>
                        <td id="image"><?php echo"$filename" ?></td>
                    </tr>
                </table> </form>
                <input type="button" value="Print this page" onClick="window.print()" style="color: aliceblue; background-color: darkslategrey; box-shadow: 2px 2px 2px deepskyblue; width: 200px; height: 40px;">    
            </center>
        </div>
                  <footer id="makers" class="makers" style="position: fixed">
                <p style="align-items: left; text-align: center;"> By: <img src="img/Instagram-Logo.wine.png" width="20px" height="20px"><a href="https://www.instagram.com/steve_350/" style="color: white; text-decoration: none;">STEVE ASTON</a> and <img src="img/Instagram-Logo.wine.png" width="20px" height="20px"><a href="https://www.instagram.com/captured._.right/" style="color: white; text-decoration: none;">SURAJ K NAIK</a></p>
        </footer>
        <script type="text/javascript" src="java/cpay.js"></script>
    </body>
</html>