<?php

/**
 * @file
 * Contains \Drupal\helloworld\Form\CollectPhoneSettings.
 */

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class CollectPhoneSettings extends ConfigFormBase{

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames()
    {
        // Возвращает названия конфиг файла.
        // Значения будут храниться в файле:
        // helloworld.collect_phone.settings.yml

        return array('helloworld.collect_phone.settings');
    }

    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId()
    {
        return 'collect_phone_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Загружаем наши конфиги.
        $config = $this->config('helloworld.collect_phone.settings');

        // Добавляем поле для возможности задать телефон по умолчанию.
        // Далее мы будем использовать это значение в предыдущей форме.
        $form['default_phone_number'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Default phone number'),
            '#default_value' => $config->get('phone_number'),
        );
        // Субмит наследуем от ConfigFormBase
        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $values = $form_state->getValues();
        $this->config('helloworld.collect_phone.settings')->set('phone_number', $values['default_phone_number'])->save();
    }
}