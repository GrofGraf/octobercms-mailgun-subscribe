# Mailgun Subscribe

A simple multilingual form for subscribtion to Mailgun mailing list.

## Requirements

* [Mailgun](https://www.mailgun.com) account.
* [Ajax Framework](https://octobercms.com/docs/cms/ajax) must be included in your layout/page in order to handle form requests.

## Optional
* [Translate](https://octobercms.com/plugin/rainlab-translate) plugin, if you want to include multilingual contents.

## Settings

This plugin creates a Settings menu item, found by navigating to **Settings > Marketing > Mailgun Subscribe**. This page allows the setting of common features, described in more detail below.

## Configuration
* Create [Mailgun](https://www.mailgun.com) account, register a domain and create a mailing list under this domain.
* Under **Settings > Marketing > Mailgun Subscribe** fill in the required settings.

## Creating the subscription form
You can put the subscription form on any front-end page. Add the `SubscribeForm Component` to a page or layout.

The simplest way to add the signup form is to use the component's default partial and the `{% component %}` tag. Add it to a page or layout where you want to display the form:

    {% component 'subscribeForm' %}

If the default partial is not suitable for your website, replace the component tag with custom code, for example:

    <div class="confirm-subscribe-container">
    </div>
    <form class="subscribe-form"
          data-request="{{ __SELF__ }}::onSubscribe"
          data-request-update="'{{ __SELF__ }}::confirm': '.confirm-subscribe-container'">
      <div class="input-group">
        <input type="text" name="email" class="form-control" placeholder="EMAIL">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <span class="sr-only">Subscribe</span>
            <span class="glyphicon glyphicon-envelope"></span>
          </button>
        </span>
      </div>
    </form>

The example uses standard partial `{{ __SELF__ }}::confirm` for displaying the subscription confirmation message. Confirmation message will be displayed in
`.confirm-subscribe-container`. The default partial located in `plugins/grofgraf/mailgunsubscribe/components/subscribeform/confirm.htm`.

## Authors

* [GrofGraf](https://github.com/GrofGraf)

## License

The MIT License (MIT)

Copyright (c) 2017 GrofGraf

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
