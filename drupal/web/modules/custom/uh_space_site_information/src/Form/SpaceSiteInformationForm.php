<?php

namespace Drupal\uh_space_site_information\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class SpaceSiteInformationForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Retrieve the system.site configuration
    $config = $this->config('system.site');

    // Get the original form from the class we are extending
    $form = parent::buildForm($form, $form_state);

    // Add a textarea to the site information section of the form for our
    // description
    $form['service_provider'] = [
      '#title' => t('Service Provider settings'),
      '#type' => 'details',
      '#open' => TRUE,
    ];
    $form['service_provider']['logo_text'] = [
      '#type' => 'textfield',
      '#title' => t('Logo text'),
      '#default_value' => $config->get('logo_text'),
    ];
    $form['service_provider']['logo_path'] = [
      '#type' => 'textfield',
      '#title' => t('Target path from logo link'),
      '#default_value' => $config->get('logo_path'),
    ];
    $form['service_provider']['copyright_text'] = [
      '#type' => 'textfield',
      '#title' => t('Copyright text'),
      '#default_value' => $config->get('copyright_text'),
    ];
    $form['service_provider']['contact_info'] = [
      '#type' => 'textarea',
      '#title' => t('Contact information'),
      '#default_value' => $config->get('contact_info'),
    ];

    $form['spaces'] = [
      '#title' => t('Spaces settings'),
      '#type' => 'details',
      '#open' => TRUE,
    ];
    $form['spaces']['spaces_contact_info'] = [
      '#type' => 'textarea',
      '#title' => t('Contact information'),
      '#default_value' => $config->get('spaces_contact_info'),
    ];

    // Theme this form as a config form.
    $form['#theme'] = 'system_config_form';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Now we need to save the new description to the
    // system.site.description configuration.
    $this->config('system.site')
      ->set('logo_text', $form_state->getValue('logo_text'))
      ->set('logo_path', $form_state->getValue('logo_path'))
      ->set('copyright_text', $form_state->getValue('copyright_text'))
      ->set('contact_info', $form_state->getValue('contact_info'))
      ->set('spaces_contact_info', $form_state->getValue('spaces_contact_info'))
      ->save();

    // Pass the remaining values off to the original form that we have extended,
    // so that they are also saved
    parent::submitForm($form, $form_state);
  }

}
