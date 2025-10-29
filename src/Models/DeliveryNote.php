<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class DeliveryNote extends Document
{
    use JsonTrait;

    /**
     * DeliveryNote constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('04');
        $this->setVersion(3);

        // Initialize delivery note data
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

        //
        // Remove Receptor fields
        $document['receptor']['nombreComercial'] = $this->getReceiver()->getName();
        // $document['receptor']['bienTitulo'] = $this->getReceiver()->getGoodsTitle();

        // Remove cuerpoDocumento fields
        foreach ($document['cuerpoDocumento'] as $key => $item) {
            unset($document['cuerpoDocumento'][$key]['ivaItem']);
            unset($document['cuerpoDocumento'][$key]['noGravado']);
            unset($document['cuerpoDocumento'][$key]['psv']);
        }

        // Remove resumen fields
        unset($document['resumen']['totalIva']);
        unset($document['resumen']['ivaRete1']);
        unset($document['resumen']['reteRenta']);
        unset($document['resumen']['pagos']);
        unset($document['resumen']['numPagoElectronico']);
        unset($document['resumen']['totalNoGravado']);
        unset($document['resumen']['saldoFavor']);
        unset($document['resumen']['totalPagar']);
        unset($document['resumen']['condicionOperacion']);

        return $document;
    }
}
