# DGII Salvador 🇸🇻

Paquete para generar, firmar y enviar documentos tributarios electrónicos (DTE) (Factura, Nota de remisión, Nota crédito, Nota débito y Comprobante de retención) al DGII (El Salvador).

## Instalación

```bash
composer require dazza-dev/dgii-sv
```

## Uso

```php
use DazzaDev\DgiiSv\Client;

$client = new Client(true); // true (pruebas), false (producción)

// Configurar las credenciales del emisor
$client->setCredentials([
    'nit' => 'nit',
    'password' => 'clave_api',
]);

// Configurar el certificado y la clave privada del emisor
$client->setCertificate([
    'path' => '/ruta_del_certificado.crt',
    'password' => 'clave_privada',
]);

// Configurar la ruta donde se guardarán los documentos firmados
$client->setFilePath(__DIR__ . '/documentos');
```

### Enviar un documento tributario electrónico (DTE)

Para enviar un documento tributario electrónico (DTE) como Factura, Nota de remisión, Nota crédito, Nota débito o Comprobante de retención.

```php
// Configurar el tipo de documento tributario electrónico (DTE)
$client->setDocumentType('invoice');

// Configurar los datos del documento tributario electrónico (DTE)
$client->setDocumentData($documentData);

// Enviar el documento tributario electrónico (DTE)
$document = $client->sendDocument();
```

### Enviar documentos por lotes

Para enviar documentos tributarios electrónicos (DTE) en lotes.

```php
$document = $client->sendBatch(
    documentType: 'invoice',
    documents: $documents
);
```

### Buscar un documento tributario electrónico (DTE)

Para buscar un documento tributario electrónico (DTE) por tipo y código de generación.

```php
$search = $client->search(
    documentType: 'invoice',
    generationCode: '73BF2BF3-6C7B-4530-B1F6-6586906D5604'
);
```

### Buscar por lotes

```php
$search = $client->searchBatch(
    batchCode: 'batch_code'
);
```

### Invalidar un documento tributario electrónico (DTE)

Para invalidar un documento tributario electrónico (DTE) por tipo y código de generación.

```php
$client->setDocumentType('invalidation');
$client->setDocumentData($documentData);

$invalidate = $client->invalidateDocument();
```

### Evento de contingencia

Para enviar un evento de contingencia.

```php
$client->setDocumentType('contingency');
$client->setDocumentData($documentData);

$contingency = $client->contingencyEvent();
```

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

DGII El Salvador fue creado por [DAZZA](https://github.com/dazza-dev).

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
