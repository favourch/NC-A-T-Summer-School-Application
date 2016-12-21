

<?php

//created by Dominique Mattis, Jajuan Monroe and Mark Bentley

//libraries for php mailer class
include_once('class.phpmailer.php');
require_once('class.smtp.php');


//if the submit button was not clicked and the user somehow landed on this page show error
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. 
	echo "Uh oh! This page should not be accessed directly";
}



//declare captcha vars
$email;$captcha;
        //if the captcha was attempted
       if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        //if the captcha was not attempted 
        if(!$captcha){
          echo '<h2>Oops! Please verify that you are not a robot. Click the browser back button and try again</h2>';
          exit;
        }
        //verify the keys match
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeF-QkTAAAAAKvnk0xmh5r0k9tqORaG0ZuSSgMG=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        //if keys do not match alert that is spam
        if($response.success==false)
        {
          echo '<h2>The system has detected that you could be a robot. If you are not we are sorry. Click the browser back button and try again</h2>';
        }
        //if the keys match
        else
        {
    

//if the submit button was clicked then proceed
if(isset($_POST['submit'])){

//get all data entered on the form by POST method
$name = $_POST["nameFirst"]." ".$_POST["nameMiddle"]." ".$_POST["nameLast"];
$otherName = $_POST["otherName"];
$todaysDate = $_POST["todaysDate_1"]. "/" .$_POST["todaysDate_2"]. "/" .$_POST["todaysDate_3"];
$ssn = $_POST["ssn"];
$address = $_POST["streetAddress"]." ".$_POST["addressLine2"]."</br>".$_POST["city"].", ".$_POST["state"]." ".$_POST["zipCode"]."</br>".$_POST["country"];
$dayPhone = $_POST["phone1"]."-".$_POST["phone2"]."-".$_POST["phone3"];
$eveningPhone = $_POST["otherPhone1"]."-".$_POST["otherPhone2"]."-".$_POST["otherPhone3"];
$email = $_POST["email"];
$emergencyName = $_POST["ecNameFirst"]." ".$_POST["ecNameMiddle"]." ".$_POST["ecNameLast"];
$emergencyNameOther = $_POST["ecOtherName"];
$ecaddress = $_POST["ecStreetAddress"]." ".$_POST["ecAddressLine2"]."</br>".$_POST["ecCity"].", ".$_POST["ecState"]." ".$_POST["ecPostal"]."</br>".$_POST["ecCountry"];
$ecPhone = $_POST["ecphone1"]."-".$_POST["ecphone2"]."-".$_POST["ecphone3"];
$dob = $_POST["birthDate_1"]. "/" .$_POST["birthDate_2"]. "/" .$_POST["birthDate_3"];
$placeOfBirth = $_POST["pobCity"].", ".$_POST["pobState"]."</br>".$_POST["pobZipCode"]."</br>".$_POST["pobCountry"];
$countryOfCitizenship = $_POST["countryOfCitizenship"];
$visaStatus = $_POST["otherCitizenship"];
$whenAdmission = $_POST["whenAdmission"];
$whenAdmitted = $_POST["whenAdmitted"];
$whenEnrolled = $_POST["whenEnrolled"];
$whenEnrolledOther = $_POST["whenEnrolledOther"];
$hsName = $_POST["hsName"];
$hsCityState = $_POST["hsCityState"];
$hsDate = $_POST["hsDate"];
$ugCollegeName = $_POST["ugCollegeName"];
$ugCollegeCityState = $_POST["ugCollegeCityState"];
$ugCollegeDate = $_POST["ugCollegeDate"];
$gradCollegeName = $_POST["gradCollegeName"];
$gradCollegeCityState = $_POST["gradCollegeCityState"];
$gradCollegeDate = $_POST["gradCollegeDate"];
$residence  = $_POST["residence"];
$riCounty  = $_POST["riCounty"];
$riState  = $_POST["riState"];
$riState2  = $_POST["riState2"];
$startResidentMonth  = $_POST["startResidentMonth"];
$startResidentYear  = $_POST["startResidentYear"];
$finishResidentMonth  = $_POST["finishResidentMonth"];
$finishResidentYear  = $_POST["finishResidentYear"];
$fathersOccupation = $_POST["fathersOccupation"];
$fatherEmployer = $_POST["fatherEmployer"];
$mothersOccupation = $_POST["mothersOccupation"];
$motherEmployer = $_POST["motherEmployer"];
$crime1  = $_POST["crime1"];
$crime2  = $_POST["crime2"];
$crime3  = $_POST["crime3"];
$crime4  = $_POST["crime4"];
$suspend  = $_POST["suspend"];
$military = $_POST["military"];
$explain = $_POST["explain"];
$sign = $_POST["sign2"];
$lastFourSSN = $_POST["lastFourSSN2"];



//get all data selected from check boxes and radio buttons
$sessionChecked = implode(', ', $_POST['session']);
$admission = implode(', ', $_POST['admit']);
$userSex = implode(', ', $_POST['sex']);
$ethnicGroup = implode(', ', $_POST['ethnic']);
$citizenStatus = implode(', ', $_POST['citizen']);
$applied = implode(', ', $_POST['applied']);
$admitted = implode(', ', $_POST['admitted']);
$enrolled = implode(', ', $_POST['enrolled']);
$currentIns = implode(', ', $_POST['currentIns']);
$educationCompleted = implode(', ', $_POST['education']);
$reference = implode(', ', $_POST['reference']);
    
    
//build a table for the body of the email- This table is sent to admissions
$emailBody  ='<html><body>';
$emailBody .='<h2>New Student Application from '.$name.'</h2><br>';    
$emailBody .= '<table style="border-collapse: collapse" border="2"><thead>';
$emailBody .= '<tr><th></th><th>Applicant Information</th></tr>';
$emailBody .='<tr><td>Date</td><td>'.$todaysDate.'</td></tr>';
$emailBody .='<tr><td>Session(s)</td><td>'.$sessionChecked.'</td></tr>';
$emailBody .='<tr><td>Admission Status</td><td>'.$admission.'</td></tr>';
$emailBody .='<tr><td>Name</td><td>'.$name.'</td></tr>';
$emailBody .='<tr><td>Other Name</td><td>'.$otherName.'</td></tr>';
$emailBody .='<tr><td>Social Security Number</td><td>'.$ssn.'</td></tr>';
$emailBody .='<tr><td>Current Mailing Address</td><td>'.$address.'</td></tr>';
$emailBody .='<tr><td>Daytime Phone</td><td>'.$dayPhone.'</td></tr>';
$emailBody .='<tr><td>Evening Phone</td><td>'.$eveningPhone.'</td></tr>';
$emailBody .='<tr><td>Email</td><td>'.$email.'</td></tr>';
$emailBody .='<tr><td>Date of Birth</td><td>'.$dob.'</td></tr>';
$emailBody .='<tr><td>Place of Birth</td><td>'.$placeOfBirth.'</td></tr>';
$emailBody .='<tr><td>Sex</td><td>'.$userSex.'</td></tr>';
$emailBody .='<tr><td>Ethic Group</td><td>'.$ethnicGroup.'</td></tr>';
$emailBody .='<tr><td>Emergency Contact Name</td><td>'.$emergencyName.'</td></tr>';
$emailBody .='<tr><td>Emergency Contact Other Name</td><td>'.$emergencyNameOther.'</td></tr>';
$emailBody .='<tr><td>Emergency Contact Address</td><td>'.$ecaddress.'</td></tr>';
$emailBody .='<tr><td>Emergency Contact Phone</td><td>'.$ecPhone.'</td></tr>';
$emailBody .='<tr><td>Citizenship</td><td>'.$citizenStatus.'</td></tr>';
$emailBody .='<tr><td>Country of Citizenship</td><td>'.$countryOfCitizenship.'</td></tr>';
$emailBody .='<tr><td>If citizenship other than US, indicate VISA Status</td><td>'.$visaStatus.'</td></tr>';
$emailBody .='<tr><td>Have you ever applied for admission to NC A&T?</td><td>'.$applied.'</td></tr>';
$emailBody .='<tr><td>When Applied</td><td>'.$whenAdmission.'</td></tr>';
$emailBody .='<tr><td>Have you ever been admitted to NC A&T?</td><td>'.$admitted.'</td></tr>';
$emailBody .='<tr><td>When Admitted</td><td>'.$whenAdmitted.'</td></tr>';
$emailBody .='<tr><td>Have you ever been enrolled in classes at A&T?</td><td>'.$enrolled.'</td></tr>';
$emailBody .='<tr><td>When Enrolled</td><td>'.$whenEnrolled.'</td></tr>';
$emailBody .='<tr><td>Are you currently enrolled in an academic institution?</td><td>'.$currentIns.'</td></tr>';
$emailBody .='<tr><td>Where Enrolled</td><td>'.$whenEnrolledOther.'</td></tr>';
$emailBody .='<tr><td>High School Name</td><td>'.$hsName.'</td></tr>';
$emailBody .='<tr><td>High School City/State</td><td>'.$hsCityState.'</td></tr>';
$emailBody .='<tr><td>High School Dates Attended</td><td>'.$hsDate.'</td></tr>';
$emailBody .='<tr><td>Undergraduate College Name</td><td>'.$ugCollegeName.'</td></tr>';
$emailBody .='<tr><td>Undergraduate College City/State</td><td>'.$ugCollegeCityState.'</td></tr>';
$emailBody .='<tr><td>Undergraduate College Dates Attended</td><td>'.$ugCollegeDate.'</td></tr>';
$emailBody .='<tr><td>Graduate College Name</td><td>'.$gradCollegeName.'</td></tr>';
$emailBody .='<tr><td>Graduate College City/State</td><td>'.$gradCollegeCityState.'</td></tr>';
$emailBody .='<tr><td>Graduate College Dates Attended</td><td>'.$gradCollegeDate.'</td></tr>';
$emailBody .='<tr><td>Highest Education Completed</td><td>'.$educationCompleted.'</td></tr>';
$emailBody .='<tr><td>Do you claim to be a legal </br>
        resident of North Carolina </br>
        for (at least) the past 12 months</br> 
        for tutition purposes?</td><td>'.$residence.'</td></tr>';
$emailBody .='<tr><td>Residence Statement</td><td>I certify that I am a  bona fide resident of '.$riCounty.' County in '.$riState.' and have been a '.$riState2.' resident from '.$startResidentMonth.'/'.$startResidentYear.' until '.$finishResidentMonth.'/'.$finishResidentYear.'</td></tr>';
$emailBody .="<tr><td>Father's Occupation and Employer</td><td>".$fathersOccupation.", ".$fatherEmployer."</td></tr>";
$emailBody .="<tr><td>Mother's Occupation and Employer</td><td>".$mothersOccupation.", ".$motherEmployer."</td></tr>";
$emailBody .='<tr><td>Have you ever been convicted of a crime?</td><td>'.$crime1.'</td></tr>';
$emailBody .='<tr><td>Have you ever entered a plea of guilty,</br> 
            a plea of no contest, a plea of nolo</br>                 
            contendere, or an Alford plea, or have </br>
            you recieved a deffered prosecution or</br> 
            prayer for judgement continued, to a </br>
            criminal charge?  </td><td>'.$crime2.'</td></tr>';
$emailBody .='<tr><td>Have you otherwise accepted responsibility</br>
            for a commission of a crime?</td><td>'.$crime3.'</td></tr>';
$emailBody .='<tr><td>Do you have any criminal charges pending </br> 
            against you? </td><td>'.$crime4.'</td></tr>';
$emailBody .='<tr><td>Have you ever been expelled, dismissed,</br> 
            or suspended, placed on probation, or </br>
            otherwise subject to any disciplinary </br>
            sanction by any school, college, or</br>
            university?  </td><td>'.$suspend.'</td></tr>';
$emailBody .='<tr><td>If you have ever served in the military, </br>
            did you recieve any type of discharge </br>
            other than an honorable discharge?</td><td>'.$military.'</td></tr>';
$emailBody .='<tr><td>If you answered "yes" to any of the </br>
            six questions above, please explain </br>
            the circumstances below.</td><td>'.$explain.'</td></tr>';
$emailBody .='<tr><td>Applicant Signature (Parent/Guardian signature if under 18)</td><td>'.$sign.'</td></tr>';
$emailBody .='<tr><td>Last Four of SSN</td><td>'.$lastFourSSN.'</td></tr>';
//$emailBody .="<tr><td>Today's Date</td><td>".$todaysDate2."</td></tr>"; **change**
$emailBody .="<tr><td>How did you hear about us?</td><td>".$reference."</td></tr>";
$emailBody .='</table>';
    


//prepare email to send to admissions office
$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
//$mail->SMTPDebug  = 2;   // enables SMTP debug information (for testing)
// 1 = errors and messages 2 = messages only
$mail->SMTPAuth   = true;                // enable SMTP authentication
$mail->SMTPSecure = "tls";   //security type
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "ossoncat@gmail.com";  // GMAIL username
$mail->Password   = "@Aggie1890";            // GMAIL password

$mail->SetFrom('info@ncat.edu', 'No-Reply');
$mail->IsHTML(true);
$mail->Subject = "New Admission Application";    
$mail->MsgHTML($emailBody);
$mail->AddAddress("ossoncat@gmail.com");    

//if an attachment has been uploaded then process it   
if (isset($_FILES['visaFile'])) {
    $mail->AddAttachment($_FILES['visaFile']['tmp_name'],
                         $_FILES['visaFile']['name']);
}    
    

    //if the application failed to submit(email did not send)
if(!$mail->Send()) {
    echo file_get_contents("ConfirmError.html");
} else { 

    //if the application was submitted successfully do some magic
echo file_get_contents("ConfirmSuccess.html"); 
}
    
    
//Email body to be sent to APPLICANT. SSN "Hidden for your protection" message is sent to applicant
//custom message is sent with next steps
$emailBody2  = '<html><body>';
$emailBody2 .= '<h2>Thank you for applying for admission to North Carolina A&T State University.<br>Your application was submitted.</h2><br>';
$emailBody2 .= '<p><strong>Please keep a copy of this email for your records</strong></p><br>';
$emailBody2 .= '<h3>Next Steps</h3>';
$emailBody2 .= '<strong>Step 1:</strong> <a href="https://secure.touchnet.com/C20147_tsa/web/login.jsp" target="_blank">Make a payment</a><br>';
$emailBody2 .= '<strong>Step 2: </strong> Download the <a href="http://www.ncat.edu/academics/outreach/summer-session/forms/Course%20Request%20Form%2011-13.pdf" target="_blank">Course Request Form </a>and take to your home institution if necessary<br>';
$emailBody2 .= '<strong>Step 3:</strong> Download the <a href="http://www.ncat.edu/academics/outreach/summer-session/forms/transient_visiting_form.pdf" target="_blank">"Approval for Admission </a>As a Transient (Visiting) Student Form" if necessary<br>';
$emailBody2 .='&nbsp;';
$emailBody2 .='&nbsp;';      
$emailBody2 .= '<table style="border-collapse: collapse" border="2"><thead>';
$emailBody2 .= '<tr><th></th><th>Your Information</th></tr>';
$emailBody2 .='<tr><td>Date</td><td>'.$todaysDate.'</td></tr>';
$emailBody2 .='<tr><td>Session(s)</td><td>'.$sessionChecked.'</td></tr>';
$emailBody2 .='<tr><td>Admission Status</td><td>'.$admission.'</td></tr>';
$emailBody2 .='<tr><td>Name</td><td>'.$name.'</td></tr>';
$emailBody2 .='<tr><td>Other Name</td><td>'.$otherName.'</td></tr>';
$emailBody2 .='<tr><td>Social Security Number</td><td>Hidden for your protection</td></tr>';
$emailBody2 .='<tr><td>Current Mailing Address</td><td>'.$address.'</td></tr>';
$emailBody2 .='<tr><td>Daytime Phone</td><td>'.$dayPhone.'</td></tr>';
$emailBody2 .='<tr><td>Evening Phone</td><td>'.$eveningPhone.'</td></tr>';
$emailBody2 .='<tr><td>Email</td><td>'.$email.'</td></tr>';
$emailBody2 .='<tr><td>Date of Birth</td><td>'.$dob.'</td></tr>';
$emailBody2 .='<tr><td>Place of Birth</td><td>'.$placeOfBirth.'</td></tr>';
$emailBody2 .='<tr><td>Sex</td><td>'.$userSex.'</td></tr>';
$emailBody2 .='<tr><td>Ethic Group</td><td>'.$ethnicGroup.'</td></tr>';
$emailBody2 .='<tr><td>Emergency Contact Name</td><td>'.$emergencyName.'</td></tr>';
$emailBody2 .='<tr><td>Emergency Contact Other Name</td><td>'.$emergencyNameOther.'</td></tr>';
$emailBody2 .='<tr><td>Emergency Contact Address</td><td>'.$ecaddress.'</td></tr>';
$emailBody2 .='<tr><td>Emergency Contact Phone</td><td>'.$ecPhone.'</td></tr>';
$emailBody2 .='<tr><td>Citizenship</td><td>'.$citizenStatus.'</td></tr>';
$emailBody2 .='<tr><td>Country of Citizenship</td><td>'.$countryOfCitizenship.'</td></tr>';
$emailBody2 .='<tr><td>If citizenship other than US, indicate VISA Status</td><td>'.$visaStatus.'</td></tr>';
$emailBody2 .='<tr><td>Have you ever applied for admission to NC A&T?</td><td>'.$applied.'</td></tr>';
$emailBody2 .='<tr><td>When Applied</td><td>'.$whenAdmission.'</td></tr>';
$emailBody2 .='<tr><td>Have you ever been admitted to NC A&T?</td><td>'.$admitted.'</td></tr>';
$emailBody2 .='<tr><td>When Admitted</td><td>'.$whenAdmitted.'</td></tr>';
$emailBody2 .='<tr><td>Have you ever been enrolled in classes at A&T?</td><td>'.$enrolled.'</td></tr>';
$emailBody2 .='<tr><td>When Enrolled</td><td>'.$whenEnrolled.'</td></tr>';
$emailBody2 .='<tr><td>Are you currently enrolled in an academic institution?</td><td>'.$currentIns.'</td></tr>';
$emailBody2 .='<tr><td>Where Enrolled</td><td>'.$whenEnrolledOther.'</td></tr>';
$emailBody2 .='<tr><td>High School Name</td><td>'.$hsName.'</td></tr>';
$emailBody2 .='<tr><td>High School City/State</td><td>'.$hsCityState.'</td></tr>';
$emailBody2 .='<tr><td>High School Dates Attended</td><td>'.$hsDate.'</td></tr>';
$emailBody2 .='<tr><td>Undergraduate College Name</td><td>'.$ugCollegeName.'</td></tr>';
$emailBody2 .='<tr><td>Undergraduate College City/State</td><td>'.$ugCollegeCityState.'</td></tr>';
$emailBody2 .='<tr><td>Undergraduate College Dates Attended</td><td>'.$ugCollegeDate.'</td></tr>';
$emailBody2 .='<tr><td>Graduate College Name</td><td>'.$gradCollegeName.'</td></tr>';
$emailBody2 .='<tr><td>Graduate College City/State</td><td>'.$gradCollegeCityState.'</td></tr>';
$emailBody2 .='<tr><td>Graduate College Dates Attended</td><td>'.$gradCollegeDate.'</td></tr>';
$emailBody2 .='<tr><td>Highest Education Completed</td><td>'.$educationCompleted.'</td></tr>';
$emailBody2 .='<tr><td>Do you claim to be a legal </br>
        resident of North Carolina </br>
        for (at least) the past 12 months</br> 
        for tutition purposes?</td><td>'.$residence.'</td></tr>';
$emailBody2 .='<tr><td>Residence Statement</td><td>I certify that I am a  bona fide resident of '.$riCounty.' County in '.$riState.' and have been a '.$riState2.' resident from '.$startResidentMonth.'/'.$startResidentYear.' until '.$finishResidentMonth.'/'.$finishResidentYear.'</td></tr>';
$emailBody2 .="<tr><td>Father's Occupation and Employer</td><td>".$fathersOccupation.", ".$fatherEmployer."</td></tr>";
$emailBody2 .="<tr><td>Mother's Occupation and Employer</td><td>".$mothersOccupation.", ".$motherEmployer."</td></tr>";
$emailBody2 .='<tr><td>Have you ever been convicted of a crime?</td><td>'.$crime1.'</td></tr>';
$emailBody2 .='<tr><td>Have you ever entered a plea of guilty,</br> 
            a plea of no contest, a plea of nolo</br>                 
            contendere, or an Alford plea, or have </br>
            you recieved a deffered prosecution or</br> 
            prayer for judgement continued, to a </br>
            criminal charge?  </td><td>'.$crime2.'</td></tr>';
$emailBody2 .='<tr><td>Have you otherwise accepted responsibility</br>
            for a commission of a crime?</td><td>'.$crime3.'</td></tr>';
$emailBody2 .='<tr><td>Do you have any criminal charges pending </br> 
            against you? </td><td>'.$crime4.'</td></tr>';
$emailBody2 .='<tr><td>Have you ever been expelled, dismissed,</br> 
            or suspended, placed on probation, or </br>
            otherwise subject to any disciplinary </br>
            sanction by any school, college, or</br>
            university?  </td><td>'.$suspend.'</td></tr>';
$emailBody2 .='<tr><td>If you have ever served in the military, </br>
            did you recieve any type of discharge </br>
            other than an honorable discharge?</td><td>'.$military.'</td></tr>';
$emailBody2 .='<tr><td>If you answered "yes" to any of the </br>
            six questions above, please explain </br>
            the circumstances below.</td><td>'.$explain.'</td></tr>';
$emailBody2 .='<tr><td>Applicant Signature (Parent/Guardian signature if under 18)</td><td>'.$sign.'</td></tr>';
$emailBody2 .='<tr><td>Last Four of SSN</td><td>'.$lastFourSSN.'</td></tr>';
$emailBody2 .="<tr><td>How did you hear about us?</td><td>".$reference."</td></tr>";
$emailBody2 .='</table>';    

    
    
//Prepare email to be sent to applicant as confirmation uses standard php mail method
$email_from2 = 'osso@ncat.edu';
$email_subject2 = "Application Confirmation"; //subject of email
$email_body2 = $emailBody2;
    
$to2 = "$email";
$headers2 = "From: $email_from2 \r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

//Send the email to applicant
mail($to2,$email_subject2,$email_body2,$headers2);  
   
}
}
  
?> 