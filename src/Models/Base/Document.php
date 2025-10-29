<?php

namespace DazzaDev\DgiiSv\Models\Base;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Body\AdditionalInfo;
use DazzaDev\DgiiSv\Models\Body\Extension\Extension;
use DazzaDev\DgiiSv\Models\Body\LineItem\LineItem;
use DazzaDev\DgiiSv\Models\Body\OtherDocument\OtherDocument;
use DazzaDev\DgiiSv\Models\Body\Payment\Payment;
use DazzaDev\DgiiSv\Models\Body\RelatedDocument;
use DazzaDev\DgiiSv\Models\Body\Summary;
use DazzaDev\DgiiSv\Models\Body\ThirdPartySale;
use DazzaDev\DgiiSv\Traits\ContingencyTypeTrait;
use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;
use DazzaDev\DgiiSv\Traits\IssuerTrait;
use DazzaDev\DgiiSv\Traits\ReceiverTrait;
use Luecano\NumeroALetras\NumeroALetras;

class Document extends DTEModel
{
    use ContingencyTypeTrait;
    use DocumentTypeTrait;
    use IssuerTrait;
    use ReceiverTrait;

    /**
     * Sequential Number (secuencial)
     */
    private ?int $sequentialNumber = null;

    /**
     * Billing Model (modelos-factura)
     */
    private ?BillingModel $billingModel = null;

    /**
     * Operation Type (tipos-transmision)
     */
    private ?OperationType $operationType = null;

    /**
     * Currency
     */
    private string $currency = 'USD';

    /**
     * Related document (documentoRelacionado)
     */
    private ?array $relatedDocuments = null;

    /**
     * Other documents (otrosDocumentos)
     *
     * @var OtherDocument[]
     */
    private array $otherDocuments = [];

    /**
     * Third party sale (ventaTercero)
     */
    private ?ThirdPartySale $thirdPartySale = null;

    /**
     * Line items information
     *
     * @var LineItem[]
     */
    private array $lineItems = [];

    /**
     * Payments
     */
    public ?array $payments = null;

    /**
     * Summary (resumen)
     */
    private ?Summary $summary = null;

    /**
     * Extension (extension)
     */
    private ?Extension $extension = null;

    /**
     * Additional information
     *
     * @var AdditionalInfo[]
     */
    private array $additionalInfo = [];

    /**
     * Document constructor
     *
     * @param  array  $data  DTE data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->initialize($data);
    }

    /**
     * Initialize document
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (isset($data['billing_model'])) {
            $this->setBillingModel((int) $data['billing_model']);
        }

        if (isset($data['operation_type'])) {
            $this->setOperationType((int) $data['operation_type']);
        }

        if (isset($data['sequential_number'])) {
            $this->setSequentialNumber((int) $data['sequential_number']);
        }

        if (isset($data['currency'])) {
            $this->setCurrency($data['currency']);
        }

        if (isset($data['issuer'])) {
            $this->setIssuer($data['issuer']);
        }

        if (isset($data['receiver'])) {
            $this->setReceiver($data['receiver']);
        }

        // Line items
        if (isset($data['line_items'])) {
            $this->setLineItems($data['line_items']);
        }

        // Additional info
        if (isset($data['additional_info'])) {
            $this->setAdditionalInfo($data['additional_info']);
        }

        // Related document
        if (isset($data['related_documents'])) {
            $this->setRelatedDocuments($data['related_documents']);
        }

        // Other documents
        if (isset($data['other_documents'])) {
            $this->setOtherDocuments($data['other_documents']);
        }

        // Third party sale
        if (isset($data['third_party_sale'])) {
            $this->setThirdPartySale($data['third_party_sale']);
        }

        // Payments
        if (isset($data['payments'])) {
            $this->setPayments($data['payments']);
        }

        // Summary
        if (isset($data['summary'])) {
            $this->setSummary($data['summary']);
        }

        // Extension
        if (isset($data['extension'])) {
            $this->setExtension($data['extension']);
        }
    }

    /**
     * Get Billing Model
     */
    public function getBillingModel(): ?BillingModel
    {
        return $this->billingModel;
    }

