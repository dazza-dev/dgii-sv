<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class ExportInvoice extends Document
{
    use JsonTrait;

    /**
     * ExportInvoice constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('11');
        $this->setVersion(1);

        // Initialize export invoice data
        parent::__construct($data);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $document = parent::toArray();

        // Remove fields
        unset($document['documentoRelacionado']);
        unset($document['extension']);

        // Identification
        unset($document['identificacion']['motivoContin']);
        $document['identificacion']['motivoContigencia'] = $this->getCustomReason();

        // Remove Receptor fields
        unset($document['receptor']['codActividad']);
        unset($document['receptor']['nrc']);
        unset($document['receptor']['direccion']);
        $document['receptor']['nombreComercial'] = $this->getReceiver()->getTradeName();

        // Address
        $address = $this->getReceiver()->getAddress();
        $document['receptor']['complemento'] = $address->getComplement();

        // Country
        $country = $address?->getCountry();
        $document['receptor']['codPais'] = $country?->getCode();
        $document['receptor']['nombrePais'] = $country?->getName();
        $document['receptor']['tipoPersona'] = (int) $this->getReceiver()->getPersonType()?->getCode();

        // Emisor
        $issuer = $this->getIssuer();
        $document['emisor']['tipoItemExpor'] = $issuer->getItemTypeCode();
        $document['emisor']['regimen'] = $issuer->getRegime()?->getCode();
        $document['emisor']['recintoFiscal'] = $issuer->getCustomsFacility()?->getCode();

        // Remove cuerpoDocumento fields
        foreach ($document['cuerpoDocumento'] as $key => $item) {
            unset($document['cuerpoDocumento'][$key]['tipoItem']);
            unset($document['cuerpoDocumento'][$key]['ivaItem']);
            unset($document['cuerpoDocumento'][$key]['ventaNoSuj']);
            unset($document['cuerpoDocumento'][$key]['ventaExenta']);
            unset($document['cuerpoDocumento'][$key]['psv']);
            unset($document['cuerpoDocumento'][$key]['codTributo']);
            unset($document['cuerpoDocumento'][$key]['numeroDocumento']);
        }

        // Remove Summary fields
        unset($document['resumen']['totalNoSuj']);
        unset($document['resumen']['descuNoSuj']);
        unset($document['resumen']['totalIva']);
        unset($document['resumen']['ivaRete1']);
        unset($document['resumen']['subTotalVentas']);
        unset($document['resumen']['subTotal']);
        unset($document['resumen']['reteRenta']);
        unset($document['resumen']['tributos']);
        unset($document['resumen']['descuExenta']);
        unset($document['resumen']['descuGravada']);
        unset($document['resumen']['saldoFavor']);
        unset($document['resumen']['totalExenta']);

        // Observations
        $document['resumen']['observaciones'] = $this->getSummary()->getObservations() ?? '';

        /*"observaciones":[
            "Campo descuento es requerido en #/resumen",
            "Campo codIncoterms es requerido en #/resumen",
            "Campo descIncoterms es requerido en #/resumen",
            "Campo flete es requerido en #/resumen",
            "Campo seguro es requerido en #/resumen"
        ]}
        */

        return $document;
    }
}
