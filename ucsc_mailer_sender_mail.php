<?php
use Drupal\Core\Render\Markup;

function ucsc_mailer_sender_mail($entity) {

  // Is this the mailer entity?
  if ($entity->bundle() === 'mailer') {

    // Build mail manager.
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'ucsc_mailer';
    $key = 'mailer_create';
    $langcode = \Drupal::currentUser()->getPreferredLangcode();

    // Who is this mail sent to (recipient)?
    $to = $entity->get('field_mailer_recipient')->value;

    // Create the mailer body from the body field. Add markup from WYSIWYG.
    $field_mailer_body = Markup::create($entity->get('field_mailer_body')->value);
    //$field_mailer_sub_title = Markup::create($entity->get('field_mailer_sub_title')->value);

    // Create some parameters we can use in the actual message..
    $params['node_title'] = $entity->label();
    //$link = $entity->toUrl()->toString();
    $params['field_mailer_sender_address'] = $entity->get('field_mailer_sender_address')->value;
    $params['field_mailer_sender'] = $entity->get('field_mailer_sender')->value;
    $params['field_mailer_sub_title'] = $entity->get('field_mailer_sub_title')->value;
    $params['field_mailer_bcc'] = $entity->get('field_mailer_bcc')->value;
    $params['body'] = $params['body'] = Markup::create($field_mailer_body);

    // Who is this message from (sender address)?
    $from = $entity->get('field_mailer_sender_address')->value;

    // Set send to true.
    $send = true;

    // Send all to the mail manager.   
    $result = $mailManager->mail($module, $key, $to, $langcode, $params, $from, $send);

    // Notify of the result.
    if ($result['result'] !== true) {
      drupal_set_message(t('There was a problem sending your message and it was not sent, whoops.'), 'error');
    }
    else {
      drupal_set_message(t('Your message has been sent.'));
    }
  }
}
