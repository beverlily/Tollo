<div id="listRemContainer"></div>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-primary btn-lg" id="remBtn" data-toggle="modal" data-target="#myModal">New Reminder</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Reminder</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addRemindersForm">
                    <div class="form-group">
                        <label for="remTitle">Title</label>
                        <input type="text" class="form-control" name="title" id="remTitle">

                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="remDate">Date</label>
                            <input type="date" class="form-control" name="date" id="remDate">
                        </div>
                        <div class="col">
                            <label for="remTime">Time</label>
                            <input type="time" class="form-control" name="time" id="remTime">
                        </div>
                    </div>


                    <input type="submit" value="Set" name="set" id="setRemBtn" class="btn btn-primary" />

                    <div id="errorMsg"></div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>