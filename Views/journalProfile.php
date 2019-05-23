<?php
  $title = 'Review Entry';
  $style = 'review.css';
  include '../Controllers/diaries/listEntries.php';
?>
<main id="mainContent">
    <div class="pageWrapper">
        <div class="flex-container">
            <table class="table-default table user-table">
                <tbody>
                    <tr>
                        <td>
                                <form action='../Views/diaryentry.php' method='post'>
                                <button type='submit' class='btn btn-success'>
                                <span class='table-primaryTitle highlight-black' id="createEntry">Create a new entry!</span>
                                </button>
                                </form>
                        </td>
                    </tr>
                    <?php
                    foreach ($item as $entry) {
                        echo"
                        <tr>
                            <td>
                                <form action='../Controllers/diaries/entryDetails.php' method='post'>
                                <input type='hidden' name='id' value='$entry->id'/>
                                <button type='submit' class='btn btn-light'>
                                <span class='table-primaryTitle highlight-black'>$entry->title</span>
                                </button>
                                </form>
                            </td>
                            <td>
                                <span class='table-dataTitle'>Date:</span>
                                <span class='table-primaryTitle highlight-blue'>$entry->date</span>
                            </td>
                                <td>
                                <form action='../Views/diaryUpdate.php' method='post'>
                                <input type='hidden' name='id' value='$entry->id' />
                                <button type='submit' class='btn btn-primary btn-sm btn-block'>Update</button>
                                </form>

                                <form action='../Controllers/diaries/deleteEntry.php' method='post'>
                                <input type='hidden' name='id' value='$entry->id' />
                                <button type='submit' name='delete' class='btn btn-danger btn-sm btn-block' value='Delete'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>