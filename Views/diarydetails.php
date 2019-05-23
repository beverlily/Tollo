<?php
  $title = 'Diary Entry';
  $style = 'diary.css';
  include '../../header.php';
?>
    <main id="mainContent">
        <div class="pageWrapper">
                <div id="formBox">
                    <h1><?= $entry->title ?></h1>
                    <h6><?= $entry->date ?></h4>
                    <h5><?= $entry->content ?></h3>
                </div>
        </div>
    </main>
<?php
        include '../../footer.php';
?>