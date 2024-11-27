<?php

/**
 * QuotationIndexResponseQuotationContents.
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
 * QuotationIndexResponseQuotationContents Class Doc Comment.
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
class QuotationIndexResponseQuotationContents implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'quotationIndexResponse_quotation_contents';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                 => 'int',
        'order'              => 'int',
        'type'               => 'string',
        'qty'                => 'float',
        'unit'               => 'string',
        'unit_price'         => 'float',
        'amount'             => 'int',
        'vat'                => 'int',
        'reduced_vat'        => 'bool',
        'description'        => 'string',
        'account_item_id'    => 'int',
        'account_item_name'  => 'string',
        'tax_code'           => 'int',
        'item_id'            => 'int',
        'item_name'          => 'string',
        'section_id'         => 'int',
        'section_name'       => 'string',
        'tag_ids'            => 'int[]',
        'tag_names'          => 'string[]',
        'segment_1_tag_id'   => 'int',
        'segment_1_tag_name' => 'string',
        'segment_2_tag_id'   => 'int',
        'segment_2_tag_name' => 'string',
        'segment_3_tag_id'   => 'int',
        'segment_3_tag_name' => 'string',
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
        'id'                 => 'int64',
        'order'              => 'int64',
        'type'               => null,
        'qty'                => null,
        'unit'               => null,
        'unit_price'         => null,
        'amount'             => 'int64',
        'vat'                => 'int64',
        'reduced_vat'        => null,
        'description'        => null,
        'account_item_id'    => 'int64',
        'account_item_name'  => null,
        'tax_code'           => 'int64',
        'item_id'            => 'int64',
        'item_name'          => null,
        'section_id'         => 'int64',
        'section_name'       => null,
        'tag_ids'            => 'int64',
        'tag_names'          => null,
        'segment_1_tag_id'   => 'int64',
        'segment_1_tag_name' => null,
        'segment_2_tag_id'   => 'int64',
        'segment_2_tag_name' => null,
        'segment_3_tag_id'   => 'int64',
        'segment_3_tag_name' => null,
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
        'id'                 => 'id',
        'order'              => 'order',
        'type'               => 'type',
        'qty'                => 'qty',
        'unit'               => 'unit',
        'unit_price'         => 'unit_price',
        'amount'             => 'amount',
        'vat'                => 'vat',
        'reduced_vat'        => 'reduced_vat',
        'description'        => 'description',
        'account_item_id'    => 'account_item_id',
        'account_item_name'  => 'account_item_name',
        'tax_code'           => 'tax_code',
        'item_id'            => 'item_id',
        'item_name'          => 'item_name',
        'section_id'         => 'section_id',
        'section_name'       => 'section_name',
        'tag_ids'            => 'tag_ids',
        'tag_names'          => 'tag_names',
        'segment_1_tag_id'   => 'segment_1_tag_id',
        'segment_1_tag_name' => 'segment_1_tag_name',
        'segment_2_tag_id'   => 'segment_2_tag_id',
        'segment_2_tag_name' => 'segment_2_tag_name',
        'segment_3_tag_id'   => 'segment_3_tag_id',
        'segment_3_tag_name' => 'segment_3_tag_name',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                 => 'setId',
        'order'              => 'setOrder',
        'type'               => 'setType',
        'qty'                => 'setQty',
        'unit'               => 'setUnit',
        'unit_price'         => 'setUnitPrice',
        'amount'             => 'setAmount',
        'vat'                => 'setVat',
        'reduced_vat'        => 'setReducedVat',
        'description'        => 'setDescription',
        'account_item_id'    => 'setAccountItemId',
        'account_item_name'  => 'setAccountItemName',
        'tax_code'           => 'setTaxCode',
        'item_id'            => 'setItemId',
        'item_name'          => 'setItemName',
        'section_id'         => 'setSectionId',
        'section_name'       => 'setSectionName',
        'tag_ids'            => 'setTagIds',
        'tag_names'          => 'setTagNames',
        'segment_1_tag_id'   => 'setSegment1TagId',
        'segment_1_tag_name' => 'setSegment1TagName',
        'segment_2_tag_id'   => 'setSegment2TagId',
        'segment_2_tag_name' => 'setSegment2TagName',
        'segment_3_tag_id'   => 'setSegment3TagId',
        'segment_3_tag_name' => 'setSegment3TagName',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                 => 'getId',
        'order'              => 'getOrder',
        'type'               => 'getType',
        'qty'                => 'getQty',
        'unit'               => 'getUnit',
        'unit_price'         => 'getUnitPrice',
        'amount'             => 'getAmount',
        'vat'                => 'getVat',
        'reduced_vat'        => 'getReducedVat',
        'description'        => 'getDescription',
        'account_item_id'    => 'getAccountItemId',
        'account_item_name'  => 'getAccountItemName',
        'tax_code'           => 'getTaxCode',
        'item_id'            => 'getItemId',
        'item_name'          => 'getItemName',
        'section_id'         => 'getSectionId',
        'section_name'       => 'getSectionName',
        'tag_ids'            => 'getTagIds',
        'tag_names'          => 'getTagNames',
        'segment_1_tag_id'   => 'getSegment1TagId',
        'segment_1_tag_name' => 'getSegment1TagName',
        'segment_2_tag_id'   => 'getSegment2TagId',
        'segment_2_tag_name' => 'getSegment2TagName',
        'segment_3_tag_id'   => 'getSegment3TagId',
        'segment_3_tag_name' => 'getSegment3TagName',
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

    const TYPE_NORMAL   = 'normal';
    const TYPE_DISCOUNT = 'discount';
    const TYPE_TEXT     = 'text';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_NORMAL,
            self::TYPE_DISCOUNT,
            self::TYPE_TEXT,
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
        $this->container['id']                 = $data['id'] ?? null;
        $this->container['order']              = $data['order'] ?? null;
        $this->container['type']               = $data['type'] ?? null;
        $this->container['qty']                = $data['qty'] ?? null;
        $this->container['unit']               = $data['unit'] ?? null;
        $this->container['unit_price']         = $data['unit_price'] ?? null;
        $this->container['amount']             = $data['amount'] ?? null;
        $this->container['vat']                = $data['vat'] ?? null;
        $this->container['reduced_vat']        = $data['reduced_vat'] ?? null;
        $this->container['description']        = $data['description'] ?? null;
        $this->container['account_item_id']    = $data['account_item_id'] ?? null;
        $this->container['account_item_name']  = $data['account_item_name'] ?? null;
        $this->container['tax_code']           = $data['tax_code'] ?? null;
        $this->container['item_id']            = $data['item_id'] ?? null;
        $this->container['item_name']          = $data['item_name'] ?? null;
        $this->container['section_id']         = $data['section_id'] ?? null;
        $this->container['section_name']       = $data['section_name'] ?? null;
        $this->container['tag_ids']            = $data['tag_ids'] ?? null;
        $this->container['tag_names']          = $data['tag_names'] ?? null;
        $this->container['segment_1_tag_id']   = $data['segment_1_tag_id'] ?? null;
        $this->container['segment_1_tag_name'] = $data['segment_1_tag_name'] ?? null;
        $this->container['segment_2_tag_id']   = $data['segment_2_tag_id'] ?? null;
        $this->container['segment_2_tag_name'] = $data['segment_2_tag_name'] ?? null;
        $this->container['segment_3_tag_id']   = $data['segment_3_tag_id'] ?? null;
        $this->container['segment_3_tag_name'] = $data['segment_3_tag_name'] ?? null;
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

        if ($this->container['order'] === null) {
            $invalidProperties[] = "'order' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['qty'] === null) {
            $invalidProperties[] = "'qty' can't be null";
        }
        if ($this->container['unit'] === null) {
            $invalidProperties[] = "'unit' can't be null";
        }
        if ($this->container['unit_price'] === null) {
            $invalidProperties[] = "'unit_price' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if ($this->container['vat'] === null) {
            $invalidProperties[] = "'vat' can't be null";
        }
        if ($this->container['reduced_vat'] === null) {
            $invalidProperties[] = "'reduced_vat' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['account_item_id'] === null) {
            $invalidProperties[] = "'account_item_id' can't be null";
        }
        if (($this->container['account_item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'account_item_id', must be bigger than or equal to 1.";
        }

        if ($this->container['account_item_name'] === null) {
            $invalidProperties[] = "'account_item_name' can't be null";
        }
        if ($this->container['tax_code'] === null) {
            $invalidProperties[] = "'tax_code' can't be null";
        }
        if ($this->container['item_id'] === null) {
            $invalidProperties[] = "'item_id' can't be null";
        }
        if (($this->container['item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'item_id', must be bigger than or equal to 1.";
        }

        if ($this->container['item_name'] === null) {
            $invalidProperties[] = "'item_name' can't be null";
        }
        if ($this->container['section_id'] === null) {
            $invalidProperties[] = "'section_id' can't be null";
        }
        if (($this->container['section_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'section_id', must be bigger than or equal to 1.";
        }

        if ($this->container['section_name'] === null) {
            $invalidProperties[] = "'section_name' can't be null";
        }
        if ($this->container['tag_ids'] === null) {
            $invalidProperties[] = "'tag_ids' can't be null";
        }
        if ($this->container['tag_names'] === null) {
            $invalidProperties[] = "'tag_names' can't be null";
        }
        if (!is_null($this->container['segment_1_tag_id']) && ($this->container['segment_1_tag_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'segment_1_tag_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['segment_2_tag_id']) && ($this->container['segment_2_tag_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'segment_2_tag_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['segment_3_tag_id']) && ($this->container['segment_3_tag_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'segment_3_tag_id', must be bigger than or equal to 1.";
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
     * @param int $id 見積内容ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets order.
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order.
     *
     * @param int $order 順序
     *
     * @return self
     */
    public function setOrder($order)
    {
        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type.
     *
     * @param string $type 行の種類
     *
     * @return self
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets qty.
     *
     * @return float
     */
    public function getQty()
    {
        return $this->container['qty'];
    }

    /**
     * Sets qty.
     *
     * @param float $qty 数量
     *
     * @return self
     */
    public function setQty($qty)
    {
        $this->container['qty'] = $qty;

        return $this;
    }

    /**
     * Gets unit.
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->container['unit'];
    }

    /**
     * Sets unit.
     *
     * @param string $unit 単位
     *
     * @return self
     */
    public function setUnit($unit)
    {
        $this->container['unit'] = $unit;

        return $this;
    }

    /**
     * Gets unit_price.
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->container['unit_price'];
    }

    /**
     * Sets unit_price.
     *
     * @param float $unit_price 単価
     *
     * @return self
     */
    public function setUnitPrice($unit_price)
    {
        $this->container['unit_price'] = $unit_price;

        return $this;
    }

    /**
     * Gets amount.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount.
     *
     * @param int $amount 内税/外税の判別とamountの税込み、税抜きについて <ul> <li>tax_entry_methodがexclusive (外税)の場合</li> <ul> <li>amount: 消費税抜きの金額</li> <li>vat: 消費税の金額</li> </ul> <li>tax_entry_methodがinclusive (内税)の場合</li> <ul> <li>amount: 消費税込みの金額</li> <li>vat: 消費税の金額</li> </ul> </ul>
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets vat.
     *
     * @return int
     */
    public function getVat()
    {
        return $this->container['vat'];
    }

    /**
     * Sets vat.
     *
     * @param int $vat 消費税額
     *
     * @return self
     */
    public function setVat($vat)
    {
        $this->container['vat'] = $vat;

        return $this;
    }

    /**
     * Gets reduced_vat.
     *
     * @return bool
     */
    public function getReducedVat()
    {
        return $this->container['reduced_vat'];
    }

    /**
     * Sets reduced_vat.
     *
     * @param bool $reduced_vat 軽減税率税区分（true: 対象、false: 対象外）
     *
     * @return self
     */
    public function setReducedVat($reduced_vat)
    {
        $this->container['reduced_vat'] = $reduced_vat;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description.
     *
     * @param string $description 備考
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets account_item_id.
     *
     * @return int
     */
    public function getAccountItemId()
    {
        return $this->container['account_item_id'];
    }

    /**
     * Sets account_item_id.
     *
     * @param int $account_item_id 勘定科目ID
     *
     * @return self
     */
    public function setAccountItemId($account_item_id)
    {
        if (($account_item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $account_item_id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['account_item_id'] = $account_item_id;

        return $this;
    }

    /**
     * Gets account_item_name.
     *
     * @return string
     */
    public function getAccountItemName()
    {
        return $this->container['account_item_name'];
    }

    /**
     * Sets account_item_name.
     *
     * @param string $account_item_name 勘定科目名
     *
     * @return self
     */
    public function setAccountItemName($account_item_name)
    {
        $this->container['account_item_name'] = $account_item_name;

        return $this;
    }

    /**
     * Gets tax_code.
     *
     * @return int
     */
    public function getTaxCode()
    {
        return $this->container['tax_code'];
    }

    /**
     * Sets tax_code.
     *
     * @param int $tax_code 税区分コード
     *
     * @return self
     */
    public function setTaxCode($tax_code)
    {
        $this->container['tax_code'] = $tax_code;

        return $this;
    }

    /**
     * Gets item_id.
     *
     * @return int
     */
    public function getItemId()
    {
        return $this->container['item_id'];
    }

    /**
     * Sets item_id.
     *
     * @param int $item_id 品目ID
     *
     * @return self
     */
    public function setItemId($item_id)
    {
        if (($item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $item_id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['item_id'] = $item_id;

        return $this;
    }

    /**
     * Gets item_name.
     *
     * @return string
     */
    public function getItemName()
    {
        return $this->container['item_name'];
    }

    /**
     * Sets item_name.
     *
     * @param string $item_name 品目
     *
     * @return self
     */
    public function setItemName($item_name)
    {
        $this->container['item_name'] = $item_name;

        return $this;
    }

    /**
     * Gets section_id.
     *
     * @return int
     */
    public function getSectionId()
    {
        return $this->container['section_id'];
    }

    /**
     * Sets section_id.
     *
     * @param int $section_id 部門ID
     *
     * @return self
     */
    public function setSectionId($section_id)
    {
        if (($section_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $section_id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['section_id'] = $section_id;

        return $this;
    }

    /**
     * Gets section_name.
     *
     * @return string
     */
    public function getSectionName()
    {
        return $this->container['section_name'];
    }

    /**
     * Sets section_name.
     *
     * @param string $section_name 部門
     *
     * @return self
     */
    public function setSectionName($section_name)
    {
        $this->container['section_name'] = $section_name;

        return $this;
    }

    /**
     * Gets tag_ids.
     *
     * @return int[]
     */
    public function getTagIds()
    {
        return $this->container['tag_ids'];
    }

    /**
     * Sets tag_ids.
     *
     * @param int[] $tag_ids tag_ids
     *
     * @return self
     */
    public function setTagIds($tag_ids)
    {
        $this->container['tag_ids'] = $tag_ids;

        return $this;
    }

    /**
     * Gets tag_names.
     *
     * @return string[]
     */
    public function getTagNames()
    {
        return $this->container['tag_names'];
    }

    /**
     * Sets tag_names.
     *
     * @param string[] $tag_names tag_names
     *
     * @return self
     */
    public function setTagNames($tag_names)
    {
        $this->container['tag_names'] = $tag_names;

        return $this;
    }

    /**
     * Gets segment_1_tag_id.
     *
     * @return int|null
     */
    public function getSegment1TagId()
    {
        return $this->container['segment_1_tag_id'];
    }

    /**
     * Sets segment_1_tag_id.
     *
     * @param int|null $segment_1_tag_id セグメント１タグID
     *
     * @return self
     */
    public function setSegment1TagId($segment_1_tag_id)
    {
        if (!is_null($segment_1_tag_id) && ($segment_1_tag_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $segment_1_tag_id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['segment_1_tag_id'] = $segment_1_tag_id;

        return $this;
    }

    /**
     * Gets segment_1_tag_name.
     *
     * @return string|null
     */
    public function getSegment1TagName()
    {
        return $this->container['segment_1_tag_name'];
    }

    /**
     * Sets segment_1_tag_name.
     *
     * @param string|null $segment_1_tag_name セグメント１タグ名
     *
     * @return self
     */
    public function setSegment1TagName($segment_1_tag_name)
    {
        $this->container['segment_1_tag_name'] = $segment_1_tag_name;

        return $this;
    }

    /**
     * Gets segment_2_tag_id.
     *
     * @return int|null
     */
    public function getSegment2TagId()
    {
        return $this->container['segment_2_tag_id'];
    }

    /**
     * Sets segment_2_tag_id.
     *
     * @param int|null $segment_2_tag_id セグメント２タグID
     *
     * @return self
     */
    public function setSegment2TagId($segment_2_tag_id)
    {
        if (!is_null($segment_2_tag_id) && ($segment_2_tag_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $segment_2_tag_id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['segment_2_tag_id'] = $segment_2_tag_id;

        return $this;
    }

    /**
     * Gets segment_2_tag_name.
     *
     * @return string|null
     */
    public function getSegment2TagName()
    {
        return $this->container['segment_2_tag_name'];
    }

    /**
     * Sets segment_2_tag_name.
     *
     * @param string|null $segment_2_tag_name セグメント２タグ名
     *
     * @return self
     */
    public function setSegment2TagName($segment_2_tag_name)
    {
        $this->container['segment_2_tag_name'] = $segment_2_tag_name;

        return $this;
    }

    /**
     * Gets segment_3_tag_id.
     *
     * @return int|null
     */
    public function getSegment3TagId()
    {
        return $this->container['segment_3_tag_id'];
    }

    /**
     * Sets segment_3_tag_id.
     *
     * @param int|null $segment_3_tag_id セグメント３タグID
     *
     * @return self
     */
    public function setSegment3TagId($segment_3_tag_id)
    {
        if (!is_null($segment_3_tag_id) && ($segment_3_tag_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $segment_3_tag_id when calling QuotationIndexResponseQuotationContents., must be bigger than or equal to 1.');
        }

        $this->container['segment_3_tag_id'] = $segment_3_tag_id;

        return $this;
    }

    /**
     * Gets segment_3_tag_name.
     *
     * @return string|null
     */
    public function getSegment3TagName()
    {
        return $this->container['segment_3_tag_name'];
    }

    /**
     * Sets segment_3_tag_name.
     *
     * @param string|null $segment_3_tag_name セグメント３タグ名
     *
     * @return self
     */
    public function setSegment3TagName($segment_3_tag_name)
    {
        $this->container['segment_3_tag_name'] = $segment_3_tag_name;

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
