<?php
  $title = 'Diary Entry';
  $style = 'diary.css';
//   include '../Controllers/diaries/addEntry.php';
  include '../header.php';
?>
    <main id="mainContent">
        <div class="pageWrapper">
            <!-- <form method="post" action="diaryentry.php"> -->
            <form method="post" action="../Controllers/diaries/addEntry.php">
                <div id="formBox">
                    <h1>Diary Entry</h1>
                    <div><label>Title:</label></div>
                    <input type="text" class="formFields" name="title"/>
                    <div><label>Date:</label></div>
                    <input type="date" class="formFields" name="date">
                    <div><label>Text:</label></div>
                    <textarea class="formFields" id="textArea" name="content" wrap="soft"></textarea>                 
                    <div><button type="submit" id="submitBtn" name="submit">Submit Entry</div>
                    <div id="errMsg"><?=$_SESSION['DiaryErrorMessage']?></div>
                </div>
            </form>
        </div>
    </main>
<?php
        $_SESSION['DiaryErrorMessage'] = "";
        include '../footer.php';
?>