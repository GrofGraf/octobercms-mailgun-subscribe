<?php namespace GrofGraf\MailgunSubscribe\Components;

require './vendor/autoload.php';

use GrofGraf\MailgunSubscribe\Models\Settings;
use Cms\Classes\ComponentBase;
use Mailgun\Mailgun;
use Validator;
use ValidationException;
use System\Models\MailSetting;
/*use Lang;
use Illuminate\Support\MessageBag;*/

class SubscribeForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'SubscribeForm Component',
            'description' => 'Form for maillist subscribtion'
        ];
    }

    public function defineProperties()
    {
      return [
        'loadBootstrap' => [
            'title'       => 'Load Bootstrap',
            'description' => 'Load Bootstrap assets (not recommended for production)',
            'type'        => 'checkbox',
            'default'     => true,
        ],
        'loadJS' => [
            'title'       => 'Load JS',
            'description' => 'Load javascript required for animation',
            'type'        => 'checkbox',
            'default'     => true,
        ]
      ];
    }

    public function init(){
      //this will execute when component is first initialized (including AJAX events)
    }

    public function onRun(){
      if($this->property('loadBootstrap') == true){
        $this->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        $this->addJs('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
      }

      if($this->property('loadJS') == true) {
        $this->addJs('assets/js/main.js');
      }
    }

    public $formValidationRules = [
        'email' => ['required', 'email'],
    ];

    public function onSubscribe(){
      if(Settings::get('mailgun_configuration')){
        $mailgun_domain = MailSetting::get('mailgun_domain');
        $api_key = MailSetting::get('mailgun_secret');
      }else{
        $mailgun_domain = Settings::get('mailgun_domain');
        $api_key = Settings::get('api_key');
      }
      $validator = Validator::make(post(), $this->formValidationRules);
      if ($validator->fails()) {
        throw new ValidationException($validator);
      }
      $mgClient = new Mailgun($api_key);
      $listAddress = Settings::get('maillist_title') . '@' . $mailgun_domain;
      $result = $mgClient->post("lists/" . $listAddress . "/members", array(
          'address'     => post('email'),
          'subscribed'  => true,
          'name'        => ucwords(str_replace('.', " ", explode('@', post('email'))[0])),
          'upsert'      => 'yes'
      ));

      $this->page["confirmation_text"] = Settings::instance()->confirmation_text ?: "You successfully subscribed to our maillist.";
      return;
    }
}
