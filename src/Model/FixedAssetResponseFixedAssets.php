<?php

/**
 * FixedAssetResponseFixedAssets.
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
 * FixedAssetResponseFixedAssets Class Doc Comment.
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
class FixedAssetResponseFixedAssets implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'fixedAssetResponse_fixed_assets';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'company_id'                       => 'int',
        'id'                               => 'int',
        'name'                             => 'string',
        'management_number'                => 'string',
        'account_item_id'                  => 'int',
        'section_id'                       => 'int',
        'item_id'                          => 'int',
        'depreciation_method'              => 'string',
        'depreciation_account_item_id'     => 'int',
        'prefecture_code'                  => 'int',
        'city_name'                        => 'string',
        'depreciation_amount'              => 'int',
        'acquisition_cost'                 => 'int',
        'opening_balance'                  => 'int',
        'undepreciated_balance'            => 'int',
        'opening_accumulated_depreciation' => 'int',
        'closing_accumulated_depreciation' => 'int',
        'life_years'                       => 'int',
        'acquisition_date'                 => '\DateTime',
        'created_at'                       => 'string',
        'depreciation_status'              => 'string',
        'retire_date'                      => '\DateTime',
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
        'company_id'                       => 'int64',
        'id'                               => 'int64',
        'name'                             => null,
        'management_number'                => null,
        'account_item_id'                  => 'int64',
        'section_id'                       => 'int64',
        'item_id'                          => 'int64',
        'depreciation_method'              => null,
        'depreciation_account_item_id'     => 'int64',
        'prefecture_code'                  => 'int64',
        'city_name'                        => null,
        'depreciation_amount'              => 'int64',
        'acquisition_cost'                 => 'int64',
        'opening_balance'                  => 'int64',
        'undepreciated_balance'            => 'int64',
        'opening_accumulated_depreciation' => 'int64',
        'closing_accumulated_depreciation' => 'int64',
        'life_years'                       => 'int64',
        'acquisition_date'                 => 'date',
        'created_at'                       => null,
        'depreciation_status'              => null,
        'retire_date'                      => 'date',
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
        'company_id'                       => 'company_id',
        'id'                               => 'id',
        'name'                             => 'name',
        'management_number'                => 'management_number',
        'account_item_id'                  => 'account_item_id',
        'section_id'                       => 'section_id',
        'item_id'                          => 'item_id',
        'depreciation_method'              => 'depreciation_method',
        'depreciation_account_item_id'     => 'depreciation_account_item_id',
        'prefecture_code'                  => 'prefecture_code',
        'city_name'                        => 'city_name',
        'depreciation_amount'              => 'depreciation_amount',
        'acquisition_cost'                 => 'acquisition_cost',
        'opening_balance'                  => 'opening_balance',
        'undepreciated_balance'            => 'undepreciated_balance',
        'opening_accumulated_depreciation' => 'opening_accumulated_depreciation',
        'closing_accumulated_depreciation' => 'closing_accumulated_depreciation',
        'life_years'                       => 'life_years',
        'acquisition_date'                 => 'acquisition_date',
        'created_at'                       => 'created_at',
        'depreciation_status'              => 'depreciation_status',
        'retire_date'                      => 'retire_date',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'company_id'                       => 'setCompanyId',
        'id'                               => 'setId',
        'name'                             => 'setName',
        'management_number'                => 'setManagementNumber',
        'account_item_id'                  => 'setAccountItemId',
        'section_id'                       => 'setSectionId',
        'item_id'                          => 'setItemId',
        'depreciation_method'              => 'setDepreciationMethod',
        'depreciation_account_item_id'     => 'setDepreciationAccountItemId',
        'prefecture_code'                  => 'setPrefectureCode',
        'city_name'                        => 'setCityName',
        'depreciation_amount'              => 'setDepreciationAmount',
        'acquisition_cost'                 => 'setAcquisitionCost',
        'opening_balance'                  => 'setOpeningBalance',
        'undepreciated_balance'            => 'setUndepreciatedBalance',
        'opening_accumulated_depreciation' => 'setOpeningAccumulatedDepreciation',
        'closing_accumulated_depreciation' => 'setClosingAccumulatedDepreciation',
        'life_years'                       => 'setLifeYears',
        'acquisition_date'                 => 'setAcquisitionDate',
        'created_at'                       => 'setCreatedAt',
        'depreciation_status'              => 'setDepreciationStatus',
        'retire_date'                      => 'setRetireDate',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'company_id'                       => 'getCompanyId',
        'id'                               => 'getId',
        'name'                             => 'getName',
        'management_number'                => 'getManagementNumber',
        'account_item_id'                  => 'getAccountItemId',
        'section_id'                       => 'getSectionId',
        'item_id'                          => 'getItemId',
        'depreciation_method'              => 'getDepreciationMethod',
        'depreciation_account_item_id'     => 'getDepreciationAccountItemId',
        'prefecture_code'                  => 'getPrefectureCode',
        'city_name'                        => 'getCityName',
        'depreciation_amount'              => 'getDepreciationAmount',
        'acquisition_cost'                 => 'getAcquisitionCost',
        'opening_balance'                  => 'getOpeningBalance',
        'undepreciated_balance'            => 'getUndepreciatedBalance',
        'opening_accumulated_depreciation' => 'getOpeningAccumulatedDepreciation',
        'closing_accumulated_depreciation' => 'getClosingAccumulatedDepreciation',
        'life_years'                       => 'getLifeYears',
        'acquisition_date'                 => 'getAcquisitionDate',
        'created_at'                       => 'getCreatedAt',
        'depreciation_status'              => 'getDepreciationStatus',
        'retire_date'                      => 'getRetireDate',
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

    const DEPRECIATION_METHOD_SMALL_SUM_METHOD         = 'small_sum_method';
    const DEPRECIATION_METHOD_LUMP_SUM_METHOD          = 'lump_sum_method';
    const DEPRECIATION_METHOD_STRAIGHT_LINE_METHOD     = 'straight_line_method';
    const DEPRECIATION_METHOD_MULTIPLE_METHOD          = 'multiple_method';
    const DEPRECIATION_METHOD_OLD_MULTIPLE_METHOD      = 'old_multiple_method';
    const DEPRECIATION_METHOD_OLD_STRAIGHT_LINE_METHOD = 'old_straight_line_method';
    const DEPRECIATION_METHOD_NON_DEPRECIATE_METHOD    = 'non_depreciate_method';
    const DEPRECIATION_METHOD_VOLUNTARY_METHOD         = 'voluntary_method';
    const DEPRECIATION_METHOD_IMMEDIATE_METHOD         = 'immediate_method';
    const DEPRECIATION_METHOD_EQUAL_METHOD             = 'equal_method';
    const DEPRECIATION_STATUS_SOLD                     = 'sold';
    const DEPRECIATION_STATUS_RETIRED                  = 'retired';
    const DEPRECIATION_STATUS_DEPRECIATED              = 'depreciated';
    const DEPRECIATION_STATUS_DEPRECIATION             = 'depreciation';
    const DEPRECIATION_STATUS_NON_DEPRECIATION         = 'non_depreciation';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getDepreciationMethodAllowableValues()
    {
        return [
            self::DEPRECIATION_METHOD_SMALL_SUM_METHOD,
            self::DEPRECIATION_METHOD_LUMP_SUM_METHOD,
            self::DEPRECIATION_METHOD_STRAIGHT_LINE_METHOD,
            self::DEPRECIATION_METHOD_MULTIPLE_METHOD,
            self::DEPRECIATION_METHOD_OLD_MULTIPLE_METHOD,
            self::DEPRECIATION_METHOD_OLD_STRAIGHT_LINE_METHOD,
            self::DEPRECIATION_METHOD_NON_DEPRECIATE_METHOD,
            self::DEPRECIATION_METHOD_VOLUNTARY_METHOD,
            self::DEPRECIATION_METHOD_IMMEDIATE_METHOD,
            self::DEPRECIATION_METHOD_EQUAL_METHOD,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getDepreciationStatusAllowableValues()
    {
        return [
            self::DEPRECIATION_STATUS_SOLD,
            self::DEPRECIATION_STATUS_RETIRED,
            self::DEPRECIATION_STATUS_DEPRECIATED,
            self::DEPRECIATION_STATUS_DEPRECIATION,
            self::DEPRECIATION_STATUS_NON_DEPRECIATION,
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
        $this->container['company_id']                       = $data['company_id'] ?? null;
        $this->container['id']                               = $data['id'] ?? null;
        $this->container['name']                             = $data['name'] ?? null;
        $this->container['management_number']                = $data['management_number'] ?? null;
        $this->container['account_item_id']                  = $data['account_item_id'] ?? null;
        $this->container['section_id']                       = $data['section_id'] ?? null;
        $this->container['item_id']                          = $data['item_id'] ?? null;
        $this->container['depreciation_method']              = $data['depreciation_method'] ?? null;
        $this->container['depreciation_account_item_id']     = $data['depreciation_account_item_id'] ?? null;
        $this->container['prefecture_code']                  = $data['prefecture_code'] ?? null;
        $this->container['city_name']                        = $data['city_name'] ?? null;
        $this->container['depreciation_amount']              = $data['depreciation_amount'] ?? null;
        $this->container['acquisition_cost']                 = $data['acquisition_cost'] ?? null;
        $this->container['opening_balance']                  = $data['opening_balance'] ?? null;
        $this->container['undepreciated_balance']            = $data['undepreciated_balance'] ?? null;
        $this->container['opening_accumulated_depreciation'] = $data['opening_accumulated_depreciation'] ?? null;
        $this->container['closing_accumulated_depreciation'] = $data['closing_accumulated_depreciation'] ?? null;
        $this->container['life_years']                       = $data['life_years'] ?? null;
        $this->container['acquisition_date']                 = $data['acquisition_date'] ?? null;
        $this->container['created_at']                       = $data['created_at'] ?? null;
        $this->container['depreciation_status']              = $data['depreciation_status'] ?? null;
        $this->container['retire_date']                      = $data['retire_date'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['company_id']) && ($this->container['company_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'company_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['id']) && ($this->container['id'] < 1)) {
            $invalidProperties[] = "invalid value for 'id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['account_item_id']) && ($this->container['account_item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'account_item_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['section_id']) && ($this->container['section_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'section_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['item_id']) && ($this->container['item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'item_id', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getDepreciationMethodAllowableValues();
        if (!is_null($this->container['depreciation_method']) && !in_array($this->container['depreciation_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'depreciation_method', must be one of '%s'",
                $this->container['depreciation_method'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['depreciation_account_item_id']) && ($this->container['depreciation_account_item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'depreciation_account_item_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['prefecture_code']) && ($this->container['prefecture_code'] > 46)) {
            $invalidProperties[] = "invalid value for 'prefecture_code', must be smaller than or equal to 46.";
        }

        if (!is_null($this->container['prefecture_code']) && ($this->container['prefecture_code'] < -1)) {
            $invalidProperties[] = "invalid value for 'prefecture_code', must be bigger than or equal to -1.";
        }

        $allowedValues = $this->getDepreciationStatusAllowableValues();
        if (!is_null($this->container['depreciation_status']) && !in_array($this->container['depreciation_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'depreciation_status', must be one of '%s'",
                $this->container['depreciation_status'],
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
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id.
     *
     * @param int|null $company_id 事業所ID
     *
     * @return self
     */
    public function setCompanyId($company_id)
    {
        if (!is_null($company_id) && ($company_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $company_id when calling FixedAssetResponseFixedAssets., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id.
     *
     * @param int|null $id 固定資産ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (!is_null($id) && ($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling FixedAssetResponseFixedAssets., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name.
     *
     * @param string|null $name 固定資産名
     *
     * @return self
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets management_number.
     *
     * @return string|null
     */
    public function getManagementNumber()
    {
        return $this->container['management_number'];
    }

    /**
     * Sets management_number.
     *
     * @param string|null $management_number 管理番号
     *
     * @return self
     */
    public function setManagementNumber($management_number)
    {
        $this->container['management_number'] = $management_number;

        return $this;
    }

    /**
     * Gets account_item_id.
     *
     * @return int|null
     */
    public function getAccountItemId()
    {
        return $this->container['account_item_id'];
    }

    /**
     * Sets account_item_id.
     *
     * @param int|null $account_item_id 勘定科目ID
     *
     * @return self
     */
    public function setAccountItemId($account_item_id)
    {
        if (!is_null($account_item_id) && ($account_item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $account_item_id when calling FixedAssetResponseFixedAssets., must be bigger than or equal to 1.');
        }

        $this->container['account_item_id'] = $account_item_id;

        return $this;
    }

    /**
     * Gets section_id.
     *
     * @return int|null
     */
    public function getSectionId()
    {
        return $this->container['section_id'];
    }

    /**
     * Sets section_id.
     *
     * @param int|null $section_id 部門ID
     *
     * @return self
     */
    public function setSectionId($section_id)
    {
        if (!is_null($section_id) && ($section_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $section_id when calling FixedAssetResponseFixedAssets., must be bigger than or equal to 1.');
        }

        $this->container['section_id'] = $section_id;

        return $this;
    }

    /**
     * Gets item_id.
     *
     * @return int|null
     */
    public function getItemId()
    {
        return $this->container['item_id'];
    }

    /**
     * Sets item_id.
     *
     * @param int|null $item_id 品目ID
     *
     * @return self
     */
    public function setItemId($item_id)
    {
        if (!is_null($item_id) && ($item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $item_id when calling FixedAssetResponseFixedAssets., must be bigger than or equal to 1.');
        }

        $this->container['item_id'] = $item_id;

        return $this;
    }

    /**
     * Gets depreciation_method.
     *
     * @return string|null
     */
    public function getDepreciationMethod()
    {
        return $this->container['depreciation_method'];
    }

    /**
     * Sets depreciation_method.
     *
     * @param string|null $depreciation_method 償却方法:(少額償却: small_sum_method, 一括償却: lump_sum_method, 定額法: straight_line_method, 定率法: multiple_method, 旧定率法: old_multiple_method, 旧定額法: old_straight_line_method, 償却なし: non_depreciate_method, 任意償却: voluntary_method, 即時償却: immediate_method, 均等償却: equal_method)
     *
     * @return self
     */
    public function setDepreciationMethod($depreciation_method)
    {
        $allowedValues = $this->getDepreciationMethodAllowableValues();
        if (!is_null($depreciation_method) && !in_array($depreciation_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'depreciation_method', must be one of '%s'",
                    $depreciation_method,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['depreciation_method'] = $depreciation_method;

        return $this;
    }

    /**
     * Gets depreciation_account_item_id.
     *
     * @return int|null
     */
    public function getDepreciationAccountItemId()
    {
        return $this->container['depreciation_account_item_id'];
    }

    /**
     * Sets depreciation_account_item_id.
     *
     * @param int|null $depreciation_account_item_id 減価償却に使う勘定科目ID
     *
     * @return self
     */
    public function setDepreciationAccountItemId($depreciation_account_item_id)
    {
        if (!is_null($depreciation_account_item_id) && ($depreciation_account_item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $depreciation_account_item_id when calling FixedAssetResponseFixedAssets., must be bigger than or equal to 1.');
        }

        $this->container['depreciation_account_item_id'] = $depreciation_account_item_id;

        return $this;
    }

    /**
     * Gets prefecture_code.
     *
     * @return int|null
     */
    public function getPrefectureCode()
    {
        return $this->container['prefecture_code'];
    }

    /**
     * Sets prefecture_code.
     *
     * @param int|null $prefecture_code 都道府県コード（-1: 設定しない、0:北海道、1:青森、2:岩手、3:宮城、4:秋田、5:山形、6:福島、7:茨城、8:栃木、9:群馬、10:埼玉、11:千葉、12:東京、13:神奈川、14:新潟、15:富山、16:石川、17:福井、18:山梨、19:長野、20:岐阜、21:静岡、22:愛知、23:三重、24:滋賀、25:京都、26:大阪、27:兵庫、28:奈良、29:和歌山、30:鳥取、31:島根、32:岡山、33:広島、34:山口、35:徳島、36:香川、37:愛媛、38:高知、39:福岡、40:佐賀、41:長崎、42:熊本、43:大分、44:宮崎、45:鹿児島、46:沖縄
     *
     * @return self
     */
    public function setPrefectureCode($prefecture_code)
    {
        if (!is_null($prefecture_code) && ($prefecture_code > 46)) {
            throw new \InvalidArgumentException('invalid value for $prefecture_code when calling FixedAssetResponseFixedAssets., must be smaller than or equal to 46.');
        }
        if (!is_null($prefecture_code) && ($prefecture_code < -1)) {
            throw new \InvalidArgumentException('invalid value for $prefecture_code when calling FixedAssetResponseFixedAssets., must be bigger than or equal to -1.');
        }

        $this->container['prefecture_code'] = $prefecture_code;

        return $this;
    }

    /**
     * Gets city_name.
     *
     * @return string|null
     */
    public function getCityName()
    {
        return $this->container['city_name'];
    }

    /**
     * Sets city_name.
     *
     * @param string|null $city_name 申告先市区町村
     *
     * @return self
     */
    public function setCityName($city_name)
    {
        $this->container['city_name'] = $city_name;

        return $this;
    }

    /**
     * Gets depreciation_amount.
     *
     * @return int|null
     */
    public function getDepreciationAmount()
    {
        return $this->container['depreciation_amount'];
    }

    /**
     * Sets depreciation_amount.
     *
     * @param int|null $depreciation_amount 本年分の償却費合計
     *
     * @return self
     */
    public function setDepreciationAmount($depreciation_amount)
    {
        $this->container['depreciation_amount'] = $depreciation_amount;

        return $this;
    }

    /**
     * Gets acquisition_cost.
     *
     * @return int|null
     */
    public function getAcquisitionCost()
    {
        return $this->container['acquisition_cost'];
    }

    /**
     * Sets acquisition_cost.
     *
     * @param int|null $acquisition_cost 取得価額
     *
     * @return self
     */
    public function setAcquisitionCost($acquisition_cost)
    {
        $this->container['acquisition_cost'] = $acquisition_cost;

        return $this;
    }

    /**
     * Gets opening_balance.
     *
     * @return int|null
     */
    public function getOpeningBalance()
    {
        return $this->container['opening_balance'];
    }

    /**
     * Sets opening_balance.
     *
     * @param int|null $opening_balance 期首残高（取得日が会計期間に含まれるとき期首残高は0になります。）
     *
     * @return self
     */
    public function setOpeningBalance($opening_balance)
    {
        $this->container['opening_balance'] = $opening_balance;

        return $this;
    }

    /**
     * Gets undepreciated_balance.
     *
     * @return int|null
     */
    public function getUndepreciatedBalance()
    {
        return $this->container['undepreciated_balance'];
    }

    /**
     * Sets undepreciated_balance.
     *
     * @param int|null $undepreciated_balance 未償却残高
     *
     * @return self
     */
    public function setUndepreciatedBalance($undepreciated_balance)
    {
        $this->container['undepreciated_balance'] = $undepreciated_balance;

        return $this;
    }

    /**
     * Gets opening_accumulated_depreciation.
     *
     * @return int|null
     */
    public function getOpeningAccumulatedDepreciation()
    {
        return $this->container['opening_accumulated_depreciation'];
    }

    /**
     * Sets opening_accumulated_depreciation.
     *
     * @param int|null $opening_accumulated_depreciation 期首減価償却累計額
     *
     * @return self
     */
    public function setOpeningAccumulatedDepreciation($opening_accumulated_depreciation)
    {
        $this->container['opening_accumulated_depreciation'] = $opening_accumulated_depreciation;

        return $this;
    }

    /**
     * Gets closing_accumulated_depreciation.
     *
     * @return int|null
     */
    public function getClosingAccumulatedDepreciation()
    {
        return $this->container['closing_accumulated_depreciation'];
    }

    /**
     * Sets closing_accumulated_depreciation.
     *
     * @param int|null $closing_accumulated_depreciation 期末減価償却累計額
     *
     * @return self
     */
    public function setClosingAccumulatedDepreciation($closing_accumulated_depreciation)
    {
        $this->container['closing_accumulated_depreciation'] = $closing_accumulated_depreciation;

        return $this;
    }

    /**
     * Gets life_years.
     *
     * @return int|null
     */
    public function getLifeYears()
    {
        return $this->container['life_years'];
    }

    /**
     * Sets life_years.
     *
     * @param int|null $life_years 耐用年数
     *
     * @return self
     */
    public function setLifeYears($life_years)
    {
        $this->container['life_years'] = $life_years;

        return $this;
    }

    /**
     * Gets acquisition_date.
     *
     * @return \DateTime|null
     */
    public function getAcquisitionDate()
    {
        return $this->container['acquisition_date'];
    }

    /**
     * Sets acquisition_date.
     *
     * @param \DateTime|null $acquisition_date 取得日
     *
     * @return self
     */
    public function setAcquisitionDate($acquisition_date)
    {
        $this->container['acquisition_date'] = $acquisition_date;

        return $this;
    }

    /**
     * Gets created_at.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at.
     *
     * @param string|null $created_at 作成日時（ISO8601形式）
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets depreciation_status.
     *
     * @return string|null
     */
    public function getDepreciationStatus()
    {
        return $this->container['depreciation_status'];
    }

    /**
     * Sets depreciation_status.
     *
     * @param string|null $depreciation_status 売却もしくは除却ステータス: (売却済: sold, 除却済: retired, 償却済: depreciated, 償却中: depreciation, 償却なし: non_depreciation)
     *
     * @return self
     */
    public function setDepreciationStatus($depreciation_status)
    {
        $allowedValues = $this->getDepreciationStatusAllowableValues();
        if (!is_null($depreciation_status) && !in_array($depreciation_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'depreciation_status', must be one of '%s'",
                    $depreciation_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['depreciation_status'] = $depreciation_status;

        return $this;
    }

    /**
     * Gets retire_date.
     *
     * @return \DateTime|null
     */
    public function getRetireDate()
    {
        return $this->container['retire_date'];
    }

    /**
     * Sets retire_date.
     *
     * @param \DateTime|null $retire_date 除却日、もしくは売却日
     *
     * @return self
     */
    public function setRetireDate($retire_date)
    {
        $this->container['retire_date'] = $retire_date;

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
