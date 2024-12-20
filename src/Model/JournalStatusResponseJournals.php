<?php

/**
 * JournalStatusResponseJournals.
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
 * JournalStatusResponseJournals Class Doc Comment.
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
class JournalStatusResponseJournals implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'journalStatusResponse_journals';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'            => 'int',
        'company_id'    => 'int',
        'download_type' => 'string',
        'encoding'      => 'string',
        'status'        => 'string',
        'start_date'    => 'string',
        'end_date'      => 'string',
        'visible_tags'  => 'string[]',
        'visible_ids'   => 'string[]',
        'download_url'  => 'string',
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
        'id'            => 'int64',
        'company_id'    => 'int64',
        'download_type' => null,
        'encoding'      => null,
        'status'        => null,
        'start_date'    => null,
        'end_date'      => null,
        'visible_tags'  => null,
        'visible_ids'   => null,
        'download_url'  => null,
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
        'id'            => 'id',
        'company_id'    => 'company_id',
        'download_type' => 'download_type',
        'encoding'      => 'encoding',
        'status'        => 'status',
        'start_date'    => 'start_date',
        'end_date'      => 'end_date',
        'visible_tags'  => 'visible_tags',
        'visible_ids'   => 'visible_ids',
        'download_url'  => 'download_url',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'            => 'setId',
        'company_id'    => 'setCompanyId',
        'download_type' => 'setDownloadType',
        'encoding'      => 'setEncoding',
        'status'        => 'setStatus',
        'start_date'    => 'setStartDate',
        'end_date'      => 'setEndDate',
        'visible_tags'  => 'setVisibleTags',
        'visible_ids'   => 'setVisibleIds',
        'download_url'  => 'setDownloadUrl',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'            => 'getId',
        'company_id'    => 'getCompanyId',
        'download_type' => 'getDownloadType',
        'encoding'      => 'getEncoding',
        'status'        => 'getStatus',
        'start_date'    => 'getStartDate',
        'end_date'      => 'getEndDate',
        'visible_tags'  => 'getVisibleTags',
        'visible_ids'   => 'getVisibleIds',
        'download_url'  => 'getDownloadUrl',
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

    const DOWNLOAD_TYPE_GENERIC               = 'generic';
    const DOWNLOAD_TYPE_GENERIC_V2            = 'generic_v2';
    const DOWNLOAD_TYPE_CSV                   = 'csv';
    const DOWNLOAD_TYPE_PDF                   = 'pdf';
    const ENCODING_SJIS                       = 'sjis';
    const ENCODING_UTF_8                      = 'utf-8';
    const STATUS_ENQUEUED                     = 'enqueued';
    const STATUS_WORKING                      = 'working';
    const STATUS_UPLOADED                     = 'uploaded';
    const STATUS_FAILED                       = 'failed';
    const VISIBLE_TAGS_PARTNER                = 'partner';
    const VISIBLE_TAGS_ITEM                   = 'item';
    const VISIBLE_TAGS_TAG                    = 'tag';
    const VISIBLE_TAGS_SECTION                = 'section';
    const VISIBLE_TAGS_DESCRIPTION            = 'description';
    const VISIBLE_TAGS_WALLET_TXN_DESCRIPTION = 'wallet_txn_description';
    const VISIBLE_TAGS_ALL                    = 'all';
    const VISIBLE_TAGS_SEGMENT_1_TAG          = 'segment_1_tag';
    const VISIBLE_TAGS_SEGMENT_2_TAG          = 'segment_2_tag';
    const VISIBLE_TAGS_SEGMENT_3_TAG          = 'segment_3_tag';
    const VISIBLE_IDS_DEAL_ID                 = 'deal_id';
    const VISIBLE_IDS_TRANSFER_ID             = 'transfer_id';
    const VISIBLE_IDS_MANUAL_JOURNAL_ID       = 'manual_journal_id';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getDownloadTypeAllowableValues()
    {
        return [
            self::DOWNLOAD_TYPE_GENERIC,
            self::DOWNLOAD_TYPE_GENERIC_V2,
            self::DOWNLOAD_TYPE_CSV,
            self::DOWNLOAD_TYPE_PDF,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getEncodingAllowableValues()
    {
        return [
            self::ENCODING_SJIS,
            self::ENCODING_UTF_8,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_ENQUEUED,
            self::STATUS_WORKING,
            self::STATUS_UPLOADED,
            self::STATUS_FAILED,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getVisibleTagsAllowableValues()
    {
        return [
            self::VISIBLE_TAGS_PARTNER,
            self::VISIBLE_TAGS_ITEM,
            self::VISIBLE_TAGS_TAG,
            self::VISIBLE_TAGS_SECTION,
            self::VISIBLE_TAGS_DESCRIPTION,
            self::VISIBLE_TAGS_WALLET_TXN_DESCRIPTION,
            self::VISIBLE_TAGS_ALL,
            self::VISIBLE_TAGS_SEGMENT_1_TAG,
            self::VISIBLE_TAGS_SEGMENT_2_TAG,
            self::VISIBLE_TAGS_SEGMENT_3_TAG,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getVisibleIdsAllowableValues()
    {
        return [
            self::VISIBLE_IDS_DEAL_ID,
            self::VISIBLE_IDS_TRANSFER_ID,
            self::VISIBLE_IDS_MANUAL_JOURNAL_ID,
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
        $this->container['id']            = $data['id'] ?? null;
        $this->container['company_id']    = $data['company_id'] ?? null;
        $this->container['download_type'] = $data['download_type'] ?? null;
        $this->container['encoding']      = $data['encoding'] ?? null;
        $this->container['status']        = $data['status'] ?? null;
        $this->container['start_date']    = $data['start_date'] ?? null;
        $this->container['end_date']      = $data['end_date'] ?? null;
        $this->container['visible_tags']  = $data['visible_tags'] ?? null;
        $this->container['visible_ids']   = $data['visible_ids'] ?? null;
        $this->container['download_url']  = $data['download_url'] ?? null;
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

        if ($this->container['company_id'] === null) {
            $invalidProperties[] = "'company_id' can't be null";
        }
        if (($this->container['company_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'company_id', must be bigger than or equal to 1.";
        }

        if ($this->container['download_type'] === null) {
            $invalidProperties[] = "'download_type' can't be null";
        }
        $allowedValues = $this->getDownloadTypeAllowableValues();
        if (!is_null($this->container['download_type']) && !in_array($this->container['download_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'download_type', must be one of '%s'",
                $this->container['download_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getEncodingAllowableValues();
        if (!is_null($this->container['encoding']) && !in_array($this->container['encoding'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'encoding', must be one of '%s'",
                $this->container['encoding'],
                implode("', '", $allowedValues)
            );
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

        if ($this->container['start_date'] === null) {
            $invalidProperties[] = "'start_date' can't be null";
        }
        if ($this->container['end_date'] === null) {
            $invalidProperties[] = "'end_date' can't be null";
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
     * @param int $id 受け付けID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling JournalStatusResponseJournals., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
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
        if (($company_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $company_id when calling JournalStatusResponseJournals., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets download_type.
     *
     * @return string
     */
    public function getDownloadType()
    {
        return $this->container['download_type'];
    }

    /**
     * Sets download_type.
     *
     * @param string $download_type ダウンロード形式
     *
     * @return self
     */
    public function setDownloadType($download_type)
    {
        $allowedValues = $this->getDownloadTypeAllowableValues();
        if (!in_array($download_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'download_type', must be one of '%s'",
                    $download_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['download_type'] = $download_type;

        return $this;
    }

    /**
     * Gets encoding.
     *
     * @return string|null
     */
    public function getEncoding()
    {
        return $this->container['encoding'];
    }

    /**
     * Sets encoding.
     *
     * @param string|null $encoding 文字コード
     *
     * @return self
     */
    public function setEncoding($encoding)
    {
        $allowedValues = $this->getEncodingAllowableValues();
        if (!is_null($encoding) && !in_array($encoding, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'encoding', must be one of '%s'",
                    $encoding,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['encoding'] = $encoding;

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
     * @param string $status ダウンロードリクエストのステータス
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
     * Gets start_date.
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date.
     *
     * @param string $start_date 取得開始日 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date.
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date.
     *
     * @param string $end_date 取得終了日 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets visible_tags.
     *
     * @return string[]|null
     */
    public function getVisibleTags()
    {
        return $this->container['visible_tags'];
    }

    /**
     * Sets visible_tags.
     *
     * @param string[]|null $visible_tags visible_tags
     *
     * @return self
     */
    public function setVisibleTags($visible_tags)
    {
        $allowedValues = $this->getVisibleTagsAllowableValues();
        if (!is_null($visible_tags) && array_diff($visible_tags, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'visible_tags', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['visible_tags'] = $visible_tags;

        return $this;
    }

    /**
     * Gets visible_ids.
     *
     * @return string[]|null
     */
    public function getVisibleIds()
    {
        return $this->container['visible_ids'];
    }

    /**
     * Sets visible_ids.
     *
     * @param string[]|null $visible_ids visible_ids
     *
     * @return self
     */
    public function setVisibleIds($visible_ids)
    {
        $allowedValues = $this->getVisibleIdsAllowableValues();
        if (!is_null($visible_ids) && array_diff($visible_ids, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'visible_ids', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['visible_ids'] = $visible_ids;

        return $this;
    }

    /**
     * Gets download_url.
     *
     * @return string|null
     */
    public function getDownloadUrl()
    {
        return $this->container['download_url'];
    }

    /**
     * Sets download_url.
     *
     * @param string|null $download_url ダウンロードURL
     *
     * @return self
     */
    public function setDownloadUrl($download_url)
    {
        $this->container['download_url'] = $download_url;

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
