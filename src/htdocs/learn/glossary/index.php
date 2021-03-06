<?php
// Author: Lisa Wald
// Contact: Lisa Wald
  if (!isset($TEMPLATE)) {
    $TITLE = 'Earthquake Glossary';
    $NAVIGATION = true;
    /* include_once "functions.glossary.inc.php"; */
    include 'template.inc.php';
  }

  include_once '/etc/puppet/EHPServer.class.php';
  $pdo = EHPServer::getDatabase('earthquake');

  //defaults
  $alpha = "";
  $term = "";
  $termID = "";

  $statement = $pdo->prepare("
      SELECT id, term
      from glossary
      ORDER BY term");

  try {
    // use bound parameter names
    $statement->execute(array(
    ));

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      echo '<a href="index.php?termID=' .$row['id']. '">'. $row['term'].'</a><br/>';
    }

    // must close cursor before calling execute again
    $statement->closeCursor();
  }

  catch (PDOException $e) {
    // don't output this on prod...
  print_r($e);
  }

  // free prepared statement
  $statement = null;

  // close database connection
  $pdo = null;

?>

<?php
/*
*********************OLD CODE*******************************************



$row = glossary_term($term, $termid, $db);


//check for alpha
if(isset($_GET['alpha'])) {
  $alpha = $_GET['alpha'];
}

    //actual display
    $nav = "<div id=\"glossary-nav\">" . glossary_navigation() . "</div>\n";
    $row = glossary_term($term, $termid, $db);

    if(sizeof($row)) {
      print $nav . glossary_term_navigation($row['term'], $db) . "<br />";

      //display term
      print display_glossary_term($row, $db);

    } else {
      //display index
      if($alpha == "" || is_numeric($alpha) || (strlen($alpha > 1) && $alpha != "all")) {
        $alpha = "all";
      }
      $index = glossary_index($alpha);

      $alpha = strtoupper($alpha);
      print preg_replace( "/^(.*)<a href=\".*?=$alpha\">(.*?)<\/a>(.*)$/", "$1<strong>$2</strong>$3", $nav );
      print "<hr/>";
      print $index;
    }

?>
  */
