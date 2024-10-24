<?php
/**
 * AccountItemCreateParamsAccountItem.
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
 * AccountItemCreateParamsAccountItem Class Doc Comment.
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
class AccountItemCreateParamsAccountItem implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'accountItemCreateParams_account_item';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'name'                            => 'string',
        'shortcut'                        => 'string',
        'shortcut_num'                    => 'string',
        'code'                            => 'string',
        'tax_code'                        => 'int',
        'group_name'                      => 'string',
        'account_category_id'             => 'int',
        'corresponding_income_id'         => 'int',
        'corresponding_expense_id'        => 'int',
        'accumulated_dep_account_item_id' => 'int',
        'searchable'                      => 'int',
        'items'                           => '\OpenAPI\Client\Model\AccountItemCreateParamsAccountItemItems[]',
        'partners'                        => '\OpenAPI\Client\Model\AccountItemCreateParamsAccountItemItems[]',
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
        'name'                            => null,
        'shortcut'                        => null,
        'shortcut_num'                    => null,
        'code'                            => null,
        'tax_code'                        => 'int64',
        'group_name'                      => null,
        'account_category_id'             => 'int64',
        'corresponding_income_id'         => 'int64',
        'corresponding_expense_id'        => 'int64',
        'accumulated_dep_account_item_id' => 'int64',
        'searchable'                      => 'int64',
        'items'                           => null,
        'partners'                        => null,
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
        'name'                            => 'name',
        'shortcut'                        => 'shortcut',
        'shortcut_num'                    => 'shortcut_num',
        'code'                            => 'code',
        'tax_code'                        => 'tax_code',
        'group_name'                      => 'group_name',
        'account_category_id'             => 'account_category_id',
        'corresponding_income_id'         => 'corresponding_income_id',
        'corresponding_expense_id'        => 'corresponding_expense_id',
        'accumulated_dep_account_item_id' => 'accumulated_dep_account_item_id',
        'searchable'                      => 'searchable',
        'items'                           => 'items',
        'partners'                        => 'partners',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'name'                            => 'setName',
        'shortcut'                        => 'setShortcut',
        'shortcut_num'                    => 'setShortcutNum',
        'code'                            => 'setCode',
        'tax_code'                        => 'setTaxCode',
        'group_name'                      => 'setGroupName',
        'account_category_id'             => 'setAccountCategoryId',
        'corresponding_income_id'         => 'setCorrespondingIncomeId',
        'corresponding_expense_id'        => 'setCorrespondingExpenseId',
        'accumulated_dep_account_item_id' => 'setAccumulatedDepAccountItemId',
        'searchable'                      => 'setSearchable',
        'items'                           => 'setItems',
        'partners'                        => 'setPartners',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'name'                            => 'getName',
        'shortcut'                        => 'getShortcut',
        'shortcut_num'                    => 'getShortcutNum',
        'code'                            => 'getCode',
        'tax_code'                        => 'getTaxCode',
        'group_name'                      => 'getGroupName',
        'account_category_id'             => 'getAccountCategoryId',
        'corresponding_income_id'         => 'getCorrespondingIncomeId',
        'corresponding_expense_id'        => 'getCorrespondingExpenseId',
        'accumulated_dep_account_item_id' => 'getAccumulatedDepAccountItemId',
        'searchable'                      => 'getSearchable',
        'items'                           => 'getItems',
        'partners'                        => 'getPartners',
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
        $this->container['name']                            = $data['name'] ?? null;
        $this->container['shortcut']                        = $data['shortcut'] ?? null;
        $this->container['shortcut_num']                    = $data['shortcut_num'] ?? null;
        $this->container['code']                            = $data['code'] ?? null;
        $this->container['tax_code']                        = $data['tax_code'] ?? null;
        $this->container['group_name']                      = $data['group_name'] ?? null;
        $this->container['account_category_id']             = $data['account_category_id'] ?? null;
        $this->container['corresponding_income_id']         = $data['corresponding_income_id'] ?? null;
        $this->container['corresponding_expense_id']        = $data['corresponding_expense_id'] ?? null;
        $this->container['accumulated_dep_account_item_id'] = $data['accumulated_dep_account_item_id'] ?? null;
        $this->container['searchable']                      = $data['searchable'] ?? null;
        $this->container['items']                           = $data['items'] ?? null;
        $this->container['partners']                        = $data['partners'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 30)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 30.";
        }

        if (!is_null($this->container['shortcut']) && (mb_strlen($this->container['shortcut']) > 20)) {
            $invalidProperties[] = "invalid value for 'shortcut', the character length must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['shortcut_num']) && (mb_strlen($this->container['shortcut_num']) > 20)) {
            $invalidProperties[] = "invalid value for 'shortcut_num', the character length must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['code']) && (mb_strlen($this->container['code']) > 20)) {
            $invalidProperties[] = "invalid value for 'code', the character length must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['code']) && !preg_match('/^[0-9a-zA-Z_-]+$/', $this->container['code'])) {
            $invalidProperties[] = "invalid value for 'code', must be conform to the pattern /^[0-9a-zA-Z_-]+$/.";
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

        if ($this->container['group_name'] === null) {
            $invalidProperties[] = "'group_name' can't be null";
        }
        if ($this->container['account_category_id'] === null) {
            $invalidProperties[] = "'account_category_id' can't be null";
        }
        if (($this->container['account_category_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'account_category_id', must be bigger than or equal to 1.";
        }

        if ($this->container['corresponding_income_id'] === null) {
            $invalidProperties[] = "'corresponding_income_id' can't be null";
        }
        if (($this->container['corresponding_income_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'corresponding_income_id', must be bigger than or equal to 1.";
        }

        if ($this->container['corresponding_expense_id'] === null) {
            $invalidProperties[] = "'corresponding_expense_id' can't be null";
        }
        if (($this->container['corresponding_expense_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'corresponding_expense_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['accumulated_dep_account_item_id']) && ($this->container['accumulated_dep_account_item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'accumulated_dep_account_item_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['searchable']) && ($this->container['searchable'] > 3)) {
            $invalidProperties[] = "invalid value for 'searchable', must be smaller than or equal to 3.";
        }

        if (!is_null($this->container['searchable']) && ($this->container['searchable'] < 2)) {
            $invalidProperties[] = "invalid value for 'searchable', must be bigger than or equal to 2.";
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
     * Gets name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name.
     *
     * @param string $name 勘定科目名 (30文字以内)
     *
     * @return self
     */
    public function setName($name)
    {
        if ((mb_strlen($name) > 30)) {
            throw new \InvalidArgumentException('invalid length for $name when calling AccountItemCreateParamsAccountItem., must be smaller than or equal to 30.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets shortcut.
     *
     * @return string|null
     */
    public function getShortcut()
    {
        return $this->container['shortcut'];
    }

    /**
     * Sets shortcut.
     *
     * @param string|null $shortcut ショートカット1 (20文字以内)
     *
     * @return self
     */
    public function setShortcut($shortcut)
    {
        if (!is_null($shortcut) && (mb_strlen($shortcut) > 20)) {
            throw new \InvalidArgumentException('invalid length for $shortcut when calling AccountItemCreateParamsAccountItem., must be smaller than or equal to 20.');
        }

        $this->container['shortcut'] = $shortcut;

        return $this;
    }

    /**
     * Gets shortcut_num.
     *
     * @return string|null
     */
    public function getShortcutNum()
    {
        return $this->container['shortcut_num'];
    }

    /**
     * Sets shortcut_num.
     *
     * @param string|null $shortcut_num ショートカット2 (20文字以内)
     *
     * @return self
     */
    public function setShortcutNum($shortcut_num)
    {
        if (!is_null($shortcut_num) && (mb_strlen($shortcut_num) > 20)) {
            throw new \InvalidArgumentException('invalid length for $shortcut_num when calling AccountItemCreateParamsAccountItem., must be smaller than or equal to 20.');
        }

        $this->container['shortcut_num'] = $shortcut_num;

        return $this;
    }

    /**
     * Gets code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->container['code'];
    }

    /**
     * Sets code.
     *
     * @param string|null $code 勘定科目コード
     *
     * @return self
     */
    public function setCode($code)
    {
        if (!is_null($code) && (mb_strlen($code) > 20)) {
            throw new \InvalidArgumentException('invalid length for $code when calling AccountItemCreateParamsAccountItem., must be smaller than or equal to 20.');
        }
        if (!is_null($code) && (!preg_match('/^[0-9a-zA-Z_-]+$/', $code))) {
            throw new \InvalidArgumentException("invalid value for $code when calling AccountItemCreateParamsAccountItem., must conform to the pattern /^[0-9a-zA-Z_-]+$/.");
        }

        $this->container['code'] = $code;

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
     * @param int $tax_code 税区分コード 指定できるコードは本APIの注意点をご確認ください。
     *
     * @return self
     */
    public function setTaxCode($tax_code)
    {
        if (($tax_code > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $tax_code when calling AccountItemCreateParamsAccountItem., must be smaller than or equal to 2147483647.');
        }
        if (($tax_code < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_code when calling AccountItemCreateParamsAccountItem., must be bigger than or equal to 0.');
        }

        $this->container['tax_code'] = $tax_code;

        return $this;
    }

    /**
     * Gets group_name.
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->container['group_name'];
    }

    /**
     * Sets group_name.
     *
     * @param string $group_name 決算書表示名（小カテゴリー） Selectablesフォーム用選択項目情報エンドポイント(account_groups.name)で取得可能です
     *
     * @return self
     */
    public function setGroupName($group_name)
    {
        $this->container['group_name'] = $group_name;

        return $this;
    }

    /**
     * Gets account_category_id.
     *
     * @return int
     */
    public function getAccountCategoryId()
    {
        return $this->container['account_category_id'];
    }

    /**
     * Sets account_category_id.
     *
     * @param int $account_category_id 勘定科目カテゴリーID Selectablesフォーム用選択項目情報エンドポイント(account_groups.account_category_id)で取得可能です
     *
     * @return self
     */
    public function setAccountCategoryId($account_category_id)
    {
        if (($account_category_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $account_category_id when calling AccountItemCreateParamsAccountItem., must be bigger than or equal to 1.');
        }

        $this->container['account_category_id'] = $account_category_id;

        return $this;
    }

    /**
     * Gets corresponding_income_id.
     *
     * @return int
     */
    public function getCorrespondingIncomeId()
    {
        return $this->container['corresponding_income_id'];
    }

    /**
     * Sets corresponding_income_id.
     *
     * @param int $corresponding_income_id 収入取引相手勘定科目ID
     *
     * @return self
     */
    public function setCorrespondingIncomeId($corresponding_income_id)
    {
        if (($corresponding_income_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $corresponding_income_id when calling AccountItemCreateParamsAccountItem., must be bigger than or equal to 1.');
        }

        $this->container['corresponding_income_id'] = $corresponding_income_id;

        return $this;
    }

    /**
     * Gets corresponding_expense_id.
     *
     * @return int
     */
    public function getCorrespondingExpenseId()
    {
        return $this->container['corresponding_expense_id'];
    }

    /**
     * Sets corresponding_expense_id.
     *
     * @param int $corresponding_expense_id 支出取引相手勘定科目ID
     *
     * @return self
     */
    public function setCorrespondingExpenseId($corresponding_expense_id)
    {
        if (($corresponding_expense_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $corresponding_expense_id when calling AccountItemCreateParamsAccountItem., must be bigger than or equal to 1.');
        }

        $this->container['corresponding_expense_id'] = $corresponding_expense_id;

        return $this;
    }

    /**
     * Gets accumulated_dep_account_item_id.
     *
     * @return int|null
     */
    public function getAccumulatedDepAccountItemId()
    {
        return $this->container['accumulated_dep_account_item_id'];
    }

    /**
     * Sets accumulated_dep_account_item_id.
     *
     * @param int|null $accumulated_dep_account_item_id 減価償却累計額勘定科目ID（法人のみ利用可能）
     *
     * @return self
     */
    public function setAccumulatedDepAccountItemId($accumulated_dep_account_item_id)
    {
        if (!is_null($accumulated_dep_account_item_id) && ($accumulated_dep_account_item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $accumulated_dep_account_item_id when calling AccountItemCreateParamsAccountItem., must be bigger than or equal to 1.');
        }

        $this->container['accumulated_dep_account_item_id'] = $accumulated_dep_account_item_id;

        return $this;
    }

    /**
     * Gets searchable.
     *
     * @return int|null
     */
    public function getSearchable()
    {
        return $this->container['searchable'];
    }

    /**
     * Sets searchable.
     *
     * @param int|null $searchable 検索可能:2, 検索不可：3(登録時未指定の場合は2で登録されます。更新時未指定の場合はsearchableは変更されません。)
     *
     * @return self
     */
    public function setSearchable($searchable)
    {
        if (!is_null($searchable) && ($searchable > 3)) {
            throw new \InvalidArgumentException('invalid value for $searchable when calling AccountItemCreateParamsAccountItem., must be smaller than or equal to 3.');
        }
        if (!is_null($searchable) && ($searchable < 2)) {
            throw new \InvalidArgumentException('invalid value for $searchable when calling AccountItemCreateParamsAccountItem., must be bigger than or equal to 2.');
        }

        $this->container['searchable'] = $searchable;

        return $this;
    }

    /**
     * Gets items.
     *
     * @return \OpenAPI\Client\Model\AccountItemCreateParamsAccountItemItems[]|null
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items.
     *
     * @param \OpenAPI\Client\Model\AccountItemCreateParamsAccountItemItems[]|null $items 品目
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets partners.
     *
     * @return \OpenAPI\Client\Model\AccountItemCreateParamsAccountItemItems[]|null
     */
    public function getPartners()
    {
        return $this->container['partners'];
    }

    /**
     * Sets partners.
     *
     * @param \OpenAPI\Client\Model\AccountItemCreateParamsAccountItemItems[]|null $partners 取引先
     *
     * @return self
     */
    public function setPartners($partners)
    {
        $this->container['partners'] = $partners;

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
