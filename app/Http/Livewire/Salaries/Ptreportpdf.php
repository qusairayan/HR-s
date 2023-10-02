<?php

namespace App\Http\Livewire\Salaries;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\PartTime;
use App\Models\User;
use Mpdf\Mpdf;

class Ptreportpdf extends Component
{
    public function generatePDF($id, $from, $to)
    {

        $user=User::where('id','=',$id)->first();
        $employee=$user->name;
        $company=$user->company->name;

        $partTimeQuery = PartTime::where('user_id', '=', $id);

        if ($from) {
            $partTimeQuery = $partTimeQuery->where('from', '>=', $from);
        }
        if ($to) {
            $partTimeQuery = $partTimeQuery->where('to', '<=', $to);
        }


        $partTime = $partTimeQuery->get();

        $mpdf = new Mpdf();

        $mpdf->WriteHTML(view('livewire.salaries.partTimeReport', ['partTime' => $partTime,'employee' => $employee,'company' => $company,'from'=>$from,'to'=>$to]));

        $mpdf->Output('document.pdf', 'I');
    }

    public function render()
    {
        return view('livewire.salaries.partTimeReport');
    }
}







// <?php
//   include("../classes/checkIfLoggedIn.php");
//   $isAdmin = new LoggedIn();
//   if ($isAdmin->checkUser() != 200) {
//   header("Location: https://lyon-jo.com/");
//   } else {
//   include("../../connection.php");
//   require_once __DIR__ . '/../../vendor/autoload.php';

//   $mpdf = new \Mpdf\Mpdf([
//     'orientation' => 'P',
//         'format' => 'A3-L',
//     'margin_footer' => 20
//   ]);

//   $con = mysqli_connect($host, $user, $password, $db);
//   mysqli_set_charset($con, "utf8");
//   if (isset( $_POST['company']) && isset($_POST['dateFrom']) && isset($_POST['dateTo'])){

//   $todayDate = date("Y-m-d");
//   $total = 0;
//   $companyName = $_POST['company'];
//   $dateFrom = '';
//   $dateTo = '';
//   $sqlDate='';




//   $company = mysqli_fetch_assoc(mysqli_query($con, "SELECT company_name FROM banks WHERE bank_name = '$companyName'"))['company_name'];


  
//   if (isset($_POST['dateFrom']) && isset( $_POST['dateTo'] ) && $_POST['dateFrom'] != '' && $_POST['dateTo'] != '' ) {

//   $dateFrom = $_POST['dateFrom'];
//   $dateTo = $_POST['dateTo'];
  
//   $sqlDate= "AND (date BETWEEN '". $dateFrom ."'  AND '". $dateTo ."')" ;
  
// }





//     $getPaymentDetailsQuery = mysqli_query($con, "SELECT * FROM payments WHERE (payment_for = 'Contracts' OR payment_for = 'Customers') AND  bank_name = '$companyName'  AND bank_transfer=1 ".$sqlDate."  ORDER BY `payments`.`date` ASC");

//   $paymentsArray = mysqli_fetch_all($getPaymentDetailsQuery, MYSQLI_ASSOC);
//   for ($i = 0; $i < count($paymentsArray); $i++) {
//     $total = $total + $paymentsArray[$i]['payment_value'];
//     $paymentsArray[$i]['user'] = $paymentsArray[$i]['user_name'];
//     if ($paymentsArray[$i]['payment_for'] == "Customers") {
//       $customerName = $paymentsArray[$i]['customer_name'];
//       $customerId = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM customers WHERE customer_name = '$customerName'"))['id'];
//       $paymentsArray[$i]['service'] = "Customer";
//       $paymentsArray[$i]['contract_id'] =  $customerId;
//     } elseif($paymentsArray[$i]['payment_for']=="Contracts") {
//       $contractId = $paymentsArray[$i]['contract_id'];
//       $getService = mysqli_query($con, "SELECT * FROM contracts WHERE contract_id = '$contractId'");
//       if (mysqli_num_rows($getService) > 0) {
//         $paymentsArray[$i]['service'] = "Contract "."(".$contractId." )";
//       } else {
//         $paymentsArray[$i]['service'] = "Trip";
//       }
//     }elseif($paymentsArray[$i]['payment_for']=="Sold Car"){
//       $paymentsArray[$i]['service'] = "Sold Car "."(".$paymentsArray[$i]['vehicle']." )";

//     }else {
//       $paymentsArray[$i]['service']="Lawsuit";
//     }
//     }


//         $sql = '';

