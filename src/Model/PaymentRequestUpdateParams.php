<?php

/**
 * PaymentRequestUpdateParams.
 *
 * PHP version 7.3
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */

/**
 * freee会計 API.
 *
 * <hr /> <h2 id=\"start_guide\">スタートガイド</h2>  <p>freee API開発がはじめての方は<a href=\"https://developer.freee.co.jp/getting-started\">freee API スタートガイド</a>を参照してください。</p>  <hr /> <h2 id=\"specification\">お知らせ</h2>  <p> <b>インボイス制度に伴い、freee会計の帳票機能がfreee請求書に移行します。これに伴い、2023年10月にfreee会計の「請求書の作成、見積書の作成」エンドポイントは廃止、freee請求書APIに移行する予定です。詳細は<a href=\"https://developer.freee.co.jp/news/6369\" target=\"_blank\"> freee会計 APIの仕様変更（インボイス制度対応）について</a>をご確認ください。</b> </p>  <h2 id=\"specification\">仕様</h2>  <h3 id=\"api_endpoint\">APIエンドポイント</h3>  <p>https://api.freee.co.jp/ (httpsのみ)</p>  <h3 id=\"about_authorize\">認証について</h3> <p>OAuth2.0を利用します。<a href=\"https://developer.freee.co.jp/reference/#%e8%aa%8d%e8%a8%bc\" target=\"_blank\">詳細はリファレンスの認証に関する記載を参照してください。</a></p>  <h3 id=\"data_format\">データフォーマット</h3>  <p>リクエスト、レスポンスともにJSON形式をサポートしていますが、詳細は、API毎の説明欄（application/jsonなど）を確認してください。</p>  <h3 id=\"compatibility\">後方互換性ありの変更</h3>  <p>freeeでは、APIを改善していくために以下のような変更は後方互換性ありとして通知なく変更を入れることがあります。アプリケーション実装者は以下を踏まえて開発を行ってください。</p>  <ul> <li>新しいAPIリソース・エンドポイントの追加</li> <li>既存のAPIに対して必須ではない新しいリクエストパラメータの追加</li> <li>既存のAPIレスポンスに対する新しいプロパティの追加</li> <li>既存のAPIレスポンスに対するプロパティの順番の入れ変え</li> <li>keyとなっているidやcodeの長さの変更（長くする）</li> <li>エラーメッセージの変更</li> </ul>  <h3 id=\"common_response_header\">共通レスポンスヘッダー</h3>  <p>すべてのAPIのレスポンスには以下のHTTPヘッダーが含まれます。</p>  <ul> <li> <p>X-Freee-Request-ID</p> <ul> <li>各リクエスト毎に発行されるID</li> </ul> </li> </ul>  <h3 id=\"common_error_response\">共通エラーレスポンス</h3>  <ul> <li> <p>ステータスコードはレスポンス内のJSONに含まれる他、HTTPヘッダにも含まれる</p> </li> <li> <p>一部のエラーレスポンスにはエラーコードが含まれます。<br>詳細は、<a href=\"https://developer.freee.co.jp/tips/faq/40x-checkpoint\">HTTPステータスコード400台エラー時のチェックポイント</a>を参照してください</p> </li> <p>type</p>  <ul> <li>status : HTTPステータスコードの説明</li>  <li>validation : エラーの詳細の説明（開発者向け）</li> </ul> </li> </ul>  <p>レスポンスの例</p>  <pre><code>  {     &quot;status_code&quot; : 400,     &quot;errors&quot; : [       {         &quot;type&quot; : &quot;status&quot;,         &quot;messages&quot; : [&quot;不正なリクエストです。&quot;]       },       {         &quot;type&quot; : &quot;validation&quot;,         &quot;messages&quot; : [&quot;Date は不正な日付フォーマットです。入力例：2019-12-17&quot;]       }     ]   }</code></pre>  </br>  <h3 id=\"api_rate_limit\">API 使用制限</h3>    <p>freeeは一定期間に過度のアクセスを検知した場合、APIアクセスをコントロールする場合があります。</p>   <p>その際のhttp status codeは403となります。制限がかかってから10分程度が過ぎると再度使用することができるようになります。</p>  <h4 id=\"reports_api_endpoint\">/reportsと/receipts/{id}/downloadエンドポイント</h4>  <p>freeeはエンドポイント毎に一定頻度以上のアクセスを検知した場合、APIアクセスをコントロールする場合があります。その際のhttp status codeは429（too many requests）となります。</p> <ul>   <li>/reports:1秒に10回まで</li>   <li>/receipts/{id}/download:1秒に3回まで</li> </ul>  <p>http status codeが429となった場合、API使用ステータスはレスポンスヘッダに付与されます。</p> <pre><code>x-ratelimit-limit:10 x-ratelimit-remaining:1 x-ratelimit-reset:2023-01-13T10:22:29+09:00 </code></pre>  <br> 各ヘッダの意味は次のとおりです。</p>  <table border=\"1\">   <tbody>     <tr>       <th style=\"padding: 10px\"><strong>ヘッダ名</strong></th>       <th style=\"padding: 10px\"><strong>説明</strong></th>     </tr>     <tr><td style=\"padding: 10px\">x-ratelimit-limit</td><td style=\"padding: 10px\">使用回数の上限</td></tr>     <tr><td style=\"padding: 10px\">x-ratelimit-remaining</td><td style=\"padding: 10px\">残り使用回数</td></tr>     <tr><td style=\"padding: 10px\">x-ratelimit-reset</td><td style=\"padding: 10px\">使用回数がリセットされる時刻</td></tr>   </tbody> </table>  </br>  <h3 id=\"plan_api_rate_limit\">プランごとの API 使用制限</h3>   <table border=\"1\">     <tbody>       <tr>         <th style=\"padding: 10px\"><strong>freee会計プラン名</strong></th>         <th style=\"padding: 10px\"><strong>事業所とアプリケーション毎に、1日のAPIコール数の上限</strong></th>       </tr>       <tr>         <td style=\"padding: 10px\">法人エンタープライズプラン</td>         <td style=\"padding: 10px\">10,000</td>       </tr>       <tr>         <td style=\"padding: 10px\">法人アドバンスプラン（および旧法人プロフェッショナルプラン）</td>         <td style=\"padding: 10px\">5,000</td>       </tr>       <tr>         <td style=\"padding: 10px\">上記以外</td>         <td style=\"padding: 10px\">3,000</td>       </tr>     </tbody>   </table>  <h3 id=\"available_apis_by_plan\">プランごとの利用可能 API</h3> <p>契約プランごとにご利用可能な freee 会計 API は異なります。 freee 会計の Web 版でご利用いただける機能について、 freee 会計 API でもご利用いただけます。</p> <p>例えば法人スタータープラン、旧法人ベーシックプランをご契約いただいている場合、 Web 版では経費精算機能をご利用いただけますので、 API でも経費精算 API をご利用可能です。</p> <p>ただし以下の API は例外です。</p> <ul>   <li>総勘定元帳API：旧法人プロフェッショナルプラン、旧法人エンタープライズプラン、法人アドバンスプラン、新法人エンタープライズプランに加入している事業所のみがご利用可能です。</li>   <li>固定資産台帳API：旧法人エンタープライズプラン、新法人エンタープライズプランに加入している事業所のみがご利用可能です。</li> </ul> <p>詳しくは、<a href=\"https://support.freee.co.jp/hc/ja/articles/213726523--個人-freee会計のプランについて\" target=\"_blank\">【個人】freee会計のプランについて</a> 並びに <a href=\"https://support.freee.co.jp/hc/ja/articles/202849000--法人-freee会計のプランについて\" target=\"_blank\">【法人】freee会計のプランについて</a>をご確認ください。</p>  <h3 id=\"available_parameters_by_plan\">プランごとの利用可能パラメータ</h3> <p>ご利用可能な freee 会計 API であっても、契約プランごとに利用可能なパラメータは異なります。</p> <table border=\"1\">   <thead>     <tr>       <th>パラメータ</th>       <th>説明</th>       <th>利用可能プラン</th>     </tr>   </thead>   <tbody>     <tr>       <td>segment_1_tag</td>       <td>セグメント１タグ</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン</td>     </tr>     <tr>       <td>segment_2_tag</td>       <td>セグメント２タグ</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_3_tag</td>       <td>セグメント３タグ</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_1_tag_id</td>       <td>セグメント１タグID</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン</td>     </tr>     <tr>       <td>segment_2_tag_id</td>       <td>セグメント２タグID</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_3_tag_id</td>       <td>セグメント３タグID</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_1_tag_name</td>       <td>セグメント１タグ名</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン</td>     </tr>     <tr>       <td>segment_2_tag_name</td>       <td>セグメント２タグ名</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_3_tag_name</td>       <td>セグメント３タグ名</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_id</td>       <td>セグメントID（1, 2, 3 のいずれか）</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン<br />旧法人プロフェッショナルプランにつきましては、 1 のみ指定可能です。</td>     </tr>   </tbody> </table>  <h3 id=\"webhook\">Webhookについて</h3>  <p>詳細は<a href=\"https://developer.freee.co.jp/docs/accounting/webhook\" target=\"_blank\">会計Webhook概要</a>を参照してください。</p>  <hr /> <h2 id=\"contact\">連絡先</h2>  <p>ご不明点、ご要望等は <a href=\"https://freee.my.site.com/HelpCenter/s\">freee サポートデスクへのお問い合わせフォーム</a> からご連絡ください。</p> <hr />&copy; Since 2013 freee K.K.
 *
 * The version of the OpenAPI document: v1.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */
