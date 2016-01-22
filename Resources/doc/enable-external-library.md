# Enable/Disable external libraries

You can enable or disable external libraries in your project via the configuration file of your application.

* [Enable/Disable jQuery](#jquery)

<a name="jquery" id="jquery"></a> 
## Enable/disable jquery

### Enable jQuery

Don't forget to install jQuery with Composer like this :

```bash
$ composer require components/jquery "2.2.*"
```

After that, edit config.yml and enable jQuery :

```yaml
# app/config/config.yml
asf_layout:
    supports:
        jquery: true
    jquery_config:
        path: "%kernel.root_dir%/vendor/components/jquery/jquery.min.js"
```

Remember to fill in the path to jQuery file. By default, the path is like the exemple above; based on package components/jquery. 

## Disable jQuery

Just edit config.yml :

asf_layout:
    supports:
        jquery: false
```
