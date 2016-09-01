<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  include ($_SERVER["DOCUMENT_ROOT"] . '/comcsite/utilities11/news/classes/rendernews.class.php');
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <h1>The News!</h1>
  <section>
    <?php
      echo RenderNews::listStories(8);
    ?>
  </section>
</body>
</html>
