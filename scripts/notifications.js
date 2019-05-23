$(document).ready(function() {
  //root path
  //const root = "http://localhost/HTTP5202-No-Tears/";
  //const root = "http://localhost:8080/project-no-tears/";
  // const root = "http://localhost/project-no-tears/";
  const root = "http://tollo.beverlyli.com/";

  //Reprints list of notifs at every set amount of time
  setInterval(function() {
    $.post(
      root + "Controllers/notifications/notifications.php",
      {
        flag: "listNotif"
      },
      function(result) {
        $("#list").html(result);
      }
    );
  }, 1000);

  //Reprints count of notifs at every set amount of time
  setInterval(function() {
    $.post(
      root + "Controllers/notifications/notifications.php",
      {
        flag: "count"
      },
      function(result) {
        $("#count").html(result);
      }
    );
  }, 1000);

  //Checks for goals notifications to be added to notification list after set amount of time
  setInterval(function() {
    $.post(
      root + "Controllers/notifications/notifications.php",
      {
        flag: "checkGoals"
      },
      function(result) {
        $("#error").html(result);
      }
    );
  }, 1000);

  //Checks for reminder notifications to be added to notification list after set amount of time
  setInterval(function() {
    $.post(
      root + "Controllers/notifications/notifications.php",
      {
        flag: "checkReminders"
      },
      function(result) {
        $("#error").html(result);
      }
    );
  }, 1000);
  //when clear is clicked prevents from refreshing page
  $("#clearNotifs").on("submit", function(e) {
    e.preventDefault();
    $.post(
      root + "Controllers/notifications/deleteNotifs.php",
      {
        flag: "clear"
      },
      function(result) {
        $("#error").html(result);
      }
    );
  });
});
