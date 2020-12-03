# sistema_validade
Sistema para controlar vencimentos de produtos

## Links úteis
1. [Adicionar certificado SSL/HTTPS no Windows com XAMPP](https://www.webig.pro.br/certificado-ssl-https-windows-xampp/)
1. [Exportação e importação de certificados autoassinados no Chrome](https://www.pico.net/kb/how-do-you-get-chrome-to-accept-a-self-signed-certificate)

#### Adicionar o seguinte código no final do arquivo *httpd-vhosts.conf* para redirecionar HTTP para HTTPS
```
<VirtualHost *:80>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}
</VirtualHost>
```