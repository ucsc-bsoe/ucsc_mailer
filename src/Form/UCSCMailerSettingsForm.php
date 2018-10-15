<?php

namespace Drupal\ucsc_mailer\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class UCSCMailerSettingsForm extends ConfigFormBase {
  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ucsc_mailer_admin_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'ucsc_mailer.settings',
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ucsc_mailer.settings');

    $form["from_address"] = array(
      "#type" => "textfield",
      "#title" => "From Address",
      "#description" => "This is the e-mail address that the weekly mailer will be sent from.",
      "#default_value" => $config->get('from_address'),
      "#required" => true,
    );

    $form["to_address"] = array(
      "#type" => "textfield",
      "#title" => "To Address",
      "#description" => "This is the e-mail address that the weekly mailer will be sent to.",
      "#default_value" => $config->get('to_address'),
      "#required" => true,
    );

    $form["notification_address"] = array(
      "#type" => "textfield",
      "#title" => "Notification Address",
      "#description" => "This is the e-mail address that should be notified when a new announcement, event or job is submitted.",
      "#default_value" => $config->get('notification_address'),
      "#required" => true,
    );

     $form["weekday"] = array(
      "#type" => "select",
      "#title" => "Weekday",
      "#description" => "Which day of the week should the weekly mailer go out on?",
      "#options" => array(
        1 => "Monday",
        2 => "Tuesday",
        3 => "Wednesday",
        4 => "Thursday",
        5 => "Friday",
      ),
      "#default_value" => $config->get('weekday'),
      "#required" => true,
    );

    $form["hour"] = array(
      "#type" => "select",
      "#title" => "Time",
      "#description" => "At what time should the mailer be sent?",
      "#options" => array(
        "9" => "9:00 AM",
        "10" => "10:00 AM",
        "11" => "11:00 AM",
        "12" => "12 Noon",
        "13" => "1:00 PM",
        "14" => "2:00 PM",
        "15" => "3:00 PM",
        "16" => "4:00 PM",
        "17" => "5:00 PM",
      ),
      "#default_value" => $config->get('hour'),
      "#required" => true,
    );

    $form["last_sent_date"] = array(
      "#type" => "textfield",
      "#title" => "Last Sent",
      "#size" => 20,
      "#description" => "This is the last date that the mailer was sent.",
      "#default_value" => date("m/d/Y h:i A", $config->get('last_sent_date')),
      //"#required" => true,
      '#attributes' => array('disabled' => 'disabled'),
    );

      return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
	// Retrieve the configuration
	$this->configFactory->getEditable('ucsc_mailer.settings')
        // Set the submitted configuration setting
        //->set('filter_format', $form_state->getValue('filter_format'))
        // You can set multiple configurations at once by making
        // multiple calls to set()
		 
	->set('from_address', $form_state->getValue('from_address'))
        ->set('to_address', $form_state->getValue('to_address'))
        ->set('notification_address', $form_state->getValue('notification_address'))
        ->set('weekday', $form_state->getValue('weekday'))
        ->set('hour', $form_state->getValue('hour'))
	->save();

      parent::submitForm($form, $form_state);
    }
}

