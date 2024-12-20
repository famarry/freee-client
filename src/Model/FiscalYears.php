<?php

/**
 * FiscalYears.
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
 * FiscalYears Class Doc Comment.
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
class FiscalYears implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'fiscal_years';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'use_industry_template'      => 'bool',
        'indirect_write_off_method'  => 'bool',
        'start_date'                 => 'string',
        'end_date'                   => 'string',
        'depreciation_record_method' => 'int',
        'tax_method'                 => 'int',
        'sales_tax_business_code'    => 'int',
        'tax_fraction'               => 'int',
        'tax_account_method'         => 'int',
        'return_code'                => 'int',
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
        'use_industry_template'      => null,
        'indirect_write_off_method'  => null,
        'start_date'                 => null,
        'end_date'                   => null,
        'depreciation_record_method' => 'int64',
        'tax_method'                 => 'int64',
        'sales_tax_business_code'    => 'int64',
        'tax_fraction'               => 'int64',
        'tax_account_method'         => 'int64',
        'return_code'                => 'int64',
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
        'use_industry_template'      => 'use_industry_template',
        'indirect_write_off_method'  => 'indirect_write_off_method',
        'start_date'                 => 'start_date',
        'end_date'                   => 'end_date',
        'depreciation_record_method' => 'depreciation_record_method',
        'tax_method'                 => 'tax_method',
        'sales_tax_business_code'    => 'sales_tax_business_code',
        'tax_fraction'               => 'tax_fraction',
        'tax_account_method'         => 'tax_account_method',
        'return_code'                => 'return_code',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'use_industry_template'      => 'setUseIndustryTemplate',
        'indirect_write_off_method'  => 'setIndirectWriteOffMethod',
        'start_date'                 => 'setStartDate',
        'end_date'                   => 'setEndDate',
        'depreciation_record_method' => 'setDepreciationRecordMethod',
        'tax_method'                 => 'setTaxMethod',
        'sales_tax_business_code'    => 'setSalesTaxBusinessCode',
        'tax_fraction'               => 'setTaxFraction',
        'tax_account_method'         => 'setTaxAccountMethod',
        'return_code'                => 'setReturnCode',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'use_industry_template'      => 'getUseIndustryTemplate',
        'indirect_write_off_method'  => 'getIndirectWriteOffMethod',
        'start_date'                 => 'getStartDate',
        'end_date'                   => 'getEndDate',
        'depreciation_record_method' => 'getDepreciationRecordMethod',
        'tax_method'                 => 'getTaxMethod',
        'sales_tax_business_code'    => 'getSalesTaxBusinessCode',
        'tax_fraction'               => 'getTaxFraction',
        'tax_account_method'         => 'getTaxAccountMethod',
        'return_code'                => 'getReturnCode',
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
        $this->container['use_industry_template']      = $data['use_industry_template'] ?? null;
        $this->container['indirect_write_off_method']  = $data['indirect_write_off_method'] ?? null;
        $this->container['start_date']                 = $data['start_date'] ?? null;
        $this->container['end_date']                   = $data['end_date'] ?? null;
        $this->container['depreciation_record_method'] = $data['depreciation_record_method'] ?? null;
        $this->container['tax_method']                 = $data['tax_method'] ?? null;
        $this->container['sales_tax_business_code']    = $data['sales_tax_business_code'] ?? null;
        $this->container['tax_fraction']               = $data['tax_fraction'] ?? null;
        $this->container['tax_account_method']         = $data['tax_account_method'] ?? null;
        $this->container['return_code']                = $data['return_code'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['use_industry_template'] === null) {
            $invalidProperties[] = "'use_industry_template' can't be null";
        }
        if ($this->container['indirect_write_off_method'] === null) {
            $invalidProperties[] = "'indirect_write_off_method' can't be null";
        }
        if ($this->container['depreciation_record_method'] === null) {
            $invalidProperties[] = "'depreciation_record_method' can't be null";
        }
        if (($this->container['depreciation_record_method'] > 1)) {
            $invalidProperties[] = "invalid value for 'depreciation_record_method', must be smaller than or equal to 1.";
        }

        if (($this->container['depreciation_record_method'] < 0)) {
            $invalidProperties[] = "invalid value for 'depreciation_record_method', must be bigger than or equal to 0.";
        }

        if ($this->container['tax_method'] === null) {
            $invalidProperties[] = "'tax_method' can't be null";
        }
        if (($this->container['tax_method'] > 4)) {
            $invalidProperties[] = "invalid value for 'tax_method', must be smaller than or equal to 4.";
        }

        if (($this->container['tax_method'] < 0)) {
            $invalidProperties[] = "invalid value for 'tax_method', must be bigger than or equal to 0.";
        }

        if ($this->container['sales_tax_business_code'] === null) {
            $invalidProperties[] = "'sales_tax_business_code' can't be null";
        }
        if (($this->container['sales_tax_business_code'] > 5)) {
            $invalidProperties[] = "invalid value for 'sales_tax_business_code', must be smaller than or equal to 5.";
        }

        if (($this->container['sales_tax_business_code'] < 0)) {
            $invalidProperties[] = "invalid value for 'sales_tax_business_code', must be bigger than or equal to 0.";
        }

        if ($this->container['tax_fraction'] === null) {
            $invalidProperties[] = "'tax_fraction' can't be null";
        }
        if (($this->container['tax_fraction'] > 2)) {
            $invalidProperties[] = "invalid value for 'tax_fraction', must be smaller than or equal to 2.";
        }

        if (($this->container['tax_fraction'] < 0)) {
            $invalidProperties[] = "invalid value for 'tax_fraction', must be bigger than or equal to 0.";
        }

        if ($this->container['tax_account_method'] === null) {
            $invalidProperties[] = "'tax_account_method' can't be null";
        }
        if (($this->container['tax_account_method'] > 2)) {
            $invalidProperties[] = "invalid value for 'tax_account_method', must be smaller than or equal to 2.";
        }

        if (($this->container['tax_account_method'] < 0)) {
            $invalidProperties[] = "invalid value for 'tax_account_method', must be bigger than or equal to 0.";
        }

        if ($this->container['return_code'] === null) {
            $invalidProperties[] = "'return_code' can't be null";
        }
        if (($this->container['return_code'] > 3)) {
            $invalidProperties[] = "invalid value for 'return_code', must be smaller than or equal to 3.";
        }

        if (($this->container['return_code'] < 0)) {
            $invalidProperties[] = "invalid value for 'return_code', must be bigger than or equal to 0.";
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
     * Gets use_industry_template.
     *
     * @return bool
     */
    public function getUseIndustryTemplate()
    {
        return $this->container['use_industry_template'];
    }

    /**
     * Sets use_industry_template.
     *
     * @param bool $use_industry_template 製造業向け機能（true: 使用する、false: 使用しない）
     *
     * @return self
     */
    public function setUseIndustryTemplate($use_industry_template)
    {
        $this->container['use_industry_template'] = $use_industry_template;

        return $this;
    }

    /**
     * Gets indirect_write_off_method.
     *
     * @return bool
     */
    public function getIndirectWriteOffMethod()
    {
        return $this->container['indirect_write_off_method'];
    }

    /**
     * Sets indirect_write_off_method.
     *
     * @param bool $indirect_write_off_method 固定資産の控除法（true: 間接控除法、false: 直接控除法）
     *
     * @return self
     */
    public function setIndirectWriteOffMethod($indirect_write_off_method)
    {
        $this->container['indirect_write_off_method'] = $indirect_write_off_method;

        return $this;
    }

    /**
     * Gets start_date.
     *
     * @return string|null
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date.
     *
     * @param string|null $start_date 期首日
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
     * @return string|null
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date.
     *
     * @param string|null $end_date 期末日
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets depreciation_record_method.
     *
     * @return int
     */
    public function getDepreciationRecordMethod()
    {
        return $this->container['depreciation_record_method'];
    }

    /**
     * Sets depreciation_record_method.
     *
     * @param int $depreciation_record_method 月次償却（0: しない、1: する）
     *
     * @return self
     */
    public function setDepreciationRecordMethod($depreciation_record_method)
    {
        if (($depreciation_record_method > 1)) {
            throw new \InvalidArgumentException('invalid value for $depreciation_record_method when calling FiscalYears., must be smaller than or equal to 1.');
        }
        if (($depreciation_record_method < 0)) {
            throw new \InvalidArgumentException('invalid value for $depreciation_record_method when calling FiscalYears., must be bigger than or equal to 0.');
        }

        $this->container['depreciation_record_method'] = $depreciation_record_method;

        return $this;
    }

    /**
     * Gets tax_method.
     *
     * @return int
     */
    public function getTaxMethod()
    {
        return $this->container['tax_method'];
    }

    /**
     * Sets tax_method.
     *
     * @param int $tax_method 課税区分（0: 免税、1: 簡易課税、2: 本則課税（個別対応方式）、3: 本則課税（一括比例配分方式）、4: 本則課税（全額控除））
     *
     * @return self
     */
    public function setTaxMethod($tax_method)
    {
        if (($tax_method > 4)) {
            throw new \InvalidArgumentException('invalid value for $tax_method when calling FiscalYears., must be smaller than or equal to 4.');
        }
        if (($tax_method < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_method when calling FiscalYears., must be bigger than or equal to 0.');
        }

        $this->container['tax_method'] = $tax_method;

        return $this;
    }

    /**
     * Gets sales_tax_business_code.
     *
     * @return int
     */
    public function getSalesTaxBusinessCode()
    {
        return $this->container['sales_tax_business_code'];
    }

    /**
     * Sets sales_tax_business_code.
     *
     * @param int $sales_tax_business_code 簡易課税用事業区分（0: 第一種：卸売業、1: 第二種：小売業、2: 第三種：農林水産業、工業、建設業、製造業など、3: 第四種：飲食店業など、4: 第五種：金融・保険業、運輸通信業、サービス業など、5: 第六種：不動産業など
     *
     * @return self
     */
    public function setSalesTaxBusinessCode($sales_tax_business_code)
    {
        if (($sales_tax_business_code > 5)) {
            throw new \InvalidArgumentException('invalid value for $sales_tax_business_code when calling FiscalYears., must be smaller than or equal to 5.');
        }
        if (($sales_tax_business_code < 0)) {
            throw new \InvalidArgumentException('invalid value for $sales_tax_business_code when calling FiscalYears., must be bigger than or equal to 0.');
        }

        $this->container['sales_tax_business_code'] = $sales_tax_business_code;

        return $this;
    }

    /**
     * Gets tax_fraction.
     *
     * @return int
     */
    public function getTaxFraction()
    {
        return $this->container['tax_fraction'];
    }

    /**
     * Sets tax_fraction.
     *
     * @param int $tax_fraction 消費税端数処理方法（0: 切り捨て、1: 切り上げ、2: 四捨五入）
     *
     * @return self
     */
    public function setTaxFraction($tax_fraction)
    {
        if (($tax_fraction > 2)) {
            throw new \InvalidArgumentException('invalid value for $tax_fraction when calling FiscalYears., must be smaller than or equal to 2.');
        }
        if (($tax_fraction < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_fraction when calling FiscalYears., must be bigger than or equal to 0.');
        }

        $this->container['tax_fraction'] = $tax_fraction;

        return $this;
    }

    /**
     * Gets tax_account_method.
     *
     * @return int
     */
    public function getTaxAccountMethod()
    {
        return $this->container['tax_account_method'];
    }

    /**
     * Sets tax_account_method.
     *
     * @param int $tax_account_method 消費税経理処理方法（0: 税込経理、1: 旧税抜経理、2: 税抜経理）
     *
     * @return self
     */
    public function setTaxAccountMethod($tax_account_method)
    {
        if (($tax_account_method > 2)) {
            throw new \InvalidArgumentException('invalid value for $tax_account_method when calling FiscalYears., must be smaller than or equal to 2.');
        }
        if (($tax_account_method < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_account_method when calling FiscalYears., must be bigger than or equal to 0.');
        }

        $this->container['tax_account_method'] = $tax_account_method;

        return $this;
    }

    /**
     * Gets return_code.
     *
     * @return int
     */
    public function getReturnCode()
    {
        return $this->container['return_code'];
    }

    /**
     * Sets return_code.
     *
     * @param int $return_code 不動産所得使用区分（0: 一般、3: 一般/不動産） ※個人事業主のみ設定可能
     *
     * @return self
     */
    public function setReturnCode($return_code)
    {
        if (($return_code > 3)) {
            throw new \InvalidArgumentException('invalid value for $return_code when calling FiscalYears., must be smaller than or equal to 3.');
        }
        if (($return_code < 0)) {
            throw new \InvalidArgumentException('invalid value for $return_code when calling FiscalYears., must be bigger than or equal to 0.');
        }

        $this->container['return_code'] = $return_code;

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
