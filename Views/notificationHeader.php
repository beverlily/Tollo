<?php
//only displays notifications if user is logged in
if (isset($_SESSION['id'])) {

    echo "
    <div id='notifContainer'>
    <button id='navbarDropdown' onclick='dropdown()'>
        <i class='fa fa-bell'>
            <!--number of notifications-->
            <span id='count' class='badge badge-light'></span>
        </i>
    </button>
    <div id='dropdownMenu' class='dropdownContent'>
        <form id='clearNotifs'>
            <button type='submit' name='clear' id='clearBtn' class='btn btn-outline-primary'>Clear</button>
        </form>
        <div class='dropdown-divider'></div>
        <!-- list of notifications -->
        <ul id='list'></ul>
    </div>
</div>
  ";
}
?>


<script>
    function dropdown() {
        document.getElementById("dropdownMenu").classList.toggle("show");
    }
</script>