//             if ($company == "marvel") {
//                 $sql = "SELECT  *, companies.company_services as companyService FROM `check_marvell` LEFT JOIN `companies` ON (companies.company_name = check_marvell.Name_To ) WHERE Bank_Name = '$companyName' AND transfare_to_bank = 1 ".$sqlDate."   ";
//             } 
//             elseif ($company == "rental") {
//                 $sql = "SELECT  *, companies.company_services as companyService FROM `check_lyon_rental` LEFT JOIN `companies` ON (companies.company_name = check_lyon_rental.Name_To ) WHERE Bank_Name = '$companyName' AND transfare_to_bank = 1 ".$sqlDate."   ";

//             } 
//             else {
//                 $sql = "SELECT *, companies.company_services as companyService FROM `check_lyon` LEFT JOIN `companies` ON (companies.company_name = check_lyon.Name_To ) WHERE Bank_Name = '$companyName' AND transfare_to_bank = 1 ".$sqlDate."   ";

//             }



//             $AllCheck = mysqli_query($con, $sql);

//             $AllCheckArray = mysqli_fetch_all($AllCheck, MYSQLI_ASSOC);

     

//             $debit=0;
//             $credit=0;
//             $balance=0;
//             $prebalance=0;

//             $TotalDebit=0;
//             $TotalCredit=0;



//             $allTransactions=array();
//             $allTransactions=array_merge($AllCheckArray,$paymentsArray);
            



//             function compareDates($a, $b) {
//               $dateA = isset($a['date']) ? strtotime($a['date']) : strtotime($a['Date']);
//               $dateB = isset($b['date']) ? strtotime($b['date']) : strtotime($b['Date']);
          
//               if ($dateA == $dateB) {
//                   return 0;
//               }
          
//               return ($dateA < $dateB) ? -1 : 1;
//           }
          
//           usort($allTransactions, 'compareDates');


          

//     if ($company == "rental") {
//       $logo = "https://lyon-jo.com/lyon logo rental.png";
//       $companyName1 = "Lyon for rental car";
//     } elseif ($company == "marvel") {
//       $logo = "https://lyon-jo.com/marvellLogo.png";
//       $companyName1 = "Marvell for rental car";
//     } else {
//       $logo = "https://lyon-jo.com/lyontravellogo.jpg";
//       $companyName1 = "Lyon travel and tourism";
//     }




//   $html = '<html>
//   <head>
//   <style>
//   body{
//   font-family: Arial, Helvetica, sans-serif;
  
//   }
//   @page {
//   margin: 10px 10px 10px 10px !important;
//   padding: 10px1 0px 10px 10px !important;
//   }
//   table {
//   font-family: Arial, Helvetica, sans-serif;
//   border-collapse: separate;
//   width: 100%;
//   }

//   table th {
//   border: 1px solid #000;
//   padding: 2px
//   }

//   table th {
//   text-align: center;
//   background-color: #F7F9F9;
//   color: black;
//   }
//   table td {
//   text-align: center;
//   padding-bottom: 5px;
//   padding: 8px;
//   border-collapse: collapse;
//   }
//   .column {
//   float: left;
//   width: 50%;
//   padding: 10px;
//   }

//   .row:after {
//   content: "";
//   display: table;
//   clear: both;
//   }
//   </style>
//   <body>
//   <div style="padding:5mm; margin: bottom 25px;">
//   <div class="row">
//   <div class="column" style="width:20%">
//   <img src="' . $logo . '" height="70" width="160" />
//   </div>
//   <div class="column"  style="width:70%">
//   <p style="font-size:18px;text-align:right"><b>' . $companyName . '</b></p>
//   </div>
//   </div>';


  
//   $html .= '
//   <div style="color: white;background-color: #03415F;" class="row">
//   <div class="column" style="padding:4px;width: 100%">
//   <p style="text-align: center; font-size:18px;color: #fff;margin:0;padding:5;"><b>Bank Report</b></p>
//   </div>
//   </div>';

//   if (isset($_POST['dateFrom']) && isset( $_POST['dateTo'] ) && $_POST['dateFrom'] != '' && $_POST['dateTo'] != '' ) {

// $html.='
//   <div style="margin-top:8px" class="row">
//   <div class="column" style="padding:0; width:15%">
//   <p style="font-size:12px;color: #03415F;margin:0;padding:4;font-weight:bold">Date From :</p>
//   <p style="font-size:12px;color: #03415F;margin:0;padding:4;font-weight:bold">Date To :</p>
//   </div>
//   <div class="column" style="padding:0;margin-left:3px">
//   <p style="font-size:12px;color: #03415F;margin:0;padding:4;font-weight:bold">' . $dateFrom . '</p>
//   <p style="font-size:12px;color: #03415F;margin:0;padding:4;font-weight:bold">' . $dateTo . '</p>
//   </div>
//   </div>';

    
//   }
// $html.='
//   <br>
//   <table id="account">
//   <tr>
//   <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 10%">Payment / Check ID</th>
//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">Date</th>
//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">Customer Name</th>
//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Payment Type</th>
    
    
//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 9%">Debit</th>
//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 9%">Credit</th>
//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 9%">Balance</th>