    /**
     * Set Billing Model (modelos-factura)
     */
    public function setBillingModel(int $billingModelCode): void
    {
        $data = (new DataLoader('modelos-factura'))->getByCode($billingModelCode);

        $this->billingModel = new BillingModel($data);
    }

    /**
     * Get Operation Type
     */
    public function getOperationType(): ?OperationType
    {
        return $this->operationType;
    }

    /**
     * Set Operation Type (tipos-transmision)
     */
    public function setOperationType(int $operationTypeCode): void
    {
        $data = (new DataLoader('tipos-transmision'))->getByCode($operationTypeCode);

        $this->operationType = new OperationType($data);
    }

    /**
     * Get Sequential Number
     */
    public function getSequentialNumber(): ?int
    {
        return $this->sequentialNumber;
    }

    /**
     * Set Sequential Number (secuencial)
     */
    public function setSequentialNumber(int $sequentialNumber): void
    {
        $this->sequentialNumber = $sequentialNumber;
    }

    /**
     * Get Control Number
     */
    public function getControlNumber(): string
    {
        $docType = $this->getDocumentType()?->getCode() ?? '';
        $estMh = $this->getIssuer()?->getEstablishment()?->getCode() ?? '';
        $ptvMh = $this->getIssuer()?->getSalePoint()?->getCode() ?? '';
        $seqStr = str_pad((string) $this->getSequentialNumber(), 15, '0', STR_PAD_LEFT);

        return 'DTE-'.$docType.'-'.$estMh.$ptvMh.'-'.$seqStr;
    }

    /**
     * Get currency
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Set currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * Get line items
     *
     * @return LineItem[]
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * Set line items
     */
    public function setLineItems(array $lineItems): void
    {
        foreach ($lineItems as $key => $lineItem) {
            $lineItem['item_number'] = $key + 1;
            $this->addLineItem($lineItem);
        }
    }

    /**
     * Add line item
     */
    public function addLineItem(array|LineItem $lineItem): void
    {
        $this->lineItems[] = $lineItem instanceof LineItem ? $lineItem : new LineItem($lineItem);
    }

