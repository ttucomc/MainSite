<?php
require_once('config.php');

class Rsvp
{


  /**
   * Checks to see if a RSVP already exists
   *
   * @param  int  $event  The ID of the event the RSVP is for
   * @param  str  $email  Email of the person RSVPing
   * @return bool $exists Answer for if the RSVP exists
   */
   function check_for_rsvp($event, $email) {
     require(ROOT_PATH . "inc/db.php");

     try {

       // This allows multiple rsvps with this email for event planner to use
       if (strtolower($email) == "rsvp.mcom@ttu.edu") {
         $exists = false;
       } else {

         $stmt = $db->prepare("SELECT * FROM people WHERE email=:email AND event_id=:event_id");
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt->bindParam(':event_id', $event, PDO::PARAM_INT);
         $stmt->execute();

         if($stmt->rowCount() > 0) {
           $exists = true;
         } else {
           $exists = false;
         }

       }

     } catch (Exception $e) {
       echo "Couldn't check if the RSVP exists in database. " . $e->getMessage();
     }

     return $exists;

   }



  /**
   * Adds an RSVP to the database
   *
   * @param  int $attending 0 or 1 for if the person is attending the event
   * @param  int $event     ID of the event the person is RSVPing for
   * @param  str $firstName First name of the person RSVPing
   * @param  str $lastName  Last name of the person RSVPing
   * @param  str $email     Email of the person RSVPing
   * @param  str $info      Any notes the person may have
   * @return str $added     String that says if it was successful or not
   */
  function add_rsvp($attending, $event, $firstName, $lastName, $email, $info) {
    require(ROOT_PATH . "inc/db.php");

    $firstName = trim($firstName);
    $lastName = trim($lastName);
    $email = trim($email);
    $info = htmlspecialchars(trim($info));

    // Check if this person already has an RSVP
    $exists = $this->check_for_rsvp($event, $email);
    if ($exists) {
      $added = "This person already has an RSVP for this event.";
    } else {

      try {

        $stmt = $db->prepare("
                              INSERT INTO people (attending, first_name, last_name, email, event_id, info)
                              VALUES (:attending, :first_name, :last_name, :email, :event_id, :info)
                            ");
        $stmt->bindParam(':attending', $attending, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':event_id', $event, PDO::PARAM_INT);
        $stmt->bindParam(':info', $info, PDO::PARAM_STR);
        $stmt->execute();

        $added = "Successfully added RSVP to database.";

      } catch (Exception $e) {
        echo "Couldn't add rsvp to database. " . $e->getMessage();
        $added = "Couldn't add RSVP to database.";
      }

    }

    return $added;

  }



  /**
   * Adds guests to an RSVP
   *
   *
   */
  function add_guests() {
    require(ROOT_PATH . "inc/db.php");


    return $added;

  }



  /**
   * Edits an rsvp in the database
   *
   * @param  int $rsvp      The ID of the rsvp we're looking for
   * @param  int $event     ID of the event the person is RSVPing for
   * @param  int $attending 0 or 1 for if the person is attending the event
   * @param  str $firstName First name of the person RSVPing
   * @param  str $lastName  Last name of the person RSVPing
   * @param  str $email     Email of the person RSVPing
   * @param  str $info      Any notes the person may have
   * @return str $added     String that says if it was successful or not
   */
   function edit_rsvp($rsvp, $event, $attending, $firstName, $lastName, $email, $info) {
     require(ROOT_PATH . "inc/db.php");

     $firstName = trim($firstName);
     $lastName = trim($lastName);
     $email = trim($email);
     $info = htmlspecialchars(trim($info));

     try {

       $stmt = $db->prepare("
                              UPDATE people
                              SET attending=:attending, first_name=:first_name, last_name=:last_name, email=:email, info=:info
                              WHERE ID=:id
                           ");
       $stmt->bindParam(':attending', $attending, PDO::PARAM_INT);
       $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
       $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
       $stmt->bindParam(':email', $email, PDO::PARAM_STR);
       $stmt->bindParam(':info', $info, PDO::PARAM_STR);
       $stmt->bindParam(':id', $rsvp, PDO::PARAM_INT);
       $stmt->execute();

       $edited = "This rsvp was successfully updated!";

     } catch (Exception $e) {
       echo "Couldn't edit the rsvp in the database." . $e->getMessage();
       $edited = "Couldn't edit the rsvp in the database.";
     }


     return $edited;
   }



  /**
   * Deletes an rsvp from the database.
   *
   * @param  int eventID The ID of the event
   * @param  int rsvpID  The ID of the rsvp
   * @return str deleted String explaining if it was successfully deleted
   */
   function delete_rsvp($eventID, $rsvpID) {
     require(ROOT_PATH . "inc/db.php");

     try {

       $stmt = $db->prepare("
                             DELETE FROM people
                             WHERE ID=:rsvpID AND event_id=:eventID;
                             DELETE FROM guests
                             WHERE host_id=:hostID AND event_id=:hostEvent;
                            ");
      $stmt->bindParam(':rsvpID', $rsvpID, PDO::PARAM_INT);
      $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
      $stmt->bindParam(':hostID', $rsvpID, PDO::PARAM_INT);
      $stmt->bindParam(':hostEvent', $eventID, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $deleted = "This RSVP has been deleted!";
      } else {
        $deleted = "This RSVP was not deleted! Please try again!";
      }


     } catch (Exception $e) {
       echo "Could not delete RSVP from the database. " . $e->getMessage();
     }


     return $deleted;

   }


























}
