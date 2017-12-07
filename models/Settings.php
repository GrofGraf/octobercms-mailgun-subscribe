<?php namespace GrofGraf\MailgunSubscribe\Models;

use Model;
use System\Models\MailSetting;
use ValidationException;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
      'System.Behaviors.SettingsModel',
      '@RainLab.Translate.Behaviors.TranslatableModel'
    ];

    public $translatable = [
      'confirmation_text'
    ];

    public $rules = [
      'maillist_title' => ['required'],
      'confirmation_text' => ['required'],
      'mailgun_domain' => ['required_if:mailgun_configuration,0'],
      'api_key' => ['required_if:mailgun_configuration,0']
    ];

    // A unique code
    public $settingsCode = 'mailgun_subscribe_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public function beforeValidate(){
      if(MailSetting::get('send_mode') != 'mailgun' && $this->mailgun_configuration){
        throw new ValidationException(['mailgun_configuration' => 'Mailgun is not set as default mail method.']);
      }
    }
}
