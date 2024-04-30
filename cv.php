<?php
session_start();
    include "coonexion.php";

// Retrieve user details from the database based on the user's session information
$user_id = $_SESSION['user_id'];
$stmt = $cnx->prepare("SELECT * FROM webuser WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [200,350]]);
$mpdf->AddPage("P");

// Include CSS stylesheet
$stylesheet = file_get_contents('stylecv.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

if (isset($_POST["submit"])) {
    $html = '<div class="container">';
    $html .= '<div class="hero">';
    $html .= '<h1 class="name"><strong>' .$user["nom"] . '</strong>' . $user["prenom"] . '</h1>' .  '<span class="job-title">'.$_POST["job"] . '</span>';
    $html .= '<span class="email">'.$user["email"] . '</span>';
    $html .= '<h2 class="lead">'.$_POST["jobd"] . '</h2>';
    $html .= '</div>';
    $html .= '</div>';
    $html .='<div class="container">';
    $html .='<div class="sections">';
    $html .='<h2 class="section-title">Skills</h2>';

    $html .='<div class="list-card">';
    $html .='<span class="exp">+ 5 years</span>';
    $html .='<div>';
    $html .='<h3>'.$_POST["nexp1"] . '</h3>';
    $html .='<span>'.$_POST["exp1"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='<div class="list-card">';
    $html .='<span class="exp">+ 3 years</span>';
    $html .='<div>';
    $html .='<h3>'.$_POST["nexp2"] . '</h3>';
    $html .='<span>'.$_POST["exp2"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='<div class="list-card">';
    $html .='<span class="exp">+ 6 years</span>';
    $html .='<div>';
    $html .='<h3>'.$_POST["nexp3"] . '</h3>';
    $html .='<span>'.$_POST["exp3"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='</div>'; // Closing "sections" div

    $html .='<div class="sections">';
    $html .='<h2 class="section-title">Interests</h2>';

    $html .='<div class="list-card">';
    $html .='<div>';
    $html .='<h3>'.$_POST["nint1"] . '</h3>';
    $html .='<span>'.$_POST["int1"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='<div class="list-card">';
    $html .='<div>';
    $html .='<h3>'.$_POST["nint2"] . '</h3>';
    $html .='<span>'.$_POST["int2"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='</div>'; 

    $html .='</div>'; 



    $html .='<div class="container cards">';

    $html .='<div class="card">';
    $html .='<div class="skill-level">';
    $html .='<span>+</span>';
    $html .='<h2>'.$_POST["nbpro1"] . '</h2>';
    $html .='</div>';

    $html .='<div class="skill-meta">';
    $html .='<h3>Projects</h3>';
    $html .='<span>'.$_POST["dpro1"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='<div class="card">';
    $html .='<div class="skill-level">';
    $html .='<h2>'.$_POST["nbsk1"] . '</h2>';
    $html .='<span>%</span>';
    $html .='</div>';

    $html .='<div class="skill-meta">';
    $html .='<h3>'.$_POST["nsk1"] . '</h3>';
    $html .='<span>'.$_POST["dbsk1"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='<div class="card">';
    $html .='<div class="skill-level">';
    $html .='<h2>'.$_POST["nbsk2"] . '</h2>';
    $html .='<span>%</span>';
    $html .='</div>';

    $html .='<div class="skill-meta">';
    $html .='<h3>'.$_POST["nsk2"] . '</h3>';
    $html .='<span>'.$_POST["dbsk2"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='<div class="card">';
    $html .='<div class="skill-level">';
    $html .='<h2>'.$_POST["nbsk3"] . '</h2>';
    $html .='<span>%</span>';
    $html .='</div>';

    $html .='<div class="skill-meta">';
    $html .='<h3>'.$_POST["nsk3"] . '</h3>';
    $html .='<span>'.$_POST["dbsk3"] . '</span>';
    $html .='</div>';
    $html .='</div>';

    $html .='</div>'; 



    $html .='<div class="container">';
    $html .='<ol class="timeline">';

    $html .='<li>';
    $html .='<p class="line">Experiences</p>';
    $html .='<span class="point"></span>';
    $html .='<p class="description">';
    $html .= $_POST["etraexp1"] ;
    $html .='</p>';
    $html .='<span class="date">Today - Apr. 2016</span>';
    $html .='</li>';

    $html .='<li>';
    $html .='<span class="point"></span>';
    $html .='<p class="description">';
    $html .= $_POST["extraexp2"] ;
    $html .='</p>';
    $html .='<span class="date">Apr. 2016 - Sep. 2015</span>';
    $html .='</li>';

    $html .='<li>';
    $html .='<p class="line">Education</p>';
    $html .='<span class="point"></span>';
    $html .='<p class="description">';
    $html .= $_POST["educ1"];
    $html .='</p>';
    $html .='<span class="date">2015 - 2013</span>';
    $html .='</li>';

    $html .='<li>';
    $html .='<span class="point"></span>';
    $html .='<p class="description">';
    $html .=$_POST["educ2"];
    $html .='</p>';
    $html .='<span class="date">2013 - 2008</span>';
    $html .='</li>';

    $html .='</ol>';
    $html .='</div>';

    $html .='<br><br>';
}


// Write HTML content to PDF
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$user_name = $user['nom'];

// Generate the filename with the user's ID and name
$file_name = "CV-" . $user_id . "-" . $user_name . ".pdf";

// Output the PDF with the customized filename for download
$mpdf->Output($file_name, \Mpdf\Output\Destination::DOWNLOAD);


?>




</body>
</html>