namespace OpenAPI\Client\Model;

use ArrayAccess;
use OpenAPI\Client\ObjectSerializer;

/**
 * PaymentRequestUpdateParams Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 *
 * @implements \ArrayAccess<TKey, TValue>
 *
 * @template TKey int|null
 * @template TValue mixed|null
 */
class PaymentRequestUpdateParams implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'paymentRequestUpdateParams';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'company_id'               => 'int',
        'title'                    => 'string',
        'application_date'         => 'string',
        'description'              => 'string',
        'payment_request_lines'    => '\OpenAPI\Client\Model\PaymentRequestUpdateParamsPaymentRequestLines[]',
        'approver_id'              => 'int',
        'approval_flow_route_id'   => 'int',
        'draft'                    => 'bool',
        'document_code'            => 'string',
        'receipt_ids'              => 'int[]',
        'issue_date'               => 'string',
        'payment_date'             => 'string',
        'payment_method'           => 'string',
        'partner_id'               => 'int',
        'partner_code'             => 'string',
        'bank_code'                => 'string',
        'bank_name'                => 'string',
        'bank_name_kana'           => 'string',
        'branch_code'              => 'string',
        'branch_name'              => 'string',
        'branch_kana'              => 'string',
        'account_name'             => 'string',
        'account_number'           => 'string',
        'account_type'             => 'string',
        'qualified_invoice_status' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @var string[]
     *
     * @phpstan-var array<string, string|null>
     *
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'company_id'               => 'int64',
        'title'                    => null,
        'application_date'         => null,
        'description'              => null,
        'payment_request_lines'    => null,
        'approver_id'              => 'int64',
        'approval_flow_route_id'   => 'int64',
        'draft'                    => null,
        'document_code'            => null,
        'receipt_ids'              => 'int64',
        'issue_date'               => null,
        'payment_date'             => null,
        'payment_method'           => null,
        'partner_id'               => 'int64',
        'partner_code'             => null,
        'bank_code'                => null,
        'bank_name'                => null,
        'bank_name_kana'           => null,
        'branch_code'              => null,
        'branch_name'              => null,
        'branch_kana'              => null,
        'account_name'             => null,
        'account_number'           => null,
        'account_type'             => null,
        'qualified_invoice_status' => null,
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'company_id'               => 'company_id',
        'title'                    => 'title',
        'application_date'         => 'application_date',
        'description'              => 'description',
        'payment_request_lines'    => 'payment_request_lines',
        'approver_id'              => 'approver_id',
        'approval_flow_route_id'   => 'approval_flow_route_id',
        'draft'                    => 'draft',
        'document_code'            => 'document_code',
        'receipt_ids'              => 'receipt_ids',
        'issue_date'               => 'issue_date',
        'payment_date'             => 'payment_date',
        'payment_method'           => 'payment_method',
        'partner_id'               => 'partner_id',
        'partner_code'             => 'partner_code',
        'bank_code'                => 'bank_code',
        'bank_name'                => 'bank_name',
        'bank_name_kana'           => 'bank_name_kana',
        'branch_code'              => 'branch_code',
        'branch_name'              => 'branch_name',
        'branch_kana'              => 'branch_kana',
        'account_name'             => 'account_name',
        'account_number'           => 'account_number',
        'account_type'             => 'account_type',
        'qualified_invoice_status' => 'qualified_invoice_status',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'company_id'               => 'setCompanyId',
        'title'                    => 'setTitle',
        'application_date'         => 'setApplicationDate',
        'description'              => 'setDescription',
        'payment_request_lines'    => 'setPaymentRequestLines',
        'approver_id'              => 'setApproverId',
        'approval_flow_route_id'   => 'setApprovalFlowRouteId',
        'draft'                    => 'setDraft',
        'document_code'            => 'setDocumentCode',
        'receipt_ids'              => 'setReceiptIds',
        'issue_date'               => 'setIssueDate',
        'payment_date'             => 'setPaymentDate',
        'payment_method'           => 'setPaymentMethod',
        'partner_id'               => 'setPartnerId',
        'partner_code'             => 'setPartnerCode',
        'bank_code'                => 'setBankCode',
        'bank_name'                => 'setBankName',
        'bank_name_kana'           => 'setBankNameKana',
        'branch_code'              => 'setBranchCode',
        'branch_name'              => 'setBranchName',
        'branch_kana'              => 'setBranchKana',
        'account_name'             => 'setAccountName',
        'account_number'           => 'setAccountNumber',
        'account_type'             => 'setAccountType',
        'qualified_invoice_status' => 'setQualifiedInvoiceStatus',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'company_id'               => 'getCompanyId',
        'title'                    => 'getTitle',
        'application_date'         => 'getApplicationDate',
        'description'              => 'getDescription',
        'payment_request_lines'    => 'getPaymentRequestLines',
        'approver_id'              => 'getApproverId',
        'approval_flow_route_id'   => 'getApprovalFlowRouteId',
        'draft'                    => 'getDraft',
        'document_code'            => 'getDocumentCode',
        'receipt_ids'              => 'getReceiptIds',
        'issue_date'               => 'getIssueDate',
        'payment_date'             => 'getPaymentDate',
        'payment_method'           => 'getPaymentMethod',
        'partner_id'               => 'getPartnerId',
        'partner_code'             => 'getPartnerCode',
        'bank_code'                => 'getBankCode',
        'bank_name'                => 'getBankName',
        'bank_name_kana'           => 'getBankNameKana',
        'branch_code'              => 'getBranchCode',
        'branch_name'              => 'getBranchName',
        'branch_kana'              => 'getBranchKana',
        'account_name'             => 'getAccountName',
        'account_number'           => 'getAccountNumber',
        'account_type'             => 'getAccountType',
        'qualified_invoice_status' => 'getQualifiedInvoiceStatus',
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const PAYMENT_METHOD_NONE                    = 'none';
    const PAYMENT_METHOD_DOMESTIC_BANK_TRANSFER  = 'domestic_bank_transfer';
    const PAYMENT_METHOD_ABROAD_BANK_TRANSFER    = 'abroad_bank_transfer';
    const PAYMENT_METHOD_ACCOUNT_TRANSFER        = 'account_transfer';
    const PAYMENT_METHOD_CREDIT_CARD             = 'credit_card';
    const ACCOUNT_TYPE_ORDINARY                  = 'ordinary';
    const ACCOUNT_TYPE_CHECKING                  = 'checking';
    const ACCOUNT_TYPE_EARMARKED                 = 'earmarked';
    const ACCOUNT_TYPE_SAVINGS                   = 'savings';
    const ACCOUNT_TYPE_OTHER                     = 'other';
    const QUALIFIED_INVOICE_STATUS_QUALIFIED     = 'qualified';
    const QUALIFIED_INVOICE_STATUS_NOT_QUALIFIED = 'not_qualified';
    const QUALIFIED_INVOICE_STATUS_UNSPECIFIED   = 'unspecified';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getPaymentMethodAllowableValues()
    {
        return [
            self::PAYMENT_METHOD_NONE,
            self::PAYMENT_METHOD_DOMESTIC_BANK_TRANSFER,
            self::PAYMENT_METHOD_ABROAD_BANK_TRANSFER,
            self::PAYMENT_METHOD_ACCOUNT_TRANSFER,
            self::PAYMENT_METHOD_CREDIT_CARD,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getAccountTypeAllowableValues()
    {
        return [
            self::ACCOUNT_TYPE_ORDINARY,
            self::ACCOUNT_TYPE_CHECKING,
            self::ACCOUNT_TYPE_EARMARKED,
            self::ACCOUNT_TYPE_SAVINGS,
            self::ACCOUNT_TYPE_OTHER,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getQualifiedInvoiceStatusAllowableValues()
    {
        return [
            self::QUALIFIED_INVOICE_STATUS_QUALIFIED,
            self::QUALIFIED_INVOICE_STATUS_NOT_QUALIFIED,
            self::QUALIFIED_INVOICE_STATUS_UNSPECIFIED,
        ];
    }

    /**
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor.
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['company_id']               = $data['company_id'] ?? null;
        $this->container['title']                    = $data['title'] ?? null;
        $this->container['application_date']         = $data['application_date'] ?? null;
        $this->container['description']              = $data['description'] ?? null;
        $this->container['payment_request_lines']    = $data['payment_request_lines'] ?? null;
        $this->container['approver_id']              = $data['approver_id'] ?? null;
        $this->container['approval_flow_route_id']   = $data['approval_flow_route_id'] ?? null;
        $this->container['draft']                    = $data['draft'] ?? null;
        $this->container['document_code']            = $data['document_code'] ?? null;
        $this->container['receipt_ids']              = $data['receipt_ids'] ?? null;
        $this->container['issue_date']               = $data['issue_date'] ?? null;
        $this->container['payment_date']             = $data['payment_date'] ?? null;
        $this->container['payment_method']           = $data['payment_method'] ?? null;
        $this->container['partner_id']               = $data['partner_id'] ?? null;
        $this->container['partner_code']             = $data['partner_code'] ?? null;
        $this->container['bank_code']                = $data['bank_code'] ?? null;
        $this->container['bank_name']                = $data['bank_name'] ?? null;
        $this->container['bank_name_kana']           = $data['bank_name_kana'] ?? null;
        $this->container['branch_code']              = $data['branch_code'] ?? null;
        $this->container['branch_name']              = $data['branch_name'] ?? null;
        $this->container['branch_kana']              = $data['branch_kana'] ?? null;
        $this->container['account_name']             = $data['account_name'] ?? null;
        $this->container['account_number']           = $data['account_number'] ?? null;
        $this->container['account_type']             = $data['account_type'] ?? null;
        $this->container['qualified_invoice_status'] = $data['qualified_invoice_status'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['company_id'] === null) {
            $invalidProperties[] = "'company_id' can't be null";
        }
        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
        if ($this->container['payment_request_lines'] === null) {
            $invalidProperties[] = "'payment_request_lines' can't be null";
        }
        if (!is_null($this->container['approver_id']) && ($this->container['approver_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'approver_id', must be bigger than or equal to 1.";
        }

        if ($this->container['approval_flow_route_id'] === null) {
            $invalidProperties[] = "'approval_flow_route_id' can't be null";
        }
        if (($this->container['approval_flow_route_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'approval_flow_route_id', must be bigger than or equal to 1.";
        }

        if ($this->container['draft'] === null) {
            $invalidProperties[] = "'draft' can't be null";
        }
        if (!is_null($this->container['document_code']) && (mb_strlen($this->container['document_code']) > 255)) {
            $invalidProperties[] = "invalid value for 'document_code', the character length must be smaller than or equal to 255.";
        }

        if ($this->container['issue_date'] === null) {
            $invalidProperties[] = "'issue_date' can't be null";
        }
        $allowedValues = $this->getPaymentMethodAllowableValues();
        if (!is_null($this->container['payment_method']) && !in_array($this->container['payment_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_method', must be one of '%s'",
                $this->container['payment_method'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['partner_id']) && ($this->container['partner_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'partner_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['bank_code']) && (mb_strlen($this->container['bank_code']) > 4)) {
            $invalidProperties[] = "invalid value for 'bank_code', the character length must be smaller than or equal to 4.";
        }

        if (!is_null($this->container['bank_name']) && (mb_strlen($this->container['bank_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['bank_name_kana']) && (mb_strlen($this->container['bank_name_kana']) > 15)) {
            $invalidProperties[] = "invalid value for 'bank_name_kana', the character length must be smaller than or equal to 15.";
        }

        if (!is_null($this->container['branch_code']) && (mb_strlen($this->container['branch_code']) > 3)) {
            $invalidProperties[] = "invalid value for 'branch_code', the character length must be smaller than or equal to 3.";
        }

        if (!is_null($this->container['branch_name']) && (mb_strlen($this->container['branch_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'branch_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['branch_kana']) && (mb_strlen($this->container['branch_kana']) > 15)) {
            $invalidProperties[] = "invalid value for 'branch_kana', the character length must be smaller than or equal to 15.";
        }

        if (!is_null($this->container['account_name']) && (mb_strlen($this->container['account_name']) > 48)) {
            $invalidProperties[] = "invalid value for 'account_name', the character length must be smaller than or equal to 48.";
        }

        if (!is_null($this->container['account_number']) && (mb_strlen($this->container['account_number']) > 7)) {
            $invalidProperties[] = "invalid value for 'account_number', the character length must be smaller than or equal to 7.";
        }

        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!is_null($this->container['account_type']) && !in_array($this->container['account_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'account_type', must be one of '%s'",
                $this->container['account_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getQualifiedInvoiceStatusAllowableValues();
        if (!is_null($this->container['qualified_invoice_status']) && !in_array($this->container['qualified_invoice_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'qualified_invoice_status', must be one of '%s'",
                $this->container['qualified_invoice_status'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed.
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets company_id.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id.
     *
     * @param int $company_id 事業所ID
     *
     * @return self
     */
    public function setCompanyId($company_id)
    {
        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title.
     *
     * @param string $title 申請タイトル<br> 申請者が、下書き状態もしくは差戻し状態の支払依頼に対して指定する場合のみ有効
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets application_date.
     *
     * @return string|null
     */
    public function getApplicationDate()
    {
        return $this->container['application_date'];
    }

    /**
     * Sets application_date.
     *
     * @param string|null $application_date 申請日 (yyyy-mm-dd)<br> 指定しない場合は当日の日付が登録されます。<br> 申請者が、下書き状態もしくは差戻し状態の支払依頼に対して指定する場合のみ有効
     *
     * @return self
     */
    public function setApplicationDate($application_date)
    {
        $this->container['application_date'] = $application_date;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description.
     *
     * @param string|null $description 備考
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets payment_request_lines.
     *
     * @return \OpenAPI\Client\Model\PaymentRequestUpdateParamsPaymentRequestLines[]
     */
    public function getPaymentRequestLines()
    {
        return $this->container['payment_request_lines'];
    }

    /**
     * Sets payment_request_lines.
     *
     * @param \OpenAPI\Client\Model\PaymentRequestUpdateParamsPaymentRequestLines[] $payment_request_lines 支払依頼の項目行一覧（配列）
     *
     * @return self
     */
    public function setPaymentRequestLines($payment_request_lines)
    {
        $this->container['payment_request_lines'] = $payment_request_lines;

        return $this;
    }

    /**
     * Gets approver_id.
     *
     * @return int|null
     */
    public function getApproverId()
    {
        return $this->container['approver_id'];
    }

    /**
     * Sets approver_id.
     *
     * @param int|null $approver_id 承認者のユーザーID<br> 「承認者を指定」の経路を申請経路として使用する場合に指定してください。<br> 指定する承認者のユーザーIDは、申請経路APIを利用して取得してください。
     *
     * @return self
     */
    public function setApproverId($approver_id)
    {
        if (!is_null($approver_id) && ($approver_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $approver_id when calling PaymentRequestUpdateParams., must be bigger than or equal to 1.');
        }

        $this->container['approver_id'] = $approver_id;

        return $this;
    }

    /**
     * Gets approval_flow_route_id.
     *
     * @return int
     */
    public function getApprovalFlowRouteId()
    {
        return $this->container['approval_flow_route_id'];
    }

    /**
     * Sets approval_flow_route_id.
     *
     * @param int $approval_flow_route_id 申請経路ID<br> 指定する申請経路IDは、申請経路APIを利用して取得してください。
     *
     * @return self
     */
    public function setApprovalFlowRouteId($approval_flow_route_id)
    {
        if (($approval_flow_route_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $approval_flow_route_id when calling PaymentRequestUpdateParams., must be bigger than or equal to 1.');
        }

        $this->container['approval_flow_route_id'] = $approval_flow_route_id;

        return $this;
    }

    /**
     * Gets draft.
     *
     * @return bool
     */
    public function getDraft()
    {
        return $this->container['draft'];
    }

    /**
     * Sets draft.
     *
     * @param bool $draft 支払依頼のステータス<br> falseを指定した時は申請中（in_progress）で支払依頼を更新します。<br> trueを指定した時は下書き（draft）で支払依頼を更新します。
     *
     * @return self
     */
    public function setDraft($draft)
    {
        $this->container['draft'] = $draft;

        return $this;
    }

    /**
     * Gets document_code.
     *
     * @return string|null
     */
    public function getDocumentCode()
    {
        return $this->container['document_code'];
    }

    /**
     * Sets document_code.
     *
     * @param string|null $document_code 請求書番号（255文字以内）
     *
     * @return self
     */
    public function setDocumentCode($document_code)
    {
        if (!is_null($document_code) && (mb_strlen($document_code) > 255)) {
            throw new \InvalidArgumentException('invalid length for $document_code when calling PaymentRequestUpdateParams., must be smaller than or equal to 255.');
        }

        $this->container['document_code'] = $document_code;

        return $this;
    }

    /**
     * Gets receipt_ids.
     *
     * @return int[]|null
     */
    public function getReceiptIds()
    {
        return $this->container['receipt_ids'];
    }

    /**
     * Sets receipt_ids.
     *
     * @param int[]|null $receipt_ids ファイルボックス（証憑ファイル）ID（配列）
     *
     * @return self
     */
    public function setReceiptIds($receipt_ids)
    {
        $this->container['receipt_ids'] = $receipt_ids;

        return $this;
    }

    /**
     * Gets issue_date.
     *
     * @return string
     */
    public function getIssueDate()
    {
        return $this->container['issue_date'];
    }

    /**
     * Sets issue_date.
     *
     * @param string $issue_date 発生日 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setIssueDate($issue_date)
    {
        $this->container['issue_date'] = $issue_date;

        return $this;
    }

    /**
     * Gets payment_date.
     *
     * @return string|null
     */
    public function getPaymentDate()
    {
        return $this->container['payment_date'];
    }

    /**
     * Sets payment_date.
     *
     * @param string|null $payment_date 支払期限 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setPaymentDate($payment_date)
    {
        $this->container['payment_date'] = $payment_date;

        return $this;
    }

    /**
     * Gets payment_method.
     *
     * @return string|null
     */
    public function getPaymentMethod()
    {
        return $this->container['payment_method'];
    }

    /**
     * Sets payment_method.
     *
     * @param string|null $payment_method '支払方法(none: 指定なし, domestic_bank_transfer: 国内振込, abroad_bank_transfer: 国外振込, account_transfer: 口座振替, credit_card: クレジットカード)'<br> 'デフォルトは none: 指定なし です。'
     *
     * @return self
     */
    public function setPaymentMethod($payment_method)
    {
        $allowedValues = $this->getPaymentMethodAllowableValues();
        if (!is_null($payment_method) && !in_array($payment_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'payment_method', must be one of '%s'",
                    $payment_method,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_method'] = $payment_method;

        return $this;
    }

    /**
     * Gets partner_id.
     *
     * @return int|null
     */
    public function getPartnerId()
    {
        return $this->container['partner_id'];
    }

    /**
     * Sets partner_id.
     *
     * @param int|null $partner_id 支払先の取引先ID
     *
     * @return self
     */
    public function setPartnerId($partner_id)
    {
        if (!is_null($partner_id) && ($partner_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $partner_id when calling PaymentRequestUpdateParams., must be bigger than or equal to 1.');
        }

        $this->container['partner_id'] = $partner_id;

        return $this;
    }

    /**
     * Gets partner_code.
     *
     * @return string|null
     */
    public function getPartnerCode()
    {
        return $this->container['partner_code'];
    }

    /**
     * Sets partner_code.
     *
     * @param string|null $partner_code 支払先の取引先コード<br> 支払先の取引先ID指定時には無効
     *
     * @return self
     */
    public function setPartnerCode($partner_code)
    {
        $this->container['partner_code'] = $partner_code;

        return $this;
    }

    /**
     * Gets bank_code.
     *
     * @return string|null
     */
    public function getBankCode()
    {
        return $this->container['bank_code'];
    }

    /**
     * Sets bank_code.
     *
     * @param string|null $bank_code 銀行コード（半角数字1桁〜4桁）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setBankCode($bank_code)
    {
        if (!is_null($bank_code) && (mb_strlen($bank_code) > 4)) {
            throw new \InvalidArgumentException('invalid length for $bank_code when calling PaymentRequestUpdateParams., must be smaller than or equal to 4.');
        }

        $this->container['bank_code'] = $bank_code;

        return $this;
    }

    /**
     * Gets bank_name.
     *
     * @return string|null
     */
    public function getBankName()
    {
        return $this->container['bank_name'];
    }

    /**
     * Sets bank_name.
     *
     * @param string|null $bank_name 銀行名（255文字以内）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setBankName($bank_name)
    {
        if (!is_null($bank_name) && (mb_strlen($bank_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank_name when calling PaymentRequestUpdateParams., must be smaller than or equal to 255.');
        }

        $this->container['bank_name'] = $bank_name;

        return $this;
    }

    /**
     * Gets bank_name_kana.
     *
     * @return string|null
     */
    public function getBankNameKana()
    {
        return $this->container['bank_name_kana'];
    }

    /**
     * Sets bank_name_kana.
     *
     * @param string|null $bank_name_kana 銀行名（カナ）（15文字以内）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setBankNameKana($bank_name_kana)
    {
        if (!is_null($bank_name_kana) && (mb_strlen($bank_name_kana) > 15)) {
            throw new \InvalidArgumentException('invalid length for $bank_name_kana when calling PaymentRequestUpdateParams., must be smaller than or equal to 15.');
        }

        $this->container['bank_name_kana'] = $bank_name_kana;

        return $this;
    }

    /**
     * Gets branch_code.
     *
     * @return string|null
     */
    public function getBranchCode()
    {
        return $this->container['branch_code'];
    }

    /**
     * Sets branch_code.
     *
     * @param string|null $branch_code 支店番号（半角数字1桁〜3桁）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setBranchCode($branch_code)
    {
        if (!is_null($branch_code) && (mb_strlen($branch_code) > 3)) {
            throw new \InvalidArgumentException('invalid length for $branch_code when calling PaymentRequestUpdateParams., must be smaller than or equal to 3.');
        }

        $this->container['branch_code'] = $branch_code;

        return $this;
    }

    /**
     * Gets branch_name.
     *
     * @return string|null
     */
    public function getBranchName()
    {
        return $this->container['branch_name'];
    }

    /**
     * Sets branch_name.
     *
     * @param string|null $branch_name 支店名（255文字以内）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setBranchName($branch_name)
    {
        if (!is_null($branch_name) && (mb_strlen($branch_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $branch_name when calling PaymentRequestUpdateParams., must be smaller than or equal to 255.');
        }

        $this->container['branch_name'] = $branch_name;

        return $this;
    }

    /**
     * Gets branch_kana.
     *
     * @return string|null
     */
    public function getBranchKana()
    {
        return $this->container['branch_kana'];
    }

    /**
     * Sets branch_kana.
     *
     * @param string|null $branch_kana 支店名（カナ）（15文字以内）<br> 指定可能な文字は、英数・カナ・丸括弧・ハイフン・スペースのみです。<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setBranchKana($branch_kana)
    {
        if (!is_null($branch_kana) && (mb_strlen($branch_kana) > 15)) {
            throw new \InvalidArgumentException('invalid length for $branch_kana when calling PaymentRequestUpdateParams., must be smaller than or equal to 15.');
        }

        $this->container['branch_kana'] = $branch_kana;

        return $this;
    }

    /**
     * Gets account_name.
     *
     * @return string|null
     */
    public function getAccountName()
    {
        return $this->container['account_name'];
    }

    /**
     * Sets account_name.
     *
     * @param string|null $account_name 受取人名（カナ）（48文字以内）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setAccountName($account_name)
    {
        if (!is_null($account_name) && (mb_strlen($account_name) > 48)) {
            throw new \InvalidArgumentException('invalid length for $account_name when calling PaymentRequestUpdateParams., must be smaller than or equal to 48.');
        }

        $this->container['account_name'] = $account_name;

        return $this;
    }

    /**
     * Gets account_number.
     *
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number.
     *
     * @param string|null $account_number 口座番号（半角数字1桁〜7桁）<br> 支払先指定時には無効
     *
     * @return self
     */
    public function setAccountNumber($account_number)
    {
        if (!is_null($account_number) && (mb_strlen($account_number) > 7)) {
            throw new \InvalidArgumentException('invalid length for $account_number when calling PaymentRequestUpdateParams., must be smaller than or equal to 7.');
        }

        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets account_type.
     *
     * @return string|null
     */
    public function getAccountType()
    {
        return $this->container['account_type'];
    }

    /**
     * Sets account_type.
     *
     * @param string|null $account_type '口座種別(ordinary: 普通、checking: 当座、earmarked: 納税準備預金、savings: 貯蓄、other: その他)'<br> '支払先指定時には無効'<br> 'デフォルトは ordinary: 普通 です'
     *
     * @return self
     */
    public function setAccountType($account_type)
    {
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!is_null($account_type) && !in_array($account_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'account_type', must be one of '%s'",
                    $account_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['account_type'] = $account_type;

        return $this;
    }

    /**
     * Gets qualified_invoice_status.
     *
     * @return string|null
     */
    public function getQualifiedInvoiceStatus()
    {
        return $this->container['qualified_invoice_status'];
    }

    /**
     * Sets qualified_invoice_status.
     *
     * @param string|null $qualified_invoice_status 適格請求書発行事業者（qualified: 該当する、not_qualified: 該当しない、unspecified: 未選択） - 支払依頼をインボイス要件をみたす申請として扱うかどうかを表します。 - qualified_invoice_statusキーをリクエストに含めない場合、unspecifiedが適用されます。 - issue_dateが2023年9月30日以前の場合、unspecified以外利用できません。 - インボイス経過措置の税区分の設定が使用する設定になっていない場合、unspecified以外利用できません。
     *
     * @return self
     */
    public function setQualifiedInvoiceStatus($qualified_invoice_status)
    {
        $allowedValues = $this->getQualifiedInvoiceStatusAllowableValues();
        if (!is_null($qualified_invoice_status) && !in_array($qualified_invoice_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'qualified_invoice_status', must be one of '%s'",
                    $qualified_invoice_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['qualified_invoice_status'] = $qualified_invoice_status;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param int $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     *               of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object.
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
