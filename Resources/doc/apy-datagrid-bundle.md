# APYDataGrid Bundle support

APYDataGridBundle is a Symfony bundle for create grids for list your Entity (ORM), Document (ODM) and Vector (Array) sources. APYDataGridBundle was initiated by Stanislav Turza (Sorien) and inspired by Zfdatagrid and Magento Grid.

LayoutBundle provide a template for APYDataGrid Bundle. To use it, just configure APYDataGrid bundle like following :

```yaml
# app/config/config.yml
# APYDataGrid Configuration
apy_data_grid:
    theme: "ASFLayoutBundle:datagrid:grid-template.html.twig"
```

> The [APY/DataGrid bundle official repository][1] is not compatible with Symfony 3+, so I forked this repository for use it with Symfony 3+ until the official APYDataGrid repository support it. Please see [artscorestudio/APYDataGridBundle][2] for further informations.

[1]: https://github.com/APY/APYDataGridBundle
[2]: https://github.com/artscorestudio/APYDataGridBundle