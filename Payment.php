<?php
session_start();
if(isset($_POST['submit']))
{
    $owner = $_POST['owner'];
    $card_no = $_POST['card_no'];
    $MM = $_POST['MM'];
    $YY = $_POST['YY'];
    $cvv = $_POST['cvv'];
    $rent = $_POST['rent'];
    $month = $_POST['month'];
    $agreement = $_POST['agreement'];


    // Database connection
    $conn = new mysqli('localhost','root','','hostel');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into payment(owner, card_no, MM, YY, cvv, rent,month, agreement) values(?, ?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("siiiisss", $owner, $card_no, $MM, $YY, $cvv, $rent, $month ,$agreement);
        $execval = $stmt->execute();
        echo $execval;
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="pstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="background-image:url('img/bg-2.jpg');background-size: cover;">
    <form action=" " method="post" >
    <div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Payment Form</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit/Debit Card </a> </li>
                            
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" onsubmit="event.preventDefault()">
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="owner" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="card_no" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="MM" class="form-control" required> <input type="number" placeholder="YY" name="YY" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" name="cvv" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div>
                                  
<div class="col-sm-8">
<div class="input-group">    
<select name="rent" id="duration" class="form-control">
<option value="">Select Rent Amount</option>
<option value="4000(1 BHK)">4000(1 BHK)</option>
<option value="5000(1.5 BHK)">5000(1.5 BHK)</option>
<option value="7000(2 BHK)">7000(2 BHK)</option>
<option value="8000(2.5 BHK)">8000(2.5 BHK)</option>
<option value="10000(3 BHK)">10000(3 BHK)</option>
</select>
<select name="month" id="duration" class="form-control">
<option value="">Select Month</option>
<option value="Jan">Jan</option>
<option value="Feb">Feb</option>
<option value="March">March</option>
<option value="April">April</option>
<option value="May">May</option>
<option value="Jun">Jun</option>
<option value="Jul">Jul</option>
<option value="Aug">Aug</option>
<option value="Sep">Sep</option>
<option value="Oct">Oct</option>
<option value="nov">nov</option>
<option value="Dec">Dec</option>


</select>

</div>

<br>
  
                                </div>
                                <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    AGREEMENT
  </label><br>
  <form action="upload.php" method="post" enctype="multipart/form-data">
  
  <input type="file" name="agreement" id="fileToUpload"required>
  

</div>
                                <div class="card-footer"> <button type="submit" onclick="myFunction()" name="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                                    <script>
function myFunction() {
  alert("Payment Successful");
}
</script>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>          
                
</body>
</html>