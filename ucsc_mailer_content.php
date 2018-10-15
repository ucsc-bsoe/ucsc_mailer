<?php

function ucsc_mailer_content() {
//  $testing = "Mailer content will go here";
//  print($testing);
//  return $testing;
  //$toc = "<ul>\n";
  //$message = "";

//  $query = new EntityFieldQuery();
//  $query->entityCondition("entity_type", "node")
//    ->entityCondition("bundle", "mailer_announcement")
//    ->fieldCondition("field_start_date", "value", strtotime(date("Y-m-d 00:00:00")), "<=")
//    ->fieldCondition("field_end_date", "value", strtotime(date("Y-m-d 23:59:59")), ">=")
//    //->fieldCondition("field_new", "value", "Y", "=")
//    ->propertyOrderBy("nid");

//  $result = $query->execute();
//
//  $query = \Drupal::entityQuery('node')
//    ->condition('field_start_date', 'strtotime(date("Y-m-d 00:00:00"))', '<=');
//
//  $result = $query->execute();
//
//  return($result);

//  if (isset($result["node"])) {
//    $toc =
//      $toc .
//      "<li>\n" .
//      "<a href=\"#NewAnnouncements\">New Announcements</a>\n" .
//      "<ul>\n";
//
//    $message =
//      $message .
//      "<a name=\"NewAnnouncements\"></a>\n" .
//      "<h2>New Announcements</h2>\n" .
//      "<ul>\n";
//    foreach(array_keys($result["node"]) as $id) {
//      $node = Node::load($id);
//
//      $node->soe_ugrad_news_new[LANGUAGE_NONE] = array(
//        array(
//          "value" => "N",
//        )
//      );
//
//      node_save($node);
//
//      $toc =
//        $toc .
//        "<li><a href=\"#Announcement" .
//        $node->nid .
//        "\">" .
//        check_plain($node->title) .
//        "</a></li>\n";
//
//      $message =
//        $message .
//        "<li>\n" .
//        "<a name=\"Announcement" .
//        $node->nid .
//        "\"></a>\n" .
//        "<h3><a href=\"" .
//        url(
//          "node/" . $node->nid,
//          array(
//            "absolute" => true,
//          )
//        ) .
//        "\">" .
//        check_plain($node->title) .
//        "</a></h3>\n" .
//        check_markup(
//          $node->body[LANGUAGE_NONE][0]["value"],
//          $node->body[LANGUAGE_NONE][0]["format"]
//        ) .
//        "\n";
//
//      $message =
//        $message .
//        "</li>\n";
//
//      $toc =
//        $toc .
//        "</ul>\n" .
//        "</li>\n";
//
//      $message =
//        $message .
//        "</ul>\n";
//    }
//  }
  //return array($toc, $message);
  //return $toc;
}
