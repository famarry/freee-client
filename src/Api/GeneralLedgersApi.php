<?php
/**
 * GeneralLedgersApi
 * PHP version 7.3.
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
namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * GeneralLedgersApi Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */
class GeneralLedgersApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client         = $client ?: new Client();
        $this->config         = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex      = $hostIndex;
    }

    /**
     * Set the host index.
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index.
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getGeneralLedgers.
     *
     * 総勘定元帳一覧の取得（β版）
     *
     * @param int       $company_id           事業所ID (required)
     * @param \DateTime $start_date           期間で絞込：開始日 (yyyy-mm-dd) (required)
     * @param \DateTime $end_date             期間で絞込：終了日 (yyyy-mm-dd) (required)
     * @param string    $account_item_name    勘定科目名で絞込 (optional)
     * @param string    $tax_name             税区分名で絞込 (optional)
     * @param string    $tax_rate             税率で絞込 (optional)
     * @param string    $adjustment           決算整理仕訳で絞込（決算整理仕訳のみ：only, 決算整理仕訳以外：without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string    $cost_allocation      配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string    $partner_name         取引先で絞込（未選択を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string    $item_name            品目で絞込（未選択を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string    $section_name         部門で絞込（未選択を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string    $tag_name             メモタグで絞込&lt;br&gt; 取引数が多すぎる場合はタイムアウトする場合があります。&lt;br&gt; その場合はWeb画面よりPDF/CSV出力をご利用ください。 (optional)
     * @param string    $segment_tag_1_name   セグメント１タグ名で絞込（未選択を指定すると、セグメント１タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_2_name   セグメント２タグ名で絞込（未選択を指定すると、セグメント２タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_3_name   セグメント３タグ名で絞込（未選択を指定すると、セグメント３タグが未選択で絞り込めます） (optional)
     * @param string    $approval_flow_status 承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     *
     * @return \OpenAPI\Client\Model\GeneralLedgersResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError|\OpenAPI\Client\Model\ServiceUnavailableError
     */
    public function getGeneralLedgers($company_id, $start_date, $end_date, $account_item_name = null, $tax_name = null, $tax_rate = null, $adjustment = null, $cost_allocation = null, $partner_name = null, $item_name = null, $section_name = null, $tag_name = null, $segment_tag_1_name = null, $segment_tag_2_name = null, $segment_tag_3_name = null, $approval_flow_status = null)
    {
        list($response) = $this->getGeneralLedgersWithHttpInfo($company_id, $start_date, $end_date, $account_item_name, $tax_name, $tax_rate, $adjustment, $cost_allocation, $partner_name, $item_name, $section_name, $tag_name, $segment_tag_1_name, $segment_tag_2_name, $segment_tag_3_name, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getGeneralLedgersWithHttpInfo.
     *
     * 総勘定元帳一覧の取得（β版）
     *
     * @param int       $company_id           事業所ID (required)
     * @param \DateTime $start_date           期間で絞込：開始日 (yyyy-mm-dd) (required)
     * @param \DateTime $end_date             期間で絞込：終了日 (yyyy-mm-dd) (required)
     * @param string    $account_item_name    勘定科目名で絞込 (optional)
     * @param string    $tax_name             税区分名で絞込 (optional)
     * @param string    $tax_rate             税率で絞込 (optional)
     * @param string    $adjustment           決算整理仕訳で絞込（決算整理仕訳のみ：only, 決算整理仕訳以外：without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string    $cost_allocation      配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string    $partner_name         取引先で絞込（未選択を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string    $item_name            品目で絞込（未選択を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string    $section_name         部門で絞込（未選択を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string    $tag_name             メモタグで絞込&lt;br&gt; 取引数が多すぎる場合はタイムアウトする場合があります。&lt;br&gt; その場合はWeb画面よりPDF/CSV出力をご利用ください。 (optional)
     * @param string    $segment_tag_1_name   セグメント１タグ名で絞込（未選択を指定すると、セグメント１タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_2_name   セグメント２タグ名で絞込（未選択を指定すると、セグメント２タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_3_name   セグメント３タグ名で絞込（未選択を指定すると、セグメント３タグが未選択で絞り込めます） (optional)
     * @param string    $approval_flow_status 承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     *
     * @return array of \OpenAPI\Client\Model\GeneralLedgersResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError|\OpenAPI\Client\Model\ServiceUnavailableError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getGeneralLedgersWithHttpInfo($company_id, $start_date, $end_date, $account_item_name = null, $tax_name = null, $tax_rate = null, $adjustment = null, $cost_allocation = null, $partner_name = null, $item_name = null, $section_name = null, $tag_name = null, $segment_tag_1_name = null, $segment_tag_2_name = null, $segment_tag_3_name = null, $approval_flow_status = null)
    {
        $request = $this->getGeneralLedgersRequest($company_id, $start_date, $end_date, $account_item_name, $tax_name, $tax_rate, $adjustment, $cost_allocation, $partner_name, $item_name, $section_name, $tag_name, $segment_tag_1_name, $segment_tag_2_name, $segment_tag_3_name, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\GeneralLedgersResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\GeneralLedgersResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 503:
                    if ('\OpenAPI\Client\Model\ServiceUnavailableError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ServiceUnavailableError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\GeneralLedgersResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\GeneralLedgersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 503:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ServiceUnavailableError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getGeneralLedgersAsync.
     *
     * 総勘定元帳一覧の取得（β版）
     *
     * @param int       $company_id           事業所ID (required)
     * @param \DateTime $start_date           期間で絞込：開始日 (yyyy-mm-dd) (required)
     * @param \DateTime $end_date             期間で絞込：終了日 (yyyy-mm-dd) (required)
     * @param string    $account_item_name    勘定科目名で絞込 (optional)
     * @param string    $tax_name             税区分名で絞込 (optional)
     * @param string    $tax_rate             税率で絞込 (optional)
     * @param string    $adjustment           決算整理仕訳で絞込（決算整理仕訳のみ：only, 決算整理仕訳以外：without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string    $cost_allocation      配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string    $partner_name         取引先で絞込（未選択を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string    $item_name            品目で絞込（未選択を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string    $section_name         部門で絞込（未選択を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string    $tag_name             メモタグで絞込&lt;br&gt; 取引数が多すぎる場合はタイムアウトする場合があります。&lt;br&gt; その場合はWeb画面よりPDF/CSV出力をご利用ください。 (optional)
     * @param string    $segment_tag_1_name   セグメント１タグ名で絞込（未選択を指定すると、セグメント１タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_2_name   セグメント２タグ名で絞込（未選択を指定すると、セグメント２タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_3_name   セグメント３タグ名で絞込（未選択を指定すると、セグメント３タグが未選択で絞り込めます） (optional)
     * @param string    $approval_flow_status 承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @throws \InvalidArgumentException
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGeneralLedgersAsync($company_id, $start_date, $end_date, $account_item_name = null, $tax_name = null, $tax_rate = null, $adjustment = null, $cost_allocation = null, $partner_name = null, $item_name = null, $section_name = null, $tag_name = null, $segment_tag_1_name = null, $segment_tag_2_name = null, $segment_tag_3_name = null, $approval_flow_status = null)
    {
        return $this->getGeneralLedgersAsyncWithHttpInfo($company_id, $start_date, $end_date, $account_item_name, $tax_name, $tax_rate, $adjustment, $cost_allocation, $partner_name, $item_name, $section_name, $tag_name, $segment_tag_1_name, $segment_tag_2_name, $segment_tag_3_name, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getGeneralLedgersAsyncWithHttpInfo.
     *
     * 総勘定元帳一覧の取得（β版）
     *
     * @param int       $company_id           事業所ID (required)
     * @param \DateTime $start_date           期間で絞込：開始日 (yyyy-mm-dd) (required)
     * @param \DateTime $end_date             期間で絞込：終了日 (yyyy-mm-dd) (required)
     * @param string    $account_item_name    勘定科目名で絞込 (optional)
     * @param string    $tax_name             税区分名で絞込 (optional)
     * @param string    $tax_rate             税率で絞込 (optional)
     * @param string    $adjustment           決算整理仕訳で絞込（決算整理仕訳のみ：only, 決算整理仕訳以外：without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string    $cost_allocation      配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string    $partner_name         取引先で絞込（未選択を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string    $item_name            品目で絞込（未選択を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string    $section_name         部門で絞込（未選択を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string    $tag_name             メモタグで絞込&lt;br&gt; 取引数が多すぎる場合はタイムアウトする場合があります。&lt;br&gt; その場合はWeb画面よりPDF/CSV出力をご利用ください。 (optional)
     * @param string    $segment_tag_1_name   セグメント１タグ名で絞込（未選択を指定すると、セグメント１タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_2_name   セグメント２タグ名で絞込（未選択を指定すると、セグメント２タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_3_name   セグメント３タグ名で絞込（未選択を指定すると、セグメント３タグが未選択で絞り込めます） (optional)
     * @param string    $approval_flow_status 承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @throws \InvalidArgumentException
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGeneralLedgersAsyncWithHttpInfo($company_id, $start_date, $end_date, $account_item_name = null, $tax_name = null, $tax_rate = null, $adjustment = null, $cost_allocation = null, $partner_name = null, $item_name = null, $section_name = null, $tag_name = null, $segment_tag_1_name = null, $segment_tag_2_name = null, $segment_tag_3_name = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\GeneralLedgersResponse';
        $request    = $this->getGeneralLedgersRequest($company_id, $start_date, $end_date, $account_item_name, $tax_name, $tax_rate, $adjustment, $cost_allocation, $partner_name, $item_name, $section_name, $tag_name, $segment_tag_1_name, $segment_tag_2_name, $segment_tag_3_name, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getGeneralLedgers'.
     *
     * @param int       $company_id           事業所ID (required)
     * @param \DateTime $start_date           期間で絞込：開始日 (yyyy-mm-dd) (required)
     * @param \DateTime $end_date             期間で絞込：終了日 (yyyy-mm-dd) (required)
     * @param string    $account_item_name    勘定科目名で絞込 (optional)
     * @param string    $tax_name             税区分名で絞込 (optional)
     * @param string    $tax_rate             税率で絞込 (optional)
     * @param string    $adjustment           決算整理仕訳で絞込（決算整理仕訳のみ：only, 決算整理仕訳以外：without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string    $cost_allocation      配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string    $partner_name         取引先で絞込（未選択を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string    $item_name            品目で絞込（未選択を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string    $section_name         部門で絞込（未選択を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string    $tag_name             メモタグで絞込&lt;br&gt; 取引数が多すぎる場合はタイムアウトする場合があります。&lt;br&gt; その場合はWeb画面よりPDF/CSV出力をご利用ください。 (optional)
     * @param string    $segment_tag_1_name   セグメント１タグ名で絞込（未選択を指定すると、セグメント１タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_2_name   セグメント２タグ名で絞込（未選択を指定すると、セグメント２タグが未選択で絞り込めます） (optional)
     * @param string    $segment_tag_3_name   セグメント３タグ名で絞込（未選択を指定すると、セグメント３タグが未選択で絞り込めます） (optional)
     * @param string    $approval_flow_status 承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @throws \InvalidArgumentException
     *
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getGeneralLedgersRequest($company_id, $start_date, $end_date, $account_item_name = null, $tax_name = null, $tax_rate = null, $adjustment = null, $cost_allocation = null, $partner_name = null, $item_name = null, $section_name = null, $tag_name = null, $segment_tag_1_name = null, $segment_tag_2_name = null, $segment_tag_3_name = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getGeneralLedgers'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling GeneralLedgersApi.getGeneralLedgers, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'start_date' is set
        if ($start_date === null || (is_array($start_date) && count($start_date) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $start_date when calling getGeneralLedgers'
            );
        }
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $start_date)) {
            throw new \InvalidArgumentException('invalid value for "start_date" when calling GeneralLedgersApi.getGeneralLedgers, must conform to the pattern /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/.');
        }

        // verify the required parameter 'end_date' is set
        if ($end_date === null || (is_array($end_date) && count($end_date) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $end_date when calling getGeneralLedgers'
            );
        }
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $end_date)) {
            throw new \InvalidArgumentException('invalid value for "end_date" when calling GeneralLedgersApi.getGeneralLedgers, must conform to the pattern /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/.');
        }


        $resourcePath = '/api/1/reports/general_ledgers';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_name !== null) {
            if ('form' === 'form' && is_array($account_item_name)) {
                foreach ($account_item_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_name'] = $account_item_name;
            }
        }
        // query params
        if ($tax_name !== null) {
            if ('form' === 'form' && is_array($tax_name)) {
                foreach ($tax_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['tax_name'] = $tax_name;
            }
        }
        // query params
        if ($tax_rate !== null) {
            if ('form' === 'form' && is_array($tax_rate)) {
                foreach ($tax_rate as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['tax_rate'] = $tax_rate;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($partner_name !== null) {
            if ('form' === 'form' && is_array($partner_name)) {
                foreach ($partner_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_name'] = $partner_name;
            }
        }
        // query params
        if ($item_name !== null) {
            if ('form' === 'form' && is_array($item_name)) {
                foreach ($item_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_name'] = $item_name;
            }
        }
        // query params
        if ($section_name !== null) {
            if ('form' === 'form' && is_array($section_name)) {
                foreach ($section_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_name'] = $section_name;
            }
        }
        // query params
        if ($tag_name !== null) {
            if ('form' === 'form' && is_array($tag_name)) {
                foreach ($tag_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['tag_name'] = $tag_name;
            }
        }
        // query params
        if ($segment_tag_1_name !== null) {
            if ('form' === 'form' && is_array($segment_tag_1_name)) {
                foreach ($segment_tag_1_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_tag_1_name'] = $segment_tag_1_name;
            }
        }
        // query params
        if ($segment_tag_2_name !== null) {
            if ('form' === 'form' && is_array($segment_tag_2_name)) {
                foreach ($segment_tag_2_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_tag_2_name'] = $segment_tag_2_name;
            }
        }
        // query params
        if ($segment_tag_3_name !== null) {
            if ('form' === 'form' && is_array($segment_tag_3_name)) {
                foreach ($segment_tag_3_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_tag_3_name'] = $segment_tag_3_name;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option.
     *
     * @throws \RuntimeException on file opening failure
     *
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: '.$this->config->getDebugFile());
            }
        }

        return $options;
    }
}
