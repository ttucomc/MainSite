<?php
require_once('config.php');
require_once('functions.php');

// Getting all events from db
$events = get_all_events("DESC");

?>

<?php foreach($events as $event): ?>
  <div class="mdl-card mdl-shadow--2dp event-card <?php if($event['listed'] == 0) { echo 'inactive'; } ?>">
    <div class="mdl-card__title">
      <h2 class="mdl-card__title-text"><?php echo $event['name']; ?></h2>
    </div>
    <div class="mdl-card__supporting-text">
      <?php
        $invitees =  get_invitees($event['ID']);
        $guests = get_guests($event['ID']);
      ?>
        <h3>Details<?php if($event['listed'] == 0) { echo ' &mdash; <em>Inactive</em>'; } ?></h3>
        <div id="details-<?php echo $event['ID']; ?>">
          <p>
            <span class="event-description"><?php if (!empty($event['description'])){ echo nl2br($event['description']); } ?></span>
          </p>
          <p>
            <strong>Location:</strong> <span class="event-location"><?php echo $event['location']; ?></span><br />
            <strong>Address:</strong> <span class="event-address"><?php echo $event['address'] ?></span> (<a class="event-directions" href="http://maps.google.com/?q=<?php echo $event['address']; ?>" target="_blank">Directions</a>)<br />
            <strong>Time:</strong> <span class="event-date"><?php echo date('m/j/Y', strtotime($event['datetime'])); ?></span> - <span class="event-time"><?php echo date('h:i A', strtotime($event['datetime'])); ?></span>
            <?php
              if(!empty($event['end_time'])) {
                echo " to <span class=\"event-end-time\">" . date('h:i A', strtotime($event['end_time'])). "</span>";
              } else {
                echo "<span class=\"event-end-time\"></span>";
              }
            ?>
          </p>

          <h4>RSVPs</h4>
          <form>
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="rsvp-switch-<?php echo $event['ID']; ?>">
              <input type="checkbox" id="rsvp-switch-<?php echo $event['ID']; ?>" class="mdl-switch__input event-rsvp-switch" value="yes" <?php if($event['rsvps'] == 1): ?>checked<?php endif; ?> data-event-id="<?php echo $event['ID']; ?>">
              <span class="mdl-switch__label">Toggle off/on</span>
            </label>
          </form>
          <?php if($event['rsvps'] == 1): ?>
            <p id="rsvp-details-<?php echo $event['ID']; ?>">
              <strong>RSVP Password:</strong> <span class="event-password"><?php echo $event['password']; ?></span><br />
              <strong>Total RSVPs:</strong> <?php echo total_rsvps($invitees); ?><br />
              <strong>Total People Attending:</strong> <?php echo total_attending($invitees, $guests); ?><br />
              <strong>RSVP Deadline:</strong> <span class="event-rsvp-deadline"><?php echo date('m/j/Y', strtotime($event['rsvp_date'])); ?></span><br />
              <?php if($event['allow_guests'] == 1): ?>
                <strong>Allows guests?</strong> <span class="event-allow-guests">Yes</span>
              <?php else: ?>
                <strong>Allows guests?</strong> <span class="event-allow-guests">No</span>
              <?php endif; ?>
            </p>
          <?php endif; ?>
        </div>
    </div>
    <?php if($event['rsvps'] == 1): ?>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo BASE_URL . 'rsvps/?id=' . $event['ID']; ?>">
          See Who's Coming
        </a>
      </div>
    <?php endif; ?>
    <div class="mdl-card__menu">
      <button id="event-card-menu-<?php echo $event['ID']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">more_vert</i>
      </button>
      <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="event-card-menu-<?php echo $event['ID']; ?>">
        <li data-event-id="<?php echo $event['ID']; ?>" class="mdl-menu__item edit-event">Edit This Event</li>
        <?php if($event['listed'] == 1): ?>
          <li data-event-id="<?php echo $event['ID']; ?>" class="mdl-menu__item toggle-listing">Remove from events page</li>
        <?php else: ?>
          <li data-event-id="<?php echo $event['ID']; ?>" class="mdl-menu__item toggle-listing">Add to events page</li>
        <?php endif; ?>
        <li class="mdl-menu__item delete-event" data-event-id="<?php echo $event['ID']; ?>">Delete This Event</li>
      </ul>
    </div>
  </div>
<?php endforeach; ?>
