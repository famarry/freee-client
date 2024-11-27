<?php

/**
 * ManualJournalDetails.
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
 * ManualJournalDetails Class Doc Comment.
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
class ManualJournalDetails implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'manual_journal_details';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                 => 'int',
        'entry_side'         => 'string',
        'account_item_id'    => 'int',
        'tax_code'           => 'int',
        'partner_id'         => 'int',
        'partner_name'       => 'string',
        'partner_code'       => 'string',
        'partner_long_name'  => 'string',
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
        'amount'             => 'int',
        'vat'                => 'int',
        'description'        => 'string',
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
        'entry_side'         => null,
        'account_item_id'    => 'int64',
        'tax_code'           => 'int64',
        'partner_id'         => 'int64',
        'partner_name'       => null,
        'partner_code'       => null,
        'partner_long_name'  => null,
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
        'amount'             => 'int64',
        'vat'                => 'int64',
        'description'        => null,
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
        'entry_side'         => 'entry_side',
        'account_item_id'    => 'account_item_id',
        'tax_code'           => 'tax_code',
        'partner_id'         => 'partner_id',
        'partner_name'       => 'partner_name',
        'partner_code'       => 'partner_code',
        'partner_long_name'  => 'partner_long_name',
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
        'amount'             => 'amount',
        'vat'                => 'vat',
        'description'        => 'description',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                 => 'setId',
        'entry_side'         => 'setEntrySide',
        'account_item_id'    => 'setAccountItemId',
        'tax_code'           => 'setTaxCode',
        'partner_id'         => 'setPartnerId',
        'partner_name'       => 'setPartnerName',
        'partner_code'       => 'setPartnerCode',
        'partner_long_name'  => 'setPartnerLongName',
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
        'amount'             => 'setAmount',
        'vat'                => 'setVat',
        'description'        => 'setDescription',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                 => 'getId',
        'entry_side'         => 'getEntrySide',
        'account_item_id'    => 'getAccountItemId',
        'tax_code'           => 'getTaxCode',
        'partner_id'         => 'getPartnerId',
        'partner_name'       => 'getPartnerName',
        'partner_code'       => 'getPartnerCode',
        'partner_long_name'  => 'getPartnerLongName',
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
        'amount'             => 'getAmount',
        'vat'                => 'getVat',
        'description'        => 'getDescription',
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

    const ENTRY_SIDE_CREDIT = 'credit';
    const ENTRY_SIDE_DEBIT  = 'debit';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getEntrySideAllowableValues()
    {
        return [
            self::ENTRY_SIDE_CREDIT,
            self::ENTRY_SIDE_DEBIT,
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
        $this->container['entry_side']         = $data['entry_side'] ?? null;
        $this->container['account_item_id']    = $data['account_item_id'] ?? null;
        $this->container['tax_code']           = $data['tax_code'] ?? null;
        $this->container['partner_id']         = $data['partner_id'] ?? null;
        $this->container['partner_name']       = $data['partner_name'] ?? null;
        $this->container['partner_code']       = $data['partner_code'] ?? null;
        $this->container['partner_long_name']  = $data['partner_long_name'] ?? null;
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
        $this->container['amount']             = $data['amount'] ?? null;
        $this->container['vat']                = $data['vat'] ?? null;
        $this->container['description']        = $data['description'] ?? null;
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

        if ($this->container['entry_side'] === null) {
            $invalidProperties[] = "'entry_side' can't be null";
        }
        $allowedValues = $this->getEntrySideAllowableValues();
        if (!is_null($this->container['entry_side']) && !in_array($this->container['entry_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'entry_side', must be one of '%s'",
                $this->container['entry_side'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['account_item_id'] === null) {
            $invalidProperties[] = "'account_item_id' can't be null";
        }
        if (($this->container['account_item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'account_item_id', must be bigger than or equal to 1.";
        }

        if ($this->container['tax_code'] === null) {
            $invalidProperties[] = "'tax_code' can't be null";
        }
        if (($this->container['tax_code'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'tax_code', must be smaller than or equal to 2147483647.";
        }

        if (($this->container['tax_code'] < 0)) {
            $invalidProperties[] = "invalid value for 'tax_code', must be bigger than or equal to 0.";
        }

        if ($this->container['partner_id'] === null) {
            $invalidProperties[] = "'partner_id' can't be null";
        }
        if (($this->container['partner_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'partner_id', must be bigger than or equal to 1.";
        }

        if ($this->container['partner_name'] === null) {
            $invalidProperties[] = "'partner_name' can't be null";
        }
        if ($this->container['partner_long_name'] === null) {
            $invalidProperties[] = "'partner_long_name' can't be null";
        }
        if ((mb_strlen($this->container['partner_long_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'partner_long_name', the character length must be smaller than or equal to 255.";
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

        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if (($this->container['amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'amount', must be smaller than or equal to 2147483647.";
        }

        if (($this->container['amount'] < 1)) {
            $invalidProperties[] = "invalid value for 'amount', must be bigger than or equal to 1.";
        }

        if ($this->container['vat'] === null) {
            $invalidProperties[] = "'vat' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
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
     * @param int $id 貸借行ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling ManualJournalDetails., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets entry_side.
     *
     * @return string
     */
    public function getEntrySide()
    {
        return $this->container['entry_side'];
    }

    /**
     * Sets entry_side.
     *
     * @param string $entry_side 貸借(貸方: credit, 借方: debit)
     *
     * @return self
     */
    public function setEntrySide($entry_side)
    {
        $allowedValues = $this->getEntrySideAllowableValues();
        if (!in_array($entry_side, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'entry_side', must be one of '%s'",
                    $entry_side,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['entry_side'] = $entry_side;

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
            throw new \InvalidArgumentException('invalid value for $account_item_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
        }

        $this->container['account_item_id'] = $account_item_id;

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
        if (($tax_code > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $tax_code when calling ManualJournalDetails., must be smaller than or equal to 2147483647.');
        }
        if (($tax_code < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_code when calling ManualJournalDetails., must be bigger than or equal to 0.');
        }

        $this->container['tax_code'] = $tax_code;

        return $this;
    }

    /**
     * Gets partner_id.
     *
     * @return int
     */
    public function getPartnerId()
    {
        return $this->container['partner_id'];
    }

    /**
     * Sets partner_id.
     *
     * @param int $partner_id 取引先ID
     *
     * @return self
     */
    public function setPartnerId($partner_id)
    {
        if (($partner_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $partner_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
        }

        $this->container['partner_id'] = $partner_id;

        return $this;
    }

    /**
     * Gets partner_name.
     *
     * @return string
     */
    public function getPartnerName()
    {
        return $this->container['partner_name'];
    }

    /**
     * Sets partner_name.
     *
     * @param string $partner_name 取引先名
     *
     * @return self
     */
    public function setPartnerName($partner_name)
    {
        $this->container['partner_name'] = $partner_name;

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
     * @param string|null $partner_code 取引先コード
     *
     * @return self
     */
    public function setPartnerCode($partner_code)
    {
        $this->container['partner_code'] = $partner_code;

        return $this;
    }

    /**
     * Gets partner_long_name.
     *
     * @return string
     */
    public function getPartnerLongName()
    {
        return $this->container['partner_long_name'];
    }

    /**
     * Sets partner_long_name.
     *
     * @param string $partner_long_name 正式名称（255文字以内）
     *
     * @return self
     */
    public function setPartnerLongName($partner_long_name)
    {
        if ((mb_strlen($partner_long_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $partner_long_name when calling ManualJournalDetails., must be smaller than or equal to 255.');
        }

        $this->container['partner_long_name'] = $partner_long_name;

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
            throw new \InvalidArgumentException('invalid value for $item_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $section_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $segment_1_tag_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $segment_2_tag_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $segment_3_tag_id when calling ManualJournalDetails., must be bigger than or equal to 1.');
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
     * @param int $amount 金額（税込で指定してください）
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (($amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling ManualJournalDetails., must be smaller than or equal to 2147483647.');
        }
        if (($amount < 1)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling ManualJournalDetails., must be bigger than or equal to 1.');
        }

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
     * @param int $vat 消費税額（指定しない場合は自動で計算されます）
     *
     * @return self
     */
    public function setVat($vat)
    {
        $this->container['vat'] = $vat;

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
