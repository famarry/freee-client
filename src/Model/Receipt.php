<?php
/**
 * Receipt.
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
 * Receipt Class Doc Comment.
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
class Receipt implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'receipt';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                          => 'int',
        'status'                      => 'string',
        'description'                 => 'string',
        'mime_type'                   => 'string',
        'origin'                      => 'string',
        'created_at'                  => 'string',
        'user'                        => '\OpenAPI\Client\Model\DealUser',
        'receipt_metadatum'           => '\OpenAPI\Client\Model\ReceiptUpdateParamsReceiptMetadatum',
        'qualified_invoice'           => 'string',
        'invoice_registration_number' => 'string',
        'document_type'               => 'string',
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
        'id'                          => 'int64',
        'status'                      => null,
        'description'                 => null,
        'mime_type'                   => null,
        'origin'                      => null,
        'created_at'                  => null,
        'user'                        => null,
        'receipt_metadatum'           => null,
        'qualified_invoice'           => null,
        'invoice_registration_number' => null,
        'document_type'               => null,
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
        'id'                          => 'id',
        'status'                      => 'status',
        'description'                 => 'description',
        'mime_type'                   => 'mime_type',
        'origin'                      => 'origin',
        'created_at'                  => 'created_at',
        'user'                        => 'user',
        'receipt_metadatum'           => 'receipt_metadatum',
        'qualified_invoice'           => 'qualified_invoice',
        'invoice_registration_number' => 'invoice_registration_number',
        'document_type'               => 'document_type',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                          => 'setId',
        'status'                      => 'setStatus',
        'description'                 => 'setDescription',
        'mime_type'                   => 'setMimeType',
        'origin'                      => 'setOrigin',
        'created_at'                  => 'setCreatedAt',
        'user'                        => 'setUser',
        'receipt_metadatum'           => 'setReceiptMetadatum',
        'qualified_invoice'           => 'setQualifiedInvoice',
        'invoice_registration_number' => 'setInvoiceRegistrationNumber',
        'document_type'               => 'setDocumentType',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                          => 'getId',
        'status'                      => 'getStatus',
        'description'                 => 'getDescription',
        'mime_type'                   => 'getMimeType',
        'origin'                      => 'getOrigin',
        'created_at'                  => 'getCreatedAt',
        'user'                        => 'getUser',
        'receipt_metadatum'           => 'getReceiptMetadatum',
        'qualified_invoice'           => 'getQualifiedInvoice',
        'invoice_registration_number' => 'getInvoiceRegistrationNumber',
        'document_type'               => 'getDocumentType',
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

    const STATUS_CONFIRMED                = 'confirmed';
    const STATUS_DELETED                  = 'deleted';
    const STATUS_IGNORED                  = 'ignored';
    const ORIGIN_UNKNOWN                  = 'unknown';
    const ORIGIN_WEB                      = 'web';
    const ORIGIN_MOBILE_CAMERA            = 'mobile_camera';
    const ORIGIN_MOBILE_ALBUM             = 'mobile_album';
    const ORIGIN_SCANSNAP                 = 'scansnap';
    const ORIGIN_SCANNABLE                = 'scannable';
    const ORIGIN_DROPBOX                  = 'dropbox';
    const ORIGIN_MAIL                     = 'mail';
    const ORIGIN_SAFETY_CONTACT_FILE      = 'safety_contact_file';
    const ORIGIN_PUBLIC_API               = 'public_api';
    const QUALIFIED_INVOICE_QUALIFIED     = 'qualified';
    const QUALIFIED_INVOICE_NOT_QUALIFIED = 'not_qualified';
    const QUALIFIED_INVOICE_UNSELECTED    = 'unselected';
    const DOCUMENT_TYPE_RECEIPT           = 'receipt';
    const DOCUMENT_TYPE_INVOICE           = 'invoice';
    const DOCUMENT_TYPE_OTHER             = 'other';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_CONFIRMED,
            self::STATUS_DELETED,
            self::STATUS_IGNORED,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getOriginAllowableValues()
    {
        return [
            self::ORIGIN_UNKNOWN,
            self::ORIGIN_WEB,
            self::ORIGIN_MOBILE_CAMERA,
            self::ORIGIN_MOBILE_ALBUM,
            self::ORIGIN_SCANSNAP,
            self::ORIGIN_SCANNABLE,
            self::ORIGIN_DROPBOX,
            self::ORIGIN_MAIL,
            self::ORIGIN_SAFETY_CONTACT_FILE,
            self::ORIGIN_PUBLIC_API,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getQualifiedInvoiceAllowableValues()
    {
        return [
            self::QUALIFIED_INVOICE_QUALIFIED,
            self::QUALIFIED_INVOICE_NOT_QUALIFIED,
            self::QUALIFIED_INVOICE_UNSELECTED,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getDocumentTypeAllowableValues()
    {
        return [
            self::DOCUMENT_TYPE_RECEIPT,
            self::DOCUMENT_TYPE_INVOICE,
            self::DOCUMENT_TYPE_OTHER,
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
        $this->container['id']                          = $data['id'] ?? null;
        $this->container['status']                      = $data['status'] ?? null;
        $this->container['description']                 = $data['description'] ?? null;
        $this->container['mime_type']                   = $data['mime_type'] ?? null;
        $this->container['origin']                      = $data['origin'] ?? null;
        $this->container['created_at']                  = $data['created_at'] ?? null;
        $this->container['user']                        = $data['user'] ?? null;
        $this->container['receipt_metadatum']           = $data['receipt_metadatum'] ?? null;
        $this->container['qualified_invoice']           = $data['qualified_invoice'] ?? null;
        $this->container['invoice_registration_number'] = $data['invoice_registration_number'] ?? null;
        $this->container['document_type']               = $data['document_type'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if (($this->container['id'] < 1)) {
            $invalidProperties[] = "invalid value for 'id', must be bigger than or equal to 1.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['mime_type'] === null) {
            $invalidProperties[] = "'mime_type' can't be null";
        }
        if ($this->container['origin'] === null) {
            $invalidProperties[] = "'origin' can't be null";
        }
        $allowedValues = $this->getOriginAllowableValues();
        if (!is_null($this->container['origin']) && !in_array($this->container['origin'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'origin', must be one of '%s'",
                $this->container['origin'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['user'] === null) {
            $invalidProperties[] = "'user' can't be null";
        }
        $allowedValues = $this->getQualifiedInvoiceAllowableValues();
        if (!is_null($this->container['qualified_invoice']) && !in_array($this->container['qualified_invoice'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'qualified_invoice', must be one of '%s'",
                $this->container['qualified_invoice'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['invoice_registration_number']) && (mb_strlen($this->container['invoice_registration_number']) > 14)) {
            $invalidProperties[] = "invalid value for 'invoice_registration_number', the character length must be smaller than or equal to 14.";
        }

        if (!is_null($this->container['invoice_registration_number']) && (mb_strlen($this->container['invoice_registration_number']) < 14)) {
            $invalidProperties[] = "invalid value for 'invoice_registration_number', the character length must be bigger than or equal to 14.";
        }

        if (!is_null($this->container['invoice_registration_number']) && !preg_match('/^T[1-9][0-9]{12}$/', $this->container['invoice_registration_number'])) {
            $invalidProperties[] = "invalid value for 'invoice_registration_number', must be conform to the pattern /^T[1-9][0-9]{12}$/.";
        }

        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!is_null($this->container['document_type']) && !in_array($this->container['document_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'document_type', must be one of '%s'",
                $this->container['document_type'],
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
     * Gets id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id.
     *
     * @param int $id ファイルボックス（証憑ファイル）ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling Receipt., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status.
     *
     * @param string $status ステータス(confirmed:確認済み、deleted:削除済み、ignored:無視)
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

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
     * @param string|null $description メモ
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets mime_type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->container['mime_type'];
    }

    /**
     * Sets mime_type.
     *
     * @param string $mime_type MIMEタイプ
     *
     * @return self
     */
    public function setMimeType($mime_type)
    {
        $this->container['mime_type'] = $mime_type;

        return $this;
    }

    /**
     * Gets origin.
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->container['origin'];
    }

    /**
     * Sets origin.
     *
     * @param string $origin アップロード元種別
     *
     * @return self
     */
    public function setOrigin($origin)
    {
        $allowedValues = $this->getOriginAllowableValues();
        if (!in_array($origin, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'origin', must be one of '%s'",
                    $origin,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['origin'] = $origin;

        return $this;
    }

    /**
     * Gets created_at.
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at.
     *
     * @param string $created_at アップロード日時（ISO8601形式）
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets user.
     *
     * @return \OpenAPI\Client\Model\DealUser
     */
    public function getUser()
    {
        return $this->container['user'];
    }

    /**
     * Sets user.
     *
     * @param \OpenAPI\Client\Model\DealUser $user user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->container['user'] = $user;

        return $this;
    }

    /**
     * Gets receipt_metadatum.
     *
     * @return \OpenAPI\Client\Model\ReceiptUpdateParamsReceiptMetadatum|null
     */
    public function getReceiptMetadatum()
    {
        return $this->container['receipt_metadatum'];
    }

    /**
     * Sets receipt_metadatum.
     *
     * @param \OpenAPI\Client\Model\ReceiptUpdateParamsReceiptMetadatum|null $receipt_metadatum receipt_metadatum
     *
     * @return self
     */
    public function setReceiptMetadatum($receipt_metadatum)
    {
        $this->container['receipt_metadatum'] = $receipt_metadatum;

        return $this;
    }

    /**
     * Gets qualified_invoice.
     *
     * @return string|null
     */
    public function getQualifiedInvoice()
    {
        return $this->container['qualified_invoice'];
    }

    /**
     * Sets qualified_invoice.
     *
     * @param string|null $qualified_invoice 適格請求書等（qualified: 該当する、not_qualified: 該当しない、unselected: 未選択、null: OCR解析結果が保存されている時等）
     *
     * @return self
     */
    public function setQualifiedInvoice($qualified_invoice)
    {
        $allowedValues = $this->getQualifiedInvoiceAllowableValues();
        if (!is_null($qualified_invoice) && !in_array($qualified_invoice, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'qualified_invoice', must be one of '%s'",
                    $qualified_invoice,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['qualified_invoice'] = $qualified_invoice;

        return $this;
    }

    /**
     * Gets invoice_registration_number.
     *
     * @return string|null
     */
    public function getInvoiceRegistrationNumber()
    {
        return $this->container['invoice_registration_number'];
    }

    /**
     * Sets invoice_registration_number.
     *
     * @param string|null $invoice_registration_number インボイス制度適格請求書発行事業者登録番号（null: OCR解析結果が保存されている時等） - 先頭T数字13桁の固定14桁の文字列 <a target=\"_blank\" href=\"https://www.invoice-kohyo.nta.go.jp/index.html\">国税庁インボイス制度適格請求書発行事業者公表サイト</a>
     *
     * @return self
     */
    public function setInvoiceRegistrationNumber($invoice_registration_number)
    {
        if (!is_null($invoice_registration_number) && (mb_strlen($invoice_registration_number) > 14)) {
            throw new \InvalidArgumentException('invalid length for $invoice_registration_number when calling Receipt., must be smaller than or equal to 14.');
        }
        if (!is_null($invoice_registration_number) && (mb_strlen($invoice_registration_number) < 14)) {
            throw new \InvalidArgumentException('invalid length for $invoice_registration_number when calling Receipt., must be bigger than or equal to 14.');
        }
        if (!is_null($invoice_registration_number) && (!preg_match('/^T[1-9][0-9]{12}$/', $invoice_registration_number))) {
            throw new \InvalidArgumentException("invalid value for $invoice_registration_number when calling Receipt., must conform to the pattern /^T[1-9][0-9]{12}$/.");
        }

        $this->container['invoice_registration_number'] = $invoice_registration_number;

        return $this;
    }

    /**
     * Gets document_type.
     *
     * @return string|null
     */
    public function getDocumentType()
    {
        return $this->container['document_type'];
    }

    /**
     * Sets document_type.
     *
     * @param string|null $document_type 書類の種類（receipt: 領収書、invoice: 請求書、other: その他、null: OCR解析結果が保存されている時等）
     *
     * @return self
     */
    public function setDocumentType($document_type)
    {
        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!is_null($document_type) && !in_array($document_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'document_type', must be one of '%s'",
                    $document_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['document_type'] = $document_type;

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