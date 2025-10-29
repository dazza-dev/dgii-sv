<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class TaxCreditInvoice extends Document
{
    use JsonTrait;

    /**
     * TaxCreditInvoice constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('03');
        $this->setVersion(3);

        // Initialize tax credit invoice data
        parent::__construct($data);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $document = parent::toArray();

        // Remove Receptor fields
        unset($document['receptor']['tipoDocumento']);
        unset($document['receptor']['numDocumento']);
        $document['receptor']['nit'] = $this->getReceiver()->getIdentificationNumber();
        $document['receptor']['nombreComercial'] = $this->getReceiver()->getName();

        // Remove cuerpoDocumento fields
        foreach ($document['cuerpoDocumento'] as $key => $item) {
            unset($document['cuerpoDocumento'][$key]['ivaItem']);
        }

        // Remove resumen fields
        unset($document['resumen']['totalIva']);
        $document['resumen']['ivaPerci1'] = $this->getSummary()->getIvaWithheld();

        return $document;
    }
}
