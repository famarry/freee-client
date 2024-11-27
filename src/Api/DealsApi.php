<?php

/**
 * DealsApi
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
 * DealsApi Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */
class DealsApi
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
     * Operation createDeal.
     *
     * 取引（収入・支出）の作成
     *
     * @param \OpenAPI\Client\Model\DealCreateParams $deal_create_params 取引（収入・支出）の作成 (optional)
     *
     * @return \OpenAPI\Client\Model\DealCreateResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function createDeal($deal_create_params = null)
    {
        [$response] = $this->createDealWithHttpInfo($deal_create_params);

        return $response;
    }

    /**
     * Operation createDealWithHttpInfo.
     *
     * 取引（収入・支出）の作成
     *
     * @param \OpenAPI\Client\Model\DealCreateParams $deal_create_params 取引（収入・支出）の作成 (optional)
     *
     * @return array of \OpenAPI\Client\Model\DealCreateResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function createDealWithHttpInfo($deal_create_params = null)
    {
        $request = $this->createDealRequest($deal_create_params);

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
                    if ('\OpenAPI\Client\Model\DealCreateResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\DealCreateResponse', []),
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

            $returnType = '\OpenAPI\Client\Model\DealCreateResponse';
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
                        '\OpenAPI\Client\Model\DealCreateResponse',
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
     * Operation createDealAsync.
     *
     * 取引（収入・支出）の作成
     *
     * @param \OpenAPI\Client\Model\DealCreateParams $deal_create_params 取引（収入・支出）の作成 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createDealAsync($deal_create_params = null)
    {
        return $this->createDealAsyncWithHttpInfo($deal_create_params)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createDealAsyncWithHttpInfo.
     *
     * 取引（収入・支出）の作成
     *
     * @param \OpenAPI\Client\Model\DealCreateParams $deal_create_params 取引（収入・支出）の作成 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createDealAsyncWithHttpInfo($deal_create_params = null)
    {
        $returnType = '\OpenAPI\Client\Model\DealCreateResponse';
        $request    = $this->createDealRequest($deal_create_params);

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
     * Create request for operation 'createDeal'.
     *
     * @param \OpenAPI\Client\Model\DealCreateParams $deal_create_params 取引（収入・支出）の作成 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function createDealRequest($deal_create_params = null)
    {
        $resourcePath = '/api/1/deals';
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
        if (isset($deal_create_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($deal_create_params));
            } else {
                $httpBody = $deal_create_params;
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
     * Operation destroyDeal.
     *
     * 取引（収入・支出）の削除
     *
     * @param int $id         取引ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function destroyDeal($id, $company_id)
    {
        $this->destroyDealWithHttpInfo($id, $company_id);
    }

    /**
     * Operation destroyDealWithHttpInfo.
     *
     * 取引（収入・支出）の削除
     *
     * @param int $id         取引ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function destroyDealWithHttpInfo($id, $company_id)
    {
        $request = $this->destroyDealRequest($id, $company_id);

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
     * Operation destroyDealAsync.
     *
     * 取引（収入・支出）の削除
     *
     * @param int $id         取引ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function destroyDealAsync($id, $company_id)
    {
        return $this->destroyDealAsyncWithHttpInfo($id, $company_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation destroyDealAsyncWithHttpInfo.
     *
     * 取引（収入・支出）の削除
     *
     * @param int $id         取引ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function destroyDealAsyncWithHttpInfo($id, $company_id)
    {
        $returnType = '';
        $request    = $this->destroyDealRequest($id, $company_id);

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
     * Create request for operation 'destroyDeal'.
     *
     * @param int $id         取引ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function destroyDealRequest($id, $company_id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling destroyDeal'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling DealsApi.destroyDeal, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling destroyDeal'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling DealsApi.destroyDeal, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/deals/{id}';
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
     * Operation getDeal.
     *
     * 取引（収入・支出）の取得
     *
     * @param int    $company_id 事業所ID (required)
     * @param int    $id         id (required)
     * @param string $accruals   取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \OpenAPI\Client\Model\DealResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function getDeal($company_id, $id, $accruals = null)
    {
        [$response] = $this->getDealWithHttpInfo($company_id, $id, $accruals);

        return $response;
    }

    /**
     * Operation getDealWithHttpInfo.
     *
     * 取引（収入・支出）の取得
     *
     * @param int    $company_id 事業所ID (required)
     * @param int    $id         (required)
     * @param string $accruals   取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return array of \OpenAPI\Client\Model\DealResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function getDealWithHttpInfo($company_id, $id, $accruals = null)
    {
        $request = $this->getDealRequest($company_id, $id, $accruals);

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
                    if ('\OpenAPI\Client\Model\DealResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\DealResponse', []),
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

            $returnType = '\OpenAPI\Client\Model\DealResponse';
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
                        '\OpenAPI\Client\Model\DealResponse',
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
     * Operation getDealAsync.
     *
     * 取引（収入・支出）の取得
     *
     * @param int    $company_id 事業所ID (required)
     * @param int    $id         (required)
     * @param string $accruals   取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getDealAsync($company_id, $id, $accruals = null)
    {
        return $this->getDealAsyncWithHttpInfo($company_id, $id, $accruals)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDealAsyncWithHttpInfo.
     *
     * 取引（収入・支出）の取得
     *
     * @param int    $company_id 事業所ID (required)
     * @param int    $id         (required)
     * @param string $accruals   取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getDealAsyncWithHttpInfo($company_id, $id, $accruals = null)
    {
        $returnType = '\OpenAPI\Client\Model\DealResponse';
        $request    = $this->getDealRequest($company_id, $id, $accruals);

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
     * Create request for operation 'getDeal'.
     *
     * @param int    $company_id 事業所ID (required)
     * @param int    $id         (required)
     * @param string $accruals   取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getDealRequest($company_id, $id, $accruals = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getDeal'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling DealsApi.getDeal, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getDeal'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling DealsApi.getDeal, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/deals/{id}';
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
        if ($accruals !== null) {
            if ('form' === 'form' && is_array($accruals)) {
                foreach ($accruals as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['accruals'] = $accruals;
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
     * Operation getDeals.
     *
     * 取引（収入・支出）一覧の取得
     *
     * @param int    $company_id       事業所ID (required)
     * @param int    $partner_id       取引先IDで絞込 (optional)
     * @param int    $account_item_id  勘定科目IDで絞込 (optional)
     * @param string $partner_code     取引先コードで絞込 (optional)
     * @param string $status           決済状況で絞込 (未決済: unsettled, 完了: settled) (optional)
     * @param string $type             収支区分 (収入: income, 支出: expense) (optional)
     * @param string $start_issue_date 発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date   発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_due_date   支払期日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_due_date     支払期日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_renew_date +更新日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_renew_date   +更新日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param int    $offset           取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit            取得レコードの件数 (デフォルト: 20, 最大: 100) (optional)
     * @param string $registered_from  取引登録元アプリで絞込（me: 本APIを叩くアプリ自身から登録した取引のみ） (optional)
     * @param string $accruals         取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \OpenAPI\Client\Model\InlineResponse2002|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getDeals($company_id, $partner_id = null, $account_item_id = null, $partner_code = null, $status = null, $type = null, $start_issue_date = null, $end_issue_date = null, $start_due_date = null, $end_due_date = null, $start_renew_date = null, $end_renew_date = null, $offset = null, $limit = null, $registered_from = null, $accruals = null)
    {
        [$response] = $this->getDealsWithHttpInfo($company_id, $partner_id, $account_item_id, $partner_code, $status, $type, $start_issue_date, $end_issue_date, $start_due_date, $end_due_date, $start_renew_date, $end_renew_date, $offset, $limit, $registered_from, $accruals);

        return $response;
    }

    /**
     * Operation getDealsWithHttpInfo.
     *
     * 取引（収入・支出）一覧の取得
     *
     * @param int    $company_id       事業所ID (required)
     * @param int    $partner_id       取引先IDで絞込 (optional)
     * @param int    $account_item_id  勘定科目IDで絞込 (optional)
     * @param string $partner_code     取引先コードで絞込 (optional)
     * @param string $status           決済状況で絞込 (未決済: unsettled, 完了: settled) (optional)
     * @param string $type             収支区分 (収入: income, 支出: expense) (optional)
     * @param string $start_issue_date 発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date   発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_due_date   支払期日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_due_date     支払期日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_renew_date +更新日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_renew_date   +更新日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param int    $offset           取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit            取得レコードの件数 (デフォルト: 20, 最大: 100) (optional)
     * @param string $registered_from  取引登録元アプリで絞込（me: 本APIを叩くアプリ自身から登録した取引のみ） (optional)
     * @param string $accruals         取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return array of \OpenAPI\Client\Model\InlineResponse2002|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getDealsWithHttpInfo($company_id, $partner_id = null, $account_item_id = null, $partner_code = null, $status = null, $type = null, $start_issue_date = null, $end_issue_date = null, $start_due_date = null, $end_due_date = null, $start_renew_date = null, $end_renew_date = null, $offset = null, $limit = null, $registered_from = null, $accruals = null)
    {
        $request = $this->getDealsRequest($company_id, $partner_id, $account_item_id, $partner_code, $status, $type, $start_issue_date, $end_issue_date, $start_due_date, $end_due_date, $start_renew_date, $end_renew_date, $offset, $limit, $registered_from, $accruals);

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
                    if ('\OpenAPI\Client\Model\InlineResponse2002' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InlineResponse2002', []),
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

            $returnType = '\OpenAPI\Client\Model\InlineResponse2002';
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
                        '\OpenAPI\Client\Model\InlineResponse2002',
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
     * Operation getDealsAsync.
     *
     * 取引（収入・支出）一覧の取得
     *
     * @param int    $company_id       事業所ID (required)
     * @param int    $partner_id       取引先IDで絞込 (optional)
     * @param int    $account_item_id  勘定科目IDで絞込 (optional)
     * @param string $partner_code     取引先コードで絞込 (optional)
     * @param string $status           決済状況で絞込 (未決済: unsettled, 完了: settled) (optional)
     * @param string $type             収支区分 (収入: income, 支出: expense) (optional)
     * @param string $start_issue_date 発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date   発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_due_date   支払期日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_due_date     支払期日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_renew_date +更新日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_renew_date   +更新日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param int    $offset           取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit            取得レコードの件数 (デフォルト: 20, 最大: 100) (optional)
     * @param string $registered_from  取引登録元アプリで絞込（me: 本APIを叩くアプリ自身から登録した取引のみ） (optional)
     * @param string $accruals         取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getDealsAsync($company_id, $partner_id = null, $account_item_id = null, $partner_code = null, $status = null, $type = null, $start_issue_date = null, $end_issue_date = null, $start_due_date = null, $end_due_date = null, $start_renew_date = null, $end_renew_date = null, $offset = null, $limit = null, $registered_from = null, $accruals = null)
    {
        return $this->getDealsAsyncWithHttpInfo($company_id, $partner_id, $account_item_id, $partner_code, $status, $type, $start_issue_date, $end_issue_date, $start_due_date, $end_due_date, $start_renew_date, $end_renew_date, $offset, $limit, $registered_from, $accruals)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDealsAsyncWithHttpInfo.
     *
     * 取引（収入・支出）一覧の取得
     *
     * @param int    $company_id       事業所ID (required)
     * @param int    $partner_id       取引先IDで絞込 (optional)
     * @param int    $account_item_id  勘定科目IDで絞込 (optional)
     * @param string $partner_code     取引先コードで絞込 (optional)
     * @param string $status           決済状況で絞込 (未決済: unsettled, 完了: settled) (optional)
     * @param string $type             収支区分 (収入: income, 支出: expense) (optional)
     * @param string $start_issue_date 発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date   発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_due_date   支払期日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_due_date     支払期日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_renew_date +更新日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_renew_date   +更新日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param int    $offset           取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit            取得レコードの件数 (デフォルト: 20, 最大: 100) (optional)
     * @param string $registered_from  取引登録元アプリで絞込（me: 本APIを叩くアプリ自身から登録した取引のみ） (optional)
     * @param string $accruals         取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getDealsAsyncWithHttpInfo($company_id, $partner_id = null, $account_item_id = null, $partner_code = null, $status = null, $type = null, $start_issue_date = null, $end_issue_date = null, $start_due_date = null, $end_due_date = null, $start_renew_date = null, $end_renew_date = null, $offset = null, $limit = null, $registered_from = null, $accruals = null)
    {
        $returnType = '\OpenAPI\Client\Model\InlineResponse2002';
        $request    = $this->getDealsRequest($company_id, $partner_id, $account_item_id, $partner_code, $status, $type, $start_issue_date, $end_issue_date, $start_due_date, $end_due_date, $start_renew_date, $end_renew_date, $offset, $limit, $registered_from, $accruals);

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
     * Create request for operation 'getDeals'.
     *
     * @param int    $company_id       事業所ID (required)
     * @param int    $partner_id       取引先IDで絞込 (optional)
     * @param int    $account_item_id  勘定科目IDで絞込 (optional)
     * @param string $partner_code     取引先コードで絞込 (optional)
     * @param string $status           決済状況で絞込 (未決済: unsettled, 完了: settled) (optional)
     * @param string $type             収支区分 (収入: income, 支出: expense) (optional)
     * @param string $start_issue_date 発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_issue_date   発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_due_date   支払期日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_due_date     支払期日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $start_renew_date +更新日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_renew_date   +更新日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param int    $offset           取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit            取得レコードの件数 (デフォルト: 20, 最大: 100) (optional)
     * @param string $registered_from  取引登録元アプリで絞込（me: 本APIを叩くアプリ自身から登録した取引のみ） (optional)
     * @param string $accruals         取引の債権債務行の表示（without: 表示しない(デフォルト), with: 表示する） (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getDealsRequest($company_id, $partner_id = null, $account_item_id = null, $partner_code = null, $status = null, $type = null, $start_issue_date = null, $end_issue_date = null, $start_due_date = null, $end_due_date = null, $start_renew_date = null, $end_renew_date = null, $offset = null, $limit = null, $registered_from = null, $accruals = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getDeals'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling DealsApi.getDeals, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling DealsApi.getDeals, must be bigger than or equal to 1.');
        }

        if ($account_item_id !== null && $account_item_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$account_item_id" when calling DealsApi.getDeals, must be bigger than or equal to 1.');
        }

        if ($offset !== null && $offset > 9223372036854775807) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling DealsApi.getDeals, must be smaller than or equal to 9223372036854775807.');
        }
        if ($offset !== null && $offset < 0) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling DealsApi.getDeals, must be bigger than or equal to 0.');
        }

        if ($limit !== null && $limit > 100) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling DealsApi.getDeals, must be smaller than or equal to 100.');
        }
        if ($limit !== null && $limit < 1) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling DealsApi.getDeals, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/deals';
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
        if ($status !== null) {
            if ('form' === 'form' && is_array($status)) {
                foreach ($status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['status'] = $status;
            }
        }
        // query params
        if ($type !== null) {
            if ('form' === 'form' && is_array($type)) {
                foreach ($type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['type'] = $type;
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
        if ($start_due_date !== null) {
            if ('form' === 'form' && is_array($start_due_date)) {
                foreach ($start_due_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_due_date'] = $start_due_date;
            }
        }
        // query params
        if ($end_due_date !== null) {
            if ('form' === 'form' && is_array($end_due_date)) {
                foreach ($end_due_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_due_date'] = $end_due_date;
            }
        }
        // query params
        if ($start_renew_date !== null) {
            if ('form' === 'form' && is_array($start_renew_date)) {
                foreach ($start_renew_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_renew_date'] = $start_renew_date;
            }
        }
        // query params
        if ($end_renew_date !== null) {
            if ('form' === 'form' && is_array($end_renew_date)) {
                foreach ($end_renew_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_renew_date'] = $end_renew_date;
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
        // query params
        if ($registered_from !== null) {
            if ('form' === 'form' && is_array($registered_from)) {
                foreach ($registered_from as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['registered_from'] = $registered_from;
            }
        }
        // query params
        if ($accruals !== null) {
            if ('form' === 'form' && is_array($accruals)) {
                foreach ($accruals as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['accruals'] = $accruals;
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
     * Operation updateDeal.
     *
     * 取引（収入・支出）の更新
     *
     * @param int                                    $id                 取引ID (required)
     * @param \OpenAPI\Client\Model\DealUpdateParams $deal_update_params 取引（収入・支出）の更新 (optional)
     *
     * @return \OpenAPI\Client\Model\DealResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function updateDeal($id, $deal_update_params = null)
    {
        [$response] = $this->updateDealWithHttpInfo($id, $deal_update_params);

        return $response;
    }

    /**
     * Operation updateDealWithHttpInfo.
     *
     * 取引（収入・支出）の更新
     *
     * @param int                                    $id                 取引ID (required)
     * @param \OpenAPI\Client\Model\DealUpdateParams $deal_update_params 取引（収入・支出）の更新 (optional)
     *
     * @return array of \OpenAPI\Client\Model\DealResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function updateDealWithHttpInfo($id, $deal_update_params = null)
    {
        $request = $this->updateDealRequest($id, $deal_update_params);

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
                    if ('\OpenAPI\Client\Model\DealResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\DealResponse', []),
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

            $returnType = '\OpenAPI\Client\Model\DealResponse';
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
                        '\OpenAPI\Client\Model\DealResponse',
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
     * Operation updateDealAsync.
     *
     * 取引（収入・支出）の更新
     *
     * @param int                                    $id                 取引ID (required)
     * @param \OpenAPI\Client\Model\DealUpdateParams $deal_update_params 取引（収入・支出）の更新 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function updateDealAsync($id, $deal_update_params = null)
    {
        return $this->updateDealAsyncWithHttpInfo($id, $deal_update_params)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateDealAsyncWithHttpInfo.
     *
     * 取引（収入・支出）の更新
     *
     * @param int                                    $id                 取引ID (required)
     * @param \OpenAPI\Client\Model\DealUpdateParams $deal_update_params 取引（収入・支出）の更新 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function updateDealAsyncWithHttpInfo($id, $deal_update_params = null)
    {
        $returnType = '\OpenAPI\Client\Model\DealResponse';
        $request    = $this->updateDealRequest($id, $deal_update_params);

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
     * Create request for operation 'updateDeal'.
     *
     * @param int                                    $id                 取引ID (required)
     * @param \OpenAPI\Client\Model\DealUpdateParams $deal_update_params 取引（収入・支出）の更新 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function updateDealRequest($id, $deal_update_params = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling updateDeal'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling DealsApi.updateDeal, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/deals/{id}';
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
        if (isset($deal_update_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($deal_update_params));
            } else {
                $httpBody = $deal_update_params;
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
