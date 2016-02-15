# ASFLayoutBundle Commands Reference

## Install Twitter Bootstrap fonts

You can install manually the Twitter Bootstrap default fonts with the command below :

```bash
$ php bin/console asf:twbs:fonts:install
```

## Copy Twitter Bootstrap custom Less files

If you want to customize Twitter Bootstrap less files you can manually copy files into your preferred folder :

> This command copy files and change path in *@import* declarations in files according to the *asf_layout.assets.twbs.twbs_dir* and *asf_layout.assets.twbs.customize.dest_dir* parameters.

```bash
$ php bin/console asf:twbs:less:copy
```

You can done one argument : *target_dir*, the target directory like following : 

```bash
$ php bin/console asf:twbs:less:copy src/AcmeDemoBundle/Resources/public/bootstrap/less
```

You can done one option : files, the list of files to copy like following :

```bash
$ php bin/console asf:twbs:less:copy --files=bootstrap.less
```

> The target directory and the list of files can be set throught the bundle configuration see [Twitter Bootstrap chapter](twitter-bootstrap.md).

## Copy TinyMCE files

If you want to copy TinyMCE files directly in your web folder or in a custom bundle, you can fire this command :

```bash
$ php bin/console asf:tinymce:copy
```

You can done one argument : *target_dir*, the target directory like following : 

```bash
$ php bin/console asf:twbs:less:copy src/AcmeDemoBundle/Resources/public/tinymce
```

You can done one option : files, the list of exclude files to copy like following :

```bash
$ php bin/console asf:twbs:less:copy --exclude_files=composer.json
```

> The target directory and the list of excluded files can be set throught the bundle configuration see [TinyMCE chapter](tinymce.md).