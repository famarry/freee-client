<?php

/**
 * ManualJournalsApi
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
 * ManualJournalsApi Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */
class ManualJournalsApi
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
     * Operation createManualJournal.
     *
     * 振替伝票の作成
     *
     * @param \OpenAPI\Client\Model\ManualJournalCreateParams $manual_journal_create_params 振替伝票の作成 (optional)
     *
     * @return \OpenAPI\Client\Model\ManualJournalResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError|\OpenAPI\Client\Model\ServiceUnavailableError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function createManualJournal($manual_journal_create_params = null)
    {
        [$response] = $this->createManualJournalWithHttpInfo($manual_journal_create_params);

        return $response;
    }

    /**
     * Operation createManualJournalWithHttpInfo.
     *
     * 振替伝票の作成
     *
     * @param \OpenAPI\Client\Model\ManualJournalCreateParams $manual_journal_create_params 振替伝票の作成 (optional)
     *
     * @return array of \OpenAPI\Client\Model\ManualJournalResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError|\OpenAPI\Client\Model\ServiceUnavailableError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function createManualJournalWithHttpInfo($manual_journal_create_params = null)
    {
        $request = $this->createManualJournalRequest($manual_journal_create_params);

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

            switch ($statusCode) {
                case 201:
                    if ('\OpenAPI\Client\Model\ManualJournalResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ManualJournalResponse', []),
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

            $returnType = '\OpenAPI\Client\Model\ManualJournalResponse';
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
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ManualJournalResponse',
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
     * Operation createManualJournalAsync.
     *
     * 振替伝票の作成
     *
     * @param \OpenAPI\Client\Model\ManualJournalCreateParams $manual_journal_create_params 振替伝票の作成 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createManualJournalAsync($manual_journal_create_params = null)
    {
        return $this->createManualJournalAsyncWithHttpInfo($manual_journal_create_params)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createManualJournalAsyncWithHttpInfo.
     *
     * 振替伝票の作成
     *
     * @param \OpenAPI\Client\Model\ManualJournalCreateParams $manual_journal_create_params 振替伝票の作成 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createManualJournalAsyncWithHttpInfo($manual_journal_create_params = null)
    {
        $returnType = '\OpenAPI\Client\Model\ManualJournalResponse';
        $request    = $this->createManualJournalRequest($manual_journal_create_params);

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
     * Create request for operation 'createManualJournal'.
     *
     * @param \OpenAPI\Client\Model\ManualJournalCreateParams $manual_journal_create_params 振替伝票の作成 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function createManualJournalRequest($manual_journal_create_params = null)
    {
        $resourcePath = '/api/1/manual_journals';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json', 'application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (isset($manual_journal_create_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($manual_journal_create_params));
            } else {
                $httpBody = $manual_journal_create_params;
            }
        } elseif (count($formParams) > 0) {
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
            'POST',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation destroyManualJournal.
     *
     * 振替伝票の削除
     *
     * @param int $id         id (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function destroyManualJournal($id, $company_id)
    {
        $this->destroyManualJournalWithHttpInfo($id, $company_id);
    }

    /**
     * Operation destroyManualJournalWithHttpInfo.
     *
     * 振替伝票の削除
     *
     * @param int $id         (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function destroyManualJournalWithHttpInfo($id, $company_id)
    {
        $request = $this->destroyManualJournalRequest($id, $company_id);

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

            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
            }
            throw $e;
        }
    }

    /**
     * Operation destroyManualJournalAsync.
     *
     * 振替伝票の削除
     *
     * @param int $id         (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function destroyManualJournalAsync($id, $company_id)
    {
        return $this->destroyManualJournalAsyncWithHttpInfo($id, $company_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation destroyManualJournalAsyncWithHttpInfo.
     *
     * 振替伝票の削除
     *
     * @param int $id         (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function destroyManualJournalAsyncWithHttpInfo($id, $company_id)
    {
        $returnType = '';
        $request    = $this->destroyManualJournalRequest($id, $company_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
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
     * Create request for operation 'destroyManualJournal'.
     *
     * @param int $id         (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function destroyManualJournalRequest($id, $company_id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling destroyManualJournal'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ManualJournalsApi.destroyManualJournal, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling destroyManualJournal'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ManualJournalsApi.destroyManualJournal, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/manual_journals/{id}';
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


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
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
            'DELETE',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getManualJournal.
     *
     * 振替伝票の取得
     *
     * @param int $company_id 事業所ID (required)
     * @param int $id         id (required)
     *
     * @return \OpenAPI\Client\Model\ManualJournalResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function getManualJournal($company_id, $id)
    {
        [$response] = $this->getManualJournalWithHttpInfo($company_id, $id);

        return $response;
    }

    /**
     * Operation getManualJournalWithHttpInfo.
     *
     * 振替伝票の取得
     *
     * @param int $company_id 事業所ID (required)
     * @param int $id         (required)
     *
     * @return array of \OpenAPI\Client\Model\ManualJournalResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function getManualJournalWithHttpInfo($company_id, $id)
    {
        $request = $this->getManualJournalRequest($company_id, $id);

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

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ManualJournalResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ManualJournalResponse', []),
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
                case 404:
                    if ('\OpenAPI\Client\Model\BadRequestNotFoundError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestNotFoundError', []),
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
            }

            $returnType = '\OpenAPI\Client\Model\ManualJournalResponse';
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
                        '\OpenAPI\Client\Model\ManualJournalResponse',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getManualJournalAsync.
     *
     * 振替伝票の取得
     *
     * @param int $company_id 事業所ID (required)
     * @param int $id         (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getManualJournalAsync($company_id, $id)
    {
        return $this->getManualJournalAsyncWithHttpInfo($company_id, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getManualJournalAsyncWithHttpInfo.
     *
     * 振替伝票の取得
     *
     * @param int $company_id 事業所ID (required)
     * @param int $id         (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getManualJournalAsyncWithHttpInfo($company_id, $id)
    {
        $returnType = '\OpenAPI\Client\Model\ManualJournalResponse';
        $request    = $this->getManualJournalRequest($company_id, $id);

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
     * Create request for operation 'getManualJournal'.
     *
     * @param int $company_id 事業所ID (required)
     * @param int $id         (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getManualJournalRequest($company_id, $id)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getManualJournal'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ManualJournalsApi.getManualJournal, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getManualJournal'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ManualJournalsApi.getManualJournal, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/manual_journals/{id}';
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


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
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
     * Operation getManualJournals.
     *
     * 振替伝票一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_issue_date  発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date    発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $entry_side        貸借で絞込 (貸方: credit, 借方: debit) (optional)
     * @param int    $account_item_id   勘定科目IDで絞込 (optional)
     * @param int    $min_amount        金額で絞込：下限 (optional)
     * @param int    $max_amount        金額で絞込：上限 (optional)
     * @param int    $partner_id        取引先IDで絞込（0を指定すると、取引先が未選択の貸借行を絞り込めます） (optional)
     * @param string $partner_code      取引先コードで絞込 (optional)
     * @param int    $item_id           品目IDで絞込（0を指定すると、品目が未選択の貸借行を絞り込めます） (optional)
     * @param int    $section_id        部門IDで絞込（0を指定すると、部門が未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_1_tag_id  セグメント１タグIDで絞込（0を指定すると、セグメント１タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_2_tag_id  セグメント２タグIDで絞込（0を指定すると、セグメント２タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_3_tag_id  セグメント３タグIDで絞込（0を指定すると、セグメント３タグが未選択の貸借行を絞り込めます） (optional)
     * @param string $comment_status    コメント状態で絞込（自分宛のコメント: posted_with_mention, 自分宛のコメント-未解決: raised_with_mention, 自分宛のコメント-解決済: resolved_with_mention, コメントあり: posted, 未解決: raised, 解決済: resolved, コメントなし: none） (optional)
     * @param bool   $comment_important 重要コメント付きの振替伝票を絞込 (optional)
     * @param string $adjustment        決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without） (optional)
     * @param string $txn_number        仕訳番号で絞込（事業所の仕訳番号形式が有効な場合のみ） (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 20, 最小: 1, 最大: 500) (optional)
     *
     * @return \OpenAPI\Client\Model\InlineResponse2003|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getManualJournals($company_id, $start_issue_date = null, $end_issue_date = null, $entry_side = null, $account_item_id = null, $min_amount = null, $max_amount = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $segment_1_tag_id = null, $segment_2_tag_id = null, $segment_3_tag_id = null, $comment_status = null, $comment_important = null, $adjustment = null, $txn_number = null, $offset = null, $limit = null)
    {
        [$response] = $this->getManualJournalsWithHttpInfo($company_id, $start_issue_date, $end_issue_date, $entry_side, $account_item_id, $min_amount, $max_amount, $partner_id, $partner_code, $item_id, $section_id, $segment_1_tag_id, $segment_2_tag_id, $segment_3_tag_id, $comment_status, $comment_important, $adjustment, $txn_number, $offset, $limit);

        return $response;
    }

    /**
     * Operation getManualJournalsWithHttpInfo.
     *
     * 振替伝票一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_issue_date  発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date    発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $entry_side        貸借で絞込 (貸方: credit, 借方: debit) (optional)
     * @param int    $account_item_id   勘定科目IDで絞込 (optional)
     * @param int    $min_amount        金額で絞込：下限 (optional)
     * @param int    $max_amount        金額で絞込：上限 (optional)
     * @param int    $partner_id        取引先IDで絞込（0を指定すると、取引先が未選択の貸借行を絞り込めます） (optional)
     * @param string $partner_code      取引先コードで絞込 (optional)
     * @param int    $item_id           品目IDで絞込（0を指定すると、品目が未選択の貸借行を絞り込めます） (optional)
     * @param int    $section_id        部門IDで絞込（0を指定すると、部門が未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_1_tag_id  セグメント１タグIDで絞込（0を指定すると、セグメント１タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_2_tag_id  セグメント２タグIDで絞込（0を指定すると、セグメント２タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_3_tag_id  セグメント３タグIDで絞込（0を指定すると、セグメント３タグが未選択の貸借行を絞り込めます） (optional)
     * @param string $comment_status    コメント状態で絞込（自分宛のコメント: posted_with_mention, 自分宛のコメント-未解決: raised_with_mention, 自分宛のコメント-解決済: resolved_with_mention, コメントあり: posted, 未解決: raised, 解決済: resolved, コメントなし: none） (optional)
     * @param bool   $comment_important 重要コメント付きの振替伝票を絞込 (optional)
     * @param string $adjustment        決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without） (optional)
     * @param string $txn_number        仕訳番号で絞込（事業所の仕訳番号形式が有効な場合のみ） (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 20, 最小: 1, 最大: 500) (optional)
     *
     * @return array of \OpenAPI\Client\Model\InlineResponse2003|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getManualJournalsWithHttpInfo($company_id, $start_issue_date = null, $end_issue_date = null, $entry_side = null, $account_item_id = null, $min_amount = null, $max_amount = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $segment_1_tag_id = null, $segment_2_tag_id = null, $segment_3_tag_id = null, $comment_status = null, $comment_important = null, $adjustment = null, $txn_number = null, $offset = null, $limit = null)
    {
        $request = $this->getManualJournalsRequest($company_id, $start_issue_date, $end_issue_date, $entry_side, $account_item_id, $min_amount, $max_amount, $partner_id, $partner_code, $item_id, $section_id, $segment_1_tag_id, $segment_2_tag_id, $segment_3_tag_id, $comment_status, $comment_important, $adjustment, $txn_number, $offset, $limit);

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

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\InlineResponse2003' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InlineResponse2003', []),
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
            }

            $returnType = '\OpenAPI\Client\Model\InlineResponse2003';
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
                        '\OpenAPI\Client\Model\InlineResponse2003',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getManualJournalsAsync.
     *
     * 振替伝票一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_issue_date  発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date    発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $entry_side        貸借で絞込 (貸方: credit, 借方: debit) (optional)
     * @param int    $account_item_id   勘定科目IDで絞込 (optional)
     * @param int    $min_amount        金額で絞込：下限 (optional)
     * @param int    $max_amount        金額で絞込：上限 (optional)
     * @param int    $partner_id        取引先IDで絞込（0を指定すると、取引先が未選択の貸借行を絞り込めます） (optional)
     * @param string $partner_code      取引先コードで絞込 (optional)
     * @param int    $item_id           品目IDで絞込（0を指定すると、品目が未選択の貸借行を絞り込めます） (optional)
     * @param int    $section_id        部門IDで絞込（0を指定すると、部門が未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_1_tag_id  セグメント１タグIDで絞込（0を指定すると、セグメント１タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_2_tag_id  セグメント２タグIDで絞込（0を指定すると、セグメント２タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_3_tag_id  セグメント３タグIDで絞込（0を指定すると、セグメント３タグが未選択の貸借行を絞り込めます） (optional)
     * @param string $comment_status    コメント状態で絞込（自分宛のコメント: posted_with_mention, 自分宛のコメント-未解決: raised_with_mention, 自分宛のコメント-解決済: resolved_with_mention, コメントあり: posted, 未解決: raised, 解決済: resolved, コメントなし: none） (optional)
     * @param bool   $comment_important 重要コメント付きの振替伝票を絞込 (optional)
     * @param string $adjustment        決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without） (optional)
     * @param string $txn_number        仕訳番号で絞込（事業所の仕訳番号形式が有効な場合のみ） (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 20, 最小: 1, 最大: 500) (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getManualJournalsAsync($company_id, $start_issue_date = null, $end_issue_date = null, $entry_side = null, $account_item_id = null, $min_amount = null, $max_amount = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $segment_1_tag_id = null, $segment_2_tag_id = null, $segment_3_tag_id = null, $comment_status = null, $comment_important = null, $adjustment = null, $txn_number = null, $offset = null, $limit = null)
    {
        return $this->getManualJournalsAsyncWithHttpInfo($company_id, $start_issue_date, $end_issue_date, $entry_side, $account_item_id, $min_amount, $max_amount, $partner_id, $partner_code, $item_id, $section_id, $segment_1_tag_id, $segment_2_tag_id, $segment_3_tag_id, $comment_status, $comment_important, $adjustment, $txn_number, $offset, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getManualJournalsAsyncWithHttpInfo.
     *
     * 振替伝票一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_issue_date  発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date    発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $entry_side        貸借で絞込 (貸方: credit, 借方: debit) (optional)
     * @param int    $account_item_id   勘定科目IDで絞込 (optional)
     * @param int    $min_amount        金額で絞込：下限 (optional)
     * @param int    $max_amount        金額で絞込：上限 (optional)
     * @param int    $partner_id        取引先IDで絞込（0を指定すると、取引先が未選択の貸借行を絞り込めます） (optional)
     * @param string $partner_code      取引先コードで絞込 (optional)
     * @param int    $item_id           品目IDで絞込（0を指定すると、品目が未選択の貸借行を絞り込めます） (optional)
     * @param int    $section_id        部門IDで絞込（0を指定すると、部門が未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_1_tag_id  セグメント１タグIDで絞込（0を指定すると、セグメント１タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_2_tag_id  セグメント２タグIDで絞込（0を指定すると、セグメント２タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_3_tag_id  セグメント３タグIDで絞込（0を指定すると、セグメント３タグが未選択の貸借行を絞り込めます） (optional)
     * @param string $comment_status    コメント状態で絞込（自分宛のコメント: posted_with_mention, 自分宛のコメント-未解決: raised_with_mention, 自分宛のコメント-解決済: resolved_with_mention, コメントあり: posted, 未解決: raised, 解決済: resolved, コメントなし: none） (optional)
     * @param bool   $comment_important 重要コメント付きの振替伝票を絞込 (optional)
     * @param string $adjustment        決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without） (optional)
     * @param string $txn_number        仕訳番号で絞込（事業所の仕訳番号形式が有効な場合のみ） (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 20, 最小: 1, 最大: 500) (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getManualJournalsAsyncWithHttpInfo($company_id, $start_issue_date = null, $end_issue_date = null, $entry_side = null, $account_item_id = null, $min_amount = null, $max_amount = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $segment_1_tag_id = null, $segment_2_tag_id = null, $segment_3_tag_id = null, $comment_status = null, $comment_important = null, $adjustment = null, $txn_number = null, $offset = null, $limit = null)
    {
        $returnType = '\OpenAPI\Client\Model\InlineResponse2003';
        $request    = $this->getManualJournalsRequest($company_id, $start_issue_date, $end_issue_date, $entry_side, $account_item_id, $min_amount, $max_amount, $partner_id, $partner_code, $item_id, $section_id, $segment_1_tag_id, $segment_2_tag_id, $segment_3_tag_id, $comment_status, $comment_important, $adjustment, $txn_number, $offset, $limit);

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
     * Create request for operation 'getManualJournals'.
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_issue_date  発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date    発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $entry_side        貸借で絞込 (貸方: credit, 借方: debit) (optional)
     * @param int    $account_item_id   勘定科目IDで絞込 (optional)
     * @param int    $min_amount        金額で絞込：下限 (optional)
     * @param int    $max_amount        金額で絞込：上限 (optional)
     * @param int    $partner_id        取引先IDで絞込（0を指定すると、取引先が未選択の貸借行を絞り込めます） (optional)
     * @param string $partner_code      取引先コードで絞込 (optional)
     * @param int    $item_id           品目IDで絞込（0を指定すると、品目が未選択の貸借行を絞り込めます） (optional)
     * @param int    $section_id        部門IDで絞込（0を指定すると、部門が未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_1_tag_id  セグメント１タグIDで絞込（0を指定すると、セグメント１タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_2_tag_id  セグメント２タグIDで絞込（0を指定すると、セグメント２タグが未選択の貸借行を絞り込めます） (optional)
     * @param int    $segment_3_tag_id  セグメント３タグIDで絞込（0を指定すると、セグメント３タグが未選択の貸借行を絞り込めます） (optional)
     * @param string $comment_status    コメント状態で絞込（自分宛のコメント: posted_with_mention, 自分宛のコメント-未解決: raised_with_mention, 自分宛のコメント-解決済: resolved_with_mention, コメントあり: posted, 未解決: raised, 解決済: resolved, コメントなし: none） (optional)
     * @param bool   $comment_important 重要コメント付きの振替伝票を絞込 (optional)
     * @param string $adjustment        決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without） (optional)
     * @param string $txn_number        仕訳番号で絞込（事業所の仕訳番号形式が有効な場合のみ） (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 20, 最小: 1, 最大: 500) (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getManualJournalsRequest($company_id, $start_issue_date = null, $end_issue_date = null, $entry_side = null, $account_item_id = null, $min_amount = null, $max_amount = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $segment_1_tag_id = null, $segment_2_tag_id = null, $segment_3_tag_id = null, $comment_status = null, $comment_important = null, $adjustment = null, $txn_number = null, $offset = null, $limit = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getManualJournals'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 1.');
        }

        if ($account_item_id !== null && $account_item_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$account_item_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 1.');
        }

        if ($min_amount !== null && $min_amount > 9223372036854775807) {
            throw new \InvalidArgumentException('invalid value for "$min_amount" when calling ManualJournalsApi.getManualJournals, must be smaller than or equal to 9223372036854775807.');
        }
        if ($min_amount !== null && $min_amount < -9223372036854775808) {
            throw new \InvalidArgumentException('invalid value for "$min_amount" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to -9223372036854775808.');
        }

        if ($max_amount !== null && $max_amount > 9223372036854775807) {
            throw new \InvalidArgumentException('invalid value for "$max_amount" when calling ManualJournalsApi.getManualJournals, must be smaller than or equal to 9223372036854775807.');
        }
        if ($max_amount !== null && $max_amount < -9223372036854775808) {
            throw new \InvalidArgumentException('invalid value for "$max_amount" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to -9223372036854775808.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($segment_1_tag_id !== null && $segment_1_tag_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$segment_1_tag_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($segment_2_tag_id !== null && $segment_2_tag_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$segment_2_tag_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($segment_3_tag_id !== null && $segment_3_tag_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$segment_3_tag_id" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($offset !== null && $offset > 9223372036854775807) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling ManualJournalsApi.getManualJournals, must be smaller than or equal to 9223372036854775807.');
        }
        if ($offset !== null && $offset < 0) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 0.');
        }

        if ($limit !== null && $limit > 500) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ManualJournalsApi.getManualJournals, must be smaller than or equal to 500.');
        }
        if ($limit !== null && $limit < 1) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ManualJournalsApi.getManualJournals, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/manual_journals';
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
        if ($start_issue_date !== null) {
            if ('form' === 'form' && is_array($start_issue_date)) {
                foreach ($start_issue_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_issue_date'] = $start_issue_date;
            }
        }
        // query params
        if ($end_issue_date !== null) {
            if ('form' === 'form' && is_array($end_issue_date)) {
                foreach ($end_issue_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_issue_date'] = $end_issue_date;
            }
        }
        // query params
        if ($entry_side !== null) {
            if ('form' === 'form' && is_array($entry_side)) {
                foreach ($entry_side as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['entry_side'] = $entry_side;
            }
        }
        // query params
        if ($account_item_id !== null) {
            if ('form' === 'form' && is_array($account_item_id)) {
                foreach ($account_item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_id'] = $account_item_id;
            }
        }
        // query params
        if ($min_amount !== null) {
            if ('form' === 'form' && is_array($min_amount)) {
                foreach ($min_amount as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['min_amount'] = $min_amount;
            }
        }
        // query params
        if ($max_amount !== null) {
            if ('form' === 'form' && is_array($max_amount)) {
                foreach ($max_amount as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['max_amount'] = $max_amount;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($segment_1_tag_id !== null) {
            if ('form' === 'form' && is_array($segment_1_tag_id)) {
                foreach ($segment_1_tag_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_1_tag_id'] = $segment_1_tag_id;
            }
        }
        // query params
        if ($segment_2_tag_id !== null) {
            if ('form' === 'form' && is_array($segment_2_tag_id)) {
                foreach ($segment_2_tag_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_2_tag_id'] = $segment_2_tag_id;
            }
        }
        // query params
        if ($segment_3_tag_id !== null) {
            if ('form' === 'form' && is_array($segment_3_tag_id)) {
                foreach ($segment_3_tag_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_3_tag_id'] = $segment_3_tag_id;
            }
        }
        // query params
        if ($comment_status !== null) {
            if ('form' === 'form' && is_array($comment_status)) {
                foreach ($comment_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['comment_status'] = $comment_status;
            }
        }
        // query params
        if ($comment_important !== null) {
            if ('form' === 'form' && is_array($comment_important)) {
                foreach ($comment_important as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['comment_important'] = $comment_important;
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
        if ($txn_number !== null) {
            if ('form' === 'form' && is_array($txn_number)) {
                foreach ($txn_number as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['txn_number'] = $txn_number;
            }
        }
        // query params
        if ($offset !== null) {
            if ('form' === 'form' && is_array($offset)) {
                foreach ($offset as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['offset'] = $offset;
            }
        }
        // query params
        if ($limit !== null) {
            if ('form' === 'form' && is_array($limit)) {
                foreach ($limit as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['limit'] = $limit;
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
     * Operation updateManualJournal.
     *
     * 振替伝票の更新
     *
     * @param int                                             $id                           id (required)
     * @param \OpenAPI\Client\Model\ManualJournalUpdateParams $manual_journal_update_params 振替伝票の更新 (optional)
     *
     * @return \OpenAPI\Client\Model\ManualJournalResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function updateManualJournal($id, $manual_journal_update_params = null)
    {
        [$response] = $this->updateManualJournalWithHttpInfo($id, $manual_journal_update_params);

        return $response;
    }

    /**
     * Operation updateManualJournalWithHttpInfo.
     *
     * 振替伝票の更新
     *
     * @param int                                             $id                           (required)
     * @param \OpenAPI\Client\Model\ManualJournalUpdateParams $manual_journal_update_params 振替伝票の更新 (optional)
     *
     * @return array of \OpenAPI\Client\Model\ManualJournalResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function updateManualJournalWithHttpInfo($id, $manual_journal_update_params = null)
    {
        $request = $this->updateManualJournalRequest($id, $manual_journal_update_params);

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

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ManualJournalResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ManualJournalResponse', []),
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
                case 404:
                    if ('\OpenAPI\Client\Model\BadRequestNotFoundError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestNotFoundError', []),
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
            }

            $returnType = '\OpenAPI\Client\Model\ManualJournalResponse';
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
                        '\OpenAPI\Client\Model\ManualJournalResponse',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
            }
            throw $e;
        }
    }

    /**
     * Operation updateManualJournalAsync.
     *
     * 振替伝票の更新
     *
     * @param int                                             $id                           (required)
     * @param \OpenAPI\Client\Model\ManualJournalUpdateParams $manual_journal_update_params 振替伝票の更新 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function updateManualJournalAsync($id, $manual_journal_update_params = null)
    {
        return $this->updateManualJournalAsyncWithHttpInfo($id, $manual_journal_update_params)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateManualJournalAsyncWithHttpInfo.
     *
     * 振替伝票の更新
     *
     * @param int                                             $id                           (required)
     * @param \OpenAPI\Client\Model\ManualJournalUpdateParams $manual_journal_update_params 振替伝票の更新 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function updateManualJournalAsyncWithHttpInfo($id, $manual_journal_update_params = null)
    {
        $returnType = '\OpenAPI\Client\Model\ManualJournalResponse';
        $request    = $this->updateManualJournalRequest($id, $manual_journal_update_params);

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
     * Create request for operation 'updateManualJournal'.
     *
     * @param int                                             $id                           (required)
     * @param \OpenAPI\Client\Model\ManualJournalUpdateParams $manual_journal_update_params 振替伝票の更新 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function updateManualJournalRequest($id, $manual_journal_update_params = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling updateManualJournal'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ManualJournalsApi.updateManualJournal, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/manual_journals/{id}';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json', 'application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (isset($manual_journal_update_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($manual_journal_update_params));
            } else {
                $httpBody = $manual_journal_update_params;
            }
        } elseif (count($formParams) > 0) {
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
            'PUT',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option.
     *
     * @return array of http client options
     *
     * @throws \RuntimeException on file opening failure
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