//     <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Details</th>
//   </tr>
//   </table>';
 

//   $rowsArray=array();


  
//   $date='';
//   $customer_name='';
//   $payment_type='';
//   $payment_value='';
//   $service='';

//   $counter=0;
//   for ($i = 0; $i < count($allTransactions); $i++) {





//     if (isset($_POST['dateFrom']) && isset( $_POST['dateTo'] ) && $_POST['dateFrom'] != '' && $_POST['dateTo'] != '' ) {


//     $dateCompFrom=  new DateTime($dateFrom);
//     $dateCompTo=  new DateTime($dateTo);
      
//     }
    

//     if(isset($allTransactions[$i]['Payment_Method'])){

      

//       $date=  $allTransactions[$i]['Date'];
//       $dateComp=  new DateTime($date);



//       $id = $allTransactions[$i]['Check_Number'];
//       $customer_name=$allTransactions[$i]['Name_To'];
//       $payment_type=$allTransactions[$i]['Payment_Method'];
//       $payment_value=$allTransactions[$i]['Value'];

//       $service = $allTransactions[$i]['companyService'];






//       if (isset($_POST['dateFrom']) && isset( $_POST['dateTo'] ) && $_POST['dateFrom'] != '' && $_POST['dateTo'] != '' ) {



//         if ($dateComp >= $dateCompFrom && $dateComp <= $dateCompTo) {
         
       
//             $debit = $payment_value;
//             $credit=0;
//             $balance -=$payment_value;


//             $TotalDebit+=$debit;
           

//             $rowsArray[$counter]['id']=$id;
//             $rowsArray[$counter]['date']=$date;
//             $rowsArray[$counter]['customer_name']=$customer_name;
//             $rowsArray[$counter]['payment_type']=$payment_type;
//             $rowsArray[$counter]['payment_value']=$payment_value;
//             $rowsArray[$counter]['service']=$service;
//             $rowsArray[$counter]['credit']=$credit;
//             $rowsArray[$counter]['debit']=$debit;
//             $rowsArray[$counter]['balance']=$balance;
//             $counter+=1;

//           }

//           else if ($dateComp <= $dateCompFrom){
//             $prebalance -=$payment_value;
            
            
//           }
        



//     }
//     else{
      
//       $debit = $payment_value;
//       $credit=0;
//       $balance -=$payment_value;


//       $TotalDebit+=$debit;
     

//       $rowsArray[$counter]['id']=$id;
//       $rowsArray[$counter]['date']=$date;
//       $rowsArray[$counter]['customer_name']=$customer_name;
//       $rowsArray[$counter]['payment_type']=$payment_type;
//       $rowsArray[$counter]['payment_value']=$payment_value;
//       $rowsArray[$counter]['service']=$service;
//       $rowsArray[$counter]['credit']=$credit;
//       $rowsArray[$counter]['debit']=$debit;
//       $rowsArray[$counter]['balance']=$balance;
//       $counter+=1;

//     }

//   }
//     else{
      



//       $date=  $allTransactions[$i]['date'];
//       $dateComp=  new DateTime($date);

//       $customer_name=$allTransactions[$i]['customer_name'];
//       $payment_type=$allTransactions[$i]['payment_type'];
//       $payment_value=$allTransactions[$i]['payment_value'];
//       $service = $allTransactions[$i]['service'];


         
//   if (isset($_POST['dateFrom']) && isset( $_POST['dateTo'] ) && $_POST['dateFrom'] != '' && $_POST['dateTo'] != '' ) {
    


      

//       if ($dateComp >= $dateCompFrom && $dateComp <= $dateCompTo) {
         
       
//         $credit = $payment_value;
//         $debit=0;
//         $balance +=$payment_value;


//         $TotalCredit+=$credit;
       


//         $rowsArray[$counter]['id']=$allTransactions[$i]['id'];
//         $rowsArray[$counter]['date']=$date;
//         $rowsArray[$counter]['customer_name']=$customer_name;
//         $rowsArray[$counter]['payment_type']=$payment_type;
//         $rowsArray[$counter]['payment_value']=$payment_value;
//         $rowsArray[$counter]['service']=$service;
//         $rowsArray[$counter]['credit']=$credit;
//         $rowsArray[$counter]['debit']=$debit;
//         $rowsArray[$counter]['balance']=$balance;
//         $counter +=1;

