<?php
require_once '../vendor/autoload.php';
use App\About;

$userId = $_SESSION['id'];
$a = new About();
$listInfo = $a->showAbout($userId);
?>
<div class="card">
    <div id=aboutTab class="card-body">
        <?php
        foreach ($listInfo as $info) {
            echo "
        <h5>Name: </h5><p>$info->fullname</p>
        <h5>Age: </h5><p>$info->age</p>
        <h5>Gender: </h5><p>$info->gender</p>
        <h5>Bio:</h5>
        <p>$info->bio</p>
        <form action='' method='post'>
        <input type='hidden' value='$info->id' name='id' />
        <button type='button' class='btn btn-primary btn-sm' id='aboutEdit' data-toggle='modal' data-target='#editModal'>Change</button>
        </form>
        
        ";
        }

        if ($listInfo == true) {
            //do nothing
        } else {
            echo "<button type='button' class='btn btn-primary btn-lg' id='aboutAdd' data-toggle='modal' data-target='#addModal'>Add</button>";
        }
        ?>



    </div>
</div>
<!-- Modals -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">About</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= CONPATH ?>about/aboutController.php" method="POST" class="form-horizontal" id="editAboutForm">
                    <input type="hidden" name="id">
                    <div class="col-sm-10">
                        <label for="aboutName">Full Name</label>
                        <input type="text" class="form-control" name="newfullname" id="aboutName">
                    </div>

                    <div class="col-sm-10">
                        <label for="aboutAge">Age</label>
                        <input type="text" class="form-control input-sm" name="newage" id="aboutAge">
                    </div>
                    <div class="col-sm-10">
                        <label for="aboutGender">Gender</label>
                        <input type="text" class="form-control input-sm" name="newgender" id="aboutGender">
                    </div>

                    <div class="col-sm-10">
                        <label for="aboutBio">Bio</label>
                        <textarea class="form-control" name="newbio" id="aboutBio" rows="3"></textarea>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="add" id="saveAbout" class="btn btn-primary">Add</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">About</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= CONPATH ?>about/aboutController.php" method="POST" class="form-horizontal" id="editAboutForm">
                    <input type="hidden" name="id" value='<?= $info->id; ?>'>
                    <div class="col-sm-10">
                        <label for="aboutName">Full Name</label>
                        <input type="text" class="form-control" name="fullname" id="aboutName" value='<?= $info->fullname; ?>'>
                    </div>

                    <div class="col-sm-10">
                        <label for="aboutAge">Age</label>
                        <input type="text" class="form-control input-sm" name="age" id="aboutAge" value='<?= $info->age; ?>'>
                    </div>
                    <div class="col-sm-10">
                        <label for="aboutGender">Gender</label>
                        <input type="text" class="form-control input-sm" name="gender" id="aboutGender" value='<?= $info->gender; ?>'>
                    </div>

                    <div class="col-sm-10">
                        <label for="aboutBio">Bio</label>
                        <textarea class="form-control" name="bio" id="aboutBio" rows="3"><?= $info->bio; ?></textarea>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="update" id="saveAbout" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>