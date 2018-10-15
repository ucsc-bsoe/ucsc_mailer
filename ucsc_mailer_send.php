<?php

use Drupal\ucsc_mailer\Controller\UCSCMailerContentController;
use Drupal\Core\Render\Markup;
use Drupal\node\Entity\Node;

function ucsc_mailer_send() {

  // Get information from ucsc_mailer settings configuration to use here.
  $config = \Drupal::config('ucsc_mailer.settings');

  $last_sent_date = $config->get("last_sent_date");
  $weekday = $config->get("weekday");
  $hour = $config->get("hour");

  $current_weekday = date("w");
  $current_hour = date("H");

  // Get the mailer content.
  $testing_controller = new UCSCMailerContentController();
  $mailer_content = $testing_controller->make_mailer();

  // Check the current configuration and if it's the right day and time, send
  // the email.
  if ($hour <= $current_hour
    and $current_weekday == $weekday
    and abs($last_sent_date - time()) > 86400) {

  //if (1 === 1) {

    // Settings to send the mail to ucsc_mailer_mail in ucsc_mailer.module.
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'ucsc_mailer';
    $key = 'mailer_weekly';
    $to = \Drupal::config('ucsc_mailer.settings')->get('to_address');
    $params['message'] = Markup::create($mailer_content);
    $from = \Drupal::config('ucsc_mailer.settings')->get('from_address');
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $mailManager->mail($module, $key, $to, $langcode, $params, $from, $send);

    // Save new last_sent to ucsc_mailer settings configuration.
    \Drupal::service('config.factory')->getEditable('ucsc_mailer.settings')
      ->set('last_sent_date', strtotime('now'))
      ->save();

    // Create a new node for the mailer.
    $node = Node::create(['type' => 'ucsc_mailer']);
    $node->set('title', 'Mailer for ' . date('m/d/Y'));

    $field_mailer_body = [
      'value' => $mailer_content,
      'format' => 'full_html',
     ];
    $node->set('field_mailer_body', $field_mailer_body);
    //$node->set('uid', <uid>);
    $node->status = 1;
    //$node->enforceIsNew();
    $node->save();
    drupal_set_message( "Node with nid " . $node->id() . " saved!\n");

  }

   if (1 === 1) {

    // Settings to send the mail to ucsc_mailer_mail in ucsc_mailer.module.
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'ucsc_mailer';
    $key = 'mailer_weekly';
    $to = 'kbradham@ucsc.edu';
    $params['message'] = Markup::create($mailer_content);
    $from = \Drupal::config('ucsc_mailer.settings')->get('from_address');
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $mailManager->mail($module, $key, $to, $langcode, $params, $from, $send);
  }   
}
