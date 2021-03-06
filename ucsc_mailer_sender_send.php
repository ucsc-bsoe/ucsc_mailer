<?php
use Drupal\Core\Render\Markup;

function ucsc_mailer_sender_send($entity) {
  // Is this the mailer entity?
  if ($entity->bundle() === 'mailer' && $entity->get('moderation_state')->getString() === "published") {

    // Build mail manager.
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'ucsc_mailer';
    $key = 'mailer_create';
    $langcode = \Drupal::currentUser()->getPreferredLangcode();

    // Who is this mail sent to (recipient)?
    $to = $entity->get('field_mailer_recipient')->value;

    // Create the mailer body from the body field. Add markup from WYSIWYG.
    $field_mailer_body = Markup::create($entity->get('field_mailer_body')->value);

    // Change URLS to absolute paths
    global $base_path;
    $pattern = '/(src|href)=(\'|")' . preg_quote($base_path, '/') . '/';
    $replacement = '$1=$2' . \Drupal\Core\Url::fromRoute('<front>', array(), array('absolute' => TRUE))->toString();
    $field_mailer_body_urls = \Drupal\Core\Render\Markup::create(preg_replace($pattern, $replacement, $field_mailer_body));

    // Create some parameters we can use in the actual message..
    $params['node_title'] = $entity->label();
    //$link = $entity->toUrl()->toString();
    $params['field_mailer_sender_address'] = $entity->get('field_mailer_sender_address')->value;
    $params['field_mailer_sender'] = $entity->get('field_mailer_sender')->value;
    $params['field_mailer_sub_title'] = $entity->get('field_mailer_sub_title')->value;
    
    $params['field_mailer_cc'] = ($entity->get('field_mailer_cc')->value != "") ? $entity->get('field_mailer_cc')->value : "" ;
    $params['body'] = $field_mailer_body_urls;

    $params['field_mailer_bcc'] = ($entity->get('field_mailer_bcc')->value != "") ? $entity->get('field_mailer_bcc')->value : "" ;
    $params['body'] = $field_mailer_body_urls;

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
