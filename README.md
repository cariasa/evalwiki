Wiki Eval
=========

## Pasos para la correcta configuración
1. Instalar LAMP Server
⋅⋅⋅ * Para Debian y derivados puede hacerlo con `tasksel`. Aqui las [instrucciones](http://www.unixmen.com/install-lamp-with-1-command-in-ubuntu-1010-maverick-meerkat/)
2. Configurar el módulo 'mod_rewrite' de Apache
⋅⋅⋅ * Para Debian y derivados
⋅⋅⋅⋅⋅⋅ 1. Según la [estructura](http://wiki.apache.org/httpd/DistrosDefaultLayout#Debian.2C_Ubuntu_.28Apache_httpd_2.x.29:) publicada en la página de Apache, modifique el archivo `/etc/apache2/apache2.conf` para que cada `AllowOverride` esté en `All`.
⋅⋅⋅⋅⋅⋅ 2.