    /**
     * Get additional info
     *
     * @return AdditionalInfo[]
     */
    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }

    /**
     * Set additional info
     */
    public function setAdditionalInfo(array $additionalInfo): void
    {
        $this->additionalInfo = [];
        foreach ($additionalInfo as $info) {
            $this->addAdditionalInfo($info);
        }
    }

    /**
     * Add additional info item
     */
    public function addAdditionalInfo(array|AdditionalInfo $info): void
    {
        $this->additionalInfo[] = $info instanceof AdditionalInfo ? $info : new AdditionalInfo($info);
    }

    /**
     * Get related document
     */
    public function getRelatedDocuments(): ?array
    {
        return $this->relatedDocuments;
    }

    /**
     * Set related document
     */
    public function setRelatedDocuments(array $relatedDocuments): void
    {
        foreach ($relatedDocuments as $relatedDocument) {
            $this->addRelatedDocument($relatedDocument);
        }
    }

    /**
     * Set related document
     */
    public function addRelatedDocument(array|RelatedDocument $relatedDocument): void
    {
        $this->relatedDocuments[] = $relatedDocument instanceof RelatedDocument ? $relatedDocument : new RelatedDocument($relatedDocument);
    }

    /**
     * Get other documents
     *
     * @return OtherDocument[]
     */
    public function getOtherDocuments(): array
    {
        return $this->otherDocuments;
    }

    /**
     * Set other documents
     */
    public function setOtherDocuments(array $otherDocuments): void
    {
        $this->otherDocuments = [];
        foreach ($otherDocuments as $doc) {
            $this->addOtherDocument($doc);
        }
    }

    /**
     * Add other document item
     */
    public function addOtherDocument(array|OtherDocument $otherDocument): void
    {
        $this->otherDocuments[] = $otherDocument instanceof OtherDocument ? $otherDocument : new OtherDocument($otherDocument);
    }

    /**
     * Get third party sale
     */
    public function getThirdPartySale(): ?ThirdPartySale
    {
        return $this->thirdPartySale;
    }

    /**
     * Set third party sale
     */
    public function setThirdPartySale(array|ThirdPartySale $thirdPartySale): void
    {
        $this->thirdPartySale = $thirdPartySale instanceof ThirdPartySale ? $thirdPartySale : new ThirdPartySale($thirdPartySale);
    }

    /**
     * Get summary
     */
    public function getSummary(): ?Summary
    {
        return $this->summary;
    }

    /**
     * Set summary
     */
    public function setSummary(array|Summary $summary): void
    {
        $this->summary = $summary instanceof Summary ? $summary : new Summary($summary);
    }

    /**
     * Get extension
     */
    public function getExtension(): ?Extension
    {
        return $this->extension;
    }

    /**
     * Set extension
     */
    public function setExtension(array|Extension $extension): void
    {
        $this->extension = $extension instanceof Extension ? $extension : new Extension($extension);
    }

    /**
     * Set contingency type
     */
    public function setContingency(array $contingency): void
    {
        if (isset($contingency['type']) && $contingency['type']) {
            $this->setContingencyType($contingency['type']);
        }

        if (isset($contingency['reason']) && $contingency['reason']) {
            $this->setContingencyReason($contingency['reason']);
        }
    }

    /**
     * Get payments
     */
    public function getPayments(): ?array
    {
        return $this->payments;
    }

    /**
     * Set payments
     */
    public function setPayments(array $payments): void
    {
        foreach ($payments as $payment) {
            $this->addPayment($payment);
        }
    }

    /**
     * Add payment
     */
    public function addPayment(array|Payment $payment): void
    {
        $this->payments[] = $payment instanceof Payment ? $payment : new Payment($payment);
    }

    /**
     * Get total in words
     */
    public function getTotalInWords(): ?string
    {
        if ($this->getSummary()->getTotal() === 0) {
            return null;
        }

        return (new NumeroALetras)->toMoney($this->getSummary()->getTotal(), 2, $this->getCurrency());
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $identification = [
            'version' => $this->getVersion(),
            'ambiente' => $this->getEnvironment()['code'],
            'tipoDte' => $this->getDocumentType()->getCode(),
            'numeroControl' => $this->getControlNumber(),
            'codigoGeneracion' => $this->getGenerationCode(),
            'tipoModelo' => (int) $this->getBillingModel()->getCode(),
            'tipoOperacion' => (int) $this->getOperationType()->getCode(),
            'tipoContingencia' => $this->getContingencyTypeCode(),
            'motivoContin' => $this->getCustomReason(),
            'fecEmi' => $this->getIssueDate(),
            'horEmi' => $this->getIssueTime(),
            'tipoMoneda' => $this->getCurrency(),
        ];

        $otherDocuments = null;
        if (! empty($this->getOtherDocuments())) {
            $otherDocuments = array_map(fn (OtherDocument $doc) => $doc->toArray(), $this->getOtherDocuments());
        }

        // Related Documents
        $relatedDocuments = null;
        if (! empty($this->getRelatedDocuments())) {
            $relatedDocuments = array_map(fn (RelatedDocument $doc) => $doc->toArray(), $this->getRelatedDocuments());
        }

        //
        $document = [
            'identificacion' => $identification,
            'emisor' => $this->getIssuer()?->toArray(),
            'receptor' => $this->getReceiver()?->toArray(),
            'documentoRelacionado' => $relatedDocuments,
            'otrosDocumentos' => $otherDocuments,
            'ventaTercero' => $this->getThirdPartySale()?->toArray(),
            'cuerpoDocumento' => array_map(fn (LineItem $lineItem) => $lineItem->toArray(), $this->getLineItems()),
            'resumen' => $this->getSummary()?->toArray(),
            'extension' => $this->getExtension()?->toArray(),
        ];

        // Total in words
        $document['resumen']['totalLetras'] = $this->getTotalInWords();

        // Payments
        $document['resumen']['pagos'] = array_map(fn (Payment $payment) => $payment->toArray(), $this->getPayments() ?? []);

        // Appendices
        if (! empty($this->getAdditionalInfo())) {
            $document['apendice'] = array_map(fn (AdditionalInfo $info) => $info->toArray(), $this->getAdditionalInfo());
        }

        return $document;
    }
}
