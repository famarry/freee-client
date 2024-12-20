<?php

/**
 * PaymentRequestResponsePaymentRequest.
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
 * PaymentRequestResponsePaymentRequest Class Doc Comment.
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
class PaymentRequestResponsePaymentRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'paymentRequestResponse_payment_request';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                       => 'int',
        'company_id'               => 'int',
        'title'                    => 'string',
        'application_date'         => 'string',
        'description'              => 'string',
        'total_amount'             => 'int',
        'status'                   => 'string',
        'payment_request_lines'    => '\OpenAPI\Client\Model\PaymentRequestResponsePaymentRequestPaymentRequestLines[]',
        'deal_id'                  => 'int',
        'deal_status'              => 'string',
        'applicant_id'             => 'int',
        'approvers'                => '\OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovers[]',
        'application_number'       => 'string',
        'approval_flow_route_id'   => 'int',
        'comments'                 => '\OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationComments[]',
        'approval_flow_logs'       => '\OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovalFlowLogs[]',
        'current_step_id'          => 'int',
        'current_round'            => 'int',
        'document_code'            => 'string',
        'receipt_ids'              => 'int[]',
        'issue_date'               => 'string',
        'payment_date'             => 'string',
        'payment_method'           => 'string',
        'partner_id'               => 'int',
        'partner_code'             => 'string',
        'partner_name'             => 'string',
        'bank_name'                => 'string',
        'bank_name_kana'           => 'string',
        'bank_code'                => 'string',
        'branch_name'              => 'string',
        'branch_kana'              => 'string',
        'branch_code'              => 'string',
        'account_type'             => 'string',
        'account_number'           => 'string',
        'account_name'             => 'string',
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
        'id'                       => 'int64',
        'company_id'               => 'int64',
        'title'                    => null,
        'application_date'         => null,
        'description'              => null,
        'total_amount'             => 'int64',
        'status'                   => null,
        'payment_request_lines'    => null,
        'deal_id'                  => 'int64',
        'deal_status'              => null,
        'applicant_id'             => 'int64',
        'approvers'                => null,
        'application_number'       => null,
        'approval_flow_route_id'   => 'int64',
        'comments'                 => null,
        'approval_flow_logs'       => null,
        'current_step_id'          => 'int64',
        'current_round'            => 'int64',
        'document_code'            => null,
        'receipt_ids'              => 'int64',
        'issue_date'               => null,
        'payment_date'             => null,
        'payment_method'           => null,
        'partner_id'               => 'int64',
        'partner_code'             => null,
        'partner_name'             => null,
        'bank_name'                => null,
        'bank_name_kana'           => null,
        'bank_code'                => null,
        'branch_name'              => null,
        'branch_kana'              => null,
        'branch_code'              => null,
        'account_type'             => null,
        'account_number'           => null,
        'account_name'             => null,
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
        'id'                       => 'id',
        'company_id'               => 'company_id',
        'title'                    => 'title',
        'application_date'         => 'application_date',
        'description'              => 'description',
        'total_amount'             => 'total_amount',
        'status'                   => 'status',
        'payment_request_lines'    => 'payment_request_lines',
        'deal_id'                  => 'deal_id',
        'deal_status'              => 'deal_status',
        'applicant_id'             => 'applicant_id',
        'approvers'                => 'approvers',
        'application_number'       => 'application_number',
        'approval_flow_route_id'   => 'approval_flow_route_id',
        'comments'                 => 'comments',
        'approval_flow_logs'       => 'approval_flow_logs',
        'current_step_id'          => 'current_step_id',
        'current_round'            => 'current_round',
        'document_code'            => 'document_code',
        'receipt_ids'              => 'receipt_ids',
        'issue_date'               => 'issue_date',
        'payment_date'             => 'payment_date',
        'payment_method'           => 'payment_method',
        'partner_id'               => 'partner_id',
        'partner_code'             => 'partner_code',
        'partner_name'             => 'partner_name',
        'bank_name'                => 'bank_name',
        'bank_name_kana'           => 'bank_name_kana',
        'bank_code'                => 'bank_code',
        'branch_name'              => 'branch_name',
        'branch_kana'              => 'branch_kana',
        'branch_code'              => 'branch_code',
        'account_type'             => 'account_type',
        'account_number'           => 'account_number',
        'account_name'             => 'account_name',
        'qualified_invoice_status' => 'qualified_invoice_status',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                       => 'setId',
        'company_id'               => 'setCompanyId',
        'title'                    => 'setTitle',
        'application_date'         => 'setApplicationDate',
        'description'              => 'setDescription',
        'total_amount'             => 'setTotalAmount',
        'status'                   => 'setStatus',
        'payment_request_lines'    => 'setPaymentRequestLines',
        'deal_id'                  => 'setDealId',
        'deal_status'              => 'setDealStatus',
        'applicant_id'             => 'setApplicantId',
        'approvers'                => 'setApprovers',
        'application_number'       => 'setApplicationNumber',
        'approval_flow_route_id'   => 'setApprovalFlowRouteId',
        'comments'                 => 'setComments',
        'approval_flow_logs'       => 'setApprovalFlowLogs',
        'current_step_id'          => 'setCurrentStepId',
        'current_round'            => 'setCurrentRound',
        'document_code'            => 'setDocumentCode',
        'receipt_ids'              => 'setReceiptIds',
        'issue_date'               => 'setIssueDate',
        'payment_date'             => 'setPaymentDate',
        'payment_method'           => 'setPaymentMethod',
        'partner_id'               => 'setPartnerId',
        'partner_code'             => 'setPartnerCode',
        'partner_name'             => 'setPartnerName',
        'bank_name'                => 'setBankName',
        'bank_name_kana'           => 'setBankNameKana',
        'bank_code'                => 'setBankCode',
        'branch_name'              => 'setBranchName',
        'branch_kana'              => 'setBranchKana',
        'branch_code'              => 'setBranchCode',
        'account_type'             => 'setAccountType',
        'account_number'           => 'setAccountNumber',
        'account_name'             => 'setAccountName',
        'qualified_invoice_status' => 'setQualifiedInvoiceStatus',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                       => 'getId',
        'company_id'               => 'getCompanyId',
        'title'                    => 'getTitle',
        'application_date'         => 'getApplicationDate',
        'description'              => 'getDescription',
        'total_amount'             => 'getTotalAmount',
        'status'                   => 'getStatus',
        'payment_request_lines'    => 'getPaymentRequestLines',
        'deal_id'                  => 'getDealId',
        'deal_status'              => 'getDealStatus',
        'applicant_id'             => 'getApplicantId',
        'approvers'                => 'getApprovers',
        'application_number'       => 'getApplicationNumber',
        'approval_flow_route_id'   => 'getApprovalFlowRouteId',
        'comments'                 => 'getComments',
        'approval_flow_logs'       => 'getApprovalFlowLogs',
        'current_step_id'          => 'getCurrentStepId',
        'current_round'            => 'getCurrentRound',
        'document_code'            => 'getDocumentCode',
        'receipt_ids'              => 'getReceiptIds',
        'issue_date'               => 'getIssueDate',
        'payment_date'             => 'getPaymentDate',
        'payment_method'           => 'getPaymentMethod',
        'partner_id'               => 'getPartnerId',
        'partner_code'             => 'getPartnerCode',
        'partner_name'             => 'getPartnerName',
        'bank_name'                => 'getBankName',
        'bank_name_kana'           => 'getBankNameKana',
        'bank_code'                => 'getBankCode',
        'branch_name'              => 'getBranchName',
        'branch_kana'              => 'getBranchKana',
        'branch_code'              => 'getBranchCode',
        'account_type'             => 'getAccountType',
        'account_number'           => 'getAccountNumber',
        'account_name'             => 'getAccountName',
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

    const STATUS_DRAFT                           = 'draft';
    const STATUS_IN_PROGRESS                     = 'in_progress';
    const STATUS_APPROVED                        = 'approved';
    const STATUS_REJECTED                        = 'rejected';
    const STATUS_FEEDBACK                        = 'feedback';
    const DEAL_STATUS_SETTLED                    = 'settled';
    const DEAL_STATUS_UNSETTLED                  = 'unsettled';
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
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_IN_PROGRESS,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
            self::STATUS_FEEDBACK,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getDealStatusAllowableValues()
    {
        return [
            self::DEAL_STATUS_SETTLED,
            self::DEAL_STATUS_UNSETTLED,
        ];
    }

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
        $this->container['id']                       = $data['id'] ?? null;
        $this->container['company_id']               = $data['company_id'] ?? null;
        $this->container['title']                    = $data['title'] ?? null;
        $this->container['application_date']         = $data['application_date'] ?? null;
        $this->container['description']              = $data['description'] ?? null;
        $this->container['total_amount']             = $data['total_amount'] ?? null;
        $this->container['status']                   = $data['status'] ?? null;
        $this->container['payment_request_lines']    = $data['payment_request_lines'] ?? null;
        $this->container['deal_id']                  = $data['deal_id'] ?? null;
        $this->container['deal_status']              = $data['deal_status'] ?? null;
        $this->container['applicant_id']             = $data['applicant_id'] ?? null;
        $this->container['approvers']                = $data['approvers'] ?? null;
        $this->container['application_number']       = $data['application_number'] ?? null;
        $this->container['approval_flow_route_id']   = $data['approval_flow_route_id'] ?? null;
        $this->container['comments']                 = $data['comments'] ?? null;
        $this->container['approval_flow_logs']       = $data['approval_flow_logs'] ?? null;
        $this->container['current_step_id']          = $data['current_step_id'] ?? null;
        $this->container['current_round']            = $data['current_round'] ?? null;
        $this->container['document_code']            = $data['document_code'] ?? null;
        $this->container['receipt_ids']              = $data['receipt_ids'] ?? null;
        $this->container['issue_date']               = $data['issue_date'] ?? null;
        $this->container['payment_date']             = $data['payment_date'] ?? null;
        $this->container['payment_method']           = $data['payment_method'] ?? null;
        $this->container['partner_id']               = $data['partner_id'] ?? null;
        $this->container['partner_code']             = $data['partner_code'] ?? null;
        $this->container['partner_name']             = $data['partner_name'] ?? null;
        $this->container['bank_name']                = $data['bank_name'] ?? null;
        $this->container['bank_name_kana']           = $data['bank_name_kana'] ?? null;
        $this->container['bank_code']                = $data['bank_code'] ?? null;
        $this->container['branch_name']              = $data['branch_name'] ?? null;
        $this->container['branch_kana']              = $data['branch_kana'] ?? null;
        $this->container['branch_code']              = $data['branch_code'] ?? null;
        $this->container['account_type']             = $data['account_type'] ?? null;
        $this->container['account_number']           = $data['account_number'] ?? null;
        $this->container['account_name']             = $data['account_name'] ?? null;
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

        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
        if ($this->container['application_date'] === null) {
            $invalidProperties[] = "'application_date' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['total_amount'] === null) {
            $invalidProperties[] = "'total_amount' can't be null";
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

        if ($this->container['payment_request_lines'] === null) {
            $invalidProperties[] = "'payment_request_lines' can't be null";
        }
        if ($this->container['deal_id'] === null) {
            $invalidProperties[] = "'deal_id' can't be null";
        }
        if (($this->container['deal_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'deal_id', must be bigger than or equal to 1.";
        }

        if ($this->container['deal_status'] === null) {
            $invalidProperties[] = "'deal_status' can't be null";
        }
        $allowedValues = $this->getDealStatusAllowableValues();
        if (!is_null($this->container['deal_status']) && !in_array($this->container['deal_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'deal_status', must be one of '%s'",
                $this->container['deal_status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['applicant_id'] === null) {
            $invalidProperties[] = "'applicant_id' can't be null";
        }
        if (($this->container['applicant_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'applicant_id', must be bigger than or equal to 1.";
        }

        if ($this->container['approvers'] === null) {
            $invalidProperties[] = "'approvers' can't be null";
        }
        if ($this->container['application_number'] === null) {
            $invalidProperties[] = "'application_number' can't be null";
        }
        if ($this->container['approval_flow_route_id'] === null) {
            $invalidProperties[] = "'approval_flow_route_id' can't be null";
        }
        if (($this->container['approval_flow_route_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'approval_flow_route_id', must be bigger than or equal to 1.";
        }

        if ($this->container['comments'] === null) {
            $invalidProperties[] = "'comments' can't be null";
        }
        if ($this->container['approval_flow_logs'] === null) {
            $invalidProperties[] = "'approval_flow_logs' can't be null";
        }
        if ($this->container['current_step_id'] === null) {
            $invalidProperties[] = "'current_step_id' can't be null";
        }
        if (($this->container['current_step_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'current_step_id', must be bigger than or equal to 1.";
        }

        if ($this->container['current_round'] === null) {
            $invalidProperties[] = "'current_round' can't be null";
        }
        if (($this->container['current_round'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'current_round', must be smaller than or equal to 2147483647.";
        }

        if (($this->container['current_round'] < 0)) {
            $invalidProperties[] = "invalid value for 'current_round', must be bigger than or equal to 0.";
        }

        if ($this->container['document_code'] === null) {
            $invalidProperties[] = "'document_code' can't be null";
        }
        if ($this->container['receipt_ids'] === null) {
            $invalidProperties[] = "'receipt_ids' can't be null";
        }
        if ($this->container['issue_date'] === null) {
            $invalidProperties[] = "'issue_date' can't be null";
        }
        if ($this->container['payment_date'] === null) {
            $invalidProperties[] = "'payment_date' can't be null";
        }
        if ($this->container['payment_method'] === null) {
            $invalidProperties[] = "'payment_method' can't be null";
        }
        $allowedValues = $this->getPaymentMethodAllowableValues();
        if (!is_null($this->container['payment_method']) && !in_array($this->container['payment_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_method', must be one of '%s'",
                $this->container['payment_method'],
                implode("', '", $allowedValues)
            );
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
        if ($this->container['bank_name'] === null) {
            $invalidProperties[] = "'bank_name' can't be null";
        }
        if ($this->container['bank_name_kana'] === null) {
            $invalidProperties[] = "'bank_name_kana' can't be null";
        }
        if ($this->container['bank_code'] === null) {
            $invalidProperties[] = "'bank_code' can't be null";
        }
        if ($this->container['branch_name'] === null) {
            $invalidProperties[] = "'branch_name' can't be null";
        }
        if ($this->container['branch_kana'] === null) {
            $invalidProperties[] = "'branch_kana' can't be null";
        }
        if ($this->container['branch_code'] === null) {
            $invalidProperties[] = "'branch_code' can't be null";
        }
        if ($this->container['account_type'] === null) {
            $invalidProperties[] = "'account_type' can't be null";
        }
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!is_null($this->container['account_type']) && !in_array($this->container['account_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'account_type', must be one of '%s'",
                $this->container['account_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['account_number'] === null) {
            $invalidProperties[] = "'account_number' can't be null";
        }
        if ($this->container['account_name'] === null) {
            $invalidProperties[] = "'account_name' can't be null";
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
     * @param int $id 支払依頼ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $company_id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
        }

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
     * @param string $title 申請タイトル
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
     * @return string
     */
    public function getApplicationDate()
    {
        return $this->container['application_date'];
    }

    /**
     * Sets application_date.
     *
     * @param string $application_date 申請日 (yyyy-mm-dd)
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
     * @param string $status 申請ステータス(draft:下書き, in_progress:申請中, approved:承認済, rejected:却下, feedback:差戻し)
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
     * Gets payment_request_lines.
     *
     * @return \OpenAPI\Client\Model\PaymentRequestResponsePaymentRequestPaymentRequestLines[]
     */
    public function getPaymentRequestLines()
    {
        return $this->container['payment_request_lines'];
    }

    /**
     * Sets payment_request_lines.
     *
     * @param \OpenAPI\Client\Model\PaymentRequestResponsePaymentRequestPaymentRequestLines[] $payment_request_lines 支払依頼の項目行一覧（配列）
     *
     * @return self
     */
    public function setPaymentRequestLines($payment_request_lines)
    {
        $this->container['payment_request_lines'] = $payment_request_lines;

        return $this;
    }

    /**
     * Gets deal_id.
     *
     * @return int
     */
    public function getDealId()
    {
        return $this->container['deal_id'];
    }

    /**
     * Sets deal_id.
     *
     * @param int $deal_id 取引ID (申請ステータス:statusがapprovedで、取引が存在する時のみdeal_idが表示されます)
     *
     * @return self
     */
    public function setDealId($deal_id)
    {
        if (($deal_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $deal_id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
        }

        $this->container['deal_id'] = $deal_id;

        return $this;
    }

    /**
     * Gets deal_status.
     *
     * @return string
     */
    public function getDealStatus()
    {
        return $this->container['deal_status'];
    }

    /**
     * Sets deal_status.
     *
     * @param string $deal_status 取引ステータス (申請ステータス:statusがapprovedで、取引が存在する時のみdeal_statusが表示されます settled:支払済み, unsettled:支払待ち)
     *
     * @return self
     */
    public function setDealStatus($deal_status)
    {
        $allowedValues = $this->getDealStatusAllowableValues();
        if (!in_array($deal_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'deal_status', must be one of '%s'",
                    $deal_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['deal_status'] = $deal_status;

        return $this;
    }

    /**
     * Gets applicant_id.
     *
     * @return int
     */
    public function getApplicantId()
    {
        return $this->container['applicant_id'];
    }

    /**
     * Sets applicant_id.
     *
     * @param int $applicant_id 申請者のユーザーID
     *
     * @return self
     */
    public function setApplicantId($applicant_id)
    {
        if (($applicant_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $applicant_id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
        }

        $this->container['applicant_id'] = $applicant_id;

        return $this;
    }

    /**
     * Gets approvers.
     *
     * @return \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovers[]
     */
    public function getApprovers()
    {
        return $this->container['approvers'];
    }

    /**
     * Sets approvers.
     *
     * @param \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovers[] $approvers 承認者（配列）   承認ステップのresource_typeがunspecified (指定なし)の場合はapproversはレスポンスに含まれません。   しかし、resource_typeがunspecifiedの承認ステップにおいて誰かが承認・却下・差し戻しのいずれかのアクションを取った後は、   approversはレスポンスに含まれるようになります。   その場合approversにはアクションを行ったステップのIDとアクションを行ったユーザーのIDが含まれます。
     *
     * @return self
     */
    public function setApprovers($approvers)
    {
        $this->container['approvers'] = $approvers;

        return $this;
    }

    /**
     * Gets application_number.
     *
     * @return string
     */
    public function getApplicationNumber()
    {
        return $this->container['application_number'];
    }

    /**
     * Sets application_number.
     *
     * @param string $application_number 申請No.
     *
     * @return self
     */
    public function setApplicationNumber($application_number)
    {
        $this->container['application_number'] = $application_number;

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
     * @param int $approval_flow_route_id 申請経路ID
     *
     * @return self
     */
    public function setApprovalFlowRouteId($approval_flow_route_id)
    {
        if (($approval_flow_route_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $approval_flow_route_id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
        }

        $this->container['approval_flow_route_id'] = $approval_flow_route_id;

        return $this;
    }

    /**
     * Gets comments.
     *
     * @return \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationComments[]
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments.
     *
     * @param \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationComments[] $comments 支払依頼のコメント一覧（配列）
     *
     * @return self
     */
    public function setComments($comments)
    {
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets approval_flow_logs.
     *
     * @return \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovalFlowLogs[]
     */
    public function getApprovalFlowLogs()
    {
        return $this->container['approval_flow_logs'];
    }

    /**
     * Sets approval_flow_logs.
     *
     * @param \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovalFlowLogs[] $approval_flow_logs 支払依頼の承認履歴（配列）
     *
     * @return self
     */
    public function setApprovalFlowLogs($approval_flow_logs)
    {
        $this->container['approval_flow_logs'] = $approval_flow_logs;

        return $this;
    }

    /**
     * Gets current_step_id.
     *
     * @return int
     */
    public function getCurrentStepId()
    {
        return $this->container['current_step_id'];
    }

    /**
     * Sets current_step_id.
     *
     * @param int $current_step_id 現在承認ステップID
     *
     * @return self
     */
    public function setCurrentStepId($current_step_id)
    {
        if (($current_step_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $current_step_id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
        }

        $this->container['current_step_id'] = $current_step_id;

        return $this;
    }

    /**
     * Gets current_round.
     *
     * @return int
     */
    public function getCurrentRound()
    {
        return $this->container['current_round'];
    }

    /**
     * Sets current_round.
     *
     * @param int $current_round 現在のround。差し戻し等により申請がstepの最初からやり直しになるとroundの値が増えます。
     *
     * @return self
     */
    public function setCurrentRound($current_round)
    {
        if (($current_round > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $current_round when calling PaymentRequestResponsePaymentRequest., must be smaller than or equal to 2147483647.');
        }
        if (($current_round < 0)) {
            throw new \InvalidArgumentException('invalid value for $current_round when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 0.');
        }

        $this->container['current_round'] = $current_round;

        return $this;
    }

    /**
     * Gets document_code.
     *
     * @return string
     */
    public function getDocumentCode()
    {
        return $this->container['document_code'];
    }

    /**
     * Sets document_code.
     *
     * @param string $document_code 請求書番号
     *
     * @return self
     */
    public function setDocumentCode($document_code)
    {
        $this->container['document_code'] = $document_code;

        return $this;
    }

    /**
     * Gets receipt_ids.
     *
     * @return int[]
     */
    public function getReceiptIds()
    {
        return $this->container['receipt_ids'];
    }

    /**
     * Sets receipt_ids.
     *
     * @param int[] $receipt_ids ファイルボックス（証憑ファイル）ID
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
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->container['payment_date'];
    }

    /**
     * Sets payment_date.
     *
     * @param string $payment_date 支払期限 (yyyy-mm-dd)
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
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->container['payment_method'];
    }

    /**
     * Sets payment_method.
     *
     * @param string $payment_method 支払方法(none: 指定なし, domestic_bank_transfer: 国内振込, abroad_bank_transfer: 国外振込, account_transfer: 口座振替, credit_card: クレジットカード)
     *
     * @return self
     */
    public function setPaymentMethod($payment_method)
    {
        $allowedValues = $this->getPaymentMethodAllowableValues();
        if (!in_array($payment_method, $allowedValues, true)) {
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
            throw new \InvalidArgumentException('invalid value for $partner_id when calling PaymentRequestResponsePaymentRequest., must be bigger than or equal to 1.');
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
     * Gets bank_name.
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->container['bank_name'];
    }

    /**
     * Sets bank_name.
     *
     * @param string $bank_name 銀行名
     *
     * @return self
     */
    public function setBankName($bank_name)
    {
        $this->container['bank_name'] = $bank_name;

        return $this;
    }

    /**
     * Gets bank_name_kana.
     *
     * @return string
     */
    public function getBankNameKana()
    {
        return $this->container['bank_name_kana'];
    }

    /**
     * Sets bank_name_kana.
     *
     * @param string $bank_name_kana 銀行名（カナ）
     *
     * @return self
     */
    public function setBankNameKana($bank_name_kana)
    {
        $this->container['bank_name_kana'] = $bank_name_kana;

        return $this;
    }

    /**
     * Gets bank_code.
     *
     * @return string
     */
    public function getBankCode()
    {
        return $this->container['bank_code'];
    }

    /**
     * Sets bank_code.
     *
     * @param string $bank_code 銀行コード
     *
     * @return self
     */
    public function setBankCode($bank_code)
    {
        $this->container['bank_code'] = $bank_code;

        return $this;
    }

    /**
     * Gets branch_name.
     *
     * @return string
     */
    public function getBranchName()
    {
        return $this->container['branch_name'];
    }

    /**
     * Sets branch_name.
     *
     * @param string $branch_name 支店名
     *
     * @return self
     */
    public function setBranchName($branch_name)
    {
        $this->container['branch_name'] = $branch_name;

        return $this;
    }

    /**
     * Gets branch_kana.
     *
     * @return string
     */
    public function getBranchKana()
    {
        return $this->container['branch_kana'];
    }

    /**
     * Sets branch_kana.
     *
     * @param string $branch_kana 支店名（カナ）
     *
     * @return self
     */
    public function setBranchKana($branch_kana)
    {
        $this->container['branch_kana'] = $branch_kana;

        return $this;
    }

    /**
     * Gets branch_code.
     *
     * @return string
     */
    public function getBranchCode()
    {
        return $this->container['branch_code'];
    }

    /**
     * Sets branch_code.
     *
     * @param string $branch_code 支店番号
     *
     * @return self
     */
    public function setBranchCode($branch_code)
    {
        $this->container['branch_code'] = $branch_code;

        return $this;
    }

    /**
     * Gets account_type.
     *
     * @return string
     */
    public function getAccountType()
    {
        return $this->container['account_type'];
    }

    /**
     * Sets account_type.
     *
     * @param string $account_type 口座種別(ordinary:普通、checking:当座、earmarked:納税準備預金、savings:貯蓄、other:その他)
     *
     * @return self
     */
    public function setAccountType($account_type)
    {
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!in_array($account_type, $allowedValues, true)) {
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
     * Gets account_number.
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number.
     *
     * @param string $account_number 口座番号
     *
     * @return self
     */
    public function setAccountNumber($account_number)
    {
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets account_name.
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->container['account_name'];
    }

    /**
     * Sets account_name.
     *
     * @param string $account_name 受取人名（カナ）
     *
     * @return self
     */
    public function setAccountName($account_name)
    {
        $this->container['account_name'] = $account_name;

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
     * @param string|null $qualified_invoice_status 適格請求書発行事業者（qualified: 該当する、not_qualified: 該当しない、unspecified: 未選択） - 支払依頼をインボイス要件をみたす申請として扱うかどうかを表します。
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
