# Layout models

Layout bundle embed two model layouts for your application. You can use it or not. This models are Twig template models. They include all bundle's supported assets :
* jQuery
* jQuery UI
* Twitter Bootstrap 

## How to use

If you want to use this models for your project, simply extend it :

```twig
# @YourLayoutBundle/Resources/views/index.html.twig
{% extends "ASFLayoutBundle::frontend_model.html.twig" %}
# or
{% extends "ASFLayoutBundle::backend_model.html.twig" %}
```

## Frontend/public model
The first model is a simple base twig template for a frontend/public layout :

```twig
# /vendor/artscorestudio/layout-bundle/Resources/views/frontend_model.html.twig
{% trans_default_domain 'asf_layout' %}

<!DOCTYPE html>
<html lang="{{ app.request.getLocale() }}">
    <head>
    	{% block asf_base_encoding %}
        <meta charset="UTF-8" />
        {% endblock asf_base_encoding %}
        
        <title>
        	{% block asf_base_meta_title_prefix %}{% endblock %}
			{% block asf_base_meta_title %}{{ 'Home'|trans }}{% endblock %}
			{% block asf_base_meta_title_suffix %}{% endblock %}
        </title>
        
        {% block asf_base_favicon %}
        	<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        {% endblock asf_base_favicon %}
        
		{% block asf_base_header_stylesheets %}
			{{ asf_layout_stylesheets() }}
		{% endblock %}
        
        {% block asf_base_header_javascripts %}
			{{ asf_layout_javascripts() }}
		{% endblock %}
    </head>
    
    {% block asf_base_body_tag %}
    <body>
    {% endblock asf_base_body_tag %}
    
    	{% block asf_base_body %}{% endblock asf_base_body %}

    	{% block asf_base_footer_javascripts %}{% endblock asf_base_footer_javascripts %}
    </body>
</html>
```

## Backend/admin model
The second model is a simple twig template for a backend/admin layout :

[Not yet implemented]