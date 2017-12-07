<?php namespace GrofGraf\MailgunSubscribe;

use Backend;
use System\Classes\PluginBase;

/**
 * MailgunSubscribe Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'MailgunSubscribe',
            'description' => 'Mailing list subscribtion using mailgun',
            'author'      => 'GrofGraf',
            'icon'        => 'icon-user-plus'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'GrofGraf\MailgunSubscribe\Components\SubscribeForm' => 'subscribeForm',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'grofgraf.mailgunsubscribe.some_permission' => [
                'tab' => 'MailgunSubscribe',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'mailgunsubscribe' => [
                'label'       => 'Mailgun Subscribe',
                'url'         => Backend::url('grofgraf/mailgunsubscribe/mycontroller'),
                'icon'        => 'icon-user-plus',
                'permissions' => ['grofgraf.mailgunsubscribe.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Mailgun Subscribe',
                'description' => 'Settings for mailing list subscription',
                'category'    => 'Marketing',
                'icon'        => 'icon-user-plus',
                'class'       => 'GrofGraf\MailgunSubscribe\Models\Settings',
                'order'       => 100
            ]
        ];
    }
}
