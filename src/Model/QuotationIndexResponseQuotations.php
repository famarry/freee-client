<?php
/**
 * QuotationIndexResponseQuotations.
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
 * QuotationIndexResponseQuotations Class Doc Comment.
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
class QuotationIndexResponseQuotations implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'quotationIndexResponse_quotations';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                        => 'int',
        'company_id'                => 'int',
        'issue_date'                => 'string',
        'partner_id'                => 'int',
        'partner_code'              => 'string',
        'quotation_number'          => 'string',
        'title'                     => 'string',
        'total_amount'              => 'int',
        'total_vat'                 => 'int',
        'sub_total'                 => 'int',
        'description'               => 'string',
        'quotation_status'          => 'string',
        'web_published_at'          => 'string',
        'web_downloaded_at'         => 'string',
        'web_confirmed_at'          => 'string',
        'mail_sent_at'              => 'string',
        'partner_name'              => 'string',
        'partner_display_name'      => 'string',
        'partner_title'             => 'string',
        'partner_zipcode'           => 'string',
        'partner_prefecture_code'   => 'int',
        'partner_prefecture_name'   => 'string',
        'partner_address1'          => 'string',
        'partner_address2'          => 'string',
        'partner_contact_info'      => 'string',
        'company_name'              => 'string',
        'company_zipcode'           => 'string',
        'company_prefecture_code'   => 'int',
        'company_prefecture_name'   => 'string',
        'company_address1'          => 'string',
        'company_address2'          => 'string',
        'company_contact_info'      => 'string',
        'message'                   => 'string',
        'notes'                     => 'string',
        'quotation_layout'          => 'string',
        'tax_entry_method'          => 'string',
        'quotation_contents'        => '\OpenAPI\Client\Model\QuotationIndexResponseQuotationContents[]',
        'total_amount_per_vat_rate' => '\OpenAPI\Client\Model\InvoiceIndexResponseTotalAmountPerVatRate',
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
        'id'                        => 'int64',
        'company_id'                => 'int64',
        'issue_date'                => null,
        'partner_id'                => 'int64',
        'partner_code'              => null,
        'quotation_number'          => null,
        'title'                     => null,
        'total_amount'              => 'int64',
        'total_vat'                 => 'int64',
        'sub_total'                 => 'int64',
        'description'               => null,
        'quotation_status'          => null,
        'web_published_at'          => null,
        'web_downloaded_at'         => null,
        'web_confirmed_at'          => null,
        'mail_sent_at'              => null,
        'partner_name'              => null,
        'partner_display_name'      => null,
        'partner_title'             => null,
        'partner_zipcode'           => null,
        'partner_prefecture_code'   => 'int64',
        'partner_prefecture_name'   => null,
        'partner_address1'          => null,
        'partner_address2'          => null,
        'partner_contact_info'      => null,
        'company_name'              => null,
        'company_zipcode'           => null,
        'company_prefecture_code'   => 'int64',
        'company_prefecture_name'   => null,
        'company_address1'          => null,
        'company_address2'          => null,
        'company_contact_info'      => null,
        'message'                   => null,
        'notes'                     => null,
        'quotation_layout'          => null,
        'tax_entry_method'          => null,
        'quotation_contents'        => null,
        'total_amount_per_vat_rate' => null,
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
        'id'                        => 'id',
        'company_id'                => 'company_id',
        'issue_date'                => 'issue_date',
        'partner_id'                => 'partner_id',
        'partner_code'              => 'partner_code',
        'quotation_number'          => 'quotation_number',
        'title'                     => 'title',
        'total_amount'              => 'total_amount',
        'total_vat'                 => 'total_vat',
        'sub_total'                 => 'sub_total',
        'description'               => 'description',
        'quotation_status'          => 'quotation_status',
        'web_published_at'          => 'web_published_at',
        'web_downloaded_at'         => 'web_downloaded_at',
        'web_confirmed_at'          => 'web_confirmed_at',
        'mail_sent_at'              => 'mail_sent_at',
        'partner_name'              => 'partner_name',
        'partner_display_name'      => 'partner_display_name',
        'partner_title'             => 'partner_title',
        'partner_zipcode'           => 'partner_zipcode',
        'partner_prefecture_code'   => 'partner_prefecture_code',
        'partner_prefecture_name'   => 'partner_prefecture_name',
        'partner_address1'          => 'partner_address1',
        'partner_address2'          => 'partner_address2',
        'partner_contact_info'      => 'partner_contact_info',
        'company_name'              => 'company_name',
        'company_zipcode'           => 'company_zipcode',
        'company_prefecture_code'   => 'company_prefecture_code',
        'company_prefecture_name'   => 'company_prefecture_name',
        'company_address1'          => 'company_address1',
        'company_address2'          => 'company_address2',
        'company_contact_info'      => 'company_contact_info',
        'message'                   => 'message',
        'notes'                     => 'notes',
        'quotation_layout'          => 'quotation_layout',
        'tax_entry_method'          => 'tax_entry_method',
        'quotation_contents'        => 'quotation_contents',
        'total_amount_per_vat_rate' => 'total_amount_per_vat_rate',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                        => 'setId',
        'company_id'                => 'setCompanyId',
        'issue_date'                => 'setIssueDate',
        'partner_id'                => 'setPartnerId',
        'partner_code'              => 'setPartnerCode',
        'quotation_number'          => 'setQuotationNumber',
        'title'                     => 'setTitle',
        'total_amount'              => 'setTotalAmount',
        'total_vat'                 => 'setTotalVat',
        'sub_total'                 => 'setSubTotal',
        'description'               => 'setDescription',
        'quotation_status'          => 'setQuotationStatus',
        'web_published_at'          => 'setWebPublishedAt',
        'web_downloaded_at'         => 'setWebDownloadedAt',
        'web_confirmed_at'          => 'setWebConfirmedAt',
        'mail_sent_at'              => 'setMailSentAt',
        'partner_name'              => 'setPartnerName',
        'partner_display_name'      => 'setPartnerDisplayName',
        'partner_title'             => 'setPartnerTitle',
        'partner_zipcode'           => 'setPartnerZipcode',
        'partner_prefecture_code'   => 'setPartnerPrefectureCode',
        'partner_prefecture_name'   => 'setPartnerPrefectureName',
        'partner_address1'          => 'setPartnerAddress1',
        'partner_address2'          => 'setPartnerAddress2',
        'partner_contact_info'      => 'setPartnerContactInfo',
        'company_name'              => 'setCompanyName',
        'company_zipcode'           => 'setCompanyZipcode',
        'company_prefecture_code'   => 'setCompanyPrefectureCode',
        'company_prefecture_name'   => 'setCompanyPrefectureName',
        'company_address1'          => 'setCompanyAddress1',
        'company_address2'          => 'setCompanyAddress2',
        'company_contact_info'      => 'setCompanyContactInfo',
        'message'                   => 'setMessage',
        'notes'                     => 'setNotes',
        'quotation_layout'          => 'setQuotationLayout',
        'tax_entry_method'          => 'setTaxEntryMethod',
        'quotation_contents'        => 'setQuotationContents',
        'total_amount_per_vat_rate' => 'setTotalAmountPerVatRate',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                        => 'getId',
        'company_id'                => 'getCompanyId',
        'issue_date'                => 'getIssueDate',
        'partner_id'                => 'getPartnerId',
        'partner_code'              => 'getPartnerCode',
        'quotation_number'          => 'getQuotationNumber',
        'title'                     => 'getTitle',
        'total_amount'              => 'getTotalAmount',
        'total_vat'                 => 'getTotalVat',
        'sub_total'                 => 'getSubTotal',
        'description'               => 'getDescription',
        'quotation_status'          => 'getQuotationStatus',
        'web_published_at'          => 'getWebPublishedAt',
        'web_downloaded_at'         => 'getWebDownloadedAt',
        'web_confirmed_at'          => 'getWebConfirmedAt',
        'mail_sent_at'              => 'getMailSentAt',
        'partner_name'              => 'getPartnerName',
        'partner_display_name'      => 'getPartnerDisplayName',
        'partner_title'             => 'getPartnerTitle',
        'partner_zipcode'           => 'getPartnerZipcode',
        'partner_prefecture_code'   => 'getPartnerPrefectureCode',
        'partner_prefecture_name'   => 'getPartnerPrefectureName',
        'partner_address1'          => 'getPartnerAddress1',
        'partner_address2'          => 'getPartnerAddress2',
        'partner_contact_info'      => 'getPartnerContactInfo',
        'company_name'              => 'getCompanyName',
        'company_zipcode'           => 'getCompanyZipcode',
        'company_prefecture_code'   => 'getCompanyPrefectureCode',
        'company_prefecture_name'   => 'getCompanyPrefectureName',
        'company_address1'          => 'getCompanyAddress1',
        'company_address2'          => 'getCompanyAddress2',
        'company_contact_info'      => 'getCompanyContactInfo',
        'message'                   => 'getMessage',
        'notes'                     => 'getNotes',
        'quotation_layout'          => 'getQuotationLayout',
        'tax_entry_method'          => 'getTaxEntryMethod',
        'quotation_contents'        => 'getQuotationContents',
        'total_amount_per_vat_rate' => 'getTotalAmountPerVatRate',
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

    const QUOTATION_STATUS_UNSUBMITTED      = 'unsubmitted';
    const QUOTATION_STATUS_SUBMITTED        = 'submitted';
    const QUOTATION_STATUS_ALL              = 'all';
    const QUOTATION_LAYOUT_DEFAULT_CLASSIC  = 'default_classic';
    const QUOTATION_LAYOUT_STANDARD_CLASSIC = 'standard_classic';
    const QUOTATION_LAYOUT_ENVELOPE_CLASSIC = 'envelope_classic';
    const QUOTATION_LAYOUT_DEFAULT_MODERN   = 'default_modern';
    const QUOTATION_LAYOUT_STANDARD_MODERN  = 'standard_modern';
    const QUOTATION_LAYOUT_ENVELOPE_MODERN  = 'envelope_modern';
    const TAX_ENTRY_METHOD_EMPTY            = '';
    const TAX_ENTRY_METHOD_INCLUSIVE        = 'inclusive';
    const TAX_ENTRY_METHOD_EXCLUSIVE        = 'exclusive';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getQuotationStatusAllowableValues()
    {
        return [
            self::QUOTATION_STATUS_UNSUBMITTED,
            self::QUOTATION_STATUS_SUBMITTED,
            self::QUOTATION_STATUS_ALL,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getQuotationLayoutAllowableValues()
    {
        return [
            self::QUOTATION_LAYOUT_DEFAULT_CLASSIC,
            self::QUOTATION_LAYOUT_STANDARD_CLASSIC,
            self::QUOTATION_LAYOUT_ENVELOPE_CLASSIC,
            self::QUOTATION_LAYOUT_DEFAULT_MODERN,
            self::QUOTATION_LAYOUT_STANDARD_MODERN,
            self::QUOTATION_LAYOUT_ENVELOPE_MODERN,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTaxEntryMethodAllowableValues()
    {
        return [
            self::TAX_ENTRY_METHOD_EMPTY,
            self::TAX_ENTRY_METHOD_INCLUSIVE,
            self::TAX_ENTRY_METHOD_EXCLUSIVE,
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
        $this->container['id']                        = $data['id'] ?? null;
        $this->container['company_id']                = $data['company_id'] ?? null;
        $this->container['issue_date']                = $data['issue_date'] ?? null;
        $this->container['partner_id']                = $data['partner_id'] ?? null;
        $this->container['partner_code']              = $data['partner_code'] ?? null;
        $this->container['quotation_number']          = $data['quotation_number'] ?? null;
        $this->container['title']                     = $data['title'] ?? null;
        $this->container['total_amount']              = $data['total_amount'] ?? null;
        $this->container['total_vat']                 = $data['total_vat'] ?? null;
        $this->container['sub_total']                 = $data['sub_total'] ?? null;
        $this->container['description']               = $data['description'] ?? null;
        $this->container['quotation_status']          = $data['quotation_status'] ?? null;
        $this->container['web_published_at']          = $data['web_published_at'] ?? null;
        $this->container['web_downloaded_at']         = $data['web_downloaded_at'] ?? null;
        $this->container['web_confirmed_at']          = $data['web_confirmed_at'] ?? null;
        $this->container['mail_sent_at']              = $data['mail_sent_at'] ?? null;
        $this->container['partner_name']              = $data['partner_name'] ?? null;
        $this->container['partner_display_name']      = $data['partner_display_name'] ?? null;
        $this->container['partner_title']             = $data['partner_title'] ?? null;
        $this->container['partner_zipcode']           = $data['partner_zipcode'] ?? null;
        $this->container['partner_prefecture_code']   = $data['partner_prefecture_code'] ?? null;
        $this->container['partner_prefecture_name']   = $data['partner_prefecture_name'] ?? null;
        $this->container['partner_address1']          = $data['partner_address1'] ?? null;
        $this->container['partner_address2']          = $data['partner_address2'] ?? null;
        $this->container['partner_contact_info']      = $data['partner_contact_info'] ?? null;
        $this->container['company_name']              = $data['company_name'] ?? null;
        $this->container['company_zipcode']           = $data['company_zipcode'] ?? null;
        $this->container['company_prefecture_code']   = $data['company_prefecture_code'] ?? null;
        $this->container['company_prefecture_name']   = $data['company_prefecture_name'] ?? null;
        $this->container['company_address1']          = $data['company_address1'] ?? null;
        $this->container['company_address2']          = $data['company_address2'] ?? null;
        $this->container['company_contact_info']      = $data['company_contact_info'] ?? null;
        $this->container['message']                   = $data['message'] ?? null;
        $this->container['notes']                     = $data['notes'] ?? null;
        $this->container['quotation_layout']          = $data['quotation_layout'] ?? null;
        $this->container['tax_entry_method']          = $data['tax_entry_method'] ?? null;
        $this->container['quotation_contents']        = $data['quotation_contents'] ?? null;
        $this->container['total_amount_per_vat_rate'] = $data['total_amount_per_vat_rate'] ?? null;
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

        if ($this->container['issue_date'] === null) {
            $invalidProperties[] = "'issue_date' can't be null";
        }
        if ($this->container['partner_id'] === null) {
            $invalidProperties[] = "'partner_id' can't be null";
        }
        if (($this->container['partner_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'partner_id', must be bigger than or equal to 1.";
        }

        if ($this->container['quotation_number'] === null) {
            $invalidProperties[] = "'quotation_number' can't be null";
        }
        if ($this->container['total_amount'] === null) {
            $invalidProperties[] = "'total_amount' can't be null";
        }
        if ($this->container['quotation_status'] === null) {
            $invalidProperties[] = "'quotation_status' can't be null";
        }
        $allowedValues = $this->getQuotationStatusAllowableValues();
        if (!is_null($this->container['quotation_status']) && !in_array($this->container['quotation_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'quotation_status', must be one of '%s'",
                $this->container['quotation_status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['partner_title'] === null) {
            $invalidProperties[] = "'partner_title' can't be null";
        }
        if (!is_null($this->container['partner_prefecture_code']) && ($this->container['partner_prefecture_code'] > 46)) {
            $invalidProperties[] = "invalid value for 'partner_prefecture_code', must be smaller than or equal to 46.";
        }

        if (!is_null($this->container['partner_prefecture_code']) && ($this->container['partner_prefecture_code'] < -1)) {
            $invalidProperties[] = "invalid value for 'partner_prefecture_code', must be bigger than or equal to -1.";
        }

        if ($this->container['company_name'] === null) {
            $invalidProperties[] = "'company_name' can't be null";
        }
        if (!is_null($this->container['company_prefecture_code']) && ($this->container['company_prefecture_code'] > 46)) {
            $invalidProperties[] = "invalid value for 'company_prefecture_code', must be smaller than or equal to 46.";
        }

        if (!is_null($this->container['company_prefecture_code']) && ($this->container['company_prefecture_code'] < -1)) {
            $invalidProperties[] = "invalid value for 'company_prefecture_code', must be bigger than or equal to -1.";
        }

        if ($this->container['quotation_layout'] === null) {
            $invalidProperties[] = "'quotation_layout' can't be null";
        }
        $allowedValues = $this->getQuotationLayoutAllowableValues();
        if (!is_null($this->container['quotation_layout']) && !in_array($this->container['quotation_layout'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'quotation_layout', must be one of '%s'",
                $this->container['quotation_layout'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['tax_entry_method'] === null) {
            $invalidProperties[] = "'tax_entry_method' can't be null";
        }
        $allowedValues = $this->getTaxEntryMethodAllowableValues();
        if (!is_null($this->container['tax_entry_method']) && !in_array($this->container['tax_entry_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tax_entry_method', must be one of '%s'",
                $this->container['tax_entry_method'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['total_amount_per_vat_rate'] === null) {
            $invalidProperties[] = "'total_amount_per_vat_rate' can't be null";
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
     * @param int $id 見積書ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling QuotationIndexResponseQuotations., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $company_id when calling QuotationIndexResponseQuotations., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

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
     * @param string $issue_date 見積日 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setIssueDate($issue_date)
    {
        $this->container['issue_date'] = $issue_date;

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
            throw new \InvalidArgumentException('invalid value for $partner_id when calling QuotationIndexResponseQuotations., must be bigger than or equal to 1.');
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
     * Gets quotation_number.
     *
     * @return string
     */
    public function getQuotationNumber()
    {
        return $this->container['quotation_number'];
    }

    /**
     * Sets quotation_number.
     *
     * @param string $quotation_number 見積書番号
     *
     * @return self
     */
    public function setQuotationNumber($quotation_number)
    {
        $this->container['quotation_number'] = $quotation_number;

        return $this;
    }

    /**
     * Gets title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title.
     *
     * @param string|null $title タイトル
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets total_amount.
     *
     * @return int
     */
    public function getTotalAmount()
    {
        return $this->container['total_amount'];
    }

    /**
     * Sets total_amount.
     *
     * @param int $total_amount 合計金額
     *
     * @return self
     */
    public function setTotalAmount($total_amount)
    {
        $this->container['total_amount'] = $total_amount;

        return $this;
    }

    /**
     * Gets total_vat.
     *
     * @return int|null
     */
    public function getTotalVat()
    {
        return $this->container['total_vat'];
    }

    /**
     * Sets total_vat.
     *
     * @param int|null $total_vat 消費税
     *
     * @return self
     */
    public function setTotalVat($total_vat)
    {
        $this->container['total_vat'] = $total_vat;

        return $this;
    }

    /**
     * Gets sub_total.
     *
     * @return int|null
     */
    public function getSubTotal()
    {
        return $this->container['sub_total'];
    }

    /**
     * Sets sub_total.
     *
     * @param int|null $sub_total 小計
     *
     * @return self
     */
    public function setSubTotal($sub_total)
    {
        $this->container['sub_total'] = $sub_total;

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
     * @param string|null $description 概要
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets quotation_status.
     *
     * @return string
     */
    public function getQuotationStatus()
    {
        return $this->container['quotation_status'];
    }

    /**
     * Sets quotation_status.
     *
     * @param string $quotation_status 見積書ステータス  (unsubmitted: 送付待ち, submitted: 送付済み, all: 全て)
     *
     * @return self
     */
    public function setQuotationStatus($quotation_status)
    {
        $allowedValues = $this->getQuotationStatusAllowableValues();
        if (!in_array($quotation_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'quotation_status', must be one of '%s'",
                    $quotation_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['quotation_status'] = $quotation_status;

        return $this;
    }

    /**
     * Gets web_published_at.
     *
     * @return string|null
     */
    public function getWebPublishedAt()
    {
        return $this->container['web_published_at'];
    }

    /**
     * Sets web_published_at.
     *
     * @param string|null $web_published_at Web共有日時(最新)
     *
     * @return self
     */
    public function setWebPublishedAt($web_published_at)
    {
        $this->container['web_published_at'] = $web_published_at;

        return $this;
    }

    /**
     * Gets web_downloaded_at.
     *
     * @return string|null
     */
    public function getWebDownloadedAt()
    {
        return $this->container['web_downloaded_at'];
    }

    /**
     * Sets web_downloaded_at.
     *
     * @param string|null $web_downloaded_at Web共有ダウンロード日時(最新)
     *
     * @return self
     */
    public function setWebDownloadedAt($web_downloaded_at)
    {
        $this->container['web_downloaded_at'] = $web_downloaded_at;

        return $this;
    }

    /**
     * Gets web_confirmed_at.
     *
     * @return string|null
     */
    public function getWebConfirmedAt()
    {
        return $this->container['web_confirmed_at'];
    }

    /**
     * Sets web_confirmed_at.
     *
     * @param string|null $web_confirmed_at Web共有取引先確認日時(最新)
     *
     * @return self
     */
    public function setWebConfirmedAt($web_confirmed_at)
    {
        $this->container['web_confirmed_at'] = $web_confirmed_at;

        return $this;
    }

    /**
     * Gets mail_sent_at.
     *
     * @return string|null
     */
    public function getMailSentAt()
    {
        return $this->container['mail_sent_at'];
    }

    /**
     * Sets mail_sent_at.
     *
     * @param string|null $mail_sent_at メール送信日時(最新)
     *
     * @return self
     */
    public function setMailSentAt($mail_sent_at)
    {
        $this->container['mail_sent_at'] = $mail_sent_at;

        return $this;
    }

    /**
     * Gets partner_name.
     *
     * @return string|null
     */
    public function getPartnerName()
    {
        return $this->container['partner_name'];
    }

    /**
     * Sets partner_name.
     *
     * @param string|null $partner_name 取引先名
     *
     * @return self
     */
    public function setPartnerName($partner_name)
    {
        $this->container['partner_name'] = $partner_name;

        return $this;
    }

    /**
     * Gets partner_display_name.
     *
     * @return string|null
     */
    public function getPartnerDisplayName()
    {
        return $this->container['partner_display_name'];
    }

    /**
     * Sets partner_display_name.
     *
     * @param string|null $partner_display_name 見積書に表示する取引先名
     *
     * @return self
     */
    public function setPartnerDisplayName($partner_display_name)
    {
        $this->container['partner_display_name'] = $partner_display_name;

        return $this;
    }

    /**
     * Gets partner_title.
     *
     * @return string
     */
    public function getPartnerTitle()
    {
        return $this->container['partner_title'];
    }

    /**
     * Sets partner_title.
     *
     * @param string $partner_title 敬称（御中、様、(空白)の3つから選択）
     *
     * @return self
     */
    public function setPartnerTitle($partner_title)
    {
        $this->container['partner_title'] = $partner_title;

        return $this;
    }

    /**
     * Gets partner_zipcode.
     *
     * @return string|null
     */
    public function getPartnerZipcode()
    {
        return $this->container['partner_zipcode'];
    }

    /**
     * Sets partner_zipcode.
     *
     * @param string|null $partner_zipcode 郵便番号
     *
     * @return self
     */
    public function setPartnerZipcode($partner_zipcode)
    {
        $this->container['partner_zipcode'] = $partner_zipcode;

        return $this;
    }

    /**
     * Gets partner_prefecture_code.
     *
     * @return int|null
     */
    public function getPartnerPrefectureCode()
    {
        return $this->container['partner_prefecture_code'];
    }

    /**
     * Sets partner_prefecture_code.
     *
     * @param int|null $partner_prefecture_code 都道府県コード（-1: 設定しない、0:北海道、1:青森、2:岩手、3:宮城、4:秋田、5:山形、6:福島、7:茨城、8:栃木、9:群馬、10:埼玉、11:千葉、12:東京、13:神奈川、14:新潟、15:富山、16:石川、17:福井、18:山梨、19:長野、20:岐阜、21:静岡、22:愛知、23:三重、24:滋賀、25:京都、26:大阪、27:兵庫、28:奈良、29:和歌山、30:鳥取、31:島根、32:岡山、33:広島、34:山口、35:徳島、36:香川、37:愛媛、38:高知、39:福岡、40:佐賀、41:長崎、42:熊本、43:大分、44:宮崎、45:鹿児島、46:沖縄
     *
     * @return self
     */
    public function setPartnerPrefectureCode($partner_prefecture_code)
    {
        if (!is_null($partner_prefecture_code) && ($partner_prefecture_code > 46)) {
            throw new \InvalidArgumentException('invalid value for $partner_prefecture_code when calling QuotationIndexResponseQuotations., must be smaller than or equal to 46.');
        }
        if (!is_null($partner_prefecture_code) && ($partner_prefecture_code < -1)) {
            throw new \InvalidArgumentException('invalid value for $partner_prefecture_code when calling QuotationIndexResponseQuotations., must be bigger than or equal to -1.');
        }

        $this->container['partner_prefecture_code'] = $partner_prefecture_code;

        return $this;
    }

    /**
     * Gets partner_prefecture_name.
     *
     * @return string|null
     */
    public function getPartnerPrefectureName()
    {
        return $this->container['partner_prefecture_name'];
    }

    /**
     * Sets partner_prefecture_name.
     *
     * @param string|null $partner_prefecture_name 都道府県
     *
     * @return self
     */
    public function setPartnerPrefectureName($partner_prefecture_name)
    {
        $this->container['partner_prefecture_name'] = $partner_prefecture_name;

        return $this;
    }

    /**
     * Gets partner_address1.
     *
     * @return string|null
     */
    public function getPartnerAddress1()
    {
        return $this->container['partner_address1'];
    }

    /**
     * Sets partner_address1.
     *
     * @param string|null $partner_address1 市区町村・番地
     *
     * @return self
     */
    public function setPartnerAddress1($partner_address1)
    {
        $this->container['partner_address1'] = $partner_address1;

        return $this;
    }

    /**
     * Gets partner_address2.
     *
     * @return string|null
     */
    public function getPartnerAddress2()
    {
        return $this->container['partner_address2'];
    }

    /**
     * Sets partner_address2.
     *
     * @param string|null $partner_address2 建物名・部屋番号など
     *
     * @return self
     */
    public function setPartnerAddress2($partner_address2)
    {
        $this->container['partner_address2'] = $partner_address2;

        return $this;
    }

    /**
     * Gets partner_contact_info.
     *
     * @return string|null
     */
    public function getPartnerContactInfo()
    {
        return $this->container['partner_contact_info'];
    }

    /**
     * Sets partner_contact_info.
     *
     * @param string|null $partner_contact_info 取引先担当者名
     *
     * @return self
     */
    public function setPartnerContactInfo($partner_contact_info)
    {
        $this->container['partner_contact_info'] = $partner_contact_info;

        return $this;
    }

    /**
     * Gets company_name.
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name.
     *
     * @param string $company_name 事業所名
     *
     * @return self
     */
    public function setCompanyName($company_name)
    {
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets company_zipcode.
     *
     * @return string|null
     */
    public function getCompanyZipcode()
    {
        return $this->container['company_zipcode'];
    }

    /**
     * Sets company_zipcode.
     *
     * @param string|null $company_zipcode 郵便番号
     *
     * @return self
     */
    public function setCompanyZipcode($company_zipcode)
    {
        $this->container['company_zipcode'] = $company_zipcode;

        return $this;
    }

    /**
     * Gets company_prefecture_code.
     *
     * @return int|null
     */
    public function getCompanyPrefectureCode()
    {
        return $this->container['company_prefecture_code'];
    }

    /**
     * Sets company_prefecture_code.
     *
     * @param int|null $company_prefecture_code 都道府県コード（-1: 設定しない、0:北海道、1:青森、2:岩手、3:宮城、4:秋田、5:山形、6:福島、7:茨城、8:栃木、9:群馬、10:埼玉、11:千葉、12:東京、13:神奈川、14:新潟、15:富山、16:石川、17:福井、18:山梨、19:長野、20:岐阜、21:静岡、22:愛知、23:三重、24:滋賀、25:京都、26:大阪、27:兵庫、28:奈良、29:和歌山、30:鳥取、31:島根、32:岡山、33:広島、34:山口、35:徳島、36:香川、37:愛媛、38:高知、39:福岡、40:佐賀、41:長崎、42:熊本、43:大分、44:宮崎、45:鹿児島、46:沖縄
     *
     * @return self
     */
    public function setCompanyPrefectureCode($company_prefecture_code)
    {
        if (!is_null($company_prefecture_code) && ($company_prefecture_code > 46)) {
            throw new \InvalidArgumentException('invalid value for $company_prefecture_code when calling QuotationIndexResponseQuotations., must be smaller than or equal to 46.');
        }
        if (!is_null($company_prefecture_code) && ($company_prefecture_code < -1)) {
            throw new \InvalidArgumentException('invalid value for $company_prefecture_code when calling QuotationIndexResponseQuotations., must be bigger than or equal to -1.');
        }

        $this->container['company_prefecture_code'] = $company_prefecture_code;

        return $this;
    }

    /**
     * Gets company_prefecture_name.
     *
     * @return string|null
     */
    public function getCompanyPrefectureName()
    {
        return $this->container['company_prefecture_name'];
    }

    /**
     * Sets company_prefecture_name.
     *
     * @param string|null $company_prefecture_name 都道府県
     *
     * @return self
     */
    public function setCompanyPrefectureName($company_prefecture_name)
    {
        $this->container['company_prefecture_name'] = $company_prefecture_name;

        return $this;
    }

    /**
     * Gets company_address1.
     *
     * @return string|null
     */
    public function getCompanyAddress1()
    {
        return $this->container['company_address1'];
    }

    /**
     * Sets company_address1.
     *
     * @param string|null $company_address1 市区町村・番地
     *
     * @return self
     */
    public function setCompanyAddress1($company_address1)
    {
        $this->container['company_address1'] = $company_address1;

        return $this;
    }

    /**
     * Gets company_address2.
     *
     * @return string|null
     */
    public function getCompanyAddress2()
    {
        return $this->container['company_address2'];
    }

    /**
     * Sets company_address2.
     *
     * @param string|null $company_address2 建物名・部屋番号など
     *
     * @return self
     */
    public function setCompanyAddress2($company_address2)
    {
        $this->container['company_address2'] = $company_address2;

        return $this;
    }

    /**
     * Gets company_contact_info.
     *
     * @return string|null
     */
    public function getCompanyContactInfo()
    {
        return $this->container['company_contact_info'];
    }

    /**
     * Sets company_contact_info.
     *
     * @param string|null $company_contact_info 事業所担当者名
     *
     * @return self
     */
    public function setCompanyContactInfo($company_contact_info)
    {
        $this->container['company_contact_info'] = $company_contact_info;

        return $this;
    }

    /**
     * Gets message.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message.
     *
     * @param string|null $message メッセージ
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets notes.
     *
     * @return string|null
     */
    public function getNotes()
    {
        return $this->container['notes'];
    }

    /**
     * Sets notes.
     *
     * @param string|null $notes 備考
     *
     * @return self
     */
    public function setNotes($notes)
    {
        $this->container['notes'] = $notes;

        return $this;
    }

    /**
     * Gets quotation_layout.
     *
     * @return string
     */
    public function getQuotationLayout()
    {
        return $this->container['quotation_layout'];
    }

    /**
     * Sets quotation_layout.
     *
     * @param string $quotation_layout 見積書レイアウト * `default_classic` - レイアウト１/クラシック (デフォルト)  * `standard_classic` - レイアウト２/クラシック  * `envelope_classic` - 封筒１/クラシック  * `default_modern` - レイアウト１/モダン  * `standard_modern` - レイアウト２/モダン  * `envelope_modern` - 封筒/モダン
     *
     * @return self
     */
    public function setQuotationLayout($quotation_layout)
    {
        $allowedValues = $this->getQuotationLayoutAllowableValues();
        if (!in_array($quotation_layout, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'quotation_layout', must be one of '%s'",
                    $quotation_layout,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['quotation_layout'] = $quotation_layout;

        return $this;
    }

    /**
     * Gets tax_entry_method.
     *
     * @return string
     */
    public function getTaxEntryMethod()
    {
        return $this->container['tax_entry_method'];
    }

    /**
     * Sets tax_entry_method.
     *
     * @param string $tax_entry_method 見積書の消費税計算方法(inclusive: 内税, exclusive: 外税)
     *
     * @return self
     */
    public function setTaxEntryMethod($tax_entry_method)
    {
        $allowedValues = $this->getTaxEntryMethodAllowableValues();
        if (!in_array($tax_entry_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tax_entry_method', must be one of '%s'",
                    $tax_entry_method,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tax_entry_method'] = $tax_entry_method;

        return $this;
    }

    /**
     * Gets quotation_contents.
     *
     * @return \OpenAPI\Client\Model\QuotationIndexResponseQuotationContents[]|null
     */
    public function getQuotationContents()
    {
        return $this->container['quotation_contents'];
    }

    /**
     * Sets quotation_contents.
     *
     * @param \OpenAPI\Client\Model\QuotationIndexResponseQuotationContents[]|null $quotation_contents 見積内容
     *
     * @return self
     */
    public function setQuotationContents($quotation_contents)
    {
        $this->container['quotation_contents'] = $quotation_contents;

        return $this;
    }

    /**
     * Gets total_amount_per_vat_rate.
     *
     * @return \OpenAPI\Client\Model\InvoiceIndexResponseTotalAmountPerVatRate
     */
    public function getTotalAmountPerVatRate()
    {
        return $this->container['total_amount_per_vat_rate'];
    }

    /**
     * Sets total_amount_per_vat_rate.
     *
     * @param \OpenAPI\Client\Model\InvoiceIndexResponseTotalAmountPerVatRate $total_amount_per_vat_rate total_amount_per_vat_rate
     *
     * @return self
     */
    public function setTotalAmountPerVatRate($total_amount_per_vat_rate)
    {
        $this->container['total_amount_per_vat_rate'] = $total_amount_per_vat_rate;

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
