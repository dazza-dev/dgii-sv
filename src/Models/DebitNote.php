<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class DebitNote extends Document
{
    use JsonTrait;

    /**
     * DebitNote constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('06');
        $this->setVersion(3);

        // Initialize debit note data
        parent::__construct($data);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $document = parent::toArray();

        // Remove other documents
        unset($document['otrosDocumentos']);
        unset($document['extension']['placaVehiculo']);

        // Remove codEstableMH and codEstable
        unset($document['emisor']['codEstableMH']);
        unset($document['emisor']['codEstable']);
        unset($document['emisor']['codPuntoVentaMH']);
        unset($document['emisor']['codPuntoVenta']);

        // Remove Receptor fields
        unset($document['receptor']['tipoDocumento']);
        unset($document['receptor']['numDocumento']);
        $document['receptor']['nit'] = $this->getReceiver()->getIdentificationNumber();
        $document['receptor']['nombreComercial'] = $this->getReceiver()->getName();

        // Remove cuerpoDocumento fields
        foreach ($document['cuerpoDocumento'] as $key => $item) {
            unset($document['cuerpoDocumento'][$key]['ivaItem']);
            unset($document['cuerpoDocumento'][$key]['noGravado']);
            unset($document['cuerpoDocumento'][$key]['psv']);
        }

        // Remove resumen fields
        unset($document['resumen']['pagos']);
        // unset($document['resumen']['numPagoElectronico']);
        unset($document['resumen']['totalNoGravado']);
        unset($document['resumen']['saldoFavor']);
        unset($document['resumen']['totalIva']);
        unset($document['resumen']['porcentajeDescuento']);
        unset($document['resumen']['totalPagar']);
        $document['resumen']['ivaPerci1'] = $this->getSummary()->getIvaWithheld();

        return $document;
    }
}
