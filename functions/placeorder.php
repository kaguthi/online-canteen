<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['userid'])){
    if(isset($_POST['checkout'])){
        $user_id = $_SESSION['userid'];
        $phone = mysqli_real_escape_string($connect,  $_POST["telephone"]);
        $payment_method = mysqli_real_escape_string($connect,  $_POST["payment-mode"]);
        $total_price = mysqli_real_escape_string($connect,  $_POST["total_price"]);

        if($phone == ""){
            echo "
                <script>
                    alert('telephone cannot be null');
                    window.location.href = '../checkout.php';
                </script>
            ";
        }
        $fetch_data = "SELECT c.prod_id as cprod, c.qty, f.food_id as fid, f.food_image, f.food_name, f.food_price FROM cart c, food f WHERE c.prod_id =f.food_id AND c.user_id = '$user_id'";
        $fetch_data_run = mysqli_query($connect, $fetch_data);
        
        $order_no = rand(100, 99999);
        $query = "INSERT INTO orders (order_id, order_number, payment_mode, total_price, user_id) VALUES (NULL, '$order_no', '$payment_method', '$total_price', '$user_id')";
        $query_run = mysqli_query($connect, $query);
        if($query_run){
            $order_num = mysqli_insert_id($connect);
            foreach($fetch_data_run as $product){
                $prod_id = $product['cprod'];
                $prod_qty = $product['qty'];
                $price = $product['food_price'];
                $insert_query = "INSERT INTO order_info (id, order_id, prod_id, qty, price, userid) VALUES (NULL, '$order_num','$prod_id', '$prod_qty', '$price', '$user_id')";
                $insert_query_run = mysqli_query($connect, $insert_query);
            }
            $deletequery = "DELETE FROM cart WHERE user_id = '$user_id'";
            $deletequery_run = mysqli_query($connect, $deletequery);
            // STKPUSH
            date_default_timezone_set('Africa/Nairobi');

            # access token
            $consumerKey = 'JIgZzOejdQ36QX3E7tfxJL1eYYGxjaLr'; //Fill with your app Consumer Key
            $consumerSecret = 'FGWWVJvcgkDZAu9Y'; // Fill with your app Secret

            # define the variales
            # provide the following details, this part is found on your test credentials on the developer account
            $Amount = 1;
            $BusinessShortCode = '174379'; //sandbox
            $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

            /*
                This are your info, for
                $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
                $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
                TransactionDesc can be anything, probably a better description of or the transaction
                $Amount this is the total invoiced amount, Any amount here will be 
                actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
                for developer/test accounts, this money will be reversed automatically by midnight.
            */

            $PartyA =$phone; // This is your phone number, 
            $AccountReference = 'Ngugi Solution';
            $TransactionDesc = 'test';

            # Get the timestamp, format YYYYmmddhms -> 20181004151020
            $Timestamp = date('YmdHis');    

            # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
            $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

            # header for access token
            $headers = ['Content-Type:application/json; charset=utf8'];

                # M-PESA endpoint urls
            $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

            # callback url
            $CallBackURL = 'https://64d4-41-89-236-2.in.ngrok.io/api/callback_url.php';  

            $curl = curl_init($access_token_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
            curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
            $result = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($result);
            $access_token = $result->access_token;  
            curl_close($curl);

            # header for stk push
            $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

            # initiating the transaction
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $initiate_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

            $curl_post_data = array(
                //Fill in the request parameters with valid values
                'BusinessShortCode' => $BusinessShortCode,
                'Password' => $Password,
                'Timestamp' => $Timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $Amount,
                'PartyA' => $PartyA,
                'PartyB' => $BusinessShortCode,
                'PhoneNumber' => $PartyA,
                'CallBackURL' => $CallBackURL,
                'AccountReference' => $AccountReference,
                'TransactionDesc' => $TransactionDesc
            );

            $data_string = json_encode($curl_post_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            $curl_response = curl_exec($curl);

            // echo $curl_response;
            echo "
                <script>
                    alert('Waiting for payment to be verified');
                    window.location.href = '../order.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Not successfully');
                    window.location.href = '../checkout.php';
                </script>
            ";
        }
    }
}else{
    header("Location: ../index.php");
}
?>