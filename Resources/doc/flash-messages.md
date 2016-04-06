# Flash messages

> "You can store special messages, called "flash" messages in Symfony, on the user's session. By design, flash messages are meant to be used exactly once: they vanish from the session automatically as soon as you retrieve them. This features makes "flash" messages particularly great for storing user notifications." (from : [Symfony documentation][1])

Layout bundle add Twitter Bootstrap styles for display flash messages. The bundle embed : 
* a Twig template
* a Twig function *asf_flash_alerts('success', 'My messages')*

## Twig template

```twig
{# @ASFLayoutBundle/Resources/views/session/flash_messages.html.twig #}
{% block flash_messages %}
    {% for type, messages in app.session.flashbag.all() %}
        {% for message in messages %}
            {% autoescape false %}{{ block('flash_messages_row') }}{% endautoescape %}
        {% endfor %}
    {% endfor %}
{% endblock flash_messages %}

{% block flash_messages_row %}
    <div class="flash-{{ type }} alert alert-{{ type }}">
    {% if button_close %}<button type="button" class="close" data-dismiss="alert">&times;</button>{% endif %}
        {% autoescape false %}{{ message|trans({}, trans_domain) }}{% endautoescape %}
    </div>
{% endblock %}
``` 

To use it in your template, you have to call *asf_flash_alerts()* twig function :

```twig
{# app/Resources/views/base.html.twig #}
<body>
	{{ asf_flash_alerts({close_button: true, trans_domain: 'acme'}) }} 
</body>
``` 

The twig function can have two options :
* close_button : display the close button on each flash messages
* trans_domain : translation domain

## Types of messages

You can find the Twitter Bootstrap types messages :

```php
// /your/controller/path
$this->get('asf_layout.flash_message')->alert('My message');
$this->get('asf_layout.flash_message')->success('My message');
$this->get('asf_layout.flash_message')->info('My message');
$this->get('asf_layout.flash_message')->warning('My message');
$this->get('asf_layout.flash_message')->danger('My message');
```

[1]: http://symfony.com/doc/current/book/controller.html#flash-messages