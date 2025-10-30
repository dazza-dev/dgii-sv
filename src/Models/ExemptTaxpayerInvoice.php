<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class ExemptTaxpayerInvoice extends Document
{
    use JsonTrait;

    /**
     * ExemptTaxpayerInvoice constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('14');
        $this->setVersion(1);

        // Initialize exempt taxpayer invoice data
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
        unset($document['ventaTercero']);
        unset($document['documentoRelacionado']);
        unset($document['extension']);

        // Remove cuerpoDocumento fields
        foreach ($document['cuerpoDocumento'] as $key => $item) {
            unset($document['cuerpoDocumento'][$key]['ventaGravada']);
            unset($document['cuerpoDocumento'][$key]['ivaItem']);
            unset($document['cuerpoDocumento'][$key]['ventaNoSuj']);

            unset($document['cuerpoDocumento'][$key]['ventaExenta']);
            unset($document['cuerpoDocumento'][$key]['tributos']);
            unset($document['cuerpoDocumento'][$key]['noGravado']);
            unset($document['cuerpoDocumento'][$key]['psv']);
            unset($document['cuerpoDocumento'][$key]['codTributo']);
            unset($document['cuerpoDocumento'][$key]['numeroDocumento']);
        }

        // Remove summary fields
        unset($document['resumen']['totalNoSuj']);
        unset($document['resumen']['descuNoSuj']);
        unset($document['resumen']['totalIva']);
        unset($document['resumen']['subTotalVentas']);
        unset($document['resumen']['tributos']);
        unset($document['resumen']['descuExenta']);
        unset($document['resumen']['numPagoElectronico']);
        unset($document['resumen']['descuGravada']);
        unset($document['resumen']['porcentajeDescuento']);
        unset($document['resumen']['totalGravada']);
        unset($document['resumen']['montoTotalOperacion']);
        unset($document['resumen']['totalNoGravado']);
        unset($document['resumen']['saldoFavor']);
        unset($document['resumen']['totalExenta']);

        /*"observaciones":[
            "Campo sujetoExcluido es requerido en #",
            "Campo receptor no esta permitido en #",
            "Campo totalCompra es requerido en #/resumen",
            "Campo descu es requerido en #/resumen",
            "Campo observaciones es requerido en #/resumen",
            "Campo compra es requerido en #/cuerpoDocumento/0",
            "Campo compra es requerido en #/cuerpoDocumento/1"
        ]}*/

        return $document;
    }
}
