# DGII Salvador 🇸🇻

Paquete para generar, firmar y enviar documentos tributarios electrónicos (DTE) (Factura, Nota de remisión, Nota crédito, Nota débito y Comprobante de retención) al DGII (El Salvador).

## Instalación

```bash
composer require dazza-dev/dgii-sv
```

## Autenticación

Para obtener el token de autenticación necesario para interactuar con los servicios de DGII:

```php
use DazzaDev\DgiiSv\Client;

// Crear una instancia del cliente
$client = new Client();

// Para ambiente de producción
$token = $client->auth('tu_usuario', 'tu_contraseña');

// Para ambiente de pruebas
$client->setTestMode(true);
$token = $client->auth('usuario_prueba', 'contraseña_prueba');
```

El método `auth()` retorna el token de autenticación que tiene una validez de **24 horas en producción** y **12 horas en ambiente de pruebas**.

## Uso

### Enviar un documento tributario electrónico (DTE)

Para enviar un documento tributario electrónico (DTE) como Factura, Nota de remisión, Nota crédito, Nota débito o Comprobante de retención.

### Obtener los listados

DGII tiene una lista de códigos que este paquete te pone a disposición para facilitar el trabajo de consultar esto en el anexo técnico:

```php
use DazzaDev\DgiiSv\Listing;

// Obtener los listados disponibles
$listings = Listing::getListings();

// Consultar los datos de un listado por tipo
$listingByType = Listing::getListing('tipos-documento');
```

## Contribuciones

Contribuciones son bienvenidas. Si encuentras algún error o tienes ideas para mejoras, por favor abre un issue o envía un pull request. Asegúrate de seguir las guías de contribución.

## Autor

DGII Salvador fue creado por [DAZZA](https://github.com/dazza-dev).

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
