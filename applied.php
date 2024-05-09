<?php
    session_start();
    include "coonexion.php";
    include "index.php";
    $jobid = $_GET["id"];
    $stmt="SELECT w.nom, w.prenom, w.email, w.phone, a.cv_name, a.cv_data, a.resume_name, a.resume_data
    FROM jobsproject j
    JOIN apply a ON j.jobid = a.jobid
    JOIN webuser w ON a.id = w.id
    WHERE j.jobid = ?";
    $stmt=$cnx->prepare($stmt);
    $stmt->execute([$jobid]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        foreach ($result as $res) {
            echo "<div class='job'>";
            echo "<p>" . "Candidate:" . "$res[nom]" . " " . "$res[prenom]" . "<br>" . "</p>";
            echo "<p>" . "Phone: " . "$res[phone]" . "<br>" . "</p>";
            echo "<p>" . "Email: " . "$res[email]" . "<br>" . "</p>";
            echo "<p>" . "$res[cv_name]" . "<br>" . "</p>";
            echo '<object data="data:application/pdf;base64,' . base64_encode($res["cv_data"]) . '" type="application/pdf" style="height:200px;width:60%"></object><br>'; 
            echo "<p>" . "$res[resume_name]" . "<br>". "</p>";
            echo '<object data="data:application/pdf;base64,' . base64_encode($res["resume_data"]) . '" type="application/pdf" style="height:200px;width:60%"></object><br>'; 
            echo "</div>";
            echo" <hr>";
    }
}else{  
    echo "No job applications yet";
}