//       }

//       else if ($dateComp <= $dateCompFrom){
//         $prebalance +=$payment_value;
//       }

//     }
  
//   else{
    

     
//     $credit = $payment_value;
//     $debit=0;
//     $balance +=$payment_value;


//     $TotalCredit+=$credit;
   


//     $rowsArray[$counter]['id']=$allTransactions[$i]['id'];
//     $rowsArray[$counter]['date']=$date;
//     $rowsArray[$counter]['customer_name']=$customer_name;
//     $rowsArray[$counter]['payment_type']=$payment_type;
//     $rowsArray[$counter]['payment_value']=$payment_value;
//     $rowsArray[$counter]['service']=$service;
//     $rowsArray[$counter]['credit']=$credit;
//     $rowsArray[$counter]['debit']=$debit;
//     $rowsArray[$counter]['balance']=$balance;
//     $counter +=1;

//   }

//     }



    
//   }
//   if (isset($_POST['dateFrom']) && isset( $_POST['dateTo'] ) && $_POST['dateFrom'] != '' && $_POST['dateTo'] != '' ) {


//   $html .= '
//   <br>
//   <table style="width: 100%; ">
//   <tr style="padding:10px; background:#f1f1f1;">
//   <td  style="width:76.0%; font-size: 16px; text-align: start; padding: 3px;"></td>
//   <td style="width:10%; font-size: 14px; padding: 3px; "> '.$prebalance.'</td>
//   <td style="width:10%; font-size: 14px; padding: 3px; "> Pre Balance</td>
//  </tr>  </table><br>
//  <table>
//  ';

//     }

// else{
  
//   $html .= '
//   <br>
//   <table style="width: 100%; ">';
// }    


//   for ($i = 0; $i < count($rowsArray); $i++) {
//     $rowsArray[$i]['balance'] +=$prebalance;
//     $html .= '

//    </tr>
//       <tr style="color: black; font-weight: normal;">
//       <td style="text-align: center;padding-top: 8px; width: 9%">' . $rowsArray[$i]['id']  . '</td>
//       <td style="text-align: center;padding-top: 8px; width: 16%">' . $rowsArray[$i]['date']. '</td>
//       <td style="text-align: center;padding-top: 8px; width: 22%">' . $rowsArray[$i]['customer_name']. '</td>
//       <td style="text-align: center;padding-top: 8px; width: 17%; font-size:' . 'px;"> ' . $rowsArray[$i]['payment_type']. '</td>


//       <td style="text-align: center;padding-top: 8px; width: 10%"> ' . $rowsArray[$i]['credit'] . ' </td>
//       <td style="text-align: center;padding-top: 8px; width: 10%"> ' . $rowsArray[$i]['debit'].  ' </td>
//       <td style="text-align: center;padding-top: 8px; width: 10%"> ' . $rowsArray[$i]['balance'].  ' </td>
//       <td style="text-align: center;padding-top: 8px; width: 14%">' . $rowsArray[$i]['service'] . '</td>
//       </tr>';
      
// }


//     $html .= '<tr><td colsapn=8></td></tr> <tr style="padding:10px;">
 
//     <td  style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;font-weight:bold;" colspan=4 >Total:</td>
//     <td style="text-align: left; padding-left:35px; background-color:#03415F;color: #fff; font-size: 12px;font-weight:bold;"> ' . $TotalCredit . ' JOD</td>
//     <td style="text-align: left; padding-left:35px; background-color:#03415F;color: #fff; font-size: 12px;font-weight:bold; "> ' . $TotalDebit . ' JOD</td>
//     <td style="text-align: left; padding-left:35px; background-color:#03415F;color: #fff; font-size: 12px;font-weight:bold; "> ' . ($TotalCredit-  $TotalDebit )+ $prebalance . ' JOD</td>
//     <td style=" background-color:#03415F;color: #fff;"></td>
//     </tr>
  
//     </table>';
  

//   $html .= '
//   <br>
//   <br>
//   <div class="row" style="margin-left:80px; width:100.0%;">
//   <div class="column" style="width:33.0%; float:left;">توقيع المحاسب</div>
//   <div class="column" style="width:27.0%; float:left;"></div>
//   <div class="column" style="width:33.0%; float:left;">توقيع الاداري </div>
//   </div>

//   </body>
//   </html>';
  
//   mysqli_close($con);

//     $mpdf->WriteHTML($html);
//     $mpdf->Output();

    
//   }
  


// else {
//   header("Location: https://lyon-jo.com/");
// }
//   }