<?php
    session_start();
    include "coonexion.php";
    include "index.php";
    $jobid = $_GET["id"];
    $stmt="SELECT * FROM apply WHERE jobid= ?";
    $stmt=$cnx->prepare($stmt);
    $stmt->execute([$jobid]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        foreach ($result as $res) {
            echo "<div class='job'>";
            echo "<p>" . "$res[id]" . "<br>" . "</p>";
            echo "<p>" . "$res[cv_name]" . "<br>" . "</p>";
            echo '<object data="data:application/pdf;base64,' . base64_encode($res["cv_data"]) . '" type="application/pdf" style="height:200px;width:60%"></object><br>'; 
            echo "<p>" . "$res[resume_name]" . "<br>". "</p>";
            echo '<object data="data:application/pdf;base64,' . base64_encode($res["resume_data"]) . '" type="application/pdf" style="height:200px;width:60%"></object><br>'; 
            echo "</div>";
    }
}else{  
    echo "No job applications yet";
}