<?php

namespace Drupal\islandora_premis\Plugin\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class IslandoraPremisSettingsForm extends ConfigFormBase {
  /**
   * The path to stored config file.
   *
   * @var string
   */
  protected $config_filepath;

  public function getFormId() {
    return 'islandora_premis_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'islandora_premis.settings',
    ];
  }

  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('islandora_premis.settings');

    $form['islandora_premis_file_original_name_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Original filename field'),
      '#description' => $this->t('The machine name of the field that is used for files\' original name.'),
      '#default_value' => $config->get('islandora_premis_file_original_name_field'),
    ];
    $form['islandora_premis_num_fixity_events'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Number of fixity events to include'),
      '#description' => $this->t('Number of fixity events to include in the PREMIS RDF output. Enter 0 to include all fixity events.'),
      '#default_value' => $config->get('islandora_premis_num_fixity_events'),
    ];


    return parent::buildForm($form, $form_state);
  }

    /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_numeric($form_state->getValue('islandora_premis_num_fixity_events'))) {
      $form_state->setErrorByName(
        'islandora_premis_num_fixity_events',
        $this->t('Number of fixity events must be a number.')
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->configFactory->getEditable('islandora_premis.settings')
      ->set('islandora_premis_num_fixity_events', $form_state->getValue('islandora_premis_num_fixity_events'))
      ->set('islandora_premis_file_original_name_field', $form_state->getValue('islandora_premis_file_original_name_field'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}

