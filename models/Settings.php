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
      'confirmation_text',
      'auto_reply_subject',
      'auto_reply_content'
    ];

    public $rules = [
      'maillist_title' => ['required'],
      'confirmation_text' => ['required'],
      'auto_reply_subject' => ['required_if:enable_auto_reply,1'],
      'auto_reply_content' => ['required_if:enable_auto_reply,1'],
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
