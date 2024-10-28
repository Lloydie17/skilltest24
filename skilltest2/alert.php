<?php 
    session_start();

    if (isset($_SESSION['alert'])) {
        echo "<div class='w3-container w3-padding' id='alert-message' style='position: fixed; bottom: 20px; right: 20px; z-index: 1000;'>";
            echo "<div class='w3-panel w3-amber w3-padding'>";
                echo "<h4>{$_SESSION['alert']}</h4>";
            echo "</div>";
        echo "</div>";
        
        unset($_SESSION['alert']);
    }
?>

<script>
    setTimeout(function() {
        var alertMessage = document.getElementById('alert-message');
        if(alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 2000);
